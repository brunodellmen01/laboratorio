<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model {
	protected $fillable = [
		'number',
		'laboratory_id',
		'medic_id',
		'patient_id',
	];

	public $timestamps = true;

	public function laboratory() {
		return $this->belongsTo(\App\Laboratory::class);
	}

	public function medic() {
		return $this->belongsTo(\App\Medic::class);
	}

	public function patient() {
		return $this->belongsTo(\App\Patient::class);
	}
}