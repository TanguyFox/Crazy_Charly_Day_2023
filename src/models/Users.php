<?php

namespace crazy\models;

use Illuminate\Database\Eloquent as Eloquent;

class Users extends Eloquent\Model {

	protected $table = 'users';
	protected $primaryKey = 'id';
	public $timestamps = false;

    public function panier(): Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'cart', 'id', 'id');
    }

}