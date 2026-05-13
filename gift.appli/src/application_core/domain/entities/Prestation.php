<?php
namespace gift\appli\application_core\domain\entities;
use Illuminate\Database\Eloquent\Model;


class Prestation extends Model {
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function categorie(){
        return $this->belongsTo(Categorie::class, 'cat_id', 'id');
    }
    public function coffretTypes(){
        return $this->belongsToMany(CoffretType::class, 'coffret2presta', 'presta_id', 'coffret_id');
    }

}
?>