<?php
return [
    'settings' => [
        'displayErrorDetails' => ('true' === getenv('APP_DEBUG')), // set to false in production
        'debug' => ('true' === getenv('APP_DEBUG')),
        'whoops.editor' => 'phpstorm',
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'service_directories' => [
            'services' => APP_ROOT . '/configuration/services/',
            'middlewares' => APP_ROOT . '/configuration/middleware/',
            'routes' => APP_ROOT . '/configuration/routes/',
        ],
        //Eloquent
        'db' => [
            'driver' => getenv('DB_CONNECTION'),
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => getenv('DB_CHARSET'),
            'collation' => getenv('DB_COLLATION'),
            'prefix' => getenv('DB_PREFIX'),
        ],

        // Renderer settings
        'renderer' => [
            //'template_path' => __DIR__ . '/../views/',
            'template_path' => APP_ROOT . '/src/resources/views/',
            'template_cache' => APP_ROOT . '/cache/',
            'auto_reload' => ('true' === getenv('CACHE_AUTO_RELOAD')),
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
    'twig' => [
        'title' => 'Anders',
        'description' => 'anders',
        'author' => 'anders'
    ],
];
