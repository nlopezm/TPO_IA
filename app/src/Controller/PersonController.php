<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use App\Service\AzureCognitiveService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class PersonController {

    private $repository;
    private $azure;

    public function __construct(PersonRepository $repository, AzureCognitiveService $azure) {
        $this->repository = $repository;
        $this->azure = $azure;
    }

    public function createPerson(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $legajo = $request->getParsedBody()['legajo'];
        $nombre = $request->getParsedBody()['nombre'];
        $apellido = $request->getParsedBody()['apellido'];
        $personId = $this->azure->personCreate($personGroupId, $legajo);
        $alumno = $this->repository->createPerson($personGroupId, $personId, $legajo, $nombre, $apellido);
        return $response->withStatus(200)->withJson($alumno);
    }

    public function addFace(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $alumno = $this->repository->getPerson($args['alumno']);
        $personId = $alumno->getPersonId();
        $url = $request->getParsedBody()['url'];
        $res = $this->azure->personAddFace($personGroupId, $personId, $url);
        return $response->withStatus(200)->withJson($res);
    }

}
