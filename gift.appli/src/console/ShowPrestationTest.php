<?php
namespace gift\appli\console;
require_once __DIR__ . '/../vendor/autoload.php';
use gift\appli\utils\Eloquent;
use gift\appli\models\Categorie;
use Illuminate\Database\Eloquent\ModelNotFoundException;

Eloquent::init(__DIR__ . '/../conf/db.ini');

$id = $argv[1];

try {
    $categorie = Categorie::findOrFail($id);
    echo "ID: " . $categorie->id . ", Name: " . $categorie->libelle . "\n";
} catch (ModelNotFoundException $e) {
    echo "L'identifiant est erroné ou n'existe pas.\n";
}
?>