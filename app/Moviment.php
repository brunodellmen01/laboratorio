<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moviment extends Model {
	protected $fillable = [
		'type',
		'price',
		'description',
		'id_unity',
	];

	public $timestamps = true;

	public function filial(){
        return $this->belongsTo(\App\Units::class);
    }

}
