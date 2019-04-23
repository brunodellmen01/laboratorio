<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoExame extends Model
{
       protected $fillable = [
        'name',
        'sinonimo',
        'metodo',
        'material',
        'jejum',
        'rotina',
        'uso',
        'ativo'
    ];

    public $timestamps = true;
}
