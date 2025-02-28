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
use App\Entity\Parameters;
use App\Entity\SettingsStandard;
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
     * @Route("/displaylastvalues", name="datacycle_index")
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

    /**
     * @Route("/displayoneparameter", name="datacycle_displayoneparameter")
     */
    public function displayoneparameter(Request $request)
    {
        //UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        //$em = $this->getDoctrine()->getManager();

        //get all values by get method entered by user in page to use them
        $idSite = $request->query->get('idSite');
        $idMac = $request->query->get('idmac');
        $idMould = $request->query->get('idmould');
        $idParam = $request->query->get('idparam');
        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');

        //find the parameter selected by user in table in database
        $paramnamechart = null;
        if ($idParam) {
            $selectedParameter = $this->entityManager->getRepository(Parameters::class)->find($idParam);
            $paramnamechart = $selectedParameter ? $selectedParameter->getParamname() : null;
        }

        // all sites for dropdown
        $sites = $this->entityManager->getRepository(Sites::class)->findBy([], ['idsites' => 'ASC']);

        // machines
        $machines = $this->entityManager->getRepository(ConfigMachines::class)->findBy(['idsite' => $idSite], ['macreference' => 'ASC']);

        // moulds
        $tools = $this->entityManager->getRepository(ConfigTools::class)->findBy(['idsite' => $idSite], ['toolreference' => 'ASC']);
        
        //Fetch parameters
        $parameters = $this->entityManager->getRepository(Parameters::class)->findBy([], ['idparameters' => 'ASC']);
        
        //Dates
        $dateNow = new \DateTime('now');
        $txtDateFin = $dateNow->format("Y-m-d H:i");
        $dateNow->modify("-1 day");
        $txtDateDebut = $dateNow->format("Y-m-d H:i");

        $records = [];
        $paramValues = [];
        $stdValue = 0.00;
        $toleranceMin = 0.00;
        $toleranceMax = 0.00;
        if ($idMac) {
            $records = $this->entityManager->getRepository(DataCycle::class)->findRecords($idMac, $idMould, $idParam, $startDate, $endDate);
            $standardSettings = $this->entityManager->getRepository(SettingsStandard::class)->findStandardSettings($idSite, $idMac, $idMould, $idParam);

            if(!empty($standardSettings)){
                foreach ($standardSettings as $setting) {
                    $stdValue = $setting->getStdValue();
                    $toleranceMin = $setting->getToleranceMini();
                    $toleranceMax = $setting->getToleranceMaxi();
                    
                    $paramValues[] = [
                        'stdValue' => $stdValue,
                        'toleranceMin' => $toleranceMin,
                        'toleranceMax' => $toleranceMax,
                    ];
                }
            }
        }

        return $this->render('data_cycle/data_cycle_display_one_parameter.html.twig', [
            'sites' => $sites,
            'machines' => $machines,
            'tools' => $tools,
            'parameters' => $parameters,
            'txtDateDebut' => $txtDateDebut,
            'txtDateFin' => $txtDateFin,
            'records' => $records,
            'stdValue' => $stdValue,
            'toleranceMin' => $toleranceMin,
            'toleranceMax' => $toleranceMax,
            'paramnamechart' => $paramnamechart,
            'paramvalues'=>$paramValues,

        ]);
    }
    /**
     * @Route("/displaymultipleparameters", name="datacycle_displaymultipleparameters")
     */
    public function displaymultipleparameters(Request $request)
    {
        //UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        //$em = $this->getDoctrine()->getManager();
        //get all values by get method entered by user in page to use them
        $idSite = $request->query->get('idSite');
        $idMac = $request->query->get('idmac');
        $idMould = $request->query->get('idmould');
        $idParams = $request->query->all('idparam');
        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');

        //find the parameter selected by user in table in database
        $paramnamechart = null;
        $selectedParameters = [];
        if ($idParams) {
            $selectedParameters = $this->entityManager->getRepository(Parameters::class)->findBy(['idparameters' => $idParams]);
            foreach ($selectedParameters as $param) {
                $paramnamechart[] = $param->getParamname();
            }
        }

        // all sites for dropdown
        $sites = $this->entityManager->getRepository(Sites::class)->findBy([], ['idsites' => 'ASC']);

        // machines
        $machines = $this->entityManager->getRepository(ConfigMachines::class)->findBy(['idsite' => $idSite], ['macreference' => 'ASC']);

        // moulds
        $tools = $this->entityManager->getRepository(ConfigTools::class)->findBy(['idsite' => $idSite], ['toolreference' => 'ASC']);
        
        //Fetch parameters
        $parameters = $this->entityManager->getRepository(Parameters::class)->findBy([], ['idparameters' => 'ASC']);
        
        //Dates
        $dateNow = new \DateTime('now');
        $txtDateFin = $dateNow->format("Y-m-d H:i");
        $dateNow->modify("-1 day");
        $txtDateDebut = $dateNow->format("Y-m-d H:i");

        $records = [];
        $paramValues = [];
        $stdValue = 0.00;
        $toleranceMin = 0.00;
        $toleranceMax = 0.00;
        if ($idMac) {
            $records = $this->entityManager->getRepository(DataCycle::class)->findRecordsMultipleParameters($idMac, $idMould, $idParams, $startDate, $endDate);
            $standardSettings = $this->entityManager->getRepository(SettingsStandard::class)->findStandardSettingsParamaters($idSite, $idMac, $idMould, $idParams);
            if(!empty($standardSettings)){
                foreach ($standardSettings as $setting) {
                    $stdValue = $setting->getStdValue();
                    $toleranceMin = $setting->getToleranceMini();
                    $toleranceMax = $setting->getToleranceMaxi();
                
                    $paramValues[] = [
                        'stdValue' => $stdValue,
                        'toleranceMin' => $toleranceMin,
                        'toleranceMax' => $toleranceMax,
                    ];
                }
            }
        }
        
        return $this->render('data_cycle/data_cycle_display_multiple_parameters.html.twig', [
            'sites' => $sites,
            'machines' => $machines,
            'tools' => $tools,
            'parameters' => $parameters,
            'txtDateDebut' => $txtDateDebut,
            'txtDateFin' => $txtDateFin,
            'records' => $records,
            'stdValue' => $stdValue,
            'toleranceMin' => $toleranceMin,
            'toleranceMax' => $toleranceMax,
            'paramnamechart' => $paramnamechart,
            'paramvalues'=>$paramValues,
            'selectedparameters'=>$selectedParameters,
        ]);
    }
}
