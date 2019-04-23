<?php

namespace App\Http\Controllers;


use App\TipoExame;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use crid\Http\Requests\TipoExameRequest;
use DB;

class TipoExameController extends Controller
{
    public function index(){

        //abre o formulario quando carrega a pagina

        $tipoExames = TipoExame::get();

    	return view('tipoExames.formulario', ['tipoExames' => $tipoExames]);
    }

    public function salvar(Request $request){
    	
        //pega os dados do formulario e salva
        $tipoExame = new TipoExame();
    	$tipoExame = $tipoExame->create($request->all());


        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('tipoExames.formulario');
    	
    }

    public function editar($id){

        //pega o medico pelo id e passa pro formulario
        $tipoExame = TipoExame::findOrFail($id);

        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('tipoExames.formulario', ['tipoExame' => $tipoExame]);
        //return view('medicos.formulario');
    }

    public function atualizar($id, Request $request){

        //seleciona o medico pelo id e atualiza
        $tipoExame = TipoExame::findOrFail($id);
        $tipoExames = TipoExame::pluck('name', 'id');
        $tipoExame->update($request->all());

        \Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
        return view('tipoExames.formulario', ['tipoExame' => $tipoExame]);
    }

    public function inativar($id){

        //seleciona o médico onde o id e = o id passado e muda o ativo pra 0
        $tipoExame = TipoExame::find($id);
        $tipoExame->ativo="N";
        $tipoExame->save();

        //$medico = Medico::findOrFail($id);
        //$medico->delete();

        return redirect('tipoExame/listar?certo=true');
    
    }

    public function listar(){

        //verifica se ha registros com campo ativo = 1
        //$countador = Medico::get()->where('ativo', '=', '1')->count(); 

        //seleciona todos os registros q estejam ativos
        $tipoExames = TipoExame::where('ativo', 'S')->get();


    	return view('tipoExames.lista', ['tipoExames' => $tipoExames]);
    }

}
