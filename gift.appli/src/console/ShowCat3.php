<?php
namespace gift\appli\console;
require_once __DIR__ . '/../vendor/autoload.php';
use gift\appli\utils\Eloquent;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;



Eloquent::init(__DIR__ . '/../conf/db.ini');

$prestations = Categorie::find(3)->prestations;

foreach($prestations as $prestation) {
    echo $prestation->id . " " . $prestation->libelle . "\n";
}; 
?>
