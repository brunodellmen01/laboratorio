<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
	protected $fillable = [
		'name',
		'active',
	];

	public $timestamps = true;

}
