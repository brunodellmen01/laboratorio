<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boxs extends Model {
	protected $fillable = [
		'sale_initial',
		'sale_end',
		'open',
		'closed',
		'diference',
		'status',
		'id_unity',
	];

	public $timestamps = true;

	public function filial(){
        return $this->belongsTo(\App\Units::class);
    }

}
