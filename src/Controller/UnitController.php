<?php

namespace App\Controller;

use App\Entity\Unit;
use App\Form\UnitType;
use App\Repository\UnitRepository;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/unit")
 */
class UnitController extends AbstractController
{

    private $pages;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
        $this->pages = \App\Controller\AdminController::getAdminPages();
    }

    /**
     * @Route("/", name="unit_index", methods={"GET"})
     */
    public function index(UnitRepository $unitRepository): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        
        return $this->render('unit/index.html.twig', [
            'pages' => $this->pages,
            'units' => $unitRepository->findBy([], ['id'=>'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="unit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $unit = new Unit();
        $form = $this->createForm(UnitType::class, $unit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unit);
            $entityManager->flush();
            
            if ($form->getClickedButton() && 'saveAndAdd' === $form->getClickedButton()->getName()) {
                $this->addFlash('notice','Record created, ready to add a new one.');
                return $this->redirectToRoute('unit_new');
            }

            $this->addFlash('notice','Record created.');
            return $this->redirectToRoute('unit_index');
        }

        return $this->render('unit/new.html.twig', [
            'pages' => $this->pages,
            'unit' => $unit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unit_show", methods={"GET"})
     */
    public function show(Unit $unit): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        return $this->render('unit/show.html.twig', [
            'pages' => $this->pages,
            'unit' => $unit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="unit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Unit $unit): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $form = $this->createForm(UnitType::class, $unit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice','Record updated.');
            return $this->redirectToRoute('unit_index');
        }

        return $this->render('unit/edit.html.twig', [
            'pages' => $this->pages,
            'unit' => $unit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Unit $unit): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        if ($this->isCsrfTokenValid('delete'.$unit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($unit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unit_index');
    }
}
