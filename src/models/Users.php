<?php

namespace crazy\models;

use Illuminate\Database\Eloquent as Eloquent;

class Users extends Eloquent\Model {

	const STANDARD_USER = 1;
	const ADMIN_USER = 100;
	protected int $grade;

	protected $table = 'users';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function admin(): bool {
		return $this->grade === self::ADMIN_USER;
	}

    public function panier(): Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'cart', 'id', 'id');
    }

	public function orders(): Eloquent\Relations\HasMany {
		return $this->hasMany(Order::class, 'id', 'id');
	}

    public function products(): Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'cart', 'user_id', 'product_id')->withPivot('quantity');
    }

}