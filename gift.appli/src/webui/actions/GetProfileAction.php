<?php

namespace gift\appli\webui\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetProfileAction {

    public function __invoke(Request $req, Response $res): Response {
        $user = $_SESSION['auth_user'] ?? null;

        if (!$user) {
            $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
            return $res->withHeader('Location', $basePath . '/signin')->withStatus(302);
        }

        $boxes = $user->boxes()->orderBy('created_at', 'desc')->get();

        $twig = Twig::fromRequest($req);
        return $twig->render($res, 'profileView.twig', [
            'user'  => $user,
            'boxes' => $boxes,
        ]);
    }
}
