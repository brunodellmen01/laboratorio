<?php

namespace App\Http\Controllers;

use App\Convenio;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use crid\Http\Requests\ConvenioRequest;
use DB;

class ConvenioController extends Controller
{
    public function index(){

        //abre o formulario quando carrega a pagina

        $convenios = Convenio::get();

    	return view('convenios.formulario', ['convenios' => $convenios]);
    }

    public function salvar(Request $request){
    	
        //pega os dados do formulario e salva
        $convenio = new Convenio();
    	$convenio = $convenio->create($request->all());


        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('convenios.formulario');
    	
    }

    public function editar($id){

        //pega o medico pelo id e passa pro formulario
        $convenio = Convenio::findOrFail($id);

        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('convenios.formulario', ['convenio' => $convenio]);
        //return view('medicos.formulario');
    }

    public function atualizar($id, Request $request){

        //seleciona o medico pelo id e atualiza
        $convenio = Convenio::findOrFail($id);
        $convenios = Convenio::pluck('name', 'id');
        $convenio->update($request->all());

        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('convenios.formulario', ['convenio' => $convenio]);
    }

    public function inativar($id){

        //seleciona o médico onde o id e = o id passado e muda o ativo pra 0
        $convenio = Convenio::find($id);
        $convenio->ativo="N";
        $convenio->save();

        //$medico = Medico::findOrFail($id);
        //$medico->delete();

        return redirect('convenio/listar?certo=true');
    
    }

    public function listar(){

        //verifica se ha registros com campo ativo = 1
        //$countador = Medico::get()->where('ativo', '=', '1')->count(); 

        //seleciona todos os registros q estejam ativos
        $convenios = Convenio::where('ativo', 'S')->get();


    	return view('convenios.lista', ['convenios' => $convenios]);
    }
}
