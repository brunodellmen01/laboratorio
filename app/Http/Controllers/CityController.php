<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Locale\City;

class CityController extends Controller
{
    public function index(){
        $cidades = City::all();
        return view('index', ['cidades' => $cidades]);
    }

}

