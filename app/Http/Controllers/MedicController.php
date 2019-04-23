<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Medic;
use \App\Locale\Estate;

class MedicController extends Controller {
	private $totalPorPagina = 5;
	public function index() {

		//abre o formulario quando carrega a pagina

		$medicos = Medic::get();
		$estados = Estate::get();

		return view('medicos.formulario', ['medicos' => $medicos, 'estados' => $estados]);
	}

	public function salvar(Request $request) {

		//pega os dados do formulario e salva
		$medico = new Medic();
		$medico = $medico->create($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return back();
		return view('medicos.formulario');

	}

	public function editar($id) {

		//pega o medico pelo id e passa pro formulario
		$medico = Medic::findOrFail($id);
		$estados = Estate::all();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('medicos.formulario', ['medico' => $medico, 'estados' => $estados]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {

		//seleciona o medico pelo id e atualiza
		$medico = Medic::findOrFail($id);
		$medicos = Medic::pluck('name', 'id');
		$estados = Estate::all();
		$medico->update($request->all());
		

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('medicos.formulario', ['medico' => $medico, 'estados' => $estados]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$medico = Medic::find($id);
		$medico->ativo = "N";
		$medico->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect('medico/listar?certo=true');

	}

	public function listar() {

		//verifica se ha registros com campo ativo = 1
		//$countador = Medico::get()->where('ativo', '=', '1')->count();

		//seleciona todos os registros q estejam ativos
		//$medicos = Medico::where('ativo', 'S')->get();

		$medicos = Medic::where('active', 'S')->get();
		$estados = Estate::all();

		return view('medicos.lista', ['medicos' => $medicos, 'estados' => $estados]);
	}
}
