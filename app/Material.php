<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model {
	protected $fillable = [
		'name',
		'active',
	];

	public $timestamps = true;
}
