<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

namespace App\Controller;

use App\Service\UserLog;
use App\Entity\Sites;
use App\Entity\DataCycle;
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

/**
 * @Route("/datacycle")
 */
class DataCycleController extends AbstractController
{
    private $session;
    private $entityManager;

    public function __construct(SessionInterface $session,EntityManagerInterface $entityManager) {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="datacycle_index")
     */
    public function index(Request $request)
    {
        //get values with get method entered by user
        $idSite = $request->query->get('idSite');
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
        if ($idMac || $idMould) {
        $records = $this->entityManager->getRepository(DataCycle::class)->findLastValues($idMac, $idMould);
            foreach ($records as $record) {
                $recordData[] = [
                    'Mould'=> $record['idCfgTool'],
                    'DateRecord' => $record['DataCycleDateUTC'],
                    'ParamName' => $record['paramname'],
                    'ParamValue' => $record['DataValue'],
                    'StdValue' => null,
                    'ToleranceMini' => null,
                    'ToleranceMaxi' => null,
                    'ToolReference' => $record['toolreference'],
                ];
            }
        }
        return $this->render('data_cycle/index.html.twig', [
            'sites' => $sites,
            'machines' => $machines,
            'tools' => $tools,
            'recordData' => $recordData,
        ]);
    }
}
