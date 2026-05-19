<?php
namespace gift\appli\application_core\domain\entities;

use Illuminate\Database\Eloquent\Model;


class User extends Model {
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function boxes() {
        return $this->hasMany(Box::class, 'createur_id', 'id');
    }
}



?>