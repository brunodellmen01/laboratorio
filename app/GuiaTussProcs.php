<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuiaTussProcs extends Model
{
    protected $fillable = [
        'id',
        'paciente',
        'id_tiss',
        'procedimento',
        'qtd',
        'valor',
        'valor_total',
        'cod_termo',
        'numero_tabela',
        'id_procedimento',
    ];

    public $timestamps = true;

    

}
