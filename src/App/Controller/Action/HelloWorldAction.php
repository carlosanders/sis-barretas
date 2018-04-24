<?php

namespace App\Controller\Action;

use App\Action;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HelloWorldAction extends Action
{

    public function __invoke(Request $request, Response $response, $args = [])
    {
        var_dump($this->container);
        //return $response->withRedirect($this->container->router->pathFor('categories.create'));
        return $response->write("Hello World");
    }
}
