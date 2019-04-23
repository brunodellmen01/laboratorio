<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorizedPerson extends Model {
	protected $fillable = [
		'name',
		'rg',
		'cpf',
		'relation',
		'patient_id',
	];

	public $timestamps = true;

	public function patient() {
		return $this->hasMany(\App\Patient::class);
	}

}
