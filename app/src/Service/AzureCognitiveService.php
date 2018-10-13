<?php

namespace App\Service;

use App\Service\HttpService;

class AzureCognitiveService {

    private $http;

    function __construct(HttpService $http) {
        $this->http = $http;
    }

    public function detect($imagen_url) {
        $url = AZURE_BASE_URL . 'detect';
        $body['url'] = $img;
        return $this->http->post($url, $body);
    }

    public function identify($faceIds, $personGroupId, $maxNumOfCandidatesReturned = 1) {
        $url = AZURE_BASE_URL . 'identify';
        $body['faceIds '] = $faceIds;
        $body['personGroupId '] = $personGroupId;
        $body['maxNumOfCandidatesReturned '] = $maxNumOfCandidatesReturned;
        return $this->http->post($url, $body);
    }

    public function personGroupCreate($personGroupId, $curso) {
        $url = AZURE_BASE_URL . 'persongroups/' . $personGroupId;
        $body['curso '] = $curso;
        return $this->http->put($url, $body);
    }

    public function trainPersonGroup($personGroupId) {
        $url = AZURE_BASE_URL . 'persongroups/' . $personGroupId . '/train';
        return $this->http->post($url, $body);
    }

    public function personCreate($personGroupId, $legajo, $nombre = null) {
        $url = AZURE_BASE_URL . 'persongroups/' . $personGroupId . '/persons';
        $body['name'] = $legajo;
        $body['userData'] = $nombre;
        return $this->http->post($url, $body);
    }

    public function personAddFace($personGroupId, $personId, $imagen_url) {
        $url = AZURE_BASE_URL . 'persongroups/' . $personGroupId . '/persons/' . $personId . '/persistedFaces';
        $body['url'] = $imagen_url;
        return $this->http->post($url, $body);
    }

}
