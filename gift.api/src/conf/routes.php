<?php
declare(strict_types=1);

return function (\Slim\App $app): void {

    $app->get('/api/categories', gift\api\actions\GetCategoriesAction::class)
        ->setName('api_categories');

          $app->get('/api/boxes/{ID}', gift\api\actions\GetBoxesAction::class)
        ->setName('api_boxes');
};
