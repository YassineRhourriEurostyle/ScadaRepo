<?php

namespace App\Controller;

use App\Entity\Setting;
use App\Form\SettingType;
use App\Repository\SettingRepository;
use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/setting")
 */
class SettingController extends AbstractController
{

    private $pages;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
        $this->pages = \App\Controller\AdminController::getAdminPages();
    }

    /**
     * @Route("/", name="setting_index", methods={"GET"})
     */
    public function index(SettingRepository $settingRepository): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
        
        
        return $this->render('setting/index.html.twig', [
            'pages' => $this->pages,
            'settings' => $settingRepository->findBy([], ['id'=>'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="setting_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $setting = new Setting();
        $form = $this->createForm(SettingType::class, $setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($setting);
            $entityManager->flush();
            
            if ($form->getClickedButton() && 'saveAndAdd' === $form->getClickedButton()->getName()) {
                $this->addFlash('notice','Record created, ready to add a new one.');
                return $this->redirectToRoute('setting_new');
            }

            $this->addFlash('notice','Record created.');
            return $this->redirectToRoute('setting_index');
        }

        return $this->render('setting/new.html.twig', [
            'pages' => $this->pages,
            'setting' => $setting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="setting_show", methods={"GET"})
     */
    public function show(Setting $setting): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        return $this->render('setting/show.html.twig', [
            'pages' => $this->pages,
            'setting' => $setting,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="setting_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Setting $setting): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        $form = $this->createForm(SettingType::class, $setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice','Record updated.');
            return $this->redirectToRoute('setting_index');
        }

        return $this->render('setting/edit.html.twig', [
            'pages' => $this->pages,
            'setting' => $setting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="setting_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Setting $setting): Response
    {
        UserLog::isAllowed($this->session, UserLog::DEV_ADMIN);
    
        if ($this->isCsrfTokenValid('delete'.$setting->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($setting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('setting_index');
    }
}
