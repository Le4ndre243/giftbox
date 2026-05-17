<?php
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\CatalogueService;
use Slim\Views\Twig;


class GetPrestationAction{


    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'] ?? null;

        if ($id === null) {
            throw new \Slim\Exception\HttpBadRequestException($rq, 'Paramètre id manquant');
        }

        try {
            $catalogueService = new CatalogueService();
            $prestation = $catalogueService->getPrestationById($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, 'Prestation introuvable');
        }



            $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestationView.twig', [
            'prestation' => $prestation,
            'categorie'  => $prestation['categorie'],
        ]);


    }
    }


?>