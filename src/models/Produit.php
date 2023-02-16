<?php

namespace crazy\models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categorie() {
        return $this->belongsTo('models\categorie', 'categorie');
    }
}