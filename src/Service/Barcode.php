<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Exception\TimeoutException;

/**
 * Description of Barcode
 *
 * @author aurelien.stride
 */
class Barcode {

    public static function setCode128($project_dir, $text) {
        $file = $project_dir . '/generations/barcodes/' . $text . '.png';
//        if (@imagecreatefrompng($file))
//            return $file;

        $url = 'https://barcode.tec-it.com/barcode.ashx?data=' . $text
                . '&code=Code128&multiplebarcodes=false&translate-esc=false'
                . '&unit=Fit&dpi=300&imagetype=Png&rotation=0&color=%23000000'
                . '&bgcolor=%23ffffff&qunit=Mm&quiet=0&base64=true';

        
        $client = HttpClient::create();
        try {
            $response = $client->request('GET', $url);
            file_put_contents($file, base64_decode($response->getContent()));
            
        } catch (TimeoutException $ex) {
            $url='https://bwipjs-api.metafloor.com/?bcid=code128&text=' . $text . '&scaleX=3&scaleY=1&rotate=N&includetext';
            $response = $client->request('GET', $url);
            file_put_contents($file, $response->getContent());
        }


        return $file;
    }

}
