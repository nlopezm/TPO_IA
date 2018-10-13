<?php

namespace App\Service;

class HttpService {

    public function post($url, $body) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: Application/json',
            'Ocp-Apim-Subscription-Key: 13df464c73d54c6a93948e9801833f57'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        $response = json_decode(curl_exec($ch), true, 512);
        curl_close($ch);
        return $response;
    }

    public function get($url) {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: Application/json',
            'Ocp-Apim-Subscription-Key: 13df464c73d54c6a93948e9801833f57'
        ));
        $response = json_decode(curl_exec($ch), true, 512);
        curl_close($ch);
        return $response;
    }

    public function put($url, $body) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: Application/json',
            'Ocp-Apim-Subscription-Key: 13df464c73d54c6a93948e9801833f57'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        $response = json_decode(curl_exec($ch), true, 512);
        curl_close($ch);
        return $response;
    }

    public function delete($url) {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: Application/json',
            'Ocp-Apim-Subscription-Key: 13df464c73d54c6a93948e9801833f57'
        ));

        $response = json_decode(curl_exec($ch), true, 512);
        curl_close($ch);
        return $response;
    }

}
