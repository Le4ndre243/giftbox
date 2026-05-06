<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use gift\appli\utils\Eloquent;

session_start();

require_once __DIR__ . '/../src/vendor/autoload.php';

Eloquent::init(__DIR__ . '/../src/conf/db.ini');

$app = AppFactory::create();
$app->setBasePath('/giftbox');

$routes = require_once __DIR__ . '/../src/conf/routes.php';
$routes($app);

$app->run();


