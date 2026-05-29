<?php

namespace gift\appli\webui\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\application_core\application\useCases\AuthnProviderService;
use gift\appli\application_core\application\useCases\AuthnService;

class SignOutAction {

    public function __invoke(Request $req, Response $res): Response {
        $authnProvider = new AuthnProviderService(new AuthnService());
        $authnProvider->signout();

        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        return $res->withHeader('Location', $basePath . '/')->withStatus(302);
    }
}
