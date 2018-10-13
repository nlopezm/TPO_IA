<?php
include_once __DIR__ . '/config/parameters.dev.php';
return [
    'settings' => [
        'displayErrorDetails' => true,
        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    'app/src/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' => __DIR__ . '/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => DB_HOST,
                'dbname' => DB_NAME,
                'user' => DB_USERNAME,
                'password' => DB_PASSWORD,
            ]
        ]
    ],
];
