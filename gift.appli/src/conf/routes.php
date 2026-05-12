<?php

declare(strict_types=1);

return function (\Slim\App $app): void {
  
      $app->get('/', gift\appli\controlers\GetHomeAction::class)
        ->setName('home');


    $app->get('/categories', gift\appli\controlers\GetCategoriesAction::class)
        ->setName('categories');

    $app->get('/categorie[/{id}]', gift\appli\controlers\GetCategorieAction::class)
        ->setName('categorie');

    $app->get('/coffretType', gift\appli\controlers\GetCoffretTypeAction::class)
        ->setName('coffretType');

    $app->get('/prestations', gift\appli\controlers\GetPrestationsListAction::class)
        ->setName('prestations');

    $app->get('/prestation/{id}', gift\appli\controlers\GetPrestationAction::class)
        ->setName('prestation');

    $app->get('/categorie/{id}/prestations', gift\appli\controlers\GetPrestationsByCategorieAction::class)
        ->setName('prestations_by_categorie');

<<<<<<< HEAD
    $app->get('/coffretType/{id}', gift\appli\controlers\GetCoffretByIdAction::class)
=======
    $app->get('/coffret/{id}', gift\appli\controlers\GetCoffretByIdAction::class)
>>>>>>> af640135ba76fe0d5f7efdef9f67727ee6ca02a5
        ->setName('coffret_by_id');

};
