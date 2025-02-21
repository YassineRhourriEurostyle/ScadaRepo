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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Ldap\Ldap;

class DisplayLastValueController extends AbstractController
{
    private $entityManager;
    private $requestStack;
    private $session;

    public function __construct(EntityManagerInterface $entityManager,RequestStack $requestStack,SessionInterface $session) {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->session = $session;
    }

    /**
     * @Route("/displaylastvalue", name="displaylastvalue_index")
     */
    public function index(Request $request)
    {
        //get values with get method entered by user
        $idSite = $request->query->get('idSite', 120);
        $idMac = $request->query->get('idmac');
        $idMould = $request->query->get('idmould');

        // sites for the site dropdown
        $sites = $this->entityManager->getRepository(Sites::class)->findBy([], ['idsites' => 'ASC']);

        // machines
        $machines = $this->entityManager->getRepository(ConfigMachines::class)->findBy(['idsite' => $idSite], ['macreference' => 'ASC']);

        // moulds
        $tools = $this->entityManager->getRepository(ConfigTools::class)->findBy(['idsite' => $idSite], ['toolreference' => 'ASC']);


        //get values from database in records repository and send to the page
        $recordData = [];
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

        return $this->render('display_last_value/index.html.twig', [
            'sites' => $sites,
            'machines' => $machines,
            'tools' => $tools,
            'recordData' => $recordData,
        ]);
    }
    /**
     * @Route("/displaylastvalue/get-machines", name="get_machines", methods={"GET"})
     */
    public function getMachines(Request $request): Response
    {
        $idSite = $request->query->get('idSite');

        if (!$idSite) {
            return $this->json(['error' => 'Site ID is required'], 400);
        }

        $machines = $this->entityManager->getRepository(ConfigMachines::class)->findBy(['idsite' => $idSite]);

        $data = [];
        foreach ($machines as $machine) {
            $data[] = [
                'id' => $machine->getIdCfgMachine(),
                'name' => $machine->getMacReference(),
            ];
        }

        return $this->json($data);
    }

    /**
     * @Route("/displaylastvalue/get-molds", name="get_molds", methods={"GET"})
     */
    public function getMolds(Request $request): Response
    {
        $idSite = $request->query->get('idSite');

        if (!$idSite) {
            return $this->json(['error' => 'Site ID is required'], 400);
        }

        $tools = $this->entityManager->getRepository(ConfigTools::class)->findBy(['idsite' => $idSite], ['toolreference' => 'ASC']);

        $data = [];
        foreach ($tools as $tool) {
            $data[] = [
                'id' => $tool->getIdcfgtool(),
                'name' => $tool->getToolreference(),
            ];
        }

        return $this->json($data);
    }    
}
