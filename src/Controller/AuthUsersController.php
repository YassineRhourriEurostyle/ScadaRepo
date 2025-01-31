<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthUsersRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\AuthUsers;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @Route("/authusers")
 */
class AuthUsersController extends AbstractController
{
    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/", name="auth_users_index")
     */
    public function index(AuthUsersRepository $repository): Response
    {
        $users = $repository->findAll();

        return $this->render('auth_users/index.html.twig', [
            'users' => $users,
        ]);
    }
/**
     * Add a new user
     * @Route("/new", name="auth_users_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $user = new AuthUsers();
            $user->setAdLogin($request->request->get('ad_login'));
            $user->setIdgroupusr($request->request->get('id_group_usr'));
            $user->setDateutccreation(new \DateTime());
            
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('auth_users_index');
        }

        return $this->render('auth_users/new.html.twig');
    }
    /**
     * Edit a user
     * @Route("/{id}/edit", name="auth_users_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AuthUsers $user, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $user->setAdLogin($request->request->get('ad_login'));
            $user->setIdgroupusr($request->request->get('id_group_usr'));
            $user->setDateutcmodification(new \DateTime());

            $em->flush();

            return $this->redirectToRoute('auth_users_index');
        }

        return $this->render('auth_users/edit.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * Confirm Deletion of a user
     * @Route("/{id}/confirm-delete", name="auth_users_confirm_delete", methods={"GET"})
     */
    public function confirmDelete(AuthUsers $user): Response
    {
        return $this->render('auth_users/delete.html.twig', [
            'user' => $user,
        ]);
    }
    /**
     * Delete a user
     * @Route("/{id}/delete", name="auth_users_delete", methods={"POST"})
     */
    public function delete(Request $request, AuthUsers $user, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getIduser(), $request->request->get('_token'))) {
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('auth_users_index');
  
    }

}
