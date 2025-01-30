<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeRedirection {

    public static function redirectTo($memberOf) {

        switch (true):
            default:
                return 'security_logged_ok';
                return 'security_access_denied';
        endswitch;
    }
}
