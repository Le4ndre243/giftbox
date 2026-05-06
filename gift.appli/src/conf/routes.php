<?php

declare(strict_types=1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;

return function (\Slim\App $app): void {
  

    $app->get('/categories', function (Request $rq, Response $rs, array $args): Response {
        $categories = Categorie::all();

        $items = '';
        foreach ($categories as $cat) {
            $items .= "<li><a href=\"categorie/{$cat->id}\">{$cat->id} - {$cat->libelle}</a></li>\n";
        }

        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Catégories</title>
            </head>
            <body>
                <h1>Liste des catégories</h1>
                <ul>
                    $items
                </ul>
            </body>
            </html>
            HTML;

        $rs->getBody()->write($html);
        return $rs; 
    });

    $app->get('/categorie/{id}', function (Request $rq, Response $rs, array $args): Response {
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
    });






    $app->get('/prestations', function (Request $rq, Response $rs, array $args): Response {
               $id = $rq->getQueryParams()['id'] ?? null;

        try{
            $prestation = Prestation::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $rs->getBody()->write("<h1>Prestation introuvable : " . ($id ?? 'Veuillez rentrer un id valide') . "</h1>");
            return $rs->withHeader('Content-Type', 'text/html')->withStatus(404);
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

        
    });
};
