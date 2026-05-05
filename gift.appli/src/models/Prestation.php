<?php
namespace gift\appli\models;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model {
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function categorie(){
        return $this->belongsTo(Categorie::class, 'cat_id', 'id');
    }
    }

?>