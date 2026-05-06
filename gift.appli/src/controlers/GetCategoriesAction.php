<?php
namespace gift\appli\controlers; 


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Categorie;
use Slim\Views\Twig;


class GetCategoriesAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $categories = Categorie::all();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categoriesView.twig', ['categories' => $categories->toArray()]);


}}


?>