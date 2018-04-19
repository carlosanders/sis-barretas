<?php

namespace App\Controller\Action;

use App\Controller\DefaultController as Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Pagination;
use Illuminate\Pagination\Paginator;
use Slim\Route;
use Slim\Router;


class CategoriaController extends Controller
{
    /** @var Router */
    private $router;
    /** @var \Slim\Views\TwigExtension */
    private $rota;

    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $total = DB::table('categorias')->count();
        $itensPorPagina = 5;
        $categorias = DB::table('categorias')->get();
        //$categorias = DB::table('categorias')->paginate($itensPorPagina);
        $currentItems = array_slice($categorias->toArray(), $itensPorPagina * ($currentPage - 1), $itensPorPagina);
        $paginator = new Paginator($categorias, 5, $currentPage);

        $cats = new Pagination\LengthAwarePaginator(
            $currentItems, //$categorias->toArray()['data'],
            $categorias->count() < $total ? $categorias->count() : $total, //count($categorias),
            $itensPorPagina,
            $paginator->currentPage()
        );
        //removendo '/'
        $cats->setPath('');

        $args['titulo'] = 'Lista de Categorias';
        $args['pagina'] = 'categorias/add';
        $args['categorias'] = $cats;

        return $this->view->render($response, 'categorias/index.html.twig', $args);
    }

    public function create(RequestInterface $request, ResponseInterface $response, $args)
    {
        $args['titulo'] = 'Cadastrar Categoria';
        $args['pagina'] = 'categorias/add';

        /** @var $route Route */
        $route = $request->getAttribute('route');
        //var_dump($route->getName());

        //var_dump( $this->view->getEnvironment()->getExtensions());
       // $this->router =
        /** @var $te \Slim\Views\TwigExtension */
        //$te = $this->view->getEnvironment()->getExtension('Slim\Views\TwigExtension');
        //var_dump($te->getName());
        //var_dump($this->router);

       // var_dump( $this->view->getEnvironment()->getExtension('Slim\Views\TwigExtension'));
       // var_dump( $this->view->getEnvironment()->getExtension('Slim\Container'));

        //var_dump( $this->view->getEnvironment()->getExtension('slim')->setBaseUrl($request->getUri()));


        return $this->view->render($response, 'categorias/create.html.twig', $args);
    }

    public function store(RequestInterface $request, ResponseInterface $response, $args)
    {
        $data = $request->getParsedBody();

        $name = trim(filter_var($data['name'], FILTER_SANITIZE_STRING));
        $descricao = trim(filter_var($data['descricao'], FILTER_SANITIZE_STRING));
        $precedencia = trim(filter_var($data['precedencia'], FILTER_SANITIZE_STRING));

        //$request

        /** @var $rotas \Slim\Views\TwigExtension */
        $rotas = $this->view->getEnvironment()->getExtension('Slim\Views\TwigExtension');
        $this->rota = $this->view->getEnvironment()->getExtension('Slim\Views\TwigExtension');

        if ($name == "" || $precedencia == "") {
            //$uri = $request->getUri()->withPath($this->router->pathFor('home'));
            return $response->withRedirect($rotas->pathFor('categories.create'));
        }

        $dados['nome'] = $name;
        $dados['descricao'] = $descricao;
        $dados['ordem'] = $precedencia;

        DB::table('categorias')->insert($dados);

        $args['titulo'] = 'Cadastrar Categoria';
        $args['pagina'] = 'categorias/add';


        return $response->withStatus(302)
            ->withHeader('Location', $this->rota->pathFor('categories.list'));
        //return $response->withRedirect($response->getBaseUrl() . '/new-url', 301);
    }
}
