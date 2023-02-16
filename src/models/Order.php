<?php

namespace crazy\models;

use Illuminate\Database\Eloquent as Eloquent;

class Order extends Eloquent\Model {

	protected $table = 'orders';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function user(): Eloquent\Relations\BelongsTo {
		return $this->belongsTo(Users::class, 'id', 'id');
	}

}