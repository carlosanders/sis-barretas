<?php

namespace App\Controller;

use App\Action;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DefaultController extends Action
{
    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        // Sample log message
        $this->logger->info(get_class($this)."'/'".__FUNCTION__);

        return $this->view->render($response, 'index.html.twig', $args);
    }

    public function throwException(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $this->logger->info("Slim-Skeleton '/throw' route");

        throw new \Exception('testing errors 1.2.3..');
    }
}
