<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoResultado extends Model
{
	 protected $table = 'results';
     protected $fillable = [
        'name',
        'ativo'
    ];

    public $timestamps = true;
}
