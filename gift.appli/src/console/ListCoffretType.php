<?php
namespace gift\appli\console;
require_once __DIR__ . '/../vendor/autoload.php';
use gift\appli\utils\Eloquent;

use gift\appli\models\CoffretType;




Eloquent::init(__DIR__ . '/../conf/db.ini');

$coffret = CoffretType::all();

foreach($coffret as $coffretType) {
    echo $coffretType->id . " " . $coffretType->libelle . "\n" . "Prestations associées : \n" ;
    foreach($coffretType->prestations as $prestation) {
        echo "  - " . $prestation->id . " " . $prestation->libelle . "\n";
    }
};


?>
