<?php

namespace App\Controller\Action;

use App\Action;
use Illuminate\Database\QueryException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Pagination;
use Illuminate\Pagination\Paginator;


class CategoriaAction extends Action
{

    public function index(Request $request, Response $response, $args = [])
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
        //$args['pagina'] = 'categorias/add';
        $args['categorias'] = $cats;

        return $this->view->render($response, 'categorias/index.html.twig', $args);
    }

    public function create(Request $request, Response $response, $args = [])
    {
        $args['titulo'] = 'Cadastrar Categoria';
        $args['pagina'] = 'categorias/add';

        //$args['name'] = 'teste nome';

        /** @var $route \Slim\Route */
        $route = $request->getAttribute('route');
        //var_dump($route->getName());

        /** @var $te \Slim\Views\TwigExtension */
        //$te = $this->view->getEnvironment()->getExtension('Slim\Views\TwigExtension');
        //var_dump($te->getName());
        //var_dump($this->router);

        // var_dump( $this->view->getEnvironment()->getExtension('Slim\Views\TwigExtension'));
        // var_dump( $this->view->getEnvironment()->getExtension('Slim\Container'));
        //var_dump( $this->view->getEnvironment()->getExtension('slim')->setBaseUrl($request->getUri()));

        return $this->view->render($response, 'categorias/create.html.twig', $args);
    }

    public function store(Request $request, Response $response, $args = [])
    {
        $data = $request->getParsedBody();

        $name = trim(filter_var($data['name'], FILTER_SANITIZE_STRING));
        $descricao = trim(filter_var($data['descricao'], FILTER_SANITIZE_STRING));
        $precedencia = trim(filter_var($data['precedencia'], FILTER_SANITIZE_STRING));

        if ($name == "" || $precedencia == "") {
            //$uri = $request->getUri()->withPath($this->router->pathFor('home'));
            return $response->withRedirect($this->container->router->pathFor('categories.create'));
        }

        $dados['nome'] = $name;
        $dados['descricao'] = $descricao;
        $dados['ordem'] = $precedencia;

        $uri = $request->getUri();

        //DB::table('categorias')->insert($dados);
        try {
            DB::table('categorias')->insert($dados);
        } catch (QueryException $ex) {
            $this->flash->addMessage('error', $ex->getMessage());
            $this->flash->addMessage('data', $data);

            $url = $this->container
                ->router->pathFor('categories.create');
            // return $response->withStatus(302)->withHeader('Location', $url);
            return $response->withRedirect($url);
            //return $response->withHeader('Location', $uri);
        }

        $args['titulo'] = 'Cadastrar Categoria';
        $args['pagina'] = 'categorias/add';

        return $response->withStatus(302)
            ->withHeader('Location', $this->container->router->pathFor('categories.list'));
    }

    public function edit(Request $request, Response $response)
    {
        $args['titulo'] = 'Editar Categoria';
        $args['pagina'] = 'categorias/edit';

        $id = $request->getAttribute('id');
        //url para redirecionar
        $url = $this->container->router->pathFor('categories.list');

        try {
            $categoria = DB::table('categorias')->where('id', $id)->first();

            if (!$categoria) {
                $this->flash->addMessage('error', "Categoria {$id} não encotrada.");

                return $response->withStatus(302)->withHeader('Location', $url);
            }

            $args['categoria'] = $categoria;

        } catch (QueryException $ex) {
            $this->flash->addMessage('error', $ex->getMessage());
            return $response->withStatus(302)->withHeader('Location', $url);
        }

        return $this->view->render($response, 'categorias/edit.html.twig', $args);
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getAttribute('id');
        //url para redirecionar
        $url = $this->container->router->pathFor('categories.list');

        try {
            $categoria = DB::table('categorias')->where('id', $id)->first();

            if (!$categoria) {
                $this->flash->addMessage('error', "Categoria {$id} não encotrada.");
                return $response->withStatus(302)->withHeader('Location', $url);
            }

            $data = $request->getParsedBody();

            $name = trim(filter_var($data['name'], FILTER_SANITIZE_STRING));
            $descricao = trim(filter_var($data['descricao'], FILTER_SANITIZE_STRING));
            $precedencia = trim(filter_var($data['precedencia'], FILTER_SANITIZE_STRING));

            $dados['nome'] = $name;
            $dados['descricao'] = $descricao;
            $dados['ordem'] = $precedencia;

            DB::table('categorias')->where('id', $id)->update($dados);

            $this->flash->addMessage('success', "Categoria {$id} atualizada com sucesso.");
            return $response->withStatus(302)->withHeader('Location', $url);

        } catch (QueryException $ex) {
            $this->flash->addMessage('error', $ex->getMessage());
            return $response->withStatus(302)->withHeader('Location', $url);
        }
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->getAttribute('id');
        //url para redirecionar
        $url = $this->container->router->pathFor('categories.list');

        try {
            $categoria = DB::table('categorias')->where('id', $id)->first();

            if (!$categoria) {
                $this->flash->addMessage('error', "Categoria {$id} não encotrada.");
                return $response->withStatus(302)->withHeader('Location', $url);
            }

            DB::table('categorias')->where('id', $id)->delete();

            $this->flash->addMessage('success', "Categoria {$id} excluída com sucesso.");
            return $response->withStatus(302)->withHeader('Location', $url);

        } catch (QueryException $ex) {
            $this->flash->addMessage('error', $ex->getMessage());
            return $response->withStatus(302)->withHeader('Location', $url);
        }
    }

}
