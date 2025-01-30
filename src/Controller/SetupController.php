<?php

namespace App\Controller;

use App\Entity\TypeOfDevice;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/setup")
 */
class SetupController extends AbstractController
{
    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/", name="setup_index")
     */
    public function index(Request $request)
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);

        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');

        return $this->render('setup/index.html.twig', [
            'typesOfDevice' => $em->getRepository(TypeOfDevice::class)->findBy([], ['Name'=>'ASC']),
            'type' => ($id ? $em->getRepository(TypeOfDevice::class)->find($id) : null),
        ]);
    }

    /**
     * @Route("/new", name="setup_new")
     */
    public function new() {
        
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
            
        $em = $this->getDoctrine()->getManager();

        return $this->render('setup/new.html.twig', array(
                    'typesOfDevice' => $em->getRepository(TypeOfDevice::class)->findBy([], ['Name'=>'ASC']),
        ));
    }
}