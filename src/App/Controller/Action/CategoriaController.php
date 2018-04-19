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
//        var_dump('total de paginas: '. $categorias->lastPage());
//        var_dump('se existe + paginas: '. $categorias->hasMorePages());
//        var_dump('pagina atual: '. $categorias->currentPage());
//        var_dump('itens por página: '. $categorias->perPage());
//        var_dump($categorias->nextPageUrl());
        //var_dump($categorias->);
        // var_dump($categorias); //retorna Collection items com os nomes das colunas
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        //var_dump($currentPage);

        $total = DB::table('categorias')->count();
        $itensPorPagina = 5;
        $categorias = DB::table('categorias')->get();
        //$categorias = DB::table('categorias')->paginate($itensPorPagina);
        //die(var_dump($categorias->toArray()));
        $currentItems = array_slice($categorias->toArray(), $itensPorPagina * ($currentPage - 1), $itensPorPagina);

        $paginator = new Paginator($categorias, 5, $currentPage);
        //$paginator->setPath('');
        //var_dump($paginator->items());

        $cats = new Pagination\LengthAwarePaginator(
            $currentItems, //$categorias->toArray()['data'],
            $categorias->count() < $total ? $categorias->count() : $total, //count($categorias),
            $itensPorPagina,
            $paginator->currentPage()
//
//            ,[
//                'path' => Pagination\LengthAwarePaginator::resolveCurrentPath(),
//                'pageName' => 'page',
//            ]

        );
        //removendo '/'
        $cats->setPath('');

        //var_dump($cats->previousPageUrl());
        //var_dump($cats->hasPages());
        //die(($cats->links()));
        $args['paginator'] = $paginator;
        $args['categorias'] = $cats;

        //var_dump($request->getUri());
        //var_dump($request->getUri()->getPath());
        //var_dump($request->ro);
        //var_dump($paginator->ur);

        return $this->view->render($response, 'categorias/index.html.twig', $args);
    }
}
