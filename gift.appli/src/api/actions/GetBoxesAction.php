<?php
declare(strict_types=1);

namespace gift\api\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\BoxService;
use gift\appli\application_core\application\exceptions\EntityNotFoundException;

class GetBoxesAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $id = $args['ID'];
        $service = new BoxService();

        try {
            $box = $service->getBoxById($id);
        } catch (EntityNotFoundException $e) {
            $rs->getBody()->write(json_encode(['error' => 'Box not found'], JSON_UNESCAPED_UNICODE));
            return $rs->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        $data = [
            'type' => 'resource',
            'box'  => [
                'id'          => $box['id'],
                'libelle'     => $box['libelle'],
                'description' => $box['description'],
                'message_kdo' => $box['message_kdo'],
                'statut'      => $box['statut'],
                'prestations' => array_map(function (array $presta) use ($box) {
                    return [
                        'libelle'     => $presta['libelle'],
                        'description' => $presta['description'],
                        'contenu'     => [
                            'box_id'    => $box['id'],
                            'presta_id' => $presta['id'],
                            'quantite'  => $presta['pivot']['quantite'],
                        ],
                    ];
                }, $box['prestations']),
            ],
        ];

        $rs->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}
