<?php

namespace App\Controller;

use App\Entity\UserAccess;
use App\Form\UserAccessType;
use App\Repository\UserAccessRepository;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/useraccess")
 */
class UserAccessController extends AbstractController {

    private $pages;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
        $this->pages = \App\Controller\AdminController::getAdminPages();
    }

    /**
     * @Route("/", name="useraccess_index", methods={"GET"})
     */
    public function index(UserAccessRepository $userAccessRepository): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);


        return $this->render('user_access/index.html.twig', [
                    'pages' => $this->pages,
                    'useraccesses' => $userAccessRepository->findBy([], ['id' => 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="useraccess_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        $userAccess = new UserAccess();
        $form = $this->createForm(UserAccessType::class, $userAccess, [
            'em' => $this->getDoctrine()->getManager()
        ]);
        $form->handleRequest($request);

        if (is_array($request->request->get('user_access')))
            $userAccess->setValue($request->request->get('user_access')['Value']);

        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userAccess);
            $entityManager->flush();

            if ($form->getClickedButton() && 'saveAndAdd' === $form->getClickedButton()->getName()) {
                $this->addFlash('notice', 'Record created, ready to add a new one.');
                return $this->redirectToRoute('useraccess_new');
            }

            $this->addFlash('notice', 'Record created.');
            return $this->redirectToRoute('useraccess_index');
        }

        return $this->render('user_access/new.html.twig', [
                    'pages' => $this->pages,
                    'useraccess' => $userAccess,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="useraccess_show", methods={"GET"})
     */
    public function show(UserAccess $userAccess): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        return $this->render('user_access/show.html.twig', [
                    'pages' => $this->pages,
                    'useraccess' => $userAccess,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="useraccess_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserAccess $userAccess): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        $form = $this->createForm(UserAccessType::class, $userAccess, [
            'em' => $this->getDoctrine()->getManager()
        ]);
        $form->handleRequest($request);

        var_dump($request->request->get('user_access[Value]'));

        if ($form->isSubmitted()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'Record updated.');
            return $this->redirectToRoute('useraccess_index');
        }

        return $this->render('user_access/edit.html.twig', [
                    'pages' => $this->pages,
                    'useraccess' => $userAccess,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="useraccess_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserAccess $userAccess): Response {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        if ($this->isCsrfTokenValid('delete' . $userAccess->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userAccess);
            $entityManager->flush();
        }

        return $this->redirectToRoute('useraccess_index');
    }

    /**
     * @Route("/list-values/{entityField}", name="useraccess_listvalues", methods={"GET"})
     */
    public function listValues(Request $request, ?string $entityField) {
        $entityManager = $this->getDoctrine()->getManager();
        $t = explode('.', $entityField);
        $allValues = $entityManager->getRepository('\\App\\Entity\\' . $t[0])->findAll();
        $choices = [];
        foreach ($allValues as $value):
            $v = $value->{"get" . $t[1]}();
            if (!is_object($v))
                $choices[$v] = $v;
            else
                $choices[$v->__toString()] = $v->__toString();
        endforeach;
        ksort($choices);

        return new \Symfony\Component\HttpFoundation\JsonResponse($choices);
    }

}
