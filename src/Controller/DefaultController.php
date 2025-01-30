<?php

namespace App\Controller;

use App\Entity\Log;
use App\Service\UserLog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends AbstractController {

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/", name="root")
     */
    public function index() {

        return $this->render('home.html.twig');
//        $service = new HomeRedirection();
//        return $this->redirectToRoute($service::redirectTo($this->session->get('memberOf'), $this->session));
    }

    /**
     * @Route("/help-center", name="help")
     */
    public function help() {
        $filename = __DIR__ . '/../../composer.json';
        $composerData = json_decode(file_get_contents($filename), true);

        $version = $composerData['extra']['symfony']['require'];
        $t = explode('.', $version);
        $version = $t[0] . '.' . $t[1];
        return $this->render('_help/index.html.twig', [
                    'version' => $version
        ]);
    }

    /**
     * Save a specific property on a record
     * @Route("/save_property", name="save_property")
     * @Method({"POST"})
     * @TODO return explicit message
     */
    public function saveProperty(Request $request) {
        $field = $request->request->get('field');
        $id = (int) $request->request->get('id');
        $value = $request->request->get('value');
        $t = explode('.', $field);
        $entity = $t[0];
        $attr = $t[1];
        $relation = isset($t[2]) ? $t[2] : $t[1];

        $em = $this->getDoctrine()->getManager();
        $response = new JsonResponse();


        if ($id):
            /*
             * Linked record
             */

            if (class_exists('\\App\\Entity\\' . $relation)):
                if (is_numeric($value))
                    $value = $em->getRepository('\\App\\Entity\\' . $relation)->find($value);
                else
                    $value = null;
            else:
                if ($this->check_your_datetime($value)) {
                    $v = new \DateTime($value);
                    $value = $v;
                } elseif (is_numeric(str_replace(',', '.', $value))) {
                    $value = (float) str_replace(',', '.', $value);
                }
            endif;


            $object = $em->getRepository('\\App\\Entity\\' . $entity)->find($id);
            if ($object):
                $object->{'set' . $attr}($value);
                $em->persist($object);
                $em->flush();
                if (gettype($value) == "object" && method_exists($value, 'format')) {
                    $value = $value->format('Y-m-d');
                }
                $response->setData(['message' => '[' . $attr . '] set to [' . strip_tags($value) . '].', 'status' => 'success']);
            else:
                $response->setData(['message' => 'No record #' . $id . ' for ' . $entity . ' found.', 'status' => 'notice']);
            endif;
        else:
            $response->setData(['message' => 'No record #' . $id . ' for ' . $entity . ' found.', 'status' => 'notice']);
        endif;

        return $response;
    }

    private function check_your_datetime($x) {
        return (date('Y-m-d', strtotime($x)) == $x);
    }

    /**
     * @Route("/smartsign/{id}", name="smart_sign")
     * @Method({"GET"})
     */
    public function smartSign($id) {

        $id = strtolower($id) ^ strtoupper($id) ^ $id;

        $data = json_decode(base64_decode($id), 1);
        $em = $this->getDoctrine()->getManager();

        $id = $data['id'];
        $entity = $data['entity'];

        $o = $em->getRepository('\App\Entity\\' . $entity)->find($id);

        if ($o->getNextSignatory() !== $this->session->get('logged') && !UserLog::isMemberOf($this->session, UserLog::DEV_ADMIN)):
            $this->session->set('errorFlash', "You're not allowed to sign this yet.");
            throw new AccessDeniedException('');
        endif;

        return $this->render('_smartsign.html.twig', array(
                    'action' => $data['action'],
                    'o' => $o,
        ));
    }

    /**
     * Makes a search according to controllers that can display/edit entities.
     * @Route("/search", name="search")
     * @param Request $request
     */
    public function search(Request $request) {
        $search = $request->get('q');

        if (!$search):
            return $this->redirectToRoute('root');
        endif;
        $results = [];
        $em = $this->getDoctrine()->getManager();

        //Find all entities that have a display mode in controllers
        $controllersFolder = __DIR__ . '/';
        $notToSearch = ['AdminController', 'ApiController', 'CronController',
            'DefaultController', 'ExportExcelController', 'ForumController',
            'MenuController', 'SecurityController', 'SignatureController',
            'UserAccessController'];
        $t = scandir($controllersFolder);
        foreach ($t as $file):
            if (substr($file, 0, 1) == '.')
                continue;
            if (!is_file($controllersFolder . $file))
                continue;
            $class = substr($file, 0, strlen($file) - 4);
            if (in_array($class, $notToSearch))
                continue;

            $reflection = new \ReflectionClass("\\App\\Controller\\$class");
            $joins = [];
            $joinLetter = 'a';
            $url = '';
            $controllerComment = $reflection->getDocComment();
            $matches = null;
            preg_match('/@Route\(\"[\/a-z_]*\"/', $controllerComment, $matches);
            if (isset($matches[0])):
                $url .= substr($matches[0], 8);
                $url = substr($url, 0, strlen($url) - 1);
            endif;
            if (!UserLog::isMemberOf($this->session, UserLog::DEV_ADMIN) && substr($url, 0, 7) == '/admin/')
                continue;
            foreach ($reflection->getmethods() as $controllerMethod):
                $reflectionM = new \ReflectionMethod("\\App\\Controller\\$class", $controllerMethod->getName());
                $params = $reflectionM->getParameters();
                if (!count($params))
                    continue;
                $reflectionP = new \ReflectionParameter(["\\App\\Controller\\$class", $controllerMethod->getName()], $params[0]->getName());
                if (!$reflectionP->getType())
                    continue;
                if (!class_exists($reflectionP->getType()->getName()))
                    continue;
                if (substr($reflectionP->getType()->getName(), 0, 11) != 'App\Entity\\')
                    continue;

                $actionComment = $controllerMethod->getDocComment();
                $matches = null;
                preg_match('/@Route\(\"[\/a-z\{\}]*\"/', $actionComment, $matches);
                if (isset($matches[0])):
                    $url .= substr($matches[0], 8);
                    $url = substr($url, 0, strpos($url, '"'));
                endif;
                $allEntities = $em->getRepository('\\' . $reflectionP->getType()->getName())->findAll();

                //All records
                $reflection = new \ReflectionClass('\\' . $reflectionP->getType()->getName());
                foreach ($reflection->getmethods() as $method):
                    if (substr($method->getName(), 0, 3) != 'get' && $method->getName() != '__toString')
                        continue;
                    if (count($method->getParameters()))
                        continue;
                    foreach ($allEntities as $entity):
                        if (isset($results[substr($reflection->getName(), 11)][$entity->getId()]))
                            continue;
                        $get = $entity->{$method->getName()}();
                        if (is_object($get)):
                            unset($get);
                            continue;
                        endif;
                        if (!$get):
                            unset($get);
                            continue;
                        endif;
                        if (is_array($get)):
                            unset($get);
                            continue 2;
                        endif;
                        if (strpos(strtolower($get), strtolower($search)) !== false):
                            $url2 = preg_replace('/\{[a-z]*\}/', $entity->getId(), $url);
                            $results[substr($reflection->getName(), 11)][$entity->getId()] = '<a target="_blank" href="' . $url2 . '">' . str_ireplace($search, '<strong>' . $search . '</strong>', $entity) . '</a>';
                        endif;
                        unset($get);
                        unset($entity);
                    endforeach;
                    unset($method);
                endforeach;
                unset($reflection);
                unset($allEntities);
                unset($reflectionM);
                unset($reflectionP);
                unset($params);
            endforeach;
            unset($file);
        endforeach;


        return $this->render('search.html.twig', array(
                    'search' => $search,
                    'results' => $results
        ));
    }

    /**
     * List history of changes for a givhen field of a given record.
     * @Route("/log/history/{entity}/{id}", name="log_history")
     * @param Request $request
     */
    public function historyLog($entity = 'null', $id = 0) {
        $em = $this->getDoctrine()->getManager();

        $logs = $em->getRepository(Log::class)->findBy(['Entity' => $entity, 'FieldID' => $id], ['id' => 'DESC']);

        $network = [];
        $nodes = [];

        $object = $em->getRepository("\\App\\Entity\\" . $entity)->find($id);
        LogController::setNetwork($network, $nodes, $object);
        $collections = LogController::getCollections($em, $object);

        asort($nodes);

        return $this->render('log/history.html.twig', array(
                    'collections' => $collections,
                    'entity' => $entity,
                    'id' => $id,
                    'logs' => $logs,
                    'network' => $network,
                    'nodes' => $nodes,
                    'pages' => \App\Controller\AdminController::getAdminPages(),
                    'toString' => $object->__toString(),
        ));
    }

}
