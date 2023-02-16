<?php

namespace crazy\models;

use Illuminate\Database\Eloquent as Eloquent;

class Produit extends Eloquent\Model
{
    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categorie(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('crazy\models\Categorie', 'categorie','id');
    }

    public function panier(): Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Users::class, 'cart', 'id', 'id');
    }
}