<?php

namespace App\Controller;

use App\Repository\PersonGroupRepository;
use App\Service\AzureCognitiveService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class PersonGroupController {

    private $repository;
    private $azure;

    public function __construct(PersonGroupRepository $repository, AzureCognitiveService $azure) {
        $this->repository = $repository;
        $this->azure = $azure;
    }

    public function createCurso(RequestInterface $request, ResponseInterface $response, $args) {
        $curso = strtolower($args['curso']);
        $name = $request->getParsedBody()['name'];
        $userData = $request->getParsedBody()['userData'];
        $curso = $this->repository->createCurso($curso, $name);
        return $response->withStatus(200)->withJson($curso);
    }

    public function getCurso(RequestInterface $request, ResponseInterface $response, $args) {
        $curso = $this->repository->get(strtolower($args['curso']));
        return $response->withStatus(200)->withJson($curso);
    }

    public function train(RequestInterface $request, ResponseInterface $response, $args) {
        $curso = strtolower($args['curso']);
        return $response->withStatus(200)->withJson($curso);
    }

    public function identifyFace(RequestInterface $request, ResponseInterface $response, $args) {
        $curso = strtolower($args['curso']);
        $url = $request->getParsedBody()['url'];
        return $response->withStatus(200)->withJson($curso);
    }

}
