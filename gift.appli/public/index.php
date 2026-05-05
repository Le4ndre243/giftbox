<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;

session_start();

require_once __DIR__ . '/../src/vendor/autoload.php';

$app = AppFactory::create();

$routes = require_once __DIR__ . '/../src/conf/routes.php';
$routes($app);

$app->run();


