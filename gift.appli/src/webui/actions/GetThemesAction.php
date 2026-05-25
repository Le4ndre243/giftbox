<?php
namespace gift\appli\webui\actions;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\CatalogueService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use Slim\Views\Twig;

class GetThemesAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        try {
            $catalogueService = new CatalogueService();
            $themes = $catalogueService->getThemes();
        } catch (EntityNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, $e->getMessage());
        } catch (\Exception $e) {
            throw new \Slim\Exception\HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'themesListView.twig', ['themes' => $themes]);
    }
}
