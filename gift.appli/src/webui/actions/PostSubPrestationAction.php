<?php
namespace gift\appli\webui\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\BoxService;
use Slim\Routing\RouteContext;

class PostSubPrestationAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $presta_id = $args['id'];
        $box_id = $_SESSION['current_box_id'];

        $service = new BoxService();
        $service->subPrestation($box_id, $presta_id);

        $url = $routeParser->urlFor('boxById', ['id' => $box_id]);
        return $rs->withHeader('Location', $url)->withStatus(302);
    }

    
}
