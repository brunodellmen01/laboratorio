<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Medic;
use App\Tisses;
use App\Prod_Tbl_Tuss;
use App\Configuration;
use App\GuiaTussProcs;
use App\Locale\Estate;
use Illuminate\Http\Request;
use DB;
use PDF;

class GuideController extends Controller {
	public function index($id) {
		
		$pacientes = Patient::where('id', $id)->get();
		$medicos = Medic::all();
		$empresas = Configuration::all();
		$estados = Estate::all();
		$dia = date('d/m/Y');
		return view('tiss.index', ['pacientes' => $pacientes, 'id' => $id, 'medicos' => $medicos, 'empresas' => $empresas, 'estados' => $estados, 'dia' => $dia]);
	}

	public function salvar(Request $request) {
		$guia = new Tisses();
		$guia = $guia->create($request->all());
		$id = $guia->id;
		$paciente = $guia->patient_id;

		return redirect('/historico/paciente/'.$paciente.'/tiss/'.$id.'/procedimentos');

		//return redirect()->action('GuideController@procedimentos', ['id' => $id]);
	}

	public function procedimentos($paciente, $id) {		
		$patient = Patient::where('id', $paciente)->get();
		$procedimentos = Prod_Tbl_Tuss::limit(30)->get();		
		$guia_id = Tisses::where('id', $id)->get();
		$guia = $guia_id[0]['id'];
		$nome_paciente = $patient[0]['name'];
		$id_paciente = $patient[0]['id'];
		$procedimento_id = $procedimentos[0]['id'];

		//dd($procedimentos);
		
		return view('tiss.procedimentos', ['procedimentos' => $procedimentos, 'paciente' => $paciente, 'nome_paciente' => $nome_paciente, 'guia' => $guia, 'procedimento_id' => $procedimento_id, 'id_paciente' => $id_paciente]);
	}

	public function add_procedimentos(Request $request){			
		$procedimentos = new GuiaTussProcs();		
		$procedimentos = $procedimentos->create($request->all());
		$id = $procedimentos->id;
		$id_paciente = $_POST['id_paciente'];
		$id_tiss = $procedimentos->id_tiss;
		
		$id_procedimento = $procedimentos->id_procedimento;

		/*$valor_total = 2;		
		$update = DB::table('guia_tuss_procs')
					  ->update(['valor_total' => $valor_total])
					  ->where('id', $ultimoId);*/


		
		$adicionados = GuiaTussProcs::where('id_tiss', $id_tiss)->get();


		

  		
  		return view('tiss.adicionado', ['adicionados' => $adicionados, 'id_procedimento' => $id_procedimento, 'id_tiss' => $id_tiss, 'id_paciente' => $id_paciente])->with('foi', "SIM");
		
	
	}

	public function remove_procedimentos($id_paciente, $id_tiss, $id_procedimento){
		//dd("Paciente: " .$id_paciente . "TISS: " .$id_tiss . "Procedimento: " .$id_procedimento);
		$patient = Patient::where('id', $id_paciente)->get();
		$id_paciente = $patient[0]['id'];

		$guia_id = Tisses::where('id', $id_tiss)->get();
		$guia = $guia_id[0]['id'];

		$remove_procedimentos = GuiaTussProcs::where('id_tiss', $id_tiss)->where('id_procedimento', $id_procedimento)->delete();

		
			
		$adicionados = GuiaTussProcs::where('id_tiss', $id_tiss)->get();
		$id_procedimento = $adicionados[0]['id_procedimento'];


		
		return view('tiss.adicionado', ['adicionados' => $adicionados, 'id_procedimento' => $id_procedimento, 'id_tiss' => $id_tiss, 'id_paciente' => $id_paciente])->with('removido', "SIM");

		
		
		
	}

	public function finaliza_tiss($id_paciente, $id_tiss){

		$guia_tiss = Tisses::where('id', $id_tiss)->get();

		$procedimentos = GuiaTussProcs::where('id_tiss', $id_tiss)->get();

		return view("tiss.finalizado", ['guia_tiss' => $guia_tiss, 'procedimentos' => $procedimentos])->with('finalizado', "SIM");
	}

	public function imprimir_guia(){

		$pdf = PDF::loadView('prints.guiaTissSADT');

		//$pdf->setPaper('A4', 'landscape');

		return $pdf->stream(
			'guia.pdf',

			array(
				"Attachment" => false, //pra baixar deixar true
			));
	}

	public function verGuia($id){
		$guia_tiss = Tisses::where('patient_id', $id)->get();

		//$procedimentos = GuiaTussProcs::where('id_tiss', $id_tiss)->get();

		return view("tiss.historico", ['guia_tiss' => $guia_tiss])->with('finalizado', "SIM");
	}

	public function verGuiaProc($id_tiss, $guia){
		//$guia_tiss = Tisses::where('patient_id', $id)->get();



		$procedimentos = GuiaTussProcs::where('id_tiss', $id_tiss)->get();

		return view("tiss.detalheGuia", ['procedimentos' => $procedimentos, 'guia' => $guia]);
	}

	public function consulta(){
		$guias = Tisses::orderBy('created_at', 'desc')->get();
		return view("tiss.listaGuia", ['guias' => $guias]);
	}

	public function detalheGuia($id_tiss){

		$guia_tiss = Tisses::where('id', $id_tiss)->get();

		$nome_paciente = $guia_tiss[0]['nome_paciente'];

		$procedimentos = GuiaTussProcs::where('id_tiss', $id_tiss)->get();

		return view("tiss.detalheGuia", ['guia_tiss' => $guia_tiss, 'procedimentos' => $procedimentos, 'id_tiss' => $id_tiss, 'nome_paciente' => $nome_paciente]);
	}

	
	
}