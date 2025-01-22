<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\VwSitesMachinesMoldsVersions;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/vwsitesmachinesmoldsversions")
 */
class VwSitesMachinesMoldsVersionsController extends AbstractController
{
    private $entityManager;
    private $session;

    public function __construct(EntityManagerInterface $entityManager,SessionInterface $session) {
        $this->session = $session;
        $this->entityManager=$entityManager;
    }

    /**
     * @Route("/", name="setting_list_index")
     */
    public function index()
    {
        //UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        $data = $this->entityManager->getRepository(VwSitesMachinesMoldsVersions::class)->filtrer();
        $em = $this->getDoctrine()->getManager();
        
        return $this->render('vw_sites_machines_molds_versions/index.html.twig', [
            'controller_name' => 'VwSitesMachinesMoldsVersionsController',
            'data' => $data,

        ]);
    }
}
