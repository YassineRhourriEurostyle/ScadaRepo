<?php

namespace App\Controller;

use App\Entity\Sites; // Assuming "Site" represents the `sites` table
use App\Entity\ConfigMachines; // Assuming "ConfigMachines" represents `config_machines`
use App\Entity\ConfigTools; // Assuming "ConfigTools" represents `config_tools`
use App\Entity\Records; // Assuming "Records" represents `records`
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DisplayLastValueController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/displaylastvalue", name="displaylastvalue_index")
     */
    public function index(Request $request)
    {
        $idSite = $request->query->get('idSite', 120); // Default site ID as in the original file
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
}
