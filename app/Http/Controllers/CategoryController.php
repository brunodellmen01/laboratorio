<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;

class CategoryController extends Controller {
	private $totalPorPagina = 5;
	public function index() {
		$methods = Category::where('active', 'S')->get();
		return view('metodos.formulario', ['methods' => $methods]);
	}

	public function novo() {
		return view('metodos.formulario');
	}

	public function salvar(Request $request) {
		$methods = new Category();
		$methods = $methods->create($request->all());
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return redirect()->action('CategoryController@index');
	}

	public function listar() {

		$methods = Category::where('active', 'S')->get();
		return view('metodos.lista', ['methods' => $methods]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$method = Category::findOrFail($id);
		$method->active = "N";
		$method->save();

		return redirect('metodos/listar?certo=true');

	}

	public function editar($id) {
		//pega o medico pelo id e passa pro formulario
		$method = Category::find($id);
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('metodos.formulario', ['method' => $method]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {
		//seleciona o medico pelo id e atualiza
		$method = Category::findOrFail($id);
		$methods = Category::pluck('name', 'id');
		$method->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('metodos.formulario', ['method' => $method]);
	}
}
