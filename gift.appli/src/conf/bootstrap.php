<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use gift\appli\utils\Eloquent;

session_start();

Eloquent::init(__DIR__ . '/db.ini');

$app = AppFactory::create();
$app->setBasePath('/giftbox');

$twig = Twig::create(__DIR__ . '/../views/templates', ['cache' => false]);

$twig->getEnvironment()->addGlobal('nav_menu', [
    ['url' => '/giftbox/categories', 'label' => 'Lister les catégories']
]);

$app->add(TwigMiddleware::create($app, $twig));

$routes = require_once __DIR__ . '/routes.php';
$routes($app);

$app->addErrorMiddleware(true, true, true);

return $app;