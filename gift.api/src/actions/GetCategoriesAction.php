<?php
declare(strict_types=1);

namespace gift\api\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use gift\appli\application_core\application\useCases\CatalogueService;

class GetCategoriesAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $service = new CatalogueService();
        $categories = $service->getCategories();

        $data = [
            'type'       => 'collection',
            'count'      => count($categories),
            'categories' => array_map(function (array $cat) {
                return [
                    'categorie' => [
                        'id'          => $cat['id'],
                        'libelle'     => $cat['libelle'],
                        'description' => $cat['description'],
                    ],
                    'links' => [
                        'self' => ['href' => '/categories/' . $cat['id'] . '/'],
                    ],
                ];
            }, $categories),
        ];

        $rs->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        return $rs->withHeader('Content-Type', 'application/json');
    }
}
