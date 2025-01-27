<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SettingsStandard;
use App\Form\SettingsStandardType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\AuthGroupes;


/**
 * @Route("/settingsstandard")
 */
class SettingsStandardController extends AbstractController
{
    private $session;
    private $entityManager;
    public function __construct(SessionInterface $session, EntityManagerInterface $entityManager ) {
        $this->session = $session;
        $this->entityManager = $entityManager;

    }

    /**
     * @Route("/", name="settingsstandard_index")
     */
    public function index(Request $request)
    {
        //UserLog::isLoggedAs($this->session, UserLog::DEV_ADMIN);
        $grpNum = UserLog::GroupOfUser($this->session,$this->entityManager);
        $grpDescription = $this->entityManager->getRepository(AuthGroupes::class)->findGroupDescriptionById($grpNum);
        if ($grpNum == 1) {
        } else {
            $this->session->set('errorFlash', "Your group \"".$grpDescription."\" do not have required permissions");
            // Throw an AccessDeniedException if $val is not 2
            throw new AccessDeniedException('');
        }
        $em = $this->getDoctrine()->getManager();
        $settingsStandard = new SettingsStandard();

        // Create the form
        $form = $this->createForm(SettingsStandardType::class, $settingsStandard);

        // Handle the form submission
        $form->handleRequest($request);
        return $this->render('settings_standard/index.html.twig', [
            'controller_name' => 'SettingsStandardController',
            'form' => $form->createView()
        ]);
    }
}
