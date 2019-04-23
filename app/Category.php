<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $fillable = [
		'name',
		'active',
	];

	public $timestamps = true;

//	public function reports() { // aki sim, cada categoria tem varios reports
//		return $this->hasMany(\App\Report::class);
//	} 
}
