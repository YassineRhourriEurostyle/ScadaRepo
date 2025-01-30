<?php

/*
 * To change this license header, choose License Headers in Vehicle Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

/**
 * Description of Signature
 *
 * @author aurelien.stride
 */
class Signature {

    /**
     * @param type $signFile
     */
    public static function saveSignature($signFile) {


        try {
            $request = Request::createFromGlobals();
            @unlink($signFile);

            if (!$_FILES['signfile']['name']):
                $signature = base64_decode(str_replace('data:image/png;base64,', '', $request->request->get('signature')));
                file_put_contents($signFile, $signature);
                Image::removeAlpha($signFile);
            else:
                move_uploaded_file($_FILES['signfile']['tmp_name'], $signFile);
                /*
                 * Convert if needed
                 */
                if ($img = @imagecreatefromjpeg($signFile)):
                    imagepng($img, $signFile);
                endif;
            endif;

            Image::trim($signFile);

            /*
             * resize
             */
            list($width, $height) = getimagesize($signFile);
            $new_height = 500;
            $new_width = $width * $new_height / $height;
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefrompng($signFile);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagepng($image_p, $signFile);
        } catch (FileNotFoundException $ex) {
            
        }
    }

}
