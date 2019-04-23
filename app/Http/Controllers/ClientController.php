<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use \App\Client;

class ClientController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	//ABRIR TELA INICIAL DA CLIENTE DE ATENDIMENTO
	public function index() {
		$clients = Client::all();
		return view('client.index', ['clients' => $clients]);
	}

	//ABRIR TELA DE CADASTRO
	public function openNew() {
		return view('client.cadastro');
	}

	//ABRIR TELA DE LISTAR STATUS
	public function edit($id) {
		$client = Client::findOrFail($id);
		return view('client.edit', ['client' => $client]);
	}

	//SALVAR DADOS DA EDIÇÃO
	public function saveEdit(Request $request) {
		$client = Client::find($request->input('id'));
		$client->name = $request->input('name');
		$client->street = $request->input('street');
		$client->number = $request->input('number');
		$client->city = $request->input('city');
		$client->burgh = $request->input('burgh');
		$client->save();
		return redirect()->action('ClientController@index');
	}

	//SALVAR DADOS PREENCHIDOS
	public function save(ClientRequest $request) {
		client::create($request->all());
		return redirect()->action('ClientController@index');
	}

	//DELETAR cliente DE ATENDIMENTO
	public function delete($id) {
		$client = Client::find($id);
		$client->delete();
		return redirect()->action('ClientController@index');
	}
}
