<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
        'companies_id',
        'venc',
        'price',
        'description',
        'paid',
        'id_unity',
    ];

    public $timestamps = true;

    public function company(){
        return $this->belongsTo(\App\Companies::class, 'companies_id');
    }

    public function filial(){
        return $this->belongsTo(\App\Unitys::class, 'id_unity');
    }
}
