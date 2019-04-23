<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model {
	protected $fillable = [
		'order_article_id',
		'description',
		'price',
		'reference',
		'result_id',
		'interpretation',
		'exam_id',
	];

	public $timestamps = true;

	public function order() {
		return $this->hasMany(\App\Order::class);
	}

	public function result() {
		return $this->belongsTo(\App\Result::class); // aki tb eh belongsTo
	}

	public function category() { // aki n eh hasMany cada report tem apenas uma categoria
		return $this->belongsTo(\App\Category::class);
	}

	public function exame() {
		return $this->hasMany(\App\Exam::class);
	}
}
