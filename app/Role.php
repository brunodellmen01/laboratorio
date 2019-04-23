<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	protected $fillable = [
		'name',
		'label',
	];

	public $timestamps = true;

	public function permissions() {
		return $this->belongsToMany(\App\Permission::class)->withTimestamps();
	}

}
