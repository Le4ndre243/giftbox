<?php
namespace gift\appli\controlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Categorie;

class GetPrestationsByCategorieAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'];

        try {
            $categorie = Categorie::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, 'Catégorie introuvable');
        }

        $prestations = $categorie->prestations;

        $items = '';
        foreach ($prestations as $p) {
            $items .= "<li><a href=\"/giftbox/prestations?id={$p->id}\">{$p->libelle}</a> - {$p->tarif} €/{$p->unite}</li>\n";
        }

        if ($items === '') {
            $items = '<li>Aucune prestation pour cette catégorie.</li>';
        }

        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Prestations - {$categorie->libelle}</title>
            </head>
            <body>
                <h1>Prestations de la catégorie : {$categorie->libelle}</h1>
                <ul>
                    $items
                </ul>
                <a href="/giftbox/categories">← Retour aux catégories</a>
            </body>
            </html>
            HTML;

        $rs->getBody()->write($html);
        return $rs;
    }
}
