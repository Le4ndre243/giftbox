<?php
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\domain\entities\Categorie;
use Slim\Views\Twig;

class GetPrestationsByCategorieAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'];

        try {
            $categorie = Categorie::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, 'Catégorie introuvable');
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestationByCategorieView.twig', [
            'categorie'   => $categorie->toArray(),
            'prestations' => $categorie->prestations->toArray(),
        ]);

    }
}
