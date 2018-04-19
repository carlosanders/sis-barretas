<?php

namespace App\Controller\Action;

use App\Controller\DefaultController as Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Pagination;
use Illuminate\Pagination\Paginator;


class CategoriaController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        // Sample log message
        //$this->logger->info("categorias'/'index");
        $args['titulo'] = 'Lista de Categorias';
        $args['pagina'] = 'categorias/add';
        //$args['app_name'] = getenv('APP_NAME');
        //$args['app_ver'] = getenv('APP_VER');

        //
        $currentPage  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        //$categorias = DB::table('categorias')->get();
        $categorias = DB::table('categorias')->paginate(5);
//        var_dump('total de paginas: '. $categorias->lastPage());
//        var_dump('se existe + paginas: '. $categorias->hasMorePages());
//        var_dump('pagina atual: '. $categorias->currentPage());
//        var_dump('itens por página: '. $categorias->perPage());
//        var_dump($categorias->nextPageUrl());
        //var_dump($categorias->);
       // var_dump($categorias); //retorna Collection items com os nomes das colunas

        $paginator = new Paginator($categorias, 5, $currentPage);
        $paginator->setPath('http://localhost:8888/categorias/');
        $args['paginator'] = $paginator;
        //var_dump($paginator);

        $args['categorias'] = $categorias;

        return $this->view->render($response, 'categorias/index.html.twig', $args);
    }
}
