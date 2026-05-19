<?php
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\CatalogueService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use Slim\Views\Twig;

class GetPrestationsListAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        try {
            $catalogueService = new CatalogueService();
            $prestations = $catalogueService->getPrestations();
        } catch (EntityNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, $e->getMessage());
        } catch (\Exception $e) {
            throw new \Slim\Exception\HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestationsListView.twig', ['prestations' => $prestations]);
    }
}
