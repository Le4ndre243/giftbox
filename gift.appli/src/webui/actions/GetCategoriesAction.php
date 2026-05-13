<?php
namespace gift\appli\webui\actions;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\domain\entities\Categorie;
use Slim\Views\Twig;


class GetCategoriesAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $categories = Categorie::all();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categoriesView.twig', ['categories' => $categories->toArray()]);


}}


?>