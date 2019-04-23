<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\City;
use \App\Clinic;

class ClinicController extends Controller {
	private $totalPorPagina = 5;
	public function index() {

		//abre o formulario quando carrega a pagina

		$clinica = Clinic::get();
		//so tras as cidades do parana
		$cidades = City::where('estate_id', 18)->get();
		return view('clinicas.formulario', ['clinicas' => $clinica, 'cidades' => $cidades]);
	}

	public function salvar(Request $request) {

		//pega os dados do formulario e salva
		$clinica = new Clinic();
		$cidades = City::where('estate_id', 18)->get();
		$clinica = $clinica->create($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('clinicas.formulario', ['cidades' => $cidades]);

	}

	public function editar($id) {

		//pega o medico pelo id e passa pro formulario
		$clinica = Clinic::findOrFail($id);

		//aqui pego a cidade
		$cidades = City::where('estate_id', 18)->get();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('clinicas.formulario', ['clinica' => $clinica, 'cidades' => $cidades]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {

		//seleciona o registro pelo id e atualiza
		$clinica = Clinic::findOrFail($id);
		$cidades = City::where('estate_id', 18)->get();
		$clinica->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('clinicas.formulario', ['clinica' => $clinica, 'cidades' => $cidades]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$clinica = Clinic::find($id);
		$clinica->active = "N";
		$clinica->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect('clinica/listar?certo=true');

	}

	public function listar() {

		//verifica se ha registros com campo ativo = 1
		//$countador = Medico::get()->where('ativo', '=', '1')->count();

		//seleciona todos os registros q estejam ativos
		//$clinicas = Clinica::where('ativo', 'S')->get();

		$clinicas = Clinic::where('active', 'S')->get();

		return view('clinicas.lista', ['clinicas' => $clinicas]);
	}
}
