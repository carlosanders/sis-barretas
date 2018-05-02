<?php
/**
 * ref: https://stackoverflow.com/questions/39212022/how-to-structure-route-controllers-in-slim-framework-3-mvc-pattern
 */

namespace App;

use Interop\Container\ContainerInterface as Container;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Slim\Flash\Messages;

class Action
{
    /** @var LoggerInterface */
    protected $logger;
    /** @var Twig */
    protected $view;
    /** @var \Slim\Container */
    protected $container;
    /** @var Messages */
    protected $flash;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->logger = $container->get('logger');
        $this->view = $container->get('view');
        $this->flash = $container->get('flash');
       //$this->flash->addMessage('error', 'Você deve estar anders');
       //var_dump($this->flash);
    }

    //abstract public function __invoke(Request $request, Response $response, $args = []);
}
