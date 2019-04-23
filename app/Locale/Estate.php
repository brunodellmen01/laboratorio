<?php

namespace App\Locale;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable = [
        'name',
        'initials',
        'country_id',
    ];

    public $timestamps = true;

    public function country()
    {
        return $this->hasMany(\App\Locale\Country::class, 'country_id');
    }
}
