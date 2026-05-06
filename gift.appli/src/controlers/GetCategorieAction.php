<?php
namespace gift\appli\controlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Categorie;

class GetCategorieAction{


    public function __invoke(Request $rq, Response $rs, array $args): Response { 

        $categorie = Categorie::find($args['id']);

        if (!$categorie) {
            $rs->getBody()->write('<h1>Catégorie introuvable</h1>');
            return $rs->withHeader('Content-Type', 'text/html')->withStatus(404);
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
                <a href="/giftbox/categories">← Retour à la liste</a>
            </body>
            </html>
            HTML;

        $rs->getBody()->write($html);
        return $rs;
    }
}

?>