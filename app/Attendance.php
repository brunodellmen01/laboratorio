<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
	protected $fillable = [
		'name',
	];

	public $timestamps = true;

}
