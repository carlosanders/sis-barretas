<?php
// DIC configuration

/** @var \Interop\Container\ContainerInterface $container */
$container = $app->getContainer();

// view renderer
/*
$container['renderer'] = function ($c) {
$settings = $c->get('settings')['renderer'];
return new Slim\Views\PhpRenderer($settings['template_path']);
};
 */
$container['view'] = function ($container) {
    $settings = $container->get('settings');
    $view = new \Slim\Views\Twig($settings['renderer']['template_path'], [
        'cache' => $settings['renderer']['template_cache']
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->get('router'),
        $container->get('request')->getUri()
    ));

    $loader = new Twig_Loader_Filesystem($settings['renderer']['template_path']);

    /*
    $view->addExtension(new Twig_Environment(
        $loader,
        array('debug' => true)
    ));
    */
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
