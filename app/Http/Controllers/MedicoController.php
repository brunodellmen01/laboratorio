<?php

namespace App\Http\Controllers;

use App\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use crid\Http\Requests\MedicoRequest;
use DB;

class MedicoController extends Controller
{
    public function index(){

        //abre o formulario quando carrega a pagina

        $medicos = Medico::get();

    	return view('medicos.formulario', ['medicos' => $medicos]);
    }

    public function salvar(Request $request){
    	
        //pega os dados do formulario e salva
        $medico = new Medico();
    	$medico = $medico->create($request->all());


        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('medicos.formulario');
    	
    }

    public function editar($id){

        //pega o medico pelo id e passa pro formulario
        $medico = Medico::findOrFail($id);

        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('medicos.formulario', ['medico' => $medico]);
        //return view('medicos.formulario');
    }

    public function atualizar($id, Request $request){

        //seleciona o medico pelo id e atualiza
        $medico = Medico::findOrFail($id);
        $medicos = Medico::pluck('name', 'id');
        $medico->update($request->all());

        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('medicos.formulario', ['medico' => $medico]);
    }

    public function inativar($id){

        //seleciona o médico onde o id e = o id passado e muda o ativo pra 0
        $medico = Medico::find($id);
        $medico->ativo="N";
        $medico->save();

        //$medico = Medico::findOrFail($id);
        //$medico->delete();

        return redirect('medico/listar?certo=true');
    
    }

    public function listar(){

        //verifica se ha registros com campo ativo = 1
        //$countador = Medico::get()->where('ativo', '=', '1')->count(); 

        //seleciona todos os registros q estejam ativos
        $medicos = Medico::where('ativo', 'S')->get();


    	return view('medicos.lista', ['medicos' => $medicos]);
    }


}
