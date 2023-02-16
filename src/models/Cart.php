<?php

namespace crazy\models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use netvod\user\User;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = ['product', 'user_id'];
    public $timestamps = false;

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'id');
    }
}