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
        $categorias = DB::table('categorias')
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

        $queryGrupos = "SELECT * FROM barretas.grupos";
        $rsGrupos = DB::select(DB::raw($queryGrupos));

        //monta o array
        foreach ($categorias as $categoria) {
            $categoria->medalhas = [];
            foreach ($resultsMedMB as $medalha) {
                if ($medalha->categoria_id == $categoria->id) {
                    $categoria->medalhas[] = $medalha;
                }
            }
        }
        $args['categorias'] = $categorias;
        $args['medalhas'] = $resultsMedMB;

        return $this->view->render($response, 'home.html.twig', $args);
    }
}
