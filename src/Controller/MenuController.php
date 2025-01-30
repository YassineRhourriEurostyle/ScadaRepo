<?php

namespace App\Controller;

use App\Service\UserLog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MenuController extends AbstractController {

    //put your code here

    private $session;
    private $em;

    public function __construct(SessionInterface $session, EntityManagerInterface $em) {
        $this->session = $session;
        $this->em = $em;
        
        $this->project_code = strtoupper($_SERVER['HTTP_HOST']);
        if (strpos($this->project_code, '.GMD-PLS') !== false):
            $this->project_code = substr($this->project_code, 0, strpos($this->project_code, '.GMD-PLS'));
        endif;
        if (strpos($this->project_code, 'PLS') !== false):
            $this->project_code = substr($this->project_code, 0, strpos($this->project_code, 'PLS'));
        endif;
    }

    public function display($current_route = '') {

        $menu = array();

        if (UserLog::isLogged($this->session)):
            $menu['setup_index']= 'Setup';
        endif;
        return $this->render('_menus/menubody.html.twig', [
                    'menu' => $menu,
                    'current_route' => $current_route
        ]);
    }

    public function notifications() {

        $notifications = array();

        if (UserLog::isLogged($this->session)):

//            $notifications[] = array(
//                'url' => '/',
//                'icon' => 'fas fa-bell',
//                'title' => 'Notif title',
//                'number' => 1
//            );

            if (UserLog::isMemberOf($this->session, UserLog::DEV_ADMIN)):
                $tickets = ApiController::call('itdev', 'Ticket', ['filter' => ['a.Name' => strtolower($this->project_code), 'Percent' => ['<', 100]]]);
                if (count($tickets)):
                    $notifications[] = array(
                        'url' => 'http://itdevpls/project/' . $tickets[0]['Project']['id'],
                        'icon' => 'fas fa-code standard-orange',
                        'title' => 'Opened IT tickets',
                        'number' => count($tickets)
                    );

                endif;
            endif;


        endif;

        return $this->render('_menus/notifications.html.twig', [
                    'notifications' => $notifications
        ]);
    }
}
