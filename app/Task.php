<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
	protected $fillable = ['name', 'description', 'task_date', 'patient_id', 'id_unity'];

	public $timestamps = true;

	public function patient() {
		return $this->belongsTo(\App\Patient::class);

	}

	public function filial(){
        return $this->belongsTo(\App\Unitys::class, 'id_unity');
    }
}