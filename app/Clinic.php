<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'name',
        'street',
        'city_id',
        'number',
        'country_id',
    ];

    public $timestamps = true;

    public function country()
    {
        return $this->hasMany(\App\Locale\Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(\App\Locale\City::class,'city_id');
    }

}
