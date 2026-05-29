<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use gift\appli\infrastructure\Eloquent;

Eloquent::init(__DIR__ . '/db.ini');

$app = AppFactory::create();

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$app->setBasePath($basePath);

$routes = require_once __DIR__ . '/routes.php';
$routes($app);

$app->addErrorMiddleware(true, true, true);

return $app;
