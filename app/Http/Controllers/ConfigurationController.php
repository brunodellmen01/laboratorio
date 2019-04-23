<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Locale\Estate;
use App\Locale\City;
use Illuminate\Http\Request;
use App\Unitys;

class ConfigurationController extends Controller {
	public function index() {
		$id = 1;
		$empresa = Configuration::findOrFail($id);
		$cidades = City::orderBy('name', 'asc')->get();
		$estados = Estate::orderBy('name', 'asc')->get();
		return view('configuracao.empresa', ['empresa' => $empresa, 'cidades' => $cidades, 'estados' => $estados]);
	}

	public function editar($id, Request $request) {
		$empresa = Configuration::findOrFail($id);
		$empresa->update($request->all());
		return redirect()->action('ConfigurationController@index')->with('editado', "SIM");
	}

	public function unidades(){
		$estados = Estate::orderBy('name', 'asc')->get();
		return view('configuracao.filial.index', ['estados' => $estados]);
	}

	public function salvarUnidade(Request $request){
		$unidade = new Unitys();
		$unidade = $unidade->create($request->all());
		$estados = Estate::orderBy('name', 'asc')->get();
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return redirect()->action('ConfigurationController@unidades');
		
	}

	public function listarUnidade(){
		$unidades = Unitys::orderBy('name', 'desc')->get();
		return view('configuracao.filial.lista', ['unidades' => $unidades]);
	}

	public function editarUnidade($id){
		$unidade = Unitys::findOrFail($id);
		$estados = Estate::orderBy('name', 'asc')->get();
		return view('configuracao.filial.index', ['estados' => $estados, 'unidade' => $unidade]);
	}

	public function atualizar($id, Request $request) {
		$unidade = Unitys::findOrFail($id);		
		$unidade->update($request->all());
		$estados = Estate::orderBy('name', 'asc')->get();
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('configuracao.filial.index', ['unidade' => $unidade, 'estados' => $estados]);

	}

	public function delete($id, Request $request) {
		$unidade = Unitys::findOrFail($id);		
		$unidade->delete();
		$estados = Estate::orderBy('name', 'asc')->get();
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('configuracao.filial.lista', ['unidade' => $unidade, 'estados' => $estados]);

	}

}