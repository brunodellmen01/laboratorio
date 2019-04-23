<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
	protected $fillable = [
		'subject',
		'description',
		'destination',
		'status',
	];

	public $timestamps = true;

}
