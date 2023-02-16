<?php

namespace crazy\models;

use Illuminate\Database\Eloquent as Eloquent;

class Categorie extends Eloquent\Model {
    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function produits() : Eloquent\Relations\HasMany {
        return $this->hasMany('models\Produit', 'categorie','id');
    }
}