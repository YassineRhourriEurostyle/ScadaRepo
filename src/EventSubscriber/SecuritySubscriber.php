<?php

namespace App\EventSubscriber;

use App\Controller\ApiController;
use App\Controller\DefaultController;
use App\Controller\MenuController;
use App\Controller\CronController;
use App\Controller\SecurityController;
use App\Service\UserLog;
use Sinergi\BrowserDetector\Browser;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Controller\ErrorController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Description of SecuritySubscriber
 *
 * @author aurelien.stride
 */
class SecuritySubscriber implements EventSubscriberInterface {

    private $session;
    private $router;
    private $params;

    public function __construct(SessionInterface $session, RouterInterface $router, ParameterBagInterface $params) {
        $this->session = $session;
        $this->router = $router;
        $this->params = $params;
    }

    public function onKernelController(ControllerEvent $event) {

        $request = $event->getRequest();
        return true;

        if ($request->hasPreviousSession()) {
            $this->session = $request->getSession();
        }

        $controller = $event->getController();
        $method = '';
        if (is_array($controller)):
            $method = $controller[1];
            $controller = $controller[0];
        endif;

        $project = explode('/', __DIR__)[3];
        if ($request->query->has('internal_key') && $request->query->get('internal_key') == md5($project))
            return;

        if (substr($method, -6, 6) === 'Action')
            return;

        if (($controller instanceof CronController))
            return;
        if (($controller instanceof RedirectController))
            return;
        if (($controller instanceof ApiController))
            return;
        if (($controller instanceof ErrorController))
            return;
        if (($controller instanceof ExceptionController))
            return;
        if (($controller instanceof MenuController))
            return;


        /*
         * Check browser
         */
        $browser = new Browser();
        $allowedBrowsers = [
            Browser::CHROME,
            Browser::FIREFOX,
            Browser::SAFARI,
        ];

//        var_dump($_SERVER['HTTP_USER_AGENT']);
//
//        var_dump(get_browser(null, true));
//        var_dump($browser->getName());
//        die();

        if (!in_array($browser->getName(), $allowedBrowsers) && $method === 'browser') {
            return;
        }

        if (in_array($browser->getName(), $allowedBrowsers) && $method === 'browser') {
            $event->setController(function() {
                return new RedirectResponse('/security/login');
            });
        }

        if (!in_array($browser->getName(), $allowedBrowsers) && $method !== 'browser') {
            $this->session->clear();
            $event->setController(function() {
                return new RedirectResponse('/security/browser');
            });
        }


        /*
         * Controllers not to control
         */
        if (($controller instanceof SecurityController))
            return;

        if (UserLog::IsLogged($this->session) &&
                $this->params->get('kernel.environment') == 'dev' &&
                !UserLog::isMemberOf($this->session, UserLog::DEV_ADMIN) &&
                !UserLog::isLoggedByAdmin($this->session))
            :
            $event->setController(function() {
                return new RedirectResponse('/security/maintenance');
            });
        endif;

        /*
         * User logged
         */
        if (UserLog::IsLogged($this->session))
            return;


        /*
         * Not logged
         */
        if (!UserLog::IsLogged($this->session) && !($controller instanceof SecurityController)):
            $this->url = $event->getRequest()->getPathInfo();
            //die('Not logged');
            $event->setController(function() {
                return new RedirectResponse('/security/login?redirect=' . urlencode($this->url));
            });
        endif;

        /*
         * No member of
         */
        if ($this->session->has('memberOf') && !count($this->session->get('memberOf'))):
            $this->session->clear();
            $event->setController(function() {
                //die('You are not allowed to access this application.');
                $this->addFlash('error', 'You are not allowed to access this application.');
                return new RedirectResponse('/security/login');
            });
        endif;
    }

    public static function getSubscribedEvents() {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

}
