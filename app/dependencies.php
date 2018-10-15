<?php

// DIC configuration

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
};

// Doctrine ORM
$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
                    $settings['doctrine']['meta']['entity_path'], $settings['doctrine']['meta']['auto_generate_proxies'], $settings['doctrine']['meta']['proxy_dir'], $settings['doctrine']['meta']['cache'], false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// -----------------------------------------------------------------------------
// Services
// -----------------------------------------------------------------------------
$container['App\Service\AzureCognitiveService'] = function ($c) {
    $service = new \App\Service\HttpService();
    return new App\Service\AzureCognitiveService($service);
};

// -----------------------------------------------------------------------------
// Controller
// -----------------------------------------------------------------------------

$container['App\Controller\PersonGroupController'] = function ($c) {
    $repository = new \App\Repository\PersonGroupRepository($c->get('em'));
    $azure = $c->get('App\Service\AzureCognitiveService');
    $imageService = new \App\Service\ImageService;
    return new App\Controller\PersonGroupController($repository, $azure, $imageService);
};
$container['App\Controller\PersonController'] = function ($c) {
    $repository = new \App\Repository\PersonRepository($c->get('em'));
    $azure = $c->get('App\Service\AzureCognitiveService');
    $imageService = new \App\Service\ImageService;
    return new App\Controller\PersonController($repository, $azure, $imageService);
};
