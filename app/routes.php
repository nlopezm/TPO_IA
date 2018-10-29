<?php

// Routes

$app->get('/api/persongroups', 'App\Controller\PersonGroupController:getCursos');
$app->put('/api/persongroups/{curso}', 'App\Controller\PersonGroupController:createCurso');
$app->get('/api/persongroups/{curso}', 'App\Controller\PersonGroupController:getCurso');
$app->post('/api/persongroups/{curso}/train', 'App\Controller\PersonGroupController:train');
$app->post('/api/persongroups/{curso}/asistencia', 'App\Controller\PersonGroupController:tomarAsistencia');
$app->post('/api/persongroups/{curso}/persons', 'App\Controller\PersonController:createPerson');
$app->post('/api/persongroups/{curso}/persons/{alumno}', 'App\Controller\PersonController:addFace');
$app->get('/api/doc', function($request, $response, $args) {
    $apiDoc = file_get_contents(__DIR_ . '/../swagger.html');
    return $apiDoc;
});
