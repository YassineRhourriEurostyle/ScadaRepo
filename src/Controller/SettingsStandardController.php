<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SettingsStandard;
use App\Form\SettingsStandardType;

/**
 * @Route("/settingsstandard")
 */
class SettingsStandardController extends AbstractController
{
    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/", name="settingsstandard_index")
     */
    public function index(Request $request)
    {
        //UserLog::isLoggedAs($this->session, UserLog::DEV_ADMIN);
        
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
