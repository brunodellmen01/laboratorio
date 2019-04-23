<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Notification;

class NotificationController extends Controller {
	
	public function index() {

		//abre o formulario quando carrega a pagina

		$notificacoes = Notification::orderBy('created_at', 'desc')->get();
		$total = Notification::count();
		$enviado = Notification::where('status', 'ENVIADO')->count();
		$naoEnviado = Notification::where('status', 'NÃO ENVIADO')->count();

		return view('notificacoes.lista', ['notificacoes' => $notificacoes, 'total' => $total, 'enviado' => $enviado, 'naoEnviado' => $naoEnviado]);
	}
}