<?php

namespace App\Http\Controllers;

use DB;
use \App\City;
use \App\Exam;
use \App\Order;
use \App\ParcelOrder;
use \App\ParcelPay;
use \App\Patient;
use \App\Result;
use \App\Value;
use \App\Covenant;

class RelatorioController extends Controller {
	private $totalPorPagina = 5;

	public function preco() {

		$precos = Value::orderBy('covenant_id', 'asc')->groupBy('covenant_id')->get();

		return view('relatorios.precoExame', ['precos' => $precos]);
	}

	public function convenio($id_convenio) {

		$convenio_id = $id_convenio;

		$id = intval($id_convenio);

		$convenios = Value::where('covenant_id', '=', $id)->orderBy('name', 'asc');

		$totalExames = Value::get()->where('covenant_id', '=', $id)->count();

		$valorMinimo = DB::table('values')->where('covenant_id', '=', $id)->min('value');

		$valorMaximo = DB::table('values')->where('covenant_id', '=', $id)->max('value');

		$ultimoPedido = DB::table('orders')->where('covenant_id', '=', $id)->orderBy('created_at', 'desc')->limit(1)->get();

		$exames = Value::where('covenant_id', '=', $id)->get();

		return view('relatorios.convenios', ['convenios' => $convenios, 'totalExames' => $totalExames, 'valorMinimo' => $valorMinimo, 'valorMaximo' => $valorMaximo, 'ultimoPedido' => $ultimoPedido, 'exames' => $exames]);
	}

	public function aniversariantes() {

		$hoje = date('Y-m-d');

		$aniversariantes = Patient::WhereMonth('dt_birth', '=', date('m'))
			->WhereDay('dt_birth', '=', date('d'))->get();

		$totalNiver = Patient::WhereMonth('dt_birth', '=', date('m'))
			->WhereDay('dt_birth', '=', date('d'))->count();

		return view('relatorios.aniversariantes', ['aniversariantes' => $aniversariantes, 'totalNiver' => $totalNiver]);

	}

	public function enviaParabens() {

		// Passando os dados obtidos pelo formulário para as variáveis abaixo
		$paciente = $_POST['paciente'];
		$assunto = 'Feliz Aniversario ' . $paciente;
		$descricao = $_POST['mensagem'];
		$emailremetente = 'contato@labsystem.net.br';
		$emaildestinatario = $_POST['pacienteEmail']; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web
		if ($emaildestinatario == "") {

		} else {
			/* Montando a mensagem a ser enviada no corpo do e-mail. */
			$mensagemHTML = '<p><b>Para:</b> ' . $paciente . '</p>
						' . $descricao . '
						<br><br>Atenciosamente, Equipe Lab System. ';

			// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
			// O return-path deve ser ser o mesmo e-mail do remetente.
			$headers = "MIME-Version: 1.1\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "From: $emailremetente\r\n"; // remetente
			$headers .= "Return-Path: $emailremetente \r\n"; // return-path
			$envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers);

			if ($envio) {
				$notification = DB::table('notifications')->insert([
						['subject' => 'PARABENIZANDO ' .$paciente,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'status' => "ENVIADO"],

				]);
				return back()->with('enviado', "SIM");
			} else {
				$notification = DB::table('notifications')->insert([
						['subject' => 'PARABENIZANDO ' .$paciente,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'status' => "NÃO ENVIADO"],

				]);
				return back()->with('enviado', "NAO");

			}
		}

		return back();

	}

	public function pacienteCidade($id_cidade) {

		$cidade_id = $id_cidade;

		$id = intval($id_cidade);

		$pacientes = Patient::where('city_id', '=', $id)->orderBy('name', 'asc')->get();

		return view('relatorios.pacienteCidade', ['pacientes' => $pacientes]);
	}

	public function cidades() {
		$cidades = City::orderBy('name', 'asc')->get();

		return view('relatorios.paciente', ['cidades' => $cidades]);
	}

	public function resultadoExame() {

		$exames = Exam::orderBy('name', 'asc')->get();

		return view('relatorios.exames', ['exames' => $exames]);
	}

	public function resultado($id_exame) {

		$exame_id = $id_exame;

		$id = intval($id_exame);

		$resultados = Result::where('exam_id', '=', $id)->orderBy('description', 'asc')->get();

		return view('relatorios.resultadoExame', ['resultados' => $resultados]);
	}

	public function contaReceberHoje() {

		$hoje = date('Y-m-d');
		$totalRecebe = ParcelOrder::get()->where('venc', '=', $hoje)->where('status', '<>', 'PAGO')->count();
		$total = DB::table('parcel_orders')->where('venc', '=', $hoje)->where('status', '<>', 'PAGO')->sum('price_parcel');
		$contaReceber = ParcelOrder::where('venc', $hoje)->get();
		return view('relatorios.contaReceberHoje', ['totalRecebe' => $totalRecebe, 'total' => $total, 'contaReceber' => $contaReceber]);
	}

	public function contaPagarHoje() {

		$hoje = date('Y-m-d');
		$totalPaga = ParcelPay::get()->where('venc', '=', $hoje)->where('status', '<>', 'PAGO')->count();
		$total = DB::table('parcel_pays')->where('venc', '=', $hoje)->where('status', '<>', 'PAGO')->sum('price_parcel');

		$contaPagar = ParcelPay::where('venc', $hoje)->get();
		return view('relatorios.contaPagarHoje', ['totalPaga' => $totalPaga, 'total' => $total, 'contaPagar' => $contaPagar]);
	}

	public function pedido() {

		$hoje = date('Y-m-d');

		// tira a hora da data data = Y-m-d h:m:s, fica so o dia
		//$data = substr($data_do_banco, 0, 8);

		//conto quantos tem com cada status
		$totalVencidos = ParcelOrder::where('venc', '<', $hoje)->count();

		$totalAbertos = Order::where('status', '=', 'ABERTO')->count();

		$totalAVistas = ParcelOrder::where('status', '=', 'PAGO')->count();

		$totalAnalises = Order::where('status', '=', 'EM ANALISE')->count();

		$totalFinalizados = Order::where('status', '=', 'FINALIZADO')->count();

		$totalEntregues = Order::where('status', '=', 'ENTREGUE')->count();

		//somo os valores
		$somaVencidos = ParcelOrder::where('venc', '<', $hoje)->sum('price_parcel');


		$somaAbertos = ParcelOrder::where('status', '=', 'ABERTO')->sum('price_parcel');

		$somaAVistas = ParcelOrder::where('status', '=', 'PAGO')->sum('price_parcel');

		$somaEntregues = ParcelOrder::where('status', '=', 'ENTREGUE')->sum('price_parcel');

		$somaFinalizados = ParcelOrder::where('status', '=', 'FINALIZADO')->sum('price_parcel');

		$somaAnalises = ParcelOrder::where('status', '=', 'EM ANALISE')->sum('price_parcel');

		//trago os dados de cada status
		$vencidos = ParcelOrder::where('venc', '<', $hoje)->get();

		$abertos = Order::where('status', '=', 'ABERTO')->get();

		$avistas = Order::where('status', '=', 'PAGO')->get();

		$analises = Order::where('status', '=', 'EM ANALISE')->get();

		$finalizados = Order::where('status', '=', 'FINALIZADO')->get();

		$entregues = Order::where('status', '=', 'ENTREGUE')->get();

		$hojes = Order::where('created_at', '=', $hoje)->get();

		$totalInternos = Order::where('type', '=', 'INTERNO')->count();

		$totalExternos = Order::where('type', '=', 'EXTERNO')->count();

		return view('relatorios.pedidos', ['totalVencidos' => $totalVencidos, 'totalAVistas' => $totalAVistas, 'vencidos' => $vencidos, 'avistas' => $avistas, 'totalAbertos' => $totalAbertos, 'abertos' => $abertos, 'totalAnalises' => $totalAnalises, 'analises' => $analises, 'finalizados' => $finalizados, 'totalFinalizados' => $totalFinalizados, 'entregues' => $entregues, 'totalEntregues' => $totalEntregues, 'somaVencidos' => $somaVencidos, 'somaAVistas' => $somaAVistas, 'somaEntregues' => $somaEntregues, 'somaFinalizados' => $somaFinalizados, 'somaAnalises' => $somaAnalises, 'somaAbertos' => $somaAbertos, 'totalInternos' => $totalInternos, 'totalExternos' => $totalExternos]);
	}

	public function nerd() {

		$idadeMaior = Patient::get()->max('dt_birth');

		$idadeMenor = Patient::get()->min('dt_birth');

		$pacienteVelho = Patient::where('dt_birth', '=', $idadeMaior)->get();

		$pacienteNovo = Patient::where('dt_birth', '=', $idadeMenor)->get();

		$nomeMaisNovo = $pacienteNovo[0]['name'];

		$nomeMaisVelho = $pacienteVelho[0]['name'];

		$idadeMaior = $pacienteNovo[0]['dt_birth'];

		$idadeMenor = $pacienteVelho[0]['dt_birth'];

		$totalMasculino = Patient::where('sex', '=', 'M')->count();

		$totalFeminino = Patient::where('sex', '=', 'F')->count();

		//dd($nomeMaisNovo);

		return view('relatorios.nerd', ['nomeMaisNovo' => $nomeMaisNovo, 'nomeMaisVelho' => $nomeMaisVelho, 'idadeMaior' => $idadeMaior, 'idadeMenor' => $idadeMenor, 'totalMasculino' => $totalMasculino, 'totalFeminino' => $totalFeminino]);
	}

	public function contaVencida() {

		$hoje = date('Y-m-d');
		$totalRecebe = ParcelOrder::get()->where('venc', '<', $hoje)
			->where('status', '<>', 'PAGO')
			->count();

		if ($totalRecebe == 0) {
			return view("relatorios.semcontaVencida");
		} else {
			$total = DB::table('parcel_orders')->where('venc', '<', $hoje)
				->where('status', '<>', 'PAGO')->sum('price_parcel');

			$contaReceber = ParcelOrder::where('venc', '<', $hoje)
				->where('status', '<>', 'PAGO')->get();
			//dd($contaReceber);
			$id_pedido = $contaReceber[0]['order_id'];
			//dd($id_pedido);
			$pedido = Order::where('id', $id_pedido)->get();

			$paciente = $pedido[0]['patient_id'];

			$nomePaciente = Patient::where('id', $paciente)->get();

			//2017-10-01 > 2017-10-21

			$data = $contaReceber[0]['venc'];

			return view('relatorios.contaVencida', ['totalRecebe' => $totalRecebe, 'total' => $total, 'contaReceber' => $contaReceber, 'nomePaciente' => $nomePaciente]);
		}

	}

	public function notificaParcela() {
		$paciente = $_POST['paciente'];
		$assunto = 'Tudo Bem Senhor.(a) ' . $paciente;
		$descricao = $_POST['mensagem'];
		$emailremetente = 'contato@labsystem.net.br';
		$emaildestinatario = $_POST['email'];

		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = '<p><b>Para:</b> ' . $paciente . '</p>
						' . $descricao . '
						<br><br>Atenciosamente, Equipe Lab System. ';

		// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
		// O return-path deve ser ser o mesmo e-mail do remetente.
		$headers = "MIME-Version: 1.1\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: $emailremetente\r\n"; // remetente
		$headers .= "Return-Path: $emailremetente \r\n"; // return-path
		$envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers);

		if ($envio) {
			$notification = DB::table('notifications')->insert([
						['subject' => 'NOTIFICAÇÃO DE PARCELA ATRADASA ' .$paciente,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'status' => "ENVIADO"],

				]);
			return back()->with('enviado', "SIM");
		} else {
			$notification = DB::table('notifications')->insert([
						['subject' => 'NOTIFICAÇÃO DE PARCELA ATRADASA ' .$paciente,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'status' => "NÃO ENVIADO"],

				]);
			return back()->with('enviado', "NAO");

		}

	}

	public function despesaConvenio(){
		$convenios = Order::groupBy('covenant_id')->get();
		return view('relatorios.despesaConvenio', ['convenios' => $convenios]);
	}

	public function despesaConvenioResumo($id){
		$convenios = Covenant::where('id', $id)->get();
		$total = Order::where('covenant_id', $id)->count();
		$valorTotal = DB::table('orders')->where('covenant_id', $id)->sum('value');
		$a = 1;
		$b = 7;
		$total_30 = date('Y-m-d', strtotime("-" . $a . " month"));
		$total_7 = date('Y-m-d', strtotime("-" . $b . " day"));
		$data_inicio = date('Y-m-d' . ' 00:00:00', time());
		$data_final  = date('Y-m-d' . ' 23:59:59', time());
		$valor_mes = DB::table('orders')->whereBetween('created_at', [$data_inicio, $data_final])->sum('value');
		$valor_semana = DB::table('orders')->whereBetween('created_at', [$data_inicio, $data_final])->sum('value');
		$total_pedido_7 = DB::table('orders')->whereBetween('created_at', [$data_inicio, $data_final])->count();
		$total_pedido_30 = DB::table('orders')->whereBetween('created_at', [$data_inicio, $data_final])->count();
		$ultimosPedidos = Order::orderBy('created_at', 'desc')->limit(3)->get();

		
		

        
        
		return view('relatorios.financeiroConvenio', ['convenios' => $convenios, 'total' => $total, 'valorTotal' => $valorTotal, 'total_30' => $total_30, 'valor_mes' => $valor_mes, 'total_pedido_30' => $total_pedido_30, 'total_7' => $total_7, 'total_pedido_7' => $total_pedido_7, 'valor_semana' => $valor_semana, 'ultimosPedidos' => $ultimosPedidos]);
	}

	public function chart(){
		$pedidos = Order::orderBy('value', '>', '0')->limit(1)->get();
		$hoje = date('d/m/Y');
		return view('relatorios.charts.teste', ['pedidos' => $pedidos, 'hoje' => $hoje]);
	}

}
