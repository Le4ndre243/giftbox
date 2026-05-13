<?php

declare(strict_types=1);

return function (\Slim\App $app): void {
  
      $app->get('/', gift\appli\webui\actions\GetHomeAction::class)
        ->setName('home');


    $app->get('/categories', gift\appli\webui\actions\GetCategoriesAction::class)
        ->setName('categories');

    $app->get('/categorie[/{id}]', gift\appli\webui\actions\GetCategorieAction::class)
        ->setName('categorie');

    $app->get('/coffretType', gift\appli\webui\actions\GetCoffretTypeAction::class)
        ->setName('coffretType');

    $app->get('/prestations', gift\appli\webui\actions\GetPrestationsListAction::class)
        ->setName('prestations');

    $app->get('/prestation/{id}', gift\appli\webui\actions\GetPrestationAction::class)
        ->setName('prestation');

    $app->get('/categorie/{id}/prestations', gift\appli\webui\actions\GetPrestationsByCategorieAction::class)
        ->setName('prestations_by_categorie');

    $app->get('/coffretType/{id}', gift\appli\webui\actions\GetCoffretByIdAction::class)
        ->setName('coffret_by_id');

};
