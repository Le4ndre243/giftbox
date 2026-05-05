<?php
namespace gift\appli\models;
use Illuminate\Database\Eloquent\Model;
use gift\appli\models\Prestation;

class Categorie extends Model {
    protected $table = 'categorie';
    protected $primaryKey = 'id';

   public function prestations() {
        return $this->hasMany(Prestation::class, 'cat_id', 'id');
    }
}
?>