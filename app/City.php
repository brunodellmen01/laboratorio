<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {
	protected $fillable = [
		'name',
		'estate_id',
	];

	public $timestamps = true;

	public function estate() {
		return $this->hasMany(\App\Locale\Country::class, 'estate_id');
	}

}
