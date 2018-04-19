<?php
// DIC configuration

/** @var \Interop\Container\ContainerInterface $container */
$container = $app->getContainer();

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
/*
    $environment = (new  \Dotenv\Loader(APP_ROOT.'/configuration/environments/environment.env'))
        ->parse()
        ->toArray(); // Throws LogicException if ->parse() is not called first
    //var_dump($settings);

    $view->getEnvironment()->addGlobal("app" , $environment);
*/
    //echo $settings['renderer']['cache'];
    //para exibir as variaveis
    //var_dump($view->getEnvironment());

    return $view;
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
/*
// Service factory for the ORM
$container['db'] = function ($container) {
    $settings = $container->get('settings')['db'];
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
*/
