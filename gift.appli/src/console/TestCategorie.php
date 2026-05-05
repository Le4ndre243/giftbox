<?php
namespace gift\appli\console;
require_once __DIR__ . '/../vendor/autoload.php';
use gift\appli\utils\Eloquent;
use gift\appli\models\Categorie;

Eloquent::init(__DIR__ . '/../conf/db.ini');

$categories = Categorie::all();
foreach ($categories as $categorie) {
    echo "ID: " . $categorie->id . ", Name: " . $categorie->libelle . "\n";
}
?>