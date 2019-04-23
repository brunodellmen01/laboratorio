<?php

namespace App\Locale;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'estate_id',
    ];

    public $timestamps = false;

    public function estate()
    {
        return $this->hasMany(\App\Locale\Estate::class, 'estate_id');
    }

}
