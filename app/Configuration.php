<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model {
	protected $fillable = [
		'name',
		'cnpj',
		'razao',
		'ans',
		'medico',
		'tipo_doc', //crf e o casete
		'endereco',
		'fone',
		'cep',
		'num_doc',
		'city_id',
		'estado_id',
		'cnes',

	];

	public $timestamps = true;

	public function city() {
		return $this->belongsTo(\App\Locale\City::class, 'city_id');
	}

	public function estado() {
		return $this->belongsTo(\App\Locale\Estate::class, 'estado_id');
	}

}