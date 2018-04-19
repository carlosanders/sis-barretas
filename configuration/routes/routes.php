<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


$app->get('/throw', 'DefaultController:throwException');

$app->group('/categorias', function (){
    //$this->get('', MedalhaController::class . ':index');
    $this->get('[/]', 'CategoriaController:index')->setName('categories.list');
    $this->get('/create', 'CategoriaController:create')->setName('categories.create');
    $this->post('/store', 'CategoriaController:store')->setName('categories.store');
});

$app->get('/', 'DefaultController:index');

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
