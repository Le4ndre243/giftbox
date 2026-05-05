<?php
namespace gift\appli\models;
use Illuminate\Database\Eloquent\Model;
use gift\appli\models\Prestation;

class CoffretType extends Model {
    protected $table = 'coffret_type';
    protected $primaryKey = 'id';

    public function prestations() {
        return $this->belongsToMany(Prestation::class, 'coffret2presta', 'coffret_id', 'presta_id');
    }
   
}
?>