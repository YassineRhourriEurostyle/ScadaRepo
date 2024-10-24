<?php

/*
 * Note : free version is USD-based. conversion to EUR is needed.
 */

namespace App\Service;

use App\Service\DetectLanguage;
use App\Service\Client;

class LanguageDetection {

    private static $API_KEY_DL = '4a0336c56547340fdc25a8122b221d89';

    /*
     * Get all rates
     * @return array
     */

    public static function detectLanguage($text) {

        if (!$text)
            return false;

        DetectLanguage::setApiKey(self::$API_KEY_DL);

        $results = DetectLanguage::detect($text);

        if(isset($results[0]))
            return $results[0]->language;        
        
        return $text;
    }

    public static function isEnglish($text) {

        return self::detectLanguage($text) == 'en';
    }

    /*
     * Translation
     */

    public static function translate($text, $target = 'en') {

        if (!$text)
            return '';

        $curl = curl_init();

        if (self::isEnglish($text))
            return $text;

        $source = self::detectLanguage($text);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://systran-systran-platform-for-language-processing-v1.p.rapidapi.com/"
            . "translation/text/translate?"
            . "source=" . urlencode($source) . "&target=" . urlencode($target) . "&input=" . urlencode($text) . "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: systran-systran-platform-for-language-processing-v1.p.rapidapi.com",
                "x-rapidapi-key: tS3Aeu5CUHmshILbPPxHcBm0pUjFp1F20THjsnWEVjFhRMgGVU"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($response===false)
            return $text;
        
        $json = json_decode($response, 1);
        if(isset($json['outputs'][0]['output']))
            return $json['outputs'][0]['output'];
        
        return $text;
    }

}
