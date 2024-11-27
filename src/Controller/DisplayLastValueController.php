<?php

namespace App\Controller;

use App\Service\UserLog;
use App\Entity\Sites;
use App\Entity\Site;
use App\Entity\ConfigMachines; 
use App\Entity\ConfigTools; 
use App\Entity\Records; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class DisplayLastValueController extends AbstractController
{
    private $entityManager;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager,RequestStack $requestStack) {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/displaylastvalue", name="displaylastvalue_index")
     */
    public function index(Request $request)
    {
        $idSite = $request->query->get('idSite', 120);
        $idMac = $request->query->get('idmac');
        $idMould = $request->query->get('idmould');

        // Fetch all sites for the site dropdown
        $sites = $this->entityManager->getRepository(Sites::class)->findBy([], ['idsites' => 'ASC']);

        // Fetch machines for selected site
        $machines = $this->entityManager->getRepository(ConfigMachines::class)->findBy(['idsite' => $idSite], ['macreference' => 'ASC']);

        // Fetch moulds for selected site
        $tools = $this->entityManager->getRepository(ConfigTools::class)->findBy(['idsite' => $idSite], ['toolreference' => 'ASC']);

        // If initialized, fetch the last records based on filters
        $recordData = [];
        if ($request->query->get('initPage')) {
            $records = $this->entityManager->getRepository(Records::class)->findLastValues($idSite, $idMac, $idMould);
            foreach ($records as $record) {
                $recordData[] = [
                    'Mould'=> $record['idmould'],
                    'DateRecord' => $record['daterecord'],
                    'ParamName' => $record['paramname'],
                    'ParamValue' => $record['paramvalue'],
                    'StdValue' => null,
                    'ToleranceMini' => null,
                    'ToleranceMaxi' => null,
                    'ToolReference' => $record['toolreference'],
                ];
            }
        }

        return $this->render('display_last_value/index.html.twig', [
            'sites' => $sites,
            'machines' => $machines,
            'tools' => $tools,
            'recordData' => $recordData,
        ]);
    }
    /**
     * @Route("/displaylastvalue/testco", name="testco")
     */
    public function testco(Request $request): Response
    {
        try {
            $sites2 = $this->entityManager->getRepository(Site::class)->findBy([], ['Code' => 'DESC']);
    
            return $this->render('display_last_value/test.html.twig', [
                'sites2' => $sites2, 
            ]);
        } catch (AccessDeniedException $e) {
            return $this->render('display_last_value/test.html.twig', [
                'message' => $e->getMessage(), 
            ]);
        }  
    }
    
}
