<?php
// src/Presentation/Actions/SigninAction.php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\application_core\application\useCases\AuthnProviderService;
use gift\appli\application_core\application\useCases\AuthnService;
use Slim\Views\Twig;

class SignInAction {

    private $authnProvider;
    public function __construct() {
        $this->authnProvider = new AuthnProviderService(new AuthnService());
    }

    public function showForm(Request $req, Response $res): Response {
        $twig = Twig::fromRequest($req); 
        return $twig->render($res, 'signInView.twig');
    }

    public function signin(Request $req, Response $res): Response {
        $twig  = Twig::fromRequest($req);
        $data     = $req->getParsedBody();
        $email    = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if ($this->authnProvider->signin($email, $password)) {
            return $twig->render($res, 'homeView.twig', [
                'user' => $this->authnProvider->getSignedInUser()
            ]);
        }

        return $twig->render($res, 'signInView.twig', [
            'error' => 'Email ou mot de passe incorrect.'
        ]);
    }
}