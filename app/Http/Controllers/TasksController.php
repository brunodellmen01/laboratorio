<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Task;
use Illuminate\Http\Request;
use Auth;

class TasksController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$dia = date('Y-m-d');
		$hoje = Task::where('task_date', $dia)->where('id_unity',Auth::user()->id_unity)->get();
		$tasks = Task::where('id_unity',Auth::user()->id_unity)->get();
		$pacientes = Patient::all();

		$tasks_coutnt = Task::where('id_unity',Auth::user()->id_unity)->count();

		return view('agenda.index', ['tasks' => $tasks, 'pacientes' => $pacientes, 'hoje' => $hoje]);
		

		
		//return view('agenda.index', compact('tasks'));
	}

	public function create() {

		return view('agenda.create');
	}

	public function store(Request $request) {
		Task::create($request->all());
		return back()->with('operacao', "SIM");
	}

	public function detalhe($id) {

		$agenda = Task::where('id', $id);
		$tasks = Task::where('id_unity',Auth::user()->id_unity)->get();
		$pacientes = Patient::all();

		return view('agenda.detalhe', ['id' => $id]);
	}

	public function atualizar($id,Request $request) {
		$agenda = Task::findOrFail($id);
		$agenda->update($request->all());

		return back()->with('operacao', "SIM");
		
	}

	public function excluir($id,Request $request) {
		$agenda = Task::findOrFail($id);
		$agenda->delete();

		return back()->with('operacao', "SIM");
		
	}

	//agenda geral

	public function indexAdm() {
		$dia = date('Y-m-d');
		$hoje = Task::where('task_date', $dia)->get();
		$tasks = Task::get();
		$pacientes = Patient::all();

		$tasks_coutnt = Task::count();

		return view('agenda.adm.index', ['tasks' => $tasks, 'pacientes' => $pacientes, 'hoje' => $hoje]);
		

		
		//return view('agenda.index', compact('tasks'));
	}

	public function createAdm() {

		return view('agenda.adm.create');
	}

	public function storeAdm(Request $request) {
		Task::create($request->all());
		return back()->with('operacao', "SIM");
	}

	public function detalheAdm($id) {

		$agenda = Task::where('id', $id);
		$tasks = Task::get();
		$pacientes = Patient::all();

		return view('agenda.adm.detalhe', ['id' => $id]);
	}

	public function atualizarAdm($id,Request $request) {
		$agenda = Task::findOrFail($id);
		$agenda->update($request->all());

		return back()->with('operacao', "SIM");
		
	}

	public function excluirAdm($id,Request $request) {
		$agenda = Task::findOrFail($id);
		$agenda->delete();

		return back()->with('operacao', "SIM");
		
	}
}
