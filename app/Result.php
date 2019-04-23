<?php

namespace App;

use Category;
use Illuminate\Database\Eloquent\Model;

//use Exam;

class Result extends Model {
	protected $fillable = [
		'exam_id',
		'description',
		'category_id',
		'reference',
		'active',
		'interpretation',
	];

	public $timestamps = true;

	public function reports() {
		return $this->hasMany(\App\Report::class);
	}

// isso aki vc retira se tirar category_id de result e passar pra report
	public function category() {
		return $this->belongsTo(\App\Category::class);
	}

	public function exam() {
		return $this->belongsTo(\App\Exam::class);
	}

	public function price() {
		return $this->belongsTo(\App\Exam::class);
	}
}
