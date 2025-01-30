<?php

namespace App\Controller;

use App\Entity\TypeOfDevice;
use App\Form\TypeOfDeviceType;
use App\Repository\TypeOfDeviceRepository;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/typeofdevice")
 */
class TypeOfDeviceController extends AbstractController
{

    private $pages;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
        $this->pages = \App\Controller\AdminController::getAdminPages();
    }

    /**
     * @Route("/", name="typeofdevice_index", methods={"GET"})
     */
    public function index(TypeOfDeviceRepository $typeOfDeviceRepository): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        
        return $this->render('type_of_device/index.html.twig', [
            'pages' => $this->pages,
            'typeofdevices' => $typeOfDeviceRepository->findBy([], ['id'=>'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="typeofdevice_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $typeOfDevice = new TypeOfDevice();
        $form = $this->createForm(TypeOfDeviceType::class, $typeOfDevice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeOfDevice);
            $entityManager->flush();
            
            if ($form->getClickedButton() && 'saveAndAdd' === $form->getClickedButton()->getName()) {
                $this->addFlash('notice','Record created, ready to add a new one.');
                return $this->redirectToRoute('typeofdevice_new');
            }

            $this->addFlash('notice','Record created.');
            return $this->redirectToRoute('typeofdevice_index');
        }

        return $this->render('type_of_device/new.html.twig', [
            'pages' => $this->pages,
            'typeofdevice' => $typeOfDevice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="typeofdevice_show", methods={"GET"})
     */
    public function show(TypeOfDevice $typeOfDevice): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        return $this->render('type_of_device/show.html.twig', [
            'pages' => $this->pages,
            'typeofdevice' => $typeOfDevice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="typeofdevice_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeOfDevice $typeOfDevice): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $form = $this->createForm(TypeOfDeviceType::class, $typeOfDevice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice','Record updated.');
            return $this->redirectToRoute('typeofdevice_index');
        }

        return $this->render('type_of_device/edit.html.twig', [
            'pages' => $this->pages,
            'typeofdevice' => $typeOfDevice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="typeofdevice_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeOfDevice $typeOfDevice): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        if ($this->isCsrfTokenValid('delete'.$typeOfDevice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeOfDevice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('typeofdevice_index');
    }
}
