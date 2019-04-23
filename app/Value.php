<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model {
	protected $fillable = [
		'exam_id',
		'covenant_id',
		'value',
		'active',
	];

	public $timestamps = true;

	public function exam() {
		return $this->belongsTo(\App\Exam::class);
	}

	public function covenant()
    {
        return $this->belongsTo(\App\Covenant::class);
    }

    public function order()
    {
        return $this->belongsToMany(\App\Order::class);
    }

}
