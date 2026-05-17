<?php 
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\CatalogueService;
use Slim\Views\Twig;


class getCoffretTypeAction{
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $service = new CatalogueService();
        $coffrets = $service->getThemesCoffrets();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'coffretTypeView.twig', ['coffretType' => $coffrets]);
    }
}

?>