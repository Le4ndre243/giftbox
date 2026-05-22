<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\BoxService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use gift\appli\application_core\application\exceptions\BoxNotEnoughPrestationsException;
use gift\appli\application_core\application\exceptions\BoxAlreadyValidatedException;
use Slim\Views\Twig;

class ValidateBoxAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {

        $boxService = new BoxService();

        try {
            $boxService->validateBox($args['id']);
        } catch (EntityNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, $e->getMessage());
        } catch (BoxNotEnoughPrestationsException $e) {
            throw new \Slim\Exception\HttpBadRequestException($rq, $e->getMessage());
        } catch (BoxAlreadyValidatedException $e) {
            throw new \Slim\Exception\HttpBadRequestException($rq, $e->getMessage());
        } catch (\Exception $e) {
            throw new \Slim\Exception\HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'boxValidateView.twig', [
            'boxId' => $args['id']
        ]);
    }
}