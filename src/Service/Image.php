<?php

/*
 * To change this license header, choose License Headers in Vehicle Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

/**
 * Description of Image
 *
 * @author aurelien.stride
 */
class Image {

    //put your code here

    public static function trim($filePath) {
        //load the image
        $img = imagecreatefrompng($filePath);

//find the size of the borders
        $b_top = 0;
        $b_btm = 0;
        $b_lft = 0;
        $b_rt = 0;

//top
        for (; $b_top < imagesy($img); ++$b_top) {
            for ($x = 0; $x < imagesx($img); ++$x) {
                if (imagecolorat($img, $x, $b_top) != 0xFFFFFF) {
                    break 2; //out of the 'top' loop
                }
            }
        }

//bottom
        for (; $b_btm < imagesy($img); ++$b_btm) {
            for ($x = 0; $x < imagesx($img); ++$x) {
                if (imagecolorat($img, $x, imagesy($img) - $b_btm - 1) != 0xFFFFFF) {
                    break 2; //out of the 'bottom' loop
                }
            }
        }

//left
        for (; $b_lft < imagesx($img); ++$b_lft) {
            for ($y = 0; $y < imagesy($img); ++$y) {
                if (imagecolorat($img, $b_lft, $y) != 0xFFFFFF) {
                    break 2; //out of the 'left' loop
                }
            }
        }

//right
        for (; $b_rt < imagesx($img); ++$b_rt) {
            for ($y = 0; $y < imagesy($img); ++$y) {
                if (imagecolorat($img, imagesx($img) - $b_rt - 1, $y) != 0xFFFFFF) {
                    break 2; //out of the 'right' loop
                }
            }
        }

//copy the contents, excluding the border
        $newimg = imagecreatetruecolor(
                imagesx($img) - ($b_lft + $b_rt), imagesy($img) - ($b_top + $b_btm));

        imagecopy($newimg, $img, 0, 0, $b_lft, $b_top, imagesx($newimg), imagesy($newimg));

//finally, output the image
        imagepng($newimg, $filePath);
    }

    /*
     * Turn off transparency
     */

    public static function removeAlpha($filePath) {
        // Get the original image.
        $src = imagecreatefrompng($filePath);

// Get the width and height.
        $width = imagesx($src);
        $height = imagesy($src);

// Create a white background, the same size as the original.
        $bg = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($bg, 255, 255, 255);
        imagefill($bg, 0, 0, $white);

// Merge the two images.
        imagecopyresampled(
                $bg, $src,
                0, 0, 0, 0,
                $width, $height,
                $width, $height);

// Save the finished image.
        imagepng($bg, $filePath, 0);
    }

}
