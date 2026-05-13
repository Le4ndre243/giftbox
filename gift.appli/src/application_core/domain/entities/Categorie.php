<?php
namespace gift\appli\application_core\domain\entities;
use Illuminate\Database\Eloquent\Model;
use gift\appli\application_core\domain\entities\Prestation;

class Categorie extends Model {
    protected $table = 'categorie';
    protected $primaryKey = 'id';

   public function prestations() {
        return $this->hasMany(Prestation::class, 'cat_id', 'id');
    }
}
?>