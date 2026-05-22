<?php
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\CatalogueService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use Slim\Views\Twig;

class ValidateBoxAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {


        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestationsListView.twig', [''=> $args]);
    }
}
