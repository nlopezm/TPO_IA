<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use App\Service\AzureCognitiveService;
use App\Service\ImageService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class PersonController {

    private $repository;
    private $azure;
    private $image;

    public function __construct(PersonRepository $repository, AzureCognitiveService $azure, ImageService $imageService) {
        $this->repository = $repository;
        $this->azure = $azure;
        $this->image = $imageService;
    }

    public function createPerson(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $legajo = $request->getParsedBody()['legajo'];
        $nombre = $request->getParsedBody()['nombre'];
        $apellido = $request->getParsedBody()['apellido'];
        $foto = $request->getParsedBody()['foto'];
        $personId = $this->azure->personCreate($personGroupId, $legajo);
        $alumno = $this->repository->createPerson($personGroupId, $personId, $legajo, $nombre, $apellido, $foto);
        return $response->withStatus(200)->withJson($alumno);
    }

    public function addFace(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $alumno = $this->repository->getPerson($args['alumno']);
        $personId = $alumno->getPersonId();
        $res = array();
        $url = $request->getParsedBody()['url'] ? $request->getParsedBody()['url'] : $this->image->guardarImagen($request->getParsedBody()['base64'], $args['alumno']);
        foreach ($url as $img)
            $res[] = $this->azure->personAddFace($personGroupId, $personId, $img);
        return $response->withStatus(200)->withJson($res);
    }

}
