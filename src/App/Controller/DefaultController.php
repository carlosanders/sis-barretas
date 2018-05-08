<?php

namespace App\Controller;

use App\Action;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Pagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\QueryException;

class DefaultController extends Action
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     */
    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        // Sample log message
        //$this->logger->info(get_class($this)."'/'".__FUNCTION__);
        $url = $this->container->router->pathFor('home');

        $args['categorias'] = DB::table('categorias')
            ->orderByRaw('ordem ASC')
            ->get();

        $queryMedalhasMB = "SELECT *
                    FROM categorias c,
                         (SELECT g.categoria_id, 
                                 g.nome as nome_grupo, 
                                 g.origem_id, 
                                 g.ordem as grupo_ordem, m.id, 
                                 m.nome as nome_medalha, 
                                 m.imagem, 
                                 m.ordem as med_ordem, 
                                 m.grupo_id
                            FROM medalhas m, origens o, grupos g
                            WHERE o.id = m.origem_id
                              AND g.id = m.grupo_id
                               AND m.origem_id = '4' -- por uma determinada origem (4 - MB)
                            ORDER BY g.ordem, m.ordem) med
                    WHERE c.id = med.categoria_id
                    ORDER BY c.ordem, med.med_ordem";

        $resultsMedMB = DB::select(DB::raw($queryMedalhasMB));


        $search = '3';
        $romances = array_keys(
            array_filter(
                $resultsMedMB,
                function ($value) use ($search) {
                    //var_dump($value->categoria_id);
                    if($value->categoria_id == $search){
                        //var_dump($value);
                        return $value;
                        //$matches[] = $value;
                    }
                    /*
                    if(stripos($value->categoria_id, $search) !== false) {
                        $matches[] = $livro;
                    }*/

                    //return (strpos($value->categoria_id, $search) !== false);
                    return null;
                }
            )
        );
        //var_dump($romances);
        //var_dump($results);

        //funciona parcialmente
        $matches = array();
        foreach($resultsMedMB as $medalha => $data) {
            //var_dump($data);
            //if(stripos($data->categoria_id, '3') !== false) {
            if($data->categoria_id == $search){
                $matches[] = $data;
            }
        }
        //var_dump($matches);

        $args['medalhas'] = $resultsMedMB;
        $args['myValue'] = "apples";
        $args['myValue1'] = "7";

        /*
         DB::table('categorias')
         ->select(DB::raw($query))
         ->where('categorias.id', '<>', 1)
         ->orderByRaw('ordem ASC')
         ->get();
     */

        return $this->view->render($response, 'home.html.twig', $args);
    }

    /*public function throwException(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $this->logger->info("Slim-Skeleton '/throw' route");

        throw new \Exception('testing errors 1.2.3..');
    }*/
}
