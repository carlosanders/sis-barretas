<?php
return [
    'settings' => [
        'displayErrorDetails' => ('true' === getenv('DEBUG_DETAIL')), // set to false in production
        'debug'               => ('true' === getenv('DEBUG_DETAIL')),
        'whoops.editor'       => 'phpstorm',
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'service_directories' => [
            'services' => APP_ROOT . '/configuration/services/',
            'middlewares' => APP_ROOT . '/configuration/middleware/',
            'routes' => APP_ROOT . '/configuration/routes/',
        ],

        // Renderer settings
        'renderer' => [
            //'template_path' => __DIR__ . '/../templates/',
            'template_path' => APP_ROOT . '/templates/',
            'template_cache' => APP_ROOT . '/cache/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
