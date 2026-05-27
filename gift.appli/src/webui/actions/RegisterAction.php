<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\application_core\application\useCases\AuthnProviderService;
use gift\appli\application_core\application\useCases\AuthnService;
use Slim\Views\Twig;

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

        $user = $this->authnProvider->register($email, $password);
        return $twig->render($res, 'homeView.twig', [
            'user' => $user
        ]);
    }
}