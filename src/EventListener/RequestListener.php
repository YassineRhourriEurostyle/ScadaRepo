<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 * Description of RequestListener
 *
 * @author aurelien.stride
 */
class RequestListener {
    
    public function onKernelRequest(RequestEvent $event)
    {
        //var_dump('Listener'); 
        $request = $event->getRequest();

//        if (!$request->isXmlHttpRequest()) {
//            return;
//        }
//
//        if (!$request->attributes->has('_route')) {
//            return;
//        }

        $session = $request->getSession();
        //$session->save(); 
    }
}
