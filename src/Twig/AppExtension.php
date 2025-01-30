<?php

namespace App\Twig;

use App\Service\UserLog;
use App\Service\ApplyAccessFilters;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\Dotenv\Dotenv;

/**
 * New Twig functions to be callable in twig rendering.
 *
 * @author aurelien.stride
 */
class AppExtension extends AbstractExtension {

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    public function getFunctions() {
        return [
            new TwigFunction('accessReadonly', [$this, 'accessReadonly']),
            new TwigFunction('AdminLog', [$this, 'AdminLog']),
            new TwigFunction('base64_encode', 'base64_encode'),
            new TwigFunction('checkUserAccess', [$this, 'checkUserAccess']),
            new TwigFunction('evalMath', [$this, 'evalMath']),
            new TwigFunction('getAccessMode', [$this, 'getAccessMode']),
            new TwigFunction('get_env', 'getenv'),
            new TwigFunction('isLoggedAs', [$this, 'isLoggedAs']),
            new TwigFunction('isMemberOf', [$this, 'isMemberOf']),
            new TwigFunction('reverseCase', [$this, 'reverseCase']),
            new TwigFunction('showFileWithModifiedDate', [$this, 'showFileWithModifiedDate']),
        ];
    }

    public function AdminLog($text = '') {
        if (!UserLog::isMemberOf($this->session, UserLog::DEV_ADMIN))
            return '';
        $time = new \DateTime();
        return '<small>' . trim($text . ' ' . $time->format('s.u')) . '</small>';
    }

    /**
     * Check if user member of a specific group.
     * @param string/array $member
     * @return boolean
     */
    public function isMemberOf($member) {
        return UserLog::isMemberOf($this->session, $member);
    }

    /**
     * Check if user logged as specific account.
     * @param string/array $login
     * @return boolean
     */
    public function isLoggedAs($login) {
        return UserLog::isLoggedAs($this->session, $login, false);
    }

    public function accessReadonly($entityField = null) {
        return ApplyAccessFilters::accessReadonly($this->session, $entityField);
    }

    public function getAccessMode($entityField, $value) {
        return ApplyAccessFilters::getAccessMode($entityField, $value, $this->session);
    }

    /**
     * evaluate math operation
     * @param string/array $member
     * @return number
     */
    public function evalMath($operation) {
        
        if (strpos($operation, '/0') !== false)
            return 0;
        if (strpos($operation, '/(0)') !== false)
            return 0;
        
        try {
            return eval('return ' . $operation . ';');
        } catch (Exception $ex) {
            return 0;
        }
    }

    public function checkUserAccess($entity, $field, $value) {
        return true; //$ua = new \App\Service\UserAccess($this->session)
    }

    public function reverseCase($str) {
        return strtolower($str) ^ strtoupper($str) ^ $str;
    }

    public function showFileWithModifiedDate($file) {
        $path = __DIR__ . '/../../public' . $file;
        if (is_file($path))
            return $file . '?' . filemtime($path);
        return '';
    }

}
