<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suport extends Model {
	protected $fillable = [
		'title',
		'message',
		'level',
		'type',
		'status',
		'protocol',
		'url',
		'user',
	];

	public $timestamps = true;

}