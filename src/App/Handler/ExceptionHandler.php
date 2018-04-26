<?php

namespace App\Handler;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;

class ExceptionHandler
{
    public function __invoke(Request $request, Response $response, Exception $exception)
    {
        return $response
            ->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    }
}
