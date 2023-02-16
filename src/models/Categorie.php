<?php

namespace crazy\models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function produits() {
        return $this->hasMany('models\Produit', 'categorie','id');
    }
}