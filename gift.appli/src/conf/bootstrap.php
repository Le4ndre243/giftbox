<?php

use Slim\Factory\AppFactory;
use gift\appli\utils\Eloquent;

session_start();

Eloquent::init(__DIR__ . '/db.ini');

$app = AppFactory::create();
$app->setBasePath('/giftbox');

$routes = require_once __DIR__ . '/routes.php';
$routes($app);

return $app;