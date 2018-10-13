<?php

// Routes

$app->put('/api/persongroups/{curso}', 'App\Controller\PersonGroupController:createCurso');
$app->get('/api/persongroups/{curso}', 'App\Controller\PersonGroupController:getCurso');
$app->post('/api/persongroups/{curso}/train', 'App\Controller\PersonGroupController:train');
$app->post('/api/persongroups/{curso}/identify', 'App\Controller\PersonGroupController:identifyFace');
$app->post('/api/persongroups/{curso}/persons', 'App\Controller\PersonController:createPerson');
$app->post('/api/persongroups/{curso}/persons/{alumno}', 'App\Controller\PersonController:addFace');
