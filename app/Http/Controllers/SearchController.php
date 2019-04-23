<?php

namespace App\Http\Controllers;

use App\Order;
use App\Patient;
use DB;
use App\Locale\City;

class SearchController extends Controller {
	private $totalPorPagina = 5;

	public function index() {

		$protocolo = $_POST['protocolo'];

		$protocolos = Order::where('protocol', $protocolo)->get();

		$total = Order::where('protocol', $protocolo)->count();



		return view('buscas.protocolo', ['protocolos' => $protocolos, 'total' => $total, 'protocolo' => $protocolo]);
	}

	public function paciente() {

		$nome = $_POST['nome'];

		$pacientes = Patient::where('name', 'like', '%'.$nome.'%')->get();

		$total = Patient::where('name', 'like', '%'.$nome.'%')->count();

		

		$cidades = City::where('id', '2927')
					   ->orWhere('id',   '3172')
					   ->orWhere('id',   '2949')
					   ->orWhere('id',   '4348')
					   ->orderBy('name', 'asc')->get();

		
		return view('buscas.paciente', ['pacientes' => $pacientes, 'total' => $total, 'nome' => $nome, 'cidades' => $cidades]);
	}
}