<?php
// DIC configuration

/** @var \Interop\Container\ContainerInterface $container */
$container = $app->getContainer();

// Register provider
$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages();
};

// view renderer
$container['view'] = function ($container) {
    $settings = $container->get('settings');
    $view = new \Slim\Views\Twig($settings['renderer']['template_path'], [
        'cache' => $settings['renderer']['template_cache'],
        'auto_reload' => $settings['renderer']['auto_reload']
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->get('router'),
        $container->get('request')->getUri()
    ));

    $view->addExtension(new Knlv\Slim\Views\TwigMessages(
        $container->get('flash')
    ));

    $twig = $container->get('twig');
    foreach ($twig as $name => $value) {
        $view->getEnvironment()->addGlobal($name, $value);
    }

    $env = $view->getEnvironment();
    $env->addGlobal('messages', $container->get('flash')->getMessages());
    $env->addGlobal('session', $_SESSION);

    return $view;
};

//para tratamento de erros no Slim
$container['errorHandler'] = function ($container) {
    return new App\Handler\ExceptionHandler();
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Service factory for the ORM
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')['db']);
//$capsule->bootEloquent();
$capsule->setAsGlobal();
$capsule->bootEloquent();
