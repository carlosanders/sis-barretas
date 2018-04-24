<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


$app->group('/categorias', function (){
    //$this->get('', MedalhaController::class . ':index');
    $this->get('[/]', '\App\Controller\Action\CategoriaAction:index')->setName('categories.list');
    $this->get('/create', '\App\Controller\Action\CategoriaAction:create')->setName('categories.create');
    $this->post('/store', '\App\Controller\Action\CategoriaAction:store')->setName('categories.store');
});

$app->get('/throw', '\App\Controller\DefaultController:throwException');

$app->get('/', '\App\Controller\DefaultController:index');

$app->get("/hello", \App\Controller\Action\HelloWorldAction::class);

//$app->get('/[{name}]', 'DefaultController:index');
/*
// substituido acima - Anders
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index1.phtml', $args);
    //return $response->write("Hello " . $args['name']);
});
*/
