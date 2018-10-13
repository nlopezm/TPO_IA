<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class PersonController {

    private $repository;

    public function __construct(PersonRepository $repository) {
        $this->repository = $repository;
    }

    public function createPerson(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $legajo = $request->getParsedBody()['legajo'];
        $nombre = $request->getParsedBody()['nombre'];
        $apellido = $request->getParsedBody()['apellido'];
        $alumno = $this->repository->createPerson($personGroupId, uniqid(), $legajo, $nombre, $apellido);
        return $response->withStatus(200)->withJson($alumno);
    }

    public function addFace(RequestInterface $request, ResponseInterface $response, $args) {
        $alumno = $this->repository->getPerson($args['alumno']);
        $curso = strtolower($args['curso']);
        $url = $request->getParsedBody()['url'];
        return $response->withStatus(200)->withJson($alumno->getId());
    }

}
