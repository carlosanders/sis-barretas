<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class DefaultController
{
    private $logger;
    private $renderer;

    public function __construct(LoggerInterface $logger, $renderer)
    {
        $this->logger = $logger;
        $this->renderer = $renderer;
    }

    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/' route");

        // Render index view
        return $this->renderer->render($response, 'index1.phtml', $args);
    }
}
