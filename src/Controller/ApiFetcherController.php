<?php

namespace App\Controller;

use App\Service\UserLog;
use App\Entity\Sites;
use App\Entity\Site;
use App\Entity\ConfigMachines; 
use App\Entity\ConfigTools;
use App\Entity\DistinctRecords;
use App\Entity\Records; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/apifetcher")
 */
class ApiFetcherController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/", name="apifetcher_index")
     */
    public function index()
    {
        //UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        //$em = $this->getDoctrine()->getManager();
        
        return $this->render('api_fetcher/index.html.twig', [
            'controller_name' => 'ApiFetcherController',
        ]);
    }

    /**
     * @Route("/get-machines", name="get_machines", methods={"GET"})
     */
    public function getMachines(Request $request,EntityManagerInterface $em): Response
    {
        $idSite = $request->query->get('idSite');

        if (!$idSite) {
            return $this->json(['error' => 'Site ID is required'], 400);
        }

        $machines = $em->getRepository(ConfigMachines::class)->findBy(['idsite' => $idSite]);

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
     * @Route("/get-molds", name="get_molds", methods={"GET"})
     */
    public function getMolds(Request $request, EntityManagerInterface $em): Response
    {
        $idSite = $request->query->get('idSite');
        $idMac = $request->query->get('idMac'); // Machine ID sent from the frontend
    
        if (!$idSite) {
            return $this->json(['error' => 'Site ID is required'], 400);
        }
    
        try {
            if ($idMac) {
                // Use the repository method to fetch distinct mold IDs
                $recordMoulds = $em->getRepository(DistinctRecords::class)->findDistinctMouldsBySiteAndMachine($idSite, $idMac);
    
                // Extract mold IDs from the query result
                $mouldIds = array_map(fn($record) => $record['idMould'], $recordMoulds);
    
                // If no molds are found, return an empty list
                if (empty($mouldIds)) {
                    return $this->json([]); // Return an empty array if no molds found
                }
    
                // Fetch the ConfigTools molds based on the retrieved mold IDs
                $tools = $em->getRepository(ConfigTools::class)->findBy(
                    ['idsite' => $idSite, 'idcfgtool' => $mouldIds],
                    ['toolreference' => 'ASC']
                );
            } else {
                // If no machine is selected, return all molds for the site
                $tools = $em->getRepository(ConfigTools::class)->findBy(
                    ['idsite' => $idSite],
                    ['toolreference' => 'ASC']
                );
            }
    
            // Format data for JSON response
            $data = array_map(fn($tool) => [
                'id'   => $tool->getIdcfgtool(),
                'name' => $tool->getToolreference(),
            ], $tools);
    
            return $this->json($data);
        } catch (\Exception $e) {
            // Handle any exceptions and return a JSON error
            return $this->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
