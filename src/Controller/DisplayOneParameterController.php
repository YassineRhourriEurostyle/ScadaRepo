<?php

namespace App\Controller;

use App\Entity\Parameters; 
use App\Entity\SettingsStandard; 
use App\Entity\Sites;
use App\Entity\Site;
use App\Entity\ConfigMachines; 
use App\Entity\ConfigTools; 
use App\Entity\Records; 
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class DisplayOneParameterController extends AbstractController
{
    private $entityManager;
    private $session;

    public function __construct(SessionInterface $session,EntityManagerInterface $entityManager) {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/displayoneparameter", name="displayoneparameter_index")
     */
    public function index(Request $request)
    {
        //UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        //$em = $this->getDoctrine()->getManager();

        //get all values by get method entered by user in page to use them
        $idSite = $request->query->get('idSite', 120);
        $idMac = $request->query->get('idmac');
        $idMould = $request->query->get('idmould');
        $idParam = $request->query->get('idparam');
        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');

        //find the parameter selected by user in table in database
        $paramnamechart = null;
        if ($idParam) {
            $selectedParameter = $this->getDoctrine()->getRepository(Parameters::class)->find($idParam);
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

        $records = $this->entityManager->getRepository(Records::class)->findRecords($idSite, $idMac, $idMould, $idParam, $startDate, $endDate);

        $standardSettings = $this->entityManager->getRepository(SettingsStandard::class)->findStandardSettings($idSite, $idMac, $idMould, $idParam);

        $paramValues = [];
        $stdValue = 0.00;
        $toleranceMin = 0.00;
        $toleranceMax = 0.00;

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
        return $this->render('display_one_parameter/index.html.twig', [
            'controller_name' => 'DisplayOneParameterController',
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
}
