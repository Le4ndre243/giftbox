<?php
namespace gift\appli\controlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Categorie;

class GetCategorieAction{


    public function __invoke(Request $rq, Response $rs, array $args): Response { 
                               $id = $args['id'] ?? null;

        if ($id === null) {
            throw new \Slim\Exception\HttpBadRequestException($rq, 'Paramètre id manquant');
        }

        $categorie = Categorie::find($id);
        if (!$categorie) {
            throw new \Slim\Exception\HttpNotFoundException($rq, 'Catégorie introuvable');
        }

        $html = <<<HTML
            <!DOCTYPE html> 
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>{$categorie->libelle}</title>
            </head>
            <body>
                <h1>{$categorie->libelle}</h1>
                <p>ID : {$categorie->id}</p>
                <p>Description : {$categorie->description}</p>
                <a href="/giftbox/categorie/{$categorie->id}/prestations">Voir les prestations →</a><br>
                <a href="/giftbox/categories">← Retour à la liste</a>
            </body>
            </html>
            HTML;

        $rs->getBody()->write($html);
        return $rs;
    }
}

?>