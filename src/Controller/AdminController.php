<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of Admin
 *
 * @author aurelien.stride
 * @Route("/admin")
 */
class AdminController extends AbstractController {

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/message-users", name="admin_message-users")
     */
    public function messageUsers() {

        $pages = \App\Controller\AdminController::getAdminPages();

        return $this->render('admin/message.html.twig', array(
                    'pages' => $pages,
        ));
    }

    /**
     * @Route("/update-one-field", name="admin_update1field")
     */
    public function update1field(Request $request) {

        $pages = \App\Controller\AdminController::getAdminPages();

        $em = $this->getDoctrine()->getManager();

        $selectEntity = $request->get('entity');
        $selectEntry = $request->get('id');
        $filter = $request->get('filter');
        $postMethod = $request->request->get('method');
        $changeAll = $request->request->get('changeAll');
        $postValue = null;
        if ($postMethod)
            $postValue = $request->request->get('value_' . $postMethod);

        if (is_numeric($postValue))
            $postValue = (float) $postValue;

        $e = null;

        // List all entities
        $entities = [];
        $methods = [];
        $entityDir = realpath(__DIR__ . '/../Entity/') . '/';
        $t = scandir($entityDir);
        foreach ($t as $file):
            if (substr($file, 0, 1) == '.')
                continue;
            if (strtolower(substr($file, -4, 4)) != '.php')
                continue;
            if (is_file($entityDir . $file)):
                $name = substr($file, 0, strlen($file) - 4);
                $entities[$name] = [];
                if ($selectEntity == $name):

                    $all = $em->getRepository('\App\Entity\\' . $name)->findAll();
                    foreach ($all as $e):
                        if (($filter && stripos($e->__toString(), $filter) !== false) || !$filter)
                            $entities[$name][$e->__toString()] = $e;
                        if (!$filter && count($entities[$name]) > 10000)
                            break;
                    endforeach;
                    ksort($entities[$name]);
                    $entities[$name] = array_slice($entities[$name], 0, 11000);

                    //Méthodes
                    if ($selectEntry):
                        $e = $em->getRepository('\App\Entity\\' . $name)->find((int) $selectEntry);

                        if ($postMethod && !empty($postValue)):
                            if (is_object($e->{'get' . $postMethod}())):
                                $postValue = $em->getRepository(get_class($e->{'get' . $postMethod}()))->find((int) $postValue);
                            endif;
                            if ($changeAll):
                                $oldValue = $e->{'get' . $postMethod}();
                                $all = $em->getRepository('\App\Entity\\' . $name)->findBy([$postMethod => $oldValue]);
                                foreach ($all as $o):
                                    $o->{'set' . $postMethod}($postValue);
                                    $em->persist($o);
                                endforeach;
                                $this->addFlash('success', "[$postMethod] set from [$oldValue] to [$postValue] for all concerned entries");
                            else:
                                $e->{'set' . $postMethod}($postValue);
                                $em->persist($e);
                                $this->addFlash('success', "[$postMethod] set to [$postValue] for entry #$selectEntry");
                            endif;
                            $em->flush();

                        endif;

                        $reflection = new \ReflectionClass("\\App\\Entity\\$name");
                        foreach ($reflection->getmethods() as $method):
                            $method = $method->getName();
                            if (substr($method, 0, 3) == 'set'):
                                $methods[substr($method, 3)]['current_value'] = $e->{'get' . substr($method, 3)}();
                                if (is_object($e->{'get' . substr($method, 3)}()))
                                    $methods[substr($method, 3)]['all_values'] = $em->getRepository(get_class($e->{'get' . substr($method, 3)}()))->findAll();
                            endif;
                        endforeach;
                        ksort($methods);
                    endif;
                endif;
            endif;
        endforeach;

        return $this->render('admin/updateOneField.html.twig', array(
                    'e' => $e,
                    'id' => $selectEntry,
                    'entity' => $selectEntity,
                    'entities' => $entities,
                    'methods' => $methods,
                    'pages' => $pages,
                    'filter' => $filter,
        ));
    }

    /**
     * @Route("/", name="admin_index")
     */
    public function index(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $tLogAs = [];
        if (UserLog::isMemberOf($this->session, 'DEV_ADMIN')):
            if ($login = $request->get('log_as')):

                $ul = new UserLog($this->session, $em);
                $ul->checkAccess($login, '', null, true);
                $this->addFlash('notice', 'You\'re now logged as ' . $login);
                return $this->redirectToRoute('root');
            endif;

            $tLogAs = ApiController::call('spaccess', 'User');
        endif;

        $pages = \App\Controller\AdminController::getAdminPages();
        return $this->render('admin.html.twig', array(
                    'pages' => $pages,
                    'logAs' => $tLogAs,
        ));
    }

    public static function getAdminPages() {
        $t = scandir(__DIR__);
        $pages = ['Admin home' => 'admin_index'];
        foreach ($t as $file):
            if ($file == 'AdminController.php')
                continue;
            $f = file_get_contents(__DIR__ . '/' . $file);
            $pos = strpos($f, '@Route("/admin/');
            if ($pos !== false):
                $f = substr($f, $pos + 8);
                $page = substr($file, 0, strlen($file) - 14);
                $route = substr($f, strpos($f, '@Route("/", name="') + strlen('@Route("/", name="'));
                $route = substr($route, 0, strpos($route, '"'));
                $page = preg_split('/(?=[A-Z])/', $page);
                $page = trim(implode(' ', $page));
                $pages[$page] = $route;
            endif;
        endforeach;

        return $pages;
    }

}
