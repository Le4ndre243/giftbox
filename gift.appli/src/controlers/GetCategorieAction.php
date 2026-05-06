<?php
namespace gift\appli\controlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Categorie;
use Slim\Views\Twig;

class GetCategorieAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'] ?? null;

        if ($id === null) {
            throw new \Slim\Exception\HttpBadRequestException($rq, 'Paramètre id manquant');
        }

        $categorie = Categorie::find($id);
        if (!$categorie) {
            throw new \Slim\Exception\HttpNotFoundException($rq, 'Catégorie introuvable');
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categorieView.twig', $categorie->toArray());
    }
}
