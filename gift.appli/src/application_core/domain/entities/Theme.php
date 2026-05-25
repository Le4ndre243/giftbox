<?php
namespace gift\appli\application_core\domain\entities;
use Illuminate\Database\Eloquent\Model;
use gift\appli\application_core\domain\entities\Prestation;

class Theme extends Model {
    protected $table = 'theme';
    protected $primaryKey = 'id';
  
    public function coffret() {
        return $this->hasMany(CoffretType::class, 'id', 'id');
    }
}
