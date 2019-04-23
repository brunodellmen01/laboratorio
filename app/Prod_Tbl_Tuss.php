<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prod_Tbl_Tuss extends Model
{
    protected $fillable = [
    	'id',
    	'cod_termo',
    	'termo',
    	'numero_tabela',
    ];

    public $timestamps = true;
}
