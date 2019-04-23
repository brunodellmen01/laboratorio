<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = [
        'name',
        'email',
        'crm',
        'fone',
        'obs',
        'ativo'
    ];

    public $timestamps = true;
}