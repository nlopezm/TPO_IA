<?php

namespace App\Controller;

use App\Repository\PersonGroupRepository;
use App\Service\AzureCognitiveService;
use App\Service\ImageService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class PersonGroupController {

    private $repository;
    private $azure;
    private $image;

    public function __construct(PersonGroupRepository $repository, AzureCognitiveService $azure, ImageService $imageService) {
        $this->repository = $repository;
        $this->azure = $azure;
        $this->image = $imageService;
    }

    public function createCurso(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $name = $request->getParsedBody()['nombre'];
        $this->azure->personGroupCreate($personGroupId, $name);
        $curso = $this->repository->createCurso($personGroupId, $name);
        return $response->withStatus(200)->withJson($curso);
    }

    public function getCurso(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $queryString = explode(",", $request->getQueryParam('expand'));
        $curso = $this->repository->get($personGroupId)->getArrayCopy($queryString);
        return $response->withStatus(200)->withJson($curso);
    }

    public function getCursos(RequestInterface $request, ResponseInterface $response, $args) {
        $queryString = explode(",", $request->getQueryParam('expand'));
        $res = array();
        $cursos = $this->repository->getAll();
        foreach ($cursos as $curso)
            array_push($res, $curso->getArrayCopy($queryString));
        return $response->withStatus(200)->withJson($res);
    }

    public function train(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $res = $this->azure->trainPersonGroup($personGroupId);
        return $response->withStatus(200)->withJson($res);
    }

    public function tomarAsistencia(RequestInterface $request, ResponseInterface $response, $args) {
        $personGroupId = strtolower($args['curso']);
        $url = $request->getParsedBody()['url'] ? $request->getParsedBody()['url'] : $this->image->guardarImagen($request->getParsedBody()['base64']);
        $faceIds = array();
        foreach ($url as $img) {
            $faces = $this->azure->detect($img);
            foreach ($faces as $face)
                array_push($faceIds, $face['faceId']);
        }

        $alumnos = $this->azure->identify($faceIds, $personGroupId);
        $res = $this->repository->tomarAsistencia($personGroupId, $alumnos);
        return $response->withStatus(200)->withJson($res);
    }

}
