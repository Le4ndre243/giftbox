<?php
namespace gift\appli\console;
require_once __DIR__ . '/../vendor/autoload.php';
use gift\appli\utils\Eloquent;

use gift\appli\models\CoffretType;




Eloquent::init(__DIR__ . '/../conf/db.ini');

$coffret = CoffretType::all();

foreach($coffret as $coffretType) {
    echo '<h1>' . $coffretType->id . " " . $coffretType->libelle . '</h1>';
    echo "<h3>Prestations associées : </h3>";
    echo "<ul>";
    foreach($coffretType->prestations as $prestation) {
        echo "<li>" . $prestation->id . " " . $prestation->libelle . '</li>';
    }
    echo "</ul>";
};


?>
