<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Laboratory;
use \App\Locale\City;

class LaboratoryController extends Controller {
	private $totalPorPagina = 5;
	public function index() {

		//abre o formulario quando carrega a pagina

		$laboratorio = Laboratory::all();
		$cidades = City::where('estate_id', 18)->get();
		return view('laboratorios.formulario', ['laboratorios' => $laboratorio, 'cidades' => $cidades]);
	}

	public function salvar(Request $request) {

		//pega os dados do formulario e salva
		$laboratorio = new Laboratory();
		$cidades = City::where('estate_id', 18)->get();
		$laboratorio = $laboratorio->create($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('laboratorios.formulario', ['cidades' => $cidades]);

	}

	public function editar($id) {

		//pega o medico pelo id e passa pro formulario
		$laboratorio = Laboratory::findOrFail($id);

		//aqui pego a cidade
		$cidades = City::where('estate_id', 18)->get();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('laboratorios.formulario', ['laboratorio' => $laboratorio, 'cidades' => $cidades]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {

		//seleciona o registro pelo id e atualiza
		$laboratorio = Laboratory::findOrFail($id);
		$cidades = City::where('estate_id', 18)->get();
		$laboratorio->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('laboratorios.formulario', ['laboratorio' => $laboratorio, 'cidades' => $cidades]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$laboratorio = Laboratory::find($id);
		$laboratorio->ativo = "N";
		$laboratorio->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect('laboratorio/listar?certo=true');

	}

	public function listar() {

		//verifica se ha registros com campo ativo = 1
		//$countador = Medico::get()->where('ativo', '=', '1')->count();

		//seleciona todos os registros q estejam ativos
		$laboratorios = Laboratory::where('active', 'S')->get();

		return view('laboratorios.lista', ['laboratorios' => $laboratorios]);
	}
}
