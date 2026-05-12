<?php
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use gift\appli\utils\Eloquent;

session_start();

// src/conf/db.ini
Eloquent::init(__DIR__ . '/db.ini');

$app = AppFactory::create();

// Détection automatique de l'environnement
$basePath = $_SERVER['SERVER_NAME'] === 'localhost'
    ? '/giftbox/gift.appli'
    : '/giftbox';
$app->setBasePath($basePath);

// src/conf/../../src/views/templates = src/views/templates
$twig = Twig::create(__DIR__ . '/../views/templates', ['cache' => false]);

$twig->getEnvironment()->addGlobal('nav_menu', [
    ['url' => $basePath . '/', 'label' => 'Accueil'],
    ['url' => $basePath . '/categories', 'label' => 'Lister les catégories'],
    ['url' => $basePath . '/coffretType', 'label' => 'Liste des coffrets types']

]);
$twig->getEnvironment()->addGlobal('css_dir', $basePath . '/public/css');
$twig->getEnvironment()->addGlobal('img_dir', $basePath . '/public/img');
$app->add(TwigMiddleware::create($app, $twig));

// src/conf/routes.php
$routes = require_once __DIR__ . '/routes.php';
$routes($app);

$app->addErrorMiddleware(true, true, true);

return $app;