<?php

namespace App\Controller;

use App\Entity\Indicator;
use App\Form\IndicatorType;
use App\Repository\IndicatorRepository;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/indicator")
 */
class IndicatorController extends AbstractController
{

    private $pages;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
        $this->pages = \App\Controller\AdminController::getAdminPages();
    }

    /**
     * @Route("/", name="indicator_index", methods={"GET"})
     */
    public function index(IndicatorRepository $indicatorRepository): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        
        return $this->render('indicator/index.html.twig', [
            'pages' => $this->pages,
            'indicators' => $indicatorRepository->findBy([], ['id'=>'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="indicator_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $indicator = new Indicator();
        $form = $this->createForm(IndicatorType::class, $indicator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($indicator);
            $entityManager->flush();
            
            if ($form->getClickedButton() && 'saveAndAdd' === $form->getClickedButton()->getName()) {
                $this->addFlash('notice','Record created, ready to add a new one.');
                return $this->redirectToRoute('indicator_new');
            }

            $this->addFlash('notice','Record created.');
            return $this->redirectToRoute('indicator_index');
        }

        return $this->render('indicator/new.html.twig', [
            'pages' => $this->pages,
            'indicator' => $indicator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="indicator_show", methods={"GET"})
     */
    public function show(Indicator $indicator): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        return $this->render('indicator/show.html.twig', [
            'pages' => $this->pages,
            'indicator' => $indicator,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="indicator_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Indicator $indicator): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $form = $this->createForm(IndicatorType::class, $indicator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice','Record updated.');
            return $this->redirectToRoute('indicator_index');
        }

        return $this->render('indicator/edit.html.twig', [
            'pages' => $this->pages,
            'indicator' => $indicator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="indicator_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Indicator $indicator): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        if ($this->isCsrfTokenValid('delete'.$indicator->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($indicator);
            $entityManager->flush();
        }

        return $this->redirectToRoute('indicator_index');
    }
}
