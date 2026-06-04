<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\application_core\application\useCases\AuthnProviderService;
use gift\appli\application_core\application\useCases\AuthnService;
use Slim\Views\Twig;
use Slim\Routing\RouteContext;

class RegisterAction {

    private $authnProvider;
    public function __construct() {
        $this->authnProvider = new AuthnProviderService(new AuthnService());
    }

    public function showForm(Request $req, Response $res): Response {
        $twig = Twig::fromRequest($req); 
        return $twig->render($res, 'registerView.twig');
    }

    public function register(Request $req, Response $res): Response {
        $twig  = Twig::fromRequest($req);
        $data     = $req->getParsedBody();
        $email    = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (strlen($password) < 8) {
            return $twig->render('registerView.twig', [
                'error' => 'Le mot de passe doit contenir au moins 8 caractères.'
            ]);
        }

        $this->authnProvider->register($email, $password);
        $routeParser = RouteContext::fromRequest($req)->getRouteParser();
        return $res->withHeader('Location', $routeParser->urlFor('home'))->withStatus(302);
    }
}