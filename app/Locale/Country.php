<?php

namespace App\Locale;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'initials'
    ];

    public $timestamps = false;

}
