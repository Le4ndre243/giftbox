<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\BoxService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use gift\appli\application_core\application\exceptions\BoxNotValidatedException;

class GenerateTokenAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'] ?? null;

        if ($id === null) {
            throw new \Slim\Exception\HttpBadRequestException($rq, 'Paramètre id manquant');
        }

        try {
            $service = new BoxService();
            $token = $service->generateToken($id);
        } catch (EntityNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, $e->getMessage());
        } catch (BoxNotValidatedException $e) {
            throw new \Slim\Exception\HttpForbiddenException($rq, $e->getMessage());
        } catch (\Exception $e) {
            throw new \Slim\Exception\HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $view = \Slim\Views\Twig::fromRequest($rq);
        return $view->render($rs, 'tokenView.twig', [
            'token' => $token,
            'box_id' => $id,
        ]);
    }
}
