<?php
/** @var \Interop\Container\ContainerInterface $container */
$container = $app->getContainer();

$container['DefaultController'] = function($container){
    return new \App\Controller\DefaultController(
        $container->get('logger'),
        $container->get('view') //$container->get('renderer')
    );
};

$container['CategoriaController'] = function($container){
    return new \App\Controller\Action\CategoriaController(
        $container->get('logger'),
        $container->get('view') //$container->get('renderer')
    );
};
