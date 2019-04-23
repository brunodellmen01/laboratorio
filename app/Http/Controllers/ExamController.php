<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Exam;
use \App\Category;

class ExamController extends Controller {
	private $totalPorPagina = 5;
	public function index() {

		//abre o formulario quando carrega a pagina

		$tipoExames = Exam::get();
		$categorias = Category::get();

		return view('tipoExames.formulario', ['tipoExames' => $tipoExames, 'categorias' => $categorias]);
	}

	public function salvar(Request $request) {

		//pega os dados do formulario e salva
		$tipoExame = new Exam();
		$tipoExame = $tipoExame->create($request->all());
		$categorias = Category::get();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('tipoExames.formulario', ['categorias' => $categorias]);

	}

	public function editar($id) {

		//pega o medico pelo id e passa pro formulario
		$tipoExame = Exam::findOrFail($id);
		$categorias = Category::get();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('tipoExames.formulario', ['tipoExame' => $tipoExame, 'categorias' => $categorias]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {

		//seleciona o medico pelo id e atualiza
		$tipoExame = Exam::findOrFail($id);
		$tipoExames = Exam::pluck('name', 'id');
		$tipoExame->update($request->all());
		$categorias = Category::get();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('tipoExames.formulario', ['tipoExame' => $tipoExame, 'categorias' => $categorias]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$tipoExame = Exam::find($id);
		$tipoExame->active = "N";
		$tipoExame->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect('tipoExame/listar?certo=true');

	}

	public function listar() {

		//verifica se ha registros com campo ativo = 1
		//$countador = Medico::get()->where('ativo', '=', '1')->count();

		//seleciona todos os registros q estejam ativos
		$tipoExames = Exam::where('active', 'S')->get();

		return view('tipoExames.lista', ['tipoExames' => $tipoExames]);
	}
}
