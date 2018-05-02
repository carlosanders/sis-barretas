<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/throw', '\App\Controller\DefaultController:throwException');
$app->get("/hello", \App\Controller\Action\HelloWorldAction::class);


$app->get('/', '\App\Controller\DefaultController:index')
    ->setName('home');

//Grupo de Categorias
$app->group('/categorias', function () {

    $this->get('[/]', '\App\Controller\Action\CategoriaAction:index')->setName('categories.list');
    $this->get('/create', '\App\Controller\Action\CategoriaAction:create')->setName('categories.create');
    $this->post('/store', '\App\Controller\Action\CategoriaAction:store')->setName('categories.store');
    $this->get('/{id:\d+}/edit', '\App\Controller\Action\CategoriaAction:edit')->setName('categories.edit');
    $this->put('/{id:\d+}/update', '\App\Controller\Action\CategoriaAction:update')->setName('categories.update');
    $this->delete('/{id:\d+}/delete', '\App\Controller\Action\CategoriaAction:delete')->setName('categories.trash');
});


//teste de msg - funciona eh soh descomentar
$app->get('/admin', function ($request, $response, $args) {
    $this->flash->addMessage('error', 'Você deve estar logado');
    //var_dump($this->flash);
    return $response->withStatus(302)->withHeader('Location', '/hello');
})
    ->setName('admin');

$app->get('/admin1', function ($request, $response, $args) {
    $this->flash->addMessage('error', 'Você deve estar logado');
    //var_dump($this->flash);
    return $response->withStatus(302)->withHeader('Location', '/');
})
    ->setName('admin');

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
