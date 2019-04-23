<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelOrder extends Model {
	protected $fillable = [
		'order_id',
		'price_parcel',
		'price_settled',
		'price_remain',
		'venc',
		'status',
		'id_unity',
	];

	public $timestamps = true;

	public function order() {
		return $this->belongsTo(\App\Orde::class);
	}

	public function filial(){
		return $this->belongsTo(\App\Units::class);
	}

}
