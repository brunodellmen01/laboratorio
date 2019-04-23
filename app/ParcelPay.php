<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelPay extends Model {
	protected $fillable = [
		'expenses_id',
		'price_parcel',
		'price_settled',
		'price_remain',
		'venc',
		'status',
		'id_unity',
	];

	public $timestamps = true;

	public function filial(){
		return $this->belongsTo(\App\Units::class);
	}

}
