<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Exam extends Model {
	protected $fillable = [
		'name',
		'synonymous', //Sinônimo
		'material_id',
		'fasting', //Jejum
		'routine', //Rotina
		'use',
		'category_id', //Tipo Exame
		'active',
	];

	public $timestamps = true;

	public function material() {
		return $this->belongsTo(\App\Material::class);
	}

	public function category() {
		return $this->belongsTo(\App\Category::class, 'category_id');
	}

    public function orders(){
	    return $this->belongsToMany(\App\Order::class);
    }

    public function value()
    {
        return $this->belongsTo(\App\Value::class);
    }
}
