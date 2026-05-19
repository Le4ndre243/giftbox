<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\BoxService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use Slim\Views\Twig;

class GetBoxByTokenAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $token = $args['token'] ?? null;

        if ($token === null) {
            throw new \Slim\Exception\HttpBadRequestException($rq, 'Token manquant');
        }

        try {
            $service = new BoxService();
            $box = $service->getBoxByToken($token);
        } catch (EntityNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, $e->getMessage());
        } catch (\Exception $e) {
            throw new \Slim\Exception\HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'boxView.twig', ['box' => $box]);
    }
}
