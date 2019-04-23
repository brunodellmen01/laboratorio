States.phpa<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estates extends Model
{
    protected $fillable = [
    	'name',
    ];

    public $timestamps = true;
}
