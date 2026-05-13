<?php 
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\domain\entities\CoffretType;
use Slim\Views\Twig;


class getCoffretTypeAction{
    public function __invoke(Request $rq, Response $rs, array $args): Response {
    $coffrets = CoffretType::all();

    $view = Twig::fromRequest($rq);
    return $view->render($rs, 'coffretTypeView.twig', ['coffretType' => $coffrets->toArray()]);

    }
}

?>