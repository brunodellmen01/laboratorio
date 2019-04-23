<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderArticles extends Model
{
    protected $fillable = [
    	'order_id',
    	'price',
    	'qtd',
    	'sub',
    	'type_id',
        'exam_id',
        'id_unity',

    ];

    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo(\App\Order::class);
    }


    public function type()
    {
    	return $this->belongsTo(\App\Type::class);
    }

    public function value()
    {
    	return $this->belongsTo(\App\Value::class);
    }

    public function exam()
    {
    	return $this->belongsTo(\App\Exam::class);
    }

    public function filial(){
        return $this->belongsTo(\App\Units::class);
    }
    
}
