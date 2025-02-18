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
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\AuthGroupes;



/**
 * @Route("/authusers")
 */
class AuthUsersController extends AbstractController
{
    private $session;
    private $em;
    public function __construct(SessionInterface $session,EntityManagerInterface $em) {
        $this->session = $session;
        $this ->em = $em;
    }
    private function checkUserGroup() {
        // Get the user's groups
        $userGroups = UserLog::GroupOfUser($this->session, $this->em);
        
        // Check if the user is in group 1
        $isInGroup1 = in_array(1, $userGroups); // If group 1 is in the list of user groups
    
        if (!$isInGroup1) {
            // Set the flash error message
            $this->session->set('errorFlash', "You must be in Group 1 to access this section.");
            
            // Throw AccessDeniedException to block access
            throw new AccessDeniedException('');
        }
    }
    
    /**
     * @Route("/", name="auth_users_index")
     */
    public function index(AuthUsersRepository $repository): Response
    {
        $this->checkUserGroup();
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
        $this->checkUserGroup();

        if ($request->isMethod('POST')) {
            $user = new AuthUsers();
            $user->setAdLogin($request->request->get('ad_login'));
            $user->setDateutccreation(new \DateTime());

            // Persist user first so it gets an ID
            $em->persist($user);
            $em->flush();

            // Retrieve multiple group IDs from form
            $groupIds = $request->request->get('id_group_usr', []);

            if (!empty($groupIds)) {
                foreach ($groupIds as $groupId) {
                    $group = $em->getRepository(AuthGroupes::class)->find($groupId);

                    if ($group) {
                        // Add the group to the user
                        $em->getRepository(AuthUsers::class)->addGroupsToUser($user->getId(), $groupId);
                    }
                }

                $this->addFlash('success', 'Groups added to user successfully.');
            }

            return $this->redirectToRoute('auth_users_index');
        }

        // Fetch all available groups
        $groups = $em->getRepository(AuthGroupes::class)->findAll();

        return $this->render('auth_users/new.html.twig', [
            'groups' => $groups,
        ]);
    }
    /**
     * Edit a user
     * @Route("/{id}/edit", name="auth_users_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AuthUsers $user, EntityManagerInterface $em): Response
    {
        // Check if the request is a POST request (form submission)
        if ($request->isMethod('POST')) {
            // Get the selected group ID from the form for adding/removing
            $groupId = $request->request->get('group_id'); // Field for adding/removing a group
            $action = $request->request->get('action'); // 'add' or 'remove' action
            
            if ($groupId) {
                // Check if the action is "add" and if the user is not already in the group
                if ($action === 'add') {
                    // Loop through the groups of the user and check if the group ID already exists
                    $isGroupAlreadyAdded = false;
                    foreach ($user->getGroups() as $group) {
                        if ($group->getIdgroupusr() == $groupId) {
                            $isGroupAlreadyAdded = true;
                            break;
                        }
                    }
            
                    if ($isGroupAlreadyAdded) {
                        // Group is already added to the user, handle this case
                        $this->addFlash('error', 'User is already in this group.');
                    } else {
                        // Add the group to the user using the repository method
                        $em->getRepository(AuthUsers::class)->addGroupsToUser($user->getId(), $groupId);
                        $this->addFlash('success', 'Group added to user successfully.');
                    }
                }
            
                // Check if the action is "remove" and if the user is currently in the group
                elseif ($action === 'remove') {
                    $isGroupFound = false;
                    foreach ($user->getGroups() as $group) {
                        if ($group->getIdgroupusr() == $groupId) {
                            $isGroupFound = true;
                            break;
                        }
                    }
            
                    if (!$isGroupFound) {
                        // User is not part of this group, handle this case
                        $this->addFlash('error', 'User is not in this group.');
                    } else {
                        // Remove the group from the user using the repository method
                        $em->getRepository(AuthUsers::class)->removeGroupsFromUser($user->getId(), $groupId);
                        $this->addFlash('success', 'Group removed from user successfully.');
                    }
                }
            }

            // Optionally, you can also process any other data like updating user details
            $user->setAdLogin($request->request->get('ad_login'));

            // Persist changes to the user
            $em->persist($user);
            $em->flush();

            // Redirect to the list of users after the operation is successful
            return $this->redirectToRoute('auth_users_index');
        }

        // Fetch all available groups to allow the user to select a group
        $groups = $em->getRepository(AuthGroupes::class)->findAll();

        // Render the form and pass necessary data
        return $this->render('auth_users/edit.html.twig', [
            'user' => $user,
            'groups' => $groups, // Pass available groups to the view
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
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            // Remove user from all groups first
            foreach ($user->getGroups() as $group) {
                $user->removeGroup($group);
            }

            $em->persist($user);
            $em->flush();

            // Now delete the user
            $em->remove($user);
            $em->flush();

            $this->addFlash('success', 'User deleted successfully.');
        } else {
            $this->addFlash('error', 'Invalid CSRF token.');
        }

        return $this->redirectToRoute('auth_users_index');
    }

    /**
     * @Route("/add-group-to-user", name="add_group_to_user")
     */
    public function addGroupToUser(EntityManagerInterface $em): Response
    {
        // Find the user by ID (for example, user with ID = 7)
        $userId = 7;
        $user = $em->getRepository(AuthUsers::class)->find($userId);

        if (!$user) {
            // Handle case where the user is not found
            return new Response('User not found');
        }

        // Find the group you want to add to the user (e.g., group with ID = 1)
        $groupId = 1; // Change this to the ID of the group you want to add
        $group = $em->getRepository(AuthGroupes::class)->find($groupId);

        if (!$group) {
            // Handle case where the group is not found
            return new Response('Group not found');
        }

        // Now call the custom method to add the group to the user
        $this->em->getRepository(AuthUsers::class)->addGroupsToUser($userId, $groupId);

        // Optionally, reload the user to confirm the group was added
        $user = $em->getRepository(AuthUsers::class)->find($userId);

        // Optionally, dump to verify
        dump($user->getGroups());

        return new Response('Group added to user successfully');
    }


}
