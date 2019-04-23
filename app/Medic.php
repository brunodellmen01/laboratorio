<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model
{
    protected $fillable = [
        'name',
        'email',
        'crm',
        'note',
        'tipo_doc',
        'cbos',
        'estado_id',

    ];

    public $timestamps = true;

    public function estado() {
        return $this->belongsTo(\App\Locale\Estate::class, 'estado_id');
    }

    public function phones()
    {
        return $this->hasMany(\App\Phone::class);
    }
}
