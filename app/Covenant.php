<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Covenant extends Model {
	protected $fillable = [
		'name',
		'active',
		'doc',
		'ans',
		'site',
		'email',
		'cod_clinica',
		'fone',
		'cep',
		'estado_id',
		'bairro',
		'numero',
		'complemento',
		'city_id',
		'end',
		
	];

	public $timestamps = true;

	public function exams() {
		return $this->hasMany(\App\Exam::class);
	}

	public function values() {
		return $this->hasMany(\App\Value::class);
	}

	public function estado() {
		return $this->belongsTo(\App\Locale\Estate::class, 'estado_id');
	}

	public function city() {
		return $this->belongsTo(\App\Locale\City::class, 'city_id');
	}
}
