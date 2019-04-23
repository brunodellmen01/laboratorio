<?php

namespace App\Http\Controllers;

use App\TipoResultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;

class TipoResultadoController extends Controller {
	public function index() {

		//abre o formulario quando carrega a pagina

		$tipoResultados = TipoResultado::get();

		return view('tipoResultados.formulario', ['tipoResultados' => $tipoResultados]);
	}

	public function salvar(Request $request) {

		//pega os dados do formulario e salva
		$tipoResultado = new TipoResultado();
		$tipoResultado = $tipoResultado->create($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('tipoResultados.formulario');

	}

	public function editar($id) {

		//pega o medico pelo id e passa pro formulario
		$tipoResultado = TipoResultado::findOrFail($id);

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('tipoResultados.formulario', ['tipoResultado' => $tipoResultado]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {

		//seleciona o medico pelo id e atualiza
		$tipoResultado = TipoResultado::findOrFail($id);
		$tipoResultados = TipoResultado::pluck('name', 'id');
		$tipoResultado->update($request->all());

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('tipoResultados.formulario', ['tipoResultado' => $tipoResultado]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$tipoResultado = TipoResultado::findOrFail($id);
		$tipoResultado->ativo = "N";
		$tipoResultado->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect('tipoResultado/listar?certo=true');

	}

	public function listar() {

		//verifica se ha registros com campo ativo = 1
		//$countador = Medico::get()->where('ativo', '=', '1')->count();

		//seleciona todos os registros q estejam ativos
		$tipoResultados = TipoResultado::where('ativo', 'S')->get();

		return view('tipoResultados.lista', ['tipoResultados' => $tipoResultados]);
	}
}
