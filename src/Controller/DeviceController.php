<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use App\Repository\DeviceRepository;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/device")
 */
class DeviceController extends AbstractController
{

    private $pages;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
        $this->pages = \App\Controller\AdminController::getAdminPages();
    }

    /**
     * @Route("/", name="device_index", methods={"GET"})
     */
    public function index(DeviceRepository $deviceRepository): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        
        return $this->render('device/index.html.twig', [
            'pages' => $this->pages,
            'devices' => $deviceRepository->findBy([], ['id'=>'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="device_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $device = new Device();
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($device);
            $entityManager->flush();
            
            if ($form->getClickedButton() && 'saveAndAdd' === $form->getClickedButton()->getName()) {
                $this->addFlash('notice','Record created, ready to add a new one.');
                return $this->redirectToRoute('device_new');
            }

            $this->addFlash('notice','Record created.');
            return $this->redirectToRoute('device_index');
        }

        return $this->render('device/new.html.twig', [
            'pages' => $this->pages,
            'device' => $device,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="device_show", methods={"GET"})
     */
    public function show(Device $device): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        return $this->render('device/show.html.twig', [
            'pages' => $this->pages,
            'device' => $device,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="device_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Device $device): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice','Record updated.');
            return $this->redirectToRoute('device_index');
        }

        return $this->render('device/edit.html.twig', [
            'pages' => $this->pages,
            'device' => $device,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="device_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Device $device): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        if ($this->isCsrfTokenValid('delete'.$device->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($device);
            $entityManager->flush();
        }

        return $this->redirectToRoute('device_index');
    }
}
