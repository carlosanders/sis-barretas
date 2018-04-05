<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

class DefaultController
{
    /** @var LoggerInterface  */
    private $logger;
    /** @var Twig */
    private $view;

    public function __construct(LoggerInterface $logger, Twig $view)
    {
        $this->logger = $logger;
        $this->view = $view;
    }

    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/' route");

        // Render index view
        //return $this->renderer->render($response, 'index1.phtml', $args);
        return $this->view->render($response, 'index.html.twig', $args);
    }
}
