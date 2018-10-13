<?php

namespace App\Controller;

use App\Repository\PersonGroupRepository;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class PersonGroupController {

    private $repository;

    public function __construct(PersonGroupRepository $repository) {
        $this->repository = $repository;
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
