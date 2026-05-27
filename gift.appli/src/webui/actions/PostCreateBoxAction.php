<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use gift\appli\application_core\application\useCases\BoxService;
use gift\appli\application_core\application\providers\CsrfTokenProvider;

class PostCreateBoxAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = $rq->getParsedBody();

        CsrfTokenProvider::check($data['csrf_token'] ?? '');

        $libelle = trim($data['name'] ?? '');
        $description = trim($data['desc'] ?? '');
        $kdo = isset($data['giftcheckbox']) && $data['giftcheckbox'] === '1';
        $message_kdo = trim($data['giftmess'] ?? '');

        if ($libelle === '') {
            throw new \InvalidArgumentException('Le nom de la box est obligatoire.');
        }

        // Création de la box et stockage de l'id en session
        $service = new BoxService();
        $box = $service->createBox($libelle, $description, $kdo, $message_kdo);

        $_SESSION['current_box_id'] = $box->id;

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('boxById', ['id' => $box->id]);

        return $rs->withHeader('Location', $url)->withStatus(302);
    }
}
