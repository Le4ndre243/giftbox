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
    ['url' => '/giftbox/', 'label' => 'Accueil'],
    ['url' => '/giftbox/categories', 'label' => 'Lister les catégories']

]);
$twig->getEnvironment()->addGlobal('css_dir', '/giftbox/css');
$twig->getEnvironment()->addGlobal('img_dir', '/giftbox/img');

$app->add(TwigMiddleware::create($app, $twig));

$routes = require_once __DIR__ . '/routes.php';
$routes($app);

$app->addErrorMiddleware(true, true, true);

return $app;