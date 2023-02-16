<?php

namespace crazy\models;

use Illuminate\Database\Eloquent as Eloquent;

class Utilisateur extends Eloquent\Model {

	protected $table = 'utilisateur';
	protected $primaryKey = 'user_id';
	public $timestamps = false;

}