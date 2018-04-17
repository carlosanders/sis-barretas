<?php

namespace App\Controller\Action;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Illuminate\Database\Capsule\Manager as DB;


class CategoriaController
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
        //$this->logger->info("categorias'/'index");
        $args['titulo'] = 'Lista de Categorias';
        $args['pagina'] = 'categorias/add';

        $categorias = DB::table('categorias')->get();
        //var_dump($categorias); //retorna Collection items com os nomes das colunas
        $args['categorias'] = $categorias;

        return $this->view->render($response, 'categorias/index.html.twig', $args);
    }
}
