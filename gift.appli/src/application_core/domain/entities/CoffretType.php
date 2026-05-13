<?php
namespace gift\appli\application_core\domain\entities;
use Illuminate\Database\Eloquent\Model;
use gift\appli\application_core\domain\entities\Prestation;

class CoffretType extends Model {
    protected $table = 'coffret_type';
    protected $primaryKey = 'id';

    public function prestations() {
        return $this->belongsToMany(Prestation::class, 'coffret2presta', 'coffret_id', 'presta_id');
    }
   
}
?>