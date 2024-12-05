<?php

namespace App\Controller;

use App\Entity\Process;
use App\Service\Encoding;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController {

    private static $sortOrder = array();
    private $session;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/{key}/{entity}", name="api_index")
     */
    public function index($key, $entity) {
        $request = Request::createFromGlobals();


        $secret = md5(basename($this->getParameter('kernel.project_dir')));
        if (strtolower($key) !== strtolower($secret)):
            return new JsonResponse(array('error' => 'Invalid API key.'));
        endif;

        $em = $this->getDoctrine()->getManager();
        try {
            $reflection = new \ReflectionClass("\\App\\Entity\\$entity");
        } catch (Exception $ex) {
            return new JsonResponse(array('error' => 'Invalid entity: ' . $entity));
        }
        $joins = [];
        $joinLetter = 'a';
        foreach ($reflection->getmethods() as $method):
            if (substr($method->getName(), 0, 3) == 'get'):
                $reflectionM = new \ReflectionMethod("\\App\\Entity\\$entity", $method->getName());
                $typeClass = $reflectionM->getReturnType();
                if ($typeClass && class_exists($typeClass->getName())):
                    $joins[$joinLetter] = ' LEFT JOIN m.' . substr($method->getName(), 3) . ' ' . $joinLetter;
                    $joinLetter = chr(ord($joinLetter) + 1);
                endif;
            endif;
        endforeach;


        $sql = "SELECT m";
        foreach ($joins as $joinLetter => $join):
            $sql .= ", $joinLetter";
        endforeach;
        $sql .= " FROM App\\Entity\\$entity m";
        foreach ($joins as $joinLetter => $join):
            $sql .= $join;
        endforeach;
        $sql .= " WHERE 1=1";


        //$t = $request->query->all();
        if ($request->get('filter')):
            $t = unserialize(base64_decode($request->get('filter')));
            foreach ($t as $key => $value):
                if (strpos($key, '.') === false)
                    $key = 'm.' . $key;
                if (is_array($value))
                    $sql .= " AND $key " . $value[0] . " " . (is_numeric($value[1]) ? $value[1] : "'" . $value[1] . "'");
                else
                    $sql .= " AND $key = '$value'";
            endforeach;
        endif;

        try {
            $results = $em->createQuery($sql)
                    ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        } catch (Exception $ex) {
            return new JsonResponse(array('error' => $ex->getMessage()));
        }

        return new JsonResponse($results);
    }

    /**
     */
    public static function set($project, $entity, $id, $field, $value, $getObject = false) {
//        if(!$id)
//            return [];
        //$value = str_replace('+', '%20', urlencode($value));

        $url = "http://" . $project . "pls/api/save/$entity/$id/$field/" . urlencode(base64_encode($value));

        //$response = file_get_contents($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $decode = json_decode($response, 1);

        return $decode;
    }

    /**
     * @Route("/user", name="api_user")
     */
    public function getADUser() {
        $request = Request::createFromGlobals();


//        $secret = md5(basename($this->getParameter('kernel.project_dir')));
//        if (strtolower($key) !== strtolower($secret)):
//            return new JsonResponse(array('error' => 'Invalid API key.'));
//        endif;

        $em = $this->getDoctrine()->getManager();

        $ul = new UserLog($this->session, $em);
        $results = $ul->checkAccess($request->get('login'), $request->get('password'));


        return new JsonResponse($this->session->all());
    }

    /**
     * Call an internal API
     * @param string $project vehicle code
     * @param string $entity entity to repository
     * @param type $actions two possibilities: "filter": array of Where clauses; "order": sorting
     * @return string array
     */
    public static function call($project, $entity, $actions = array('filter' => array(), 'order' => array())) {

        $url = "http://" . $project . "pls/api/" . md5($project) . "/$entity?filter=";
        if (isset($actions['filter'])):
            $url .= base64_encode(serialize($actions['filter']));
        endif;
        echo "URL: " . $url;


        $ch = curl_init();
        echo "premier";
        var_dump($ch);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo "second";
        var_dump($ch);
        $response = curl_exec($ch);
        echo "response";
        var_dump($response);
        echo "error ". curl_error($ch);
        echo "close";
        var_dump($ch);
        $decode = json_decode($response, 1);
        echo "la la";
        var_dump($decode);

        if (is_array($decode) && isset($actions['order'])):
            self::$sortOrder = $actions['order'];
            usort($decode, array('App\Controller\ApiController', 'order'));
        endif;

        echo "la ";
        var_dump($decode);

        return $decode;
    }

    /**
     *
     * @param string $login
     * @param string $password
     * @return array or false if error
     */
    public static function log(&$session, $login, $password) {
        $project = 'common';
        $url = "http://" . $project . "pls/api/user";
        $params = ['login' => $login, 'password' => $password];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                "login=" . urlencode($login) . "&password=" . urlencode($password));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $decode = json_decode($response, 1);
        foreach ($decode as $key => $value):
            $session->set($key, $value);
        endforeach;

        return isset($decode['logged']);
    }

    /**
     * Private function to order API result
     * @param array $a First item to compare
     * @param array $b Second item to compare
     * @return reordered array
     */
    private static function order($a, $b) {
        foreach (self::$sortOrder as $key => $val):
            if (!isset($a[$key]))
                continue;
            if (is_numeric($a[$key]))
                $a[$key] = (int) $a[$key];
            if (is_numeric($b[$key]))
                $b[$key] = (int) $b[$key];

            if (strToUpper($val) == 'ASC')
                return $a[$key] > $b[$key];
            else
                return $b[$key] > $a[$key];
        endforeach;
    }

    /**
     * Save
     * @Route("/save/{entity}/{id}/{field}/{value}", name="api_save")
     * @param type $entity
     * @param type $id
     * @param type $field
     * @param type $value
     */
    public function save($entity, $id, $field, $value) {
        $em = $this->getDoctrine()->getManager();
        if ($id):
            $e = $em->getRepository("\App\Entity\\$entity")->find($id);
        else:
            $class = "\App\Entity\\$entity";
            $e = new $class;
        endif;

        if ($this->is_base64_encoded($value))
            $value = Encoding::toUtf8(base64_decode($value));

        $v = $value;

        if ($value == '[null]'):
            $value = null;
        else:
            $reflection = new \ReflectionMethod("\App\Entity\\$entity", 'set' . $field);
            $typeClass = $reflection->getParameters()[0]->getClass();
            if ($typeClass !== null && !in_array($typeClass->getName(), ['DateTime', 'DateTimeInterface'])):
                $value = $em->getRepository($typeClass->getName())->find($value);
            elseif ($typeClass !== null && in_array($typeClass->getName(), ['DateTime', 'DateTimeInterface'])):
                $value = new \DateTime($value);
            endif;
        endif;
        $response = new JsonResponse();
        try {
            $e->{'set' . $field}($value);
            $em->persist($e);
            $em->flush();
        } catch (TypeError $ex) {
            $response->setData(['id' => $e->getId(), 'message' => '[' . $field . '] not set to [' . strip_tags($v) . '] : ' . $ex->getMessage() . '.', 'status' => 'error']);
            return $response;
        } catch (UniqueConstraintViolationException $ex) {
            $response->setData(['id' => $e->getId(), 'message' => '[' . $field . '] not set to [' . strip_tags($v) . '] : ' . $ex->getMessage() . '.', 'status' => 'error']);
            return $response;
        } catch (Exception $ex) {
            $response->setData(['id' => $e->getId(), 'message' => '[' . $field . '] not set to [' . strip_tags($v) . '].', 'status' => 'error']);
            return $response;
        }
        $response->setData(['id' => $e->getId(), 'message' => '[' . $field . '] set to [' . strip_tags($v) . '].', 'status' => 'success']);
        return $response;
    }

    private function is_base64_encoded($data) {
        return (!is_numeric($data)) && (base64_encode(base64_decode($data)) === $data);
    }

}
