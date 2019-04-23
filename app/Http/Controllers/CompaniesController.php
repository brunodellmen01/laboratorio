<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller {
	private $totalPorPagina = 5;
	public function index() {
		$companies = Companies::where('active', 'S')->get();
		return view('empresas.formulario', ['companies' => $companies]);
	}

	public function novo() {
		return view('empresas.formulario');
	}

	public function salvar(Request $request) {
		$companies = new Companies();
		$companies->name = $request->get('name');
		$companies->active = "S";
		$companies->save();
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return redirect()->action('CompaniesController@index');
	}

	public function listar() {

		$companies = Companies::where('active', 'S')->get();
		return view('empresas.lista', ['companies' => $companies]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$companie = Companies::findOrFail($id);
		$companie->active = "N";
		$companie->save();

		return redirect('empresa/listar?certo=true');

	}

	public function editar($id) {
		//pega o medico pelo id e passa pro formulario
		$companie = Companies::find($id);
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('empresas.formulario', ['companie' => $companie]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {
		//seleciona o medico pelo id e atualiza
		$companie = Companies::findOrFail($id);
		$companies = Companies::pluck('name', 'id');
		$companie->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('empresas.formulario', ['companie' => $companie]);
	}

}
