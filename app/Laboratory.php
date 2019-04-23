<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model {
	protected $fillable = [
		'name',
		'email',
		'city_id',
		'street',
		'cnpj',
		'active',
	];

	public $timestamps = true;

	public function city() {
		return $this->belongsTo(\App\City::class);
	}

	public function phones() {
		return $this->hasMany(\App\Phone::class);
	}
}
