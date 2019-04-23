<?php

namespace App\Http\Controllers;

use App\Method;
use Illuminate\Http\Request;
use DB;

class MethodController extends Controller {

	public function index() {
		$methods = Method::where('active', 'S')->get();
		return view('metodos.formulario', ['methods' => $methods]);
	}

	public function novo() {
		return view('metodos.formulario');
	}

	public function salvar(Request $request) {
		$methods = new Method();
		$methods->name = $request->get('name');
		$methods->active = "S";
		$methods->save();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		$methods = Method::where('active', 'S')->get();
		return view('metodos.formulario', ['methods' => $methods]);
	}

	public function listar() {

		$methods = DB::table('categories')->where('active', 'S')->get();

		//$methods = Method::where('active', 'S')->get();
		return view('metodos.lista', ['methods' => $methods]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$method = Method::findOrFail($id);
		$method->active = "N";
		$method->save();

		return redirect('metodo/listar?certo=true');

	}

	public function editar($id) {
		//pega o medico pelo id e passa pro formulario
		$method = Method::findOrFail($id);
		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('metodos.formulario', ['method' => $method]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {
		//seleciona o medico pelo id e atualiza
		$method = Method::find($id);
		$methods = Method::pluck('name', 'id');
		$method->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('metodos.formulario', ['method' => $method]);
	}

}
