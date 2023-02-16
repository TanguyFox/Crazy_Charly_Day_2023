<?php

namespace crazy\models;

use Illuminate\Database\Eloquent as Eloquent;

class Utilisateur extends Eloquent\Model {

	protected $table = 'utilisateur';
	protected $primaryKey = 'user_id';
	public $timestamps = false;

    public function panier(): Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'cart', 'id', 'id');
    }

}