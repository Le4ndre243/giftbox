<?php
namespace gift\appli\controlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Prestation;
use Slim\Views\Twig;


class GetPrestationAction{


    public function __invoke(Request $rq, Response $rs, array $args): Response { 
                       $id = $rq->getQueryParams()['id'] ?? null;

        if ($id === null) {
            throw new \Slim\Exception\HttpBadRequestException($rq, 'Paramètre id manquant');
        }

        try {
            $prestation = Prestation::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, 'Prestation introuvable');
        }



            $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestationView.twig', [
            'prestation' => $prestation->toArray(),
            'categorie'  => $prestation->categorie->toArray(),
        ]);


    }
    }


?>