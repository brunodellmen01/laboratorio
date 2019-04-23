<?php

namespace App\Http\Controllers;

use App\Covenant;
use App\Locale\Estate;
use App\Locale\City;
use Illuminate\Http\Request;

class CovenantController extends Controller {
	private $totalPorPagina = 5;
	public function index() {
		$covenants = Covenant::where('active', 'S')->get();
		$estados = Estate::get();
		$cidades = City::orderBy('name', 'asc')->get();
		return view('convenios.formulario', ['covenants' => $covenants, 'estados' => $estados, 'cidades' => $cidades]);
	}

	public function openNew() {
		return view('convenios.formulario');
	}

	public function salvar(Request $request) {
		$covenant = new Covenant();
		$covenant = $covenant->create($request->all());
		
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return redirect()->action('CovenantController@index');
	}

	public function editar($id) {
		//pega o medico pelo id e passa pro formulario
		$covenant = Covenant::findOrFail($id);
		$estados = Estate::get();
		$cidades = City::orderBy('name', 'asc')->get();
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');

		return view('convenios.formulario', ['covenant' => $covenant, 'estados' => $estados, 'cidades' => $cidades]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {
		//seleciona o medico pelo id e atualiza
		$covenant = Covenant::findOrFail($id);
		$covenants = Covenant::pluck('name', 'id');
		$estados = Estate::get();
		$cidades = City::orderBy('name', 'asc')->get();
		$covenant->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('convenios.formulario', ['covenant' => $covenant, 'estados' => $estados, 'cidades' => $cidades]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$convenio = Covenant::find($id);
		$convenio->active = "N";
		$convenio->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect('convenio/listar?certo=true');

	}

	public function listar() {

		//verifica se ha registros com campo ativo = 1
		//$countador = Medico::get()->where('ativo', '=', '1')->count();

		//seleciona todos os registros q estejam ativos
		//$convenios = Covenant::aawhere('active', 'S')->get();
		$convenios = Covenant::where('active', 'S')->get();
		$estados = Estate::get();
		$cidades = City::orderBy('name', 'asc')->get();

		return view('convenios.lista', ['convenios' => $convenios, 'estados' => $estados, 'cidades' => $cidades]);
	}
}
