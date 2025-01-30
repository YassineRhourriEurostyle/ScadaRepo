<?php

namespace App\Security;

use App\Controller\ApiController;
use App\Security\User;
use App\Service\UserLog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\Session\Session;

class AppLdapAuthenticator extends AbstractGuardAuthenticator {

    private $em;
    private $session;
    private $router;

    public function __construct(EntityManagerInterface $em, SessionInterface $session, RouterInterface $router) {
        $this->em = $em;
        $this->session = $session;
        $this->router = $router;
    }

    public function supports(Request $request) {

        return substr($request->getPathInfo(), 0, 5) == '/api/' || UserLog::IsLogged($this->session) || $request->request->has('login');
    }

    public function getCredentials(Request $request) {
        return [
            'login' => $request->request->get('login'),
            'password' => $request->request->get('password'),
            'logAs' => ($request->request->has('logAs') ? true : false),
            'touchScreen' => ($request->request->has('touchScreen') ? true : false),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider) {

        $user = new User();
        if (UserLog::IsLogged($this->session)):
            if (is_array($this->session->get('roles')))
                $user->setRoles($this->session->get('roles'));
            $user->setUuid($this->session->get('logged'));
        endif;
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user) {
        $service = new UserLog($this->session, $this->em);
        if ($credentials['login']):
//            return ApiController::log($this->session, $credentials['login'], $credentials['password']);

            return $service->checkAccess($credentials['login'], $credentials['password'], null, $credentials['logAs'], $credentials['touchScreen']);
        endif;

        return UserLog::IsLogged($this->session);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {

        $this->session->set('errorFlash', $exception->getMessage());

        return null;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) {
        return null;
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null) {
//        var_dump($request->query->get('log_as'));
//        if($request->query->get('log_as')):
//            $service = new UserLog($this->session, $this->em);
//            return $service->checkAccess($request->query->get('log_as'), '', null, true);
//        endif;
    }

    public function supportsRememberMe() {
        //die("supportsRememberMe");
    }

}
