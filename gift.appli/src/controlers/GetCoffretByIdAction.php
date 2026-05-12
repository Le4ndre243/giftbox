<?php
namespace gift\appli\controlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\CoffretType;

use Slim\Views\Twig;

class GetCoffretByIdAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'];

        try {
            $coffretType = CoffretType::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, 'Coffret introuvable');
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'coffretByIdView.twig', [
            'coffretType' => $coffretType->toArray(),
            'prestations'  => $coffretType->prestations->toArray(),
        ]);

    }
}