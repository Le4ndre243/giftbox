<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use gift\appli\application_core\application\useCases\CatalogueService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;
use gift\appli\application_core\application\providers\CsrfTokenProvider;

class GetCreateBoxFromCoffretAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $id = $args['id'] ?? null;

        if ($id === null) {
            throw new \Slim\Exception\HttpBadRequestException($rq, 'Paramètre id manquant');
        }

        try {
            $catalogueService = new CatalogueService();
            $coffret = $catalogueService->getCoffretById((int) $id);
        } catch (EntityNotFoundException $e) {
            throw new \Slim\Exception\HttpNotFoundException($rq, $e->getMessage());
        }

        $token = CsrfTokenProvider::generate();
        $view = Twig::fromRequest($rq);

        return $view->render($rs, 'createbox.html.twig', [
            'csrf_token' => $token,
            'prefill_name' => $coffret['coffretType']['libelle'] ?? '',
            'prefill_desc' => $coffret['coffretType']['description'] ?? '',
        ]);
    }
}
