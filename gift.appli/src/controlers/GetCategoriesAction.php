<?php
namespace gift\appli\controlers; 


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Categorie;


class GetCategoriesAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response { 
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


}}


?>