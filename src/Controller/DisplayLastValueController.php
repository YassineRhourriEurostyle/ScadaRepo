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
        $idSite = $request->query->get('idSite', 120);
        $idMac = $request->query->get('idmac');
        $idMould = $request->query->get('idmould');

        // sites for the site dropdown
        $sites = $this->entityManager->getRepository(Sites::class)->findBy([], ['idsites' => 'ASC']);

        // machines
        $machines = $this->entityManager->getRepository(ConfigMachines::class)->findBy(['idsite' => $idSite], ['macreference' => 'ASC']);

        // moulds
        $tools = $this->entityManager->getRepository(ConfigTools::class)->findBy(['idsite' => $idSite], ['toolreference' => 'ASC']);


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
    public function testco(Request $request)
    {
        try {
            //$entityManager = $this->getDoctrine()->getManager();  // If you're in a Symfony controller

            // Instantiate the UserLog service
            //$userLogService = new UserLog($this->session, $entityManager);

            // Test user credentials
            $login = 'yassine.rhourri.dev';  // example login
            $password = 'Euro$tyle1111!';  // example password
            //$userLogService->checkAccess($login, $password);
            $ldap_server='ldap://10.4.1.21';
            $ldap_port = 389;
            $ad = ldap_connect($ldap_server, $ldap_port);
            $domain = "esy.src.local";
            if(ldap_bind($ad,"$login@$domain", "$password")){
                echo "ldap valide";
            }

        } catch (\Exception $e) {
            // Handle authentication or access errors
            echo "Error: " . $e->getMessage();
        }
    }
    
}
