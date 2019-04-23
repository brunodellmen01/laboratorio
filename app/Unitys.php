<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unitys extends Model {
	protected $fillable = [
		'name',
		'phone',
		'adress',
		'email',
		'sede',
		'cod_unidade',
		'estado_id',
	];

	public $timestamps = true;

	public function estado() {
		return $this->belongsTo(\App\Locale\Estate::class, 'estado_id');
	}
 
}


