<?php

namespace App\Services;

use App\Interfaces\CurrencyConverterInterface;

class FixerCurrencyConverter implements CurrencyConverterInterface {

    public function convert($from, $to, $amount)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.apilayer.com/fixer/latest?symbols=".$to."&base=".$from,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: Zzf34Xc6RyWXEVRb2V98SiuYOGhKTwAU"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
        $result = json_decode($response);

        $convertedAmount = number_format((int)$amount * (int)$result->rates->$to, 2, ',', '.');
        $answer = $convertedAmount . ' ' . $result->base;

        return $answer;
    }
}