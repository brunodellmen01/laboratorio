<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Notification;

class NotificationController extends Controller {
	
	public function index() {

		//abre o formulario quando carrega a pagina

		$notificacoes = Notification::get();

		return view('notificacoes.lista', ['notificacoes' => $notificacoes]);
	}
}