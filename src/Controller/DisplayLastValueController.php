<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DisplayLastValueController extends AbstractController
{
    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/displaylastvalue", name="displaylastvalue_index")
     */
    public function index()
    {
        //UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        //$em = $this->getDoctrine()->getManager();
        
        return $this->render('display_last_value/index.html.twig', [
            'controller_name' => 'DisplayLastValueController',
        ]);
    }
}
