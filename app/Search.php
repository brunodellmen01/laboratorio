<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model {
	protected $fillable = [
		'name',
	];

	public $timestamps = true;

}
