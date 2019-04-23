<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Covenant;
use \App\Exam;
use \App\Value;

class ValueController extends Controller {
	private $totalPorPagina = 5;
	public function index() {

		$precoExame = Value::get();
		$tipoExames = Exam::all();
		$convenios = Covenant::all();

		return view('precoExames.formulario', ['precoExames' => $precoExame, 'tipoExames' => $tipoExames, 'convenios' => $convenios]);
	}

	public function salvar(Request $request) {

		$precoExame = new Value();
		$tipoExames = Exam::all();
		$convenios = Covenant::all();

		$precoExame = $precoExame->create($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('precoExames.formulario', ['precoExame' => $precoExame, 'tipoExames' => $tipoExames, 'convenios' => $convenios]);

	}

	public function editar($id) {

		$precoExame = Value::findOrFail($id);
		$tipoExames = Exam::all();
		$convenios = Covenant::all();

		//\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		//return view('precoExames.formulario', ['precoExames' => $precoExames, 'tipoExames' => $tipoExames, 'convenios' => $convenios]);

		return view('precoExames.formulario', ['precoExame' => $precoExame, 'tipoExames' => $tipoExames, 'convenios' => $convenios]);
	}

	public function atualizar($id, Request $request) {

		$precoExames = Value::findOrFail($id);
		$tipoExames = Exam::all();
		$convenios = Covenant::all();
		$precoExames->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('precoExames.formulario', ['precoExame' => $precoExames, 'tipoExames' => $tipoExames, 'convenios' => $convenios]);

		//return back()->with('mensagem_ok', 'Operação Realizada Com Sucesso.');

	}

	public function inativar($id) {

		$precoExames = Value::findOrFail($id);
		$precoExames->ativo = "N";
		$precoExames->save();

		return redirect('precoExames/listar?certo=true');

	}

	public function listar() {
		$precoExames = Value::where('active', 'S')->get();
		return view('precoExames.lista', ['precoExames' => $precoExames]);

	}

}
