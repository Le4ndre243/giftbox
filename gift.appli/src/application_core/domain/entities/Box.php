<?php
namespace gift\appli\application_core\domain\entities;

use  gift\appli\application_core\domain\entities\User;
use Illuminate\Database\Eloquent\Model;

class Box extends Model {
    protected $table = 'box';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class, 'createur_id', 'id');
    }

    public function prestations() {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')
                    ->withPivot('quantite');
    }
}