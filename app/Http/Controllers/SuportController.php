<?php

namespace App\Http\Controllers;
use App\Suport;
use Auth;
use DB;
use Illuminate\Http\Request;

class SuportController extends Controller {

	public function index() {

		return view('chamados.formulario');
	}

	public function listar() {

		$user = Auth::user()->id;
		$chamados = Suport::where('user_id', $user)->get();

		return view('chamados.lista', ['chamados' => $chamados]);
	}

	public function abrirChamado(Request $request) {

		$suporte = new Suport();
		$suporte = $suporte->create($request->all());
		$id = $suporte->id;
		$title = $suporte->title;
		$user = Auth::user()->id;

		$protocolo = uniqid();

		$inserePotocolo = DB::table('suports')
			->where('id', $id)
			->update(['protocol' => $protocolo, 'user_id' => $user]);

		$usuario = Auth::user()->name;
		$emaildestinatario = Auth::user()->email;
		$assunto = 'Chamado Registrado - ' . $title;
		$descricao = '<p> O Lab System - Suporte Agradece seu contato. </p>
					 Sua Mensagem com o assunto "' . $title . '", foi recebida com sucesso pelo nosso sistema e foi identificada pelo protocolo #' . $protocolo . '. </p>
					 <p> Informe esse numero sempre que for necessario fazer referência a esse chamado em contatos futuros.</p>
					 <p> Entraremos em contato em breve.</p>  ';
		$emailremetente = 'contato@labsystem.net.br';

		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = '<p><b>Para:</b> ' . $usuario . '</p>
						' . $descricao . '
						<br><br>Atenciosamente, Equipe Lab System. ';

		// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
		// O return-path deve ser ser o mesmo e-mail do remetente.
		$headers = "MIME-Version: 1.1\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: $emailremetente\r\n"; // remetente
		$headers .= "Return-Path: $emaildestinatario \r\n"; // return-path
		$envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers);

		if ($envio) {
			$notification = DB::table('notifications')->insert([
						['subject' => 'NOVO CHAMADO',
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "ENVIADO"],

				]);

			return view('chamados.formulario')->with('aberto', "SIM");
		} else {
			$notification = DB::table('notifications')->insert([
						['subject' => 'NOVO CHAMADO',
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "NÃO ENVIADO"],

				]);
			return view('chamados.formulario')->with('aberto', "NAO");

		}

		return view('chamados.formulario')->with('aberto', "SIM");
	}

}