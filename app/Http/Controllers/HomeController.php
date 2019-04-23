<?php

namespace App\Http\Controllers;

use App\Order;
use App\ParcelOrder;
use App\ParcelPay;
use App\Patient;
use App\Task;
use App\User;
use Auth;

class HomeController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
			$dia = date('Y-m-d');

		
			$agendas = Task::get()->where('task_date', $dia)->where('id_unity',Auth::user()->id_unity)->count();

			$parcelasReceber = ParcelOrder::get()->where('venc', $dia)->where('status', '<>', 'PAGO')->where('id_unity',Auth::user()->id_unity)->count();

			$parcelasPagar = ParcelPay::get()->where('venc', $dia)->where('status', '<>', 'PAGO')->where('id_unity',Auth::user()->id_unity)->count();

			$pedidos = Order::where('dt_retire', $dia)->where('id_unity',Auth::user()->id_unity)->get();

			$totalpedidos = Order::where('id_unity',Auth::user()->id_unity)->count();

			$totalclientes = Patient::get()->count();

			$totalparaentregar = Order::get()->where('dt_retire', $dia)->where('id_unity',Auth::user()->id_unity)->count();

			$total_usuario_inativo = User::where('active', '0')->where('id_unity',Auth::user()->id_unity)->count();

			$tasks = Task::where('task_date', '=', $dia)->where('id_unity',Auth::user()->id_unity)->get();

			$tasks = Task::where('task_date', '=', $dia)->where('id_unity',Auth::user()->id_unity)->get();
		
		

		

		//$pedidosdeHoje = Order::WhereMonth('created_at', '=', date('m'))
		//	->WhereDay('created_at', '=', date('d'))
		//	->WhereYear('created_at', '=', date('Y'))->get();

		return view('home', ['pedidos' => $pedidos, 'agendas' => $agendas, 'parcelasReceber' => $parcelasReceber, 'parcelasPagar' => $parcelasPagar, 'totalpedidos' => $totalpedidos, 'totalclientes' => $totalclientes, 'totalparaentregar' => $totalparaentregar, 'total_usuario_inativo' => $total_usuario_inativo, 'tasks' => $tasks]);
	}

	public function rhHome(){
		$dia = date('Y-m-d');

		
			$agendas = Task::get()->count();

			$parcelasReceber = ParcelOrder::get()->where('venc', $dia)->where('status', '<>', 'PAGO')->count();

			$parcelasPagar = ParcelPay::get()->where('venc', $dia)->where('status', '<>', 'PAGO')->count();

			$pedidos = Order::where('dt_retire', $dia)->get();

			$totalpedidos = Order::count();

			$totalclientes = Patient::get()->count();

			$totalparaentregar = Order::get()->where('dt_retire', $dia)->count();

			$total_usuario_inativo = User::where('active', '0')->count();

			$tasks = Task::where('task_date', '=', $dia)->get();

			$tasks = Task::where('task_date', '=', $dia)->get();
		
		

		

		//$pedidosdeHoje = Order::WhereMonth('created_at', '=', date('m'))
		//	->WhereDay('created_at', '=', date('d'))
		//	->WhereYear('created_at', '=', date('Y'))->get();

		return view('home_rh', ['pedidos' => $pedidos, 'agendas' => $agendas, 'parcelasReceber' => $parcelasReceber, 'parcelasPagar' => $parcelasPagar, 'totalpedidos' => $totalpedidos, 'totalclientes' => $totalclientes, 'totalparaentregar' => $totalparaentregar, 'total_usuario_inativo' => $total_usuario_inativo, 'tasks' => $tasks]);
	}
}
