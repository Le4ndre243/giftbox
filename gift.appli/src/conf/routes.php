<?php

declare(strict_types=1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;

return function (\Slim\App $app): void {
  

    $app->get('/categories', gift\appli\controlers\GetCategoriesAction::class);

    $app->get('/categorie[/{id}]', gift\appli\controlers\GetCategorieAction::class);

    $app->get('/prestations', gift\appli\controlers\GetPrestationAction::class);

    $app->get('/categorie/{id}/prestations', gift\appli\controlers\GetPrestationsByCategorieAction::class);


};
