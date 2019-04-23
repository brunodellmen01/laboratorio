<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Moviment;
use Auth;

class MovimentController extends Controller {
	private $totalPorPagina = 5;
	public function index() {

		$movs = Moviment::where('id_unity',Auth::user()->id_unity)->get();

		return view('financeiro.movimentacaoLista', ['movs' => $movs]);
	}

	public function movimentacao() {

		return view('financeiro.movimentacao');
	}

	public function movimentar(Request $request) {

		//pega os dados do formulario e salva
		$movimentacao = new Moviment();
		$movimentacao = $movimentacao->create($request->all());

		return view('financeiro.movimentacao');
	}

}
