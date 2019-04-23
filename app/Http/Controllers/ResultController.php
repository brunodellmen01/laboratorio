<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;
use \App\Exam;
use \App\Result;

class ResultController extends Controller {
	private $totalPorPagina = 5;
	public function index() {

		//abre o formulario quando carrega a pagina

		$resultado = Result::get();
		$tipoExames = Exam::all();
		$TipoResultados = Category::all();
		return view('resultados.formulario', ['resultados' => $resultado, 'tipoExames' => $tipoExames, 'TipoResultados' => $TipoResultados]);
	}

	public function salvar(Request $request) {

		//pega os dados do formulario e salva
		$resultado = new Result();
		$tipoExames = Exam::all();
		$TipoResultados = Category::all();
		$resultado = $resultado->create($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('resultados.formulario', ['tipoExames' => $tipoExames, 'TipoResultados' => $TipoResultados]);

	}

	public function editar($id) {

		//pega o medico pelo id e passa pro formulario
		$resultado = Result::findOrFail($id);

		//aqui pego a cidade
		$tipoExames = Exam::all();
		$tipoResultados = Category::all();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('resultados.formulario', ['resultado' => $resultado, 'tipoExames' => $tipoExames, 'TipoResultados' => $tipoResultados]);

		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {

		//seleciona o registro pelo id e atualiza
		$resultado = Result::findOrFail($id);
		$tipoExames = Exam::all();
		$TipoResultados = Category::all();
		$resultado->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('resultados.formulario', ['resultado' => $resultado, 'tipoExames' => $tipoExames, 'TipoResultados' => $TipoResultados]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$resultado = Result::find($id);
		$resultado->active = "N";
		$resultado->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect('resultado/listar?certo=true');

	}

	public function listar() {

		//verifica se ha registros com campo ativo = 1
		//$countador = Medico::get()->where('ativo', '=', '1')->count();

		//seleciona todos os registros q estejam ativos
		$resultados = Result::where('active', 'S')->get();

		return view('resultados.lista', ['resultados' => $resultados]);
	}
}
