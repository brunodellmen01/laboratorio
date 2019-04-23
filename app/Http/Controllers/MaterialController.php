<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller {

	public function index() {
		$materiais = Material::where('active', 'S')->get();
		return view('materiais.formulario', ['materiais' => $materiais]);
	}

	public function novo() {
		return view('materiais.formulario');
	}

	public function salvar(Request $request) {
		$materiais = new Material();
		$materiais->name = $request->get('name');
		$materiais->active = "S";
		$materiais->save();
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return redirect()->action('MaterialController@index');
	}

	public function listar() {

		$materiais = Material::where('active', 'S')->get();
		return view('materiais.lista', ['materiais' => $materiais]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$material = Material::findOrFail($id);
		$material->active = "N";
		$material->save();

		return redirect('material/listar?certo=true');

	}

	public function editar($id) {
		//pega o medico pelo id e passa pro formulario
		$material = Material::findOrFail($id);
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('materiais.formulario', ['material' => $material]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {
		//seleciona o medico pelo id e atualiza
		$material = Material::findOrFail($id);
		$materials = Material::pluck('name', 'id');
		$material->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('materiais.formulario', ['material' => $material]);
	}

}
