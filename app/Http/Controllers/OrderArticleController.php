<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Order;
use \App\Type;
use \App\Exam;
use DB;


class OrderController extends Controller
{

	public function index(){
		return view('Requests.Request');
	}

}