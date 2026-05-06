<?php
namespace gift\appli\controlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Prestation;

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

        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>{$prestation->libelle}</title>
            </head>
            <body>
                <h1>{$prestation->libelle}</h1>
                <p>ID : {$prestation->id}</p>
                <p>Description : {$prestation->description}</p>
                <a href="/giftbox/categories">← Retour à la liste</a>
            </body>
            </html>
            HTML;

      $rs->getBody()->write($html);
        return $rs; 

        
    }
    }


?>