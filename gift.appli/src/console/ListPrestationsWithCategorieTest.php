<?php
namespace gift\appli\console;
require_once __DIR__ . '/../vendor/autoload.php';
use gift\appli\utils\Eloquent;
use gift\appli\models\Categorie;

use gift\appli\models\Prestation;




Eloquent::init(__DIR__ . '/../conf/db.ini');

$prestations = Prestation::all();

foreach($prestations as $prestation) {
    echo $prestation->id . " " . $prestation->libelle . " " . $prestation->categorie->libelle . "\n";
};

?>