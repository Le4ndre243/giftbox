<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use gift\appli\application_core\application\providers\CsrfTokenProvider;

class GetCreateBoxAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $token = CsrfTokenProvider::generate();
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'createbox.html.twig', ['csrf_token' => $token]);
    }
}
