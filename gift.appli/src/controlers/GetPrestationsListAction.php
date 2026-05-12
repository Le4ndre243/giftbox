<?php
namespace gift\appli\controlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Prestation;
use Slim\Views\Twig;

class GetPrestationsListAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $prestations = Prestation::with('categorie')->get();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestationsListView.twig', [
            'prestations' => $prestations->toArray(),
        ]);
    }
}
