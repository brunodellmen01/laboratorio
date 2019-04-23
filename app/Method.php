<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Method extends Model {
	protected $table = 'categories';
	protected $fillable = [
		'name',
		'active',
	];

	public $timestamps = true;
}
