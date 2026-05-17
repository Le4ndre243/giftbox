<?php
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\CatalogueService;
use Slim\Views\Twig;

class GetPrestationsByCategorieAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'];

        try {
            $catalogueService = new CatalogueService();
            $categorie = $catalogueService->getCategorieById($id);
            $prestations = $catalogueService->getPrestationsbyCategorie((int) $id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, 'Catégorie introuvable');
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestationByCategorieView.twig', [
            'categorie'   => $categorie,
            'prestations' => $prestations,
        ]);

    }
}
