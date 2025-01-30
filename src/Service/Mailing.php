<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

/**
 * Description of Mailing
 *
 * @author aurelien.stride
 */
class Mailing {

    protected $templating;

    public static function sendMail($to, $subject, $template, $options, $files = array()) {

        $host = $_SERVER['SERVER_NAME'];

        // Create the Transport
        $transport = (new \Swift_SmtpTransport('10.4.200.39', 25));

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        $message = new \Swift_Message($subject);
        $message->setFrom($host . '@eurostyle-systems.com');
//        $message->setBcc('aurelien.stride@eurostyle-systems.com');

        $html = file_get_contents(__DIR__ . '/../../templates/_emails/base.html.twig');
        $html = str_replace('[[PROJECT]]', strtoupper($host), $html);
        $html = str_replace('[[TITLE]]', $subject, $html);
        $body = file_get_contents(__DIR__ . '/../../templates/_emails/' . $template . '.html.twig');
        $html = str_replace('[[ARTICLE]]', $body, $html);
        $img = $message->embed(\Swift_Image::fromPath(__DIR__ . '/../../public/img/GMD.png'));
        $html = str_replace('[[LOGO]]', $img, $html);
        $img = $message->embed(\Swift_Image::fromPath(__DIR__ . '/../../public/img/email_head_gradient.png'));
        $html = str_replace('[[GRADIENT]]', $img, $html);

        foreach ($options as $key => $value):
            $html = str_replace('[[' . $key . ']]', $value, $html);
        endforeach;

        foreach ($files as $file):
            if (is_file($file)):
                $message->attach(\Swift_Attachment::fromPath($file));
            endif;
        endforeach;


        $message->setBody(
                $html,
                'text/html'
        );

        try {
            $message->setTo($to);
            return $mailer->send($message);
        } catch (\Swift_RfcComplianceException $e) {
            mail('aurelien.stride@eurostyle-systems.com', '[DEBUG] Email issue in ' . $host, 'For : ' . $to . "\n" . $e->getMessage());
        } catch (\Swift_TransportException $e) {
            mail('aurelien.stride@eurostyle-systems.com', '[DEBUG] Email issue in ' . $host, 'For : ' . $to . "\n" . $e->getMessage());
        }
    }

}
