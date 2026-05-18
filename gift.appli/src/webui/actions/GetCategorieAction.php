<?php
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\CatalogueService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use Slim\Views\Twig;

class GetCategorieAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'] ?? null;

        if ($id === null) {
            throw new \Slim\Exception\HttpBadRequestException($rq, 'Paramètre id manquant');
        }

        try {
            $service = new CatalogueService();
            $categorie = $service->getCategorieById((int) $id);
        } catch (EntityNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categorieView.twig', ['categorie' => $categorie]);
    }
}