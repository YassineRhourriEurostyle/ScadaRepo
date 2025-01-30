<?php

namespace App\Controller;

use App\Entity\Log;
use App\Form\LogType;
use App\Repository\LogRepository;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/log")
 */
class LogController extends AbstractController {

    private $pages;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
        $this->pages = \App\Controller\AdminController::getAdminPages();
    }

    /**
     * @Route("/", name="log_index", methods={"GET"})
     */
    public function index(LogRepository $logRepository): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        $filters = [];
        $users = [];
        $entities = [];
        $allLogs = $logRepository->findAll();
        foreach ($allLogs as $log):
            $users[$log->getUser()] = $log->getUser();
            $entities[$log->getEntity()] = $log->getEntity();
        endforeach;
        ksort($users);
        ksort($entities);
        $request = Request::createFromGlobals();
        if ($request->get('user'))
            $filters['User'] = $request->get('user');
        if ($request->get('entity'))
            $filters['Entity'] = $request->get('entity');

        return $this->render('log/index.html.twig', [
                    'entities' => $entities,
                    'entity' => $request->get('entity'),
                    'logs' => $logRepository->findBy($filters, ['id' => 'DESC'], 2000),
                    'pages' => $this->pages,
                    'user' => $request->get('user'),
                    'users' => $users,
        ]);
    }

    /**
     * @Route("/new", name="log_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        $log = new Log();
        $form = $this->createForm(LogType::class, $log);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($log);
            $entityManager->flush();

            if ($form->getClickedButton() && 'saveAndAdd' === $form->getClickedButton()->getName()) {
                $this->addFlash('notice', 'Record created, ready to add a new one.');
                return $this->redirectToRoute('log_new');
            }

            $this->addFlash('notice', 'Record created.');
            return $this->redirectToRoute('log_index');
        }

        return $this->render('log/new.html.twig', [
                    'pages' => $this->pages,
                    'log' => $log,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="log_show", methods={"GET"})
     */
    public function show(Log $log): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        $em = $this->getDoctrine()->getManager();

        $network = [];
        $nodes = [];

        $object = $em->getRepository("\\App\\Entity\\" . $log->getEntity())->find($log->getFieldID());
        $this->setNetwork($network, $nodes, $object, 0);

        asort($nodes);

        return $this->render('log/show.html.twig', [
                    'log' => $log,
                    'network' => $network,
                    'nodes' => $nodes,
                    'pages' => $this->pages,
        ]);
    }

    public static function setNetwork(&$network, &$nodes, $object, $level = 0, $maxLevel = 4) {
        if ($level == $maxLevel)
            return;
        $reflection = new \ReflectionClass(get_class($object));
        foreach ($reflection->getmethods() as $method):
            if (substr($method->getName(), 0, 3) == 'get'):
                $reflectionM = new \ReflectionMethod(get_class($object), $method->getName());
                $typeClass = $reflectionM->getReturnType();
                if ($typeClass && class_exists($typeClass->getName())):
                    $child = $object->{$method->getName()}();
                    if ($child):
                        $t = explode('\\', get_class($object));
                        $tC = explode('\\', get_class($child));
                        $network[] = [end($t) . ': ' . $object->__toString(), end($tC) . ': ' . $child->__toString()];
                        if (!isset($nodes[end($t) . ': ' . $object->__toString()]))
                            $nodes[end($t) . ': ' . $object->__toString()] = $level;
                        if (!isset($nodes[end($tC) . ': ' . $child->__toString()]))
                            $nodes[end($tC) . ': ' . $child->__toString()] = $level + 1;
                        self::setNetwork($network, $nodes, $child, $level + 1);
                    endif;
                endif;
            endif;
        endforeach;
    }

    public static function getCollections(&$em, $object) {
        $objects = [];
        $reflection = new \ReflectionClass(get_class($object));
        foreach ($reflection->getmethods() as $method):
            if (substr($method->getName(), 0, 3) == 'get'):
                $reflectionM = new \ReflectionMethod(get_class($object), $method->getName());
                $typeClass = $reflectionM->getReturnType();
                if ($typeClass && $typeClass->getName() == 'Doctrine\Common\Collections\Collection'):
                    foreach ($object->{$method->getName()}() as $sub):
                        $t = explode('\\', get_class($sub));
                        $cl = end($t);
                        $objects[$cl][$sub->getId()] = [
                            'name' => $sub->__toString(),
                            'logs' => $em->getRepository(Log::class)->findBy(['Entity' => $cl, 'FieldID' => $sub->getId()], ['id' => 'DESC'])
                        ];
                    endforeach;
                endif;
            endif;
        endforeach;

        return $objects;
    }

    /**
     * @Route("/{id}/edit", name="log_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Log $log): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        $form = $this->createForm(LogType::class, $log);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'Record updated.');
            return $this->redirectToRoute('log_index');
        }

        return $this->render('log/edit.html.twig', [
                    'pages' => $this->pages,
                    'log' => $log,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="log_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Log $log): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        if ($this->isCsrfTokenValid('delete' . $log->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($log);
            $entityManager->flush();
        }

        return $this->redirectToRoute('log_index');
    }

}
