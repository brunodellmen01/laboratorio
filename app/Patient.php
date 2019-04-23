<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Patient extends Model {

	   
   

	protected $fillable = [
		'id',
		'name',
		'sex',
		'cpf',
		'rg',
		'dt_birth',
		'email',
		'street',
		'city_id',
		'active',
		'phone',
		'image',
		'num_carteira',
		'validade_carteira',
		'num_cartao',
		'cns',

	];

	public $timestamps = true;
	

	public function city() {
		return $this->belongsTo(\App\Locale\City::class, 'city_id');
	}

	public function phones() {
		return $this->hasMany(\App\Phone::class);
	}
}
