<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController {

    private $security;
    private $session;

    public function __construct(SessionInterface $session, Security $security) {
        $this->session = $session;
        $this->security = $security;
    }

    /**
     * @Route("security/request-access", name="security_request_access")
     */
    public function requestAccess(Request $request) {
        return $this->render('security/requestAccess.html.twig', array(
                    'reason' => $request->get('reason'),
                    'url' => $request->get('url'),
                    'manager' => $request->get('manager'),
                        )
        );
    }

    /**
     * @Route("security/access_denied", name="security_access_denied")
     */
    public function accessDenied(Request $request) {
        $referer = $request->headers->get('referer');
        $message = $this->session->get('errorFlash');
        $this->session->remove('errorFlash');
        return $this->render('security/notAuthorized.html.twig', array('message' => $message, 'referer' => $referer));
    }

    /**
     * @Route("/security/login", name="security_login")
     * Affichage du formulaire de login
     */
    public function login() {

        $request = Request::createFromGlobals();
        $redir = $request->get('redirect');
        $autologin = $request->get('autologin');

        $response = new Response();
        if ($autologin):
            $response->headers->setCookie(Cookie::create('autologin', $autologin));
            $response->send();
            return $this->render('security/autologin.html.twig', ['autologin' => $autologin, 'redirect' => $redir]);
        endif;

        if (!$autologin && $request->cookies->get('autologin')):
            $autologin = $request->cookies->get('autologin');
            return $this->render('security/autologin.html.twig', ['autologin' => $autologin, 'redirect' => $redir]);
        endif;

        if (UserLog::IsLogged($this->session)):
            if ($redir)
                return $this->redirect($redir);
            return $this->redirectToRoute('root');
        endif;

        $em = $this->getDoctrine()->getManager();
//        $sites = $em->getRepository(Site::class)->findAll();

        return $this->render('security/login.html.twig', ['redir' => $redir]);
    }

    /**
     * @Route("/security/logged-ok", name="security_logged_ok")
     * Affichage du formulaire de login
     */
    public function loggedOK() {

        return $this->render('security/loggedOK.html.twig');
    }

    /**
     * @Route("/security/maintenance", name="security_maintenance")
     * Affichage de la page de maintenance
     */
    public function maintenance() {

        return $this->render('security/maintenance.html.twig');
    }

    /**
     * @Route("/security/browser", name="security_browser")
     * Affichage du formulaire de login
     */
    public function browser() {

        return $this->render('security/browser.html.twig');
    }

    /**
     * @Route("/security/set_site", name="security_set_site")
     * Affichage du formulaire de choix de site
     */
    public function setSite() {
        $request = Request::createFromGlobals();
        $site = $request->get('site');
        $remain = $request->get('remain');
        if ($site):
            if ($remain)
                ApiController::set('common', 'User', $request->get('id_user_api'), 'Site', $site);
            $this->session->set('site', $site);
            return $this->redirectToRoute('root');
        endif;

        $id_API = $this->session->get('user_api_id');
        $this->session->remove('user_api_id');
        return $this->render('security/setSite.html.twig', [
                    'id_user_api' => $id_API,
        ]);
    }

    /**
     * @Route("/security/check", name="security_check")
     * Check du login
     */
    public function check() {

        $request = Request::createFromGlobals();
        $redir = $request->get('redirect');

        if ($this->session->has('errorFlash')):
            $this->addFlash('error', $this->session->get('errorFlash'));
            $this->session->remove('errorFlash');
            return $this->redirect('/security/login?redirect=' . urlencode($redir));
        endif;

        $api = ApiController::call('common', 'User', array('filter' => array('UserName' => $this->session->get('logged'))));
        if (count($api) == 0):
            ApiController::set('common', 'User', 0, 'UserName', $this->session->get('logged'));
            $api = ApiController::call('common', 'User', array('filter' => array('UserName' => $this->session->get('logged'))));
        endif;
        if (count($api) == 1):
            ApiController::set('common', 'User', $api[0]['id'], 'MemberOf', implode(", ", array_keys($this->session->get('memberOf'))));
        endif;
        $this->session->set('HighContrast', 0);
        if (count($api) == 1 && $api[0]['HighContrast']):
            $this->session->set('HighContrast', 1);
        endif;
        $this->session->set('MenuRight', 0);
        if (count($api) == 1 && $api[0]['MenuRight']):
            $this->session->set('MenuRight', 1);
        endif;


        if ($redir)
            return $this->redirect($redir);
        return $this->redirectToRoute('root');
    }

    /**
     * @Route("/security/logout", name="security_logout")
     * Logout
     */
    public function logout() {
        $this->session->clear();
        $this->addFlash('notice', 'User manually logged out.');
        return $this->redirectToRoute('security_login');
    }

}
