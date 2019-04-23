<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderArticles;
use App\Patient;
use DB;

class HistoryController extends Controller {
	public function index() {

		
		$pacientes = Order::groupBy('patient_id')->distinct()->get();


		return view('historico.index', ['pacientes' => $pacientes]);
	}

	public function historico($id_paciente) {

		$paciente_id = $id_paciente;

		$id = intval($paciente_id);

		$conta = Patient::where('id', '=', $id)->orderBy('name', 'asc')->count();

		if ($conta > 0) {

			$pacientes = Patient::where('id', '=', $id)->orderBy('name', 'asc')->get();

			//$pacientes = Patient::findOrFail($id);

			$orders = Order::where('patient_id', '=', $id)->orderBy('created_at', 'asc')->get();

			$ultimoP = Order::orderBy('id', 'desc')->first();

			$ultimoPedido = $ultimoP['date'];

			$item = $orders[0]['id'];

			$orderArticles = OrderArticles::where('order_id', $item)->get();

			$abertos = Order::get()->where('patient_id', '=', $id)->where('status', '=', 'ABERTO')->count();

			$analises = Order::get()->where('patient_id', '=', $id)->where('status', '=', 'EM ANALISE')->count();

			$finalizados = Order::get()->where('patient_id', '=', $id)->where('status', '=', 'FINALIZADO')->count();

			$entregues = Order::get()->where('patient_id', '=', $id)->where('status', '=', 'ENTREGUE')->count();
			return view('historico.paciente', ['pacientes' => $pacientes, 'orders' => $orders, 'orderArticles' => $orderArticles, 'abertos' => $abertos, 'analises' => $analises, 'finalizados' => $finalizados, 'entregues' => $entregues, 'ultimoPedido' => $ultimoPedido]);

		} else {
			return view('errors.404');
		}

	}

	public function dados() {

		$id = $_POST['paciente'];
		$qpta = $_POST['historico'];

		$update = DB::table('patients')
			->where('id', $id)
			->update(['qpta' => $qpta]);

		return back()->with('salvo', 'SIM');
	}

}
