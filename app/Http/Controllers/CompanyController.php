<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;

class CompanyController extends Controller {
	private $totalPorPagina = 5;
	public function index() {
		$companys = Companies::where('active', 'S')->get();
		return view('empresas.formulario', ['companys' => $compans]);
	}

	public function novo() {
		return view('empresas.formulario');
	}

	public function salvar(Request $request) {
		$company = new Companies();
		$company->name = $request->get('name');
		$company->active = "S";
		$company->save();
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return redirect()->action('ComponayController@index');
	}

}
