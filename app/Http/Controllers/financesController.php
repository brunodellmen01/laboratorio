<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use \App\Boxs;
use \App\Moviment;
use \App\Order;
use \App\OrderArticles;
use \App\ParcelOrder;
use \App\ParcelPay;
use \App\Patient;

class financesController extends Controller {
	private $totalPorPagina = 5;
	public function index() {

		$receitas = Order::where('states_id', 'A VISTA')->where('id_unity',Auth::user()->id_unity)->get();

		$despesas = ParcelPay::where('status', 'PAGO')->where('id_unity',Auth::user()->id_unity)->get();

		//$receitas = ParcelOrder::where('receive', '<>', '')->get();

		$movs = Moviment::where('id_unity',Auth::user()->id_unity)->get();

		$boxs = Boxs::where('id_unity',Auth::user()->id_unity)->get();

		return view('financeiro.index', ['receitas' => $receitas, 'movs' => $movs, 'boxs' => $boxs, 'despesas' => $despesas]);
	}

	public function financesOrder() {

		return view('financeiro.recebePedido');
	}

	public function geraParcela($id) {

		//seleciono o ultimo id da table Pedido (Order)
		$ultimo = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		//Pego o Id no array
		$ultimoId = $ultimo['id'];

		$id_unity = $ultimo['id_unity'];

		$status = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		$status_pedido = $status['states_id'];

		$pricePedido = OrderArticles::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		$price = $pricePedido['price'];

		$date = date('Y-d-m');

		$data = date('Y-d-m');

		//trago todos os itens e ordeno pelo ultimo
		$itens = OrderArticles::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		//trago todos os pedidos e ordeno pelo ultimo
		$status = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		//seleciono a qtd de parcelas
		$qtd_pedido = $status['qtd'];

		//seleciono o preco do pedido
		$valor_pedido = $itens['price'];

		DB::table('orders')
			->where('id', $ultimoId)
			->update(['value' => $valor_pedido]);

		//calulo o valor da percela
		$valor_parcela = ($valor_pedido / $qtd_pedido);

		$data_venc = date('Y-m-d');

		//set_time_limit(120);

		//dd($status_pedido);

		//se for A VISTA, gera uma parcela com o status pago
		if ($status_pedido == "A PRAZO" or $status_pedido == 1) {

			$parcelaAVistas = DB::table('order_articles')->where('order_id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->sum('price');

			//converte a soma para inteiro
			$parcelaAVistas = intval($parcelaAVistas);

			$hoje = date('Y-d-m');

			$i = 1;

			while ($i <= $qtd_pedido):

				$data_venc = date('Y-m-d', strtotime("+" . $i . " month"));

				DB::table('parcel_orders')->insert([
					['status' => 'PAGO',
						'price_parcel' => $parcelaAVistas,
						'venc' => $data_venc,
						'price_settled' => 0,
						'price_remain' => $parcelaAVistas,
						'receive' => '',
						'order_id' => $id,
						'id_unity' => $id_unity],

				]);

				$i++;
			endwhile;

		} else {

			$i = 1;

			while ($i <= $qtd_pedido):

				$hoje = date('Y-m-d');

				DB::table('parcel_orders')->insert([
					['status' => 'A VENCER',
						'price_parcel' => $valor_parcela,
						'venc' => $hoje,
						'price_settled' => $price,
						'price_remain' => $price,
						'receive' => $hoje,
						'order_id' => $id,
						'id_unity' => $id_unity],

				]);

				$i++;
			endwhile;

		}

		//seleciono o ultimo id da table Pedido (Order)
		$ultimo = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		//Pego o Id no array
		$ultimoId = $ultimo['id'];

		$orderArticles = Order::where('id', $id)->where('id_unity',Auth::user()->id_unity)->get();

		$pacientePedido = $orderArticles[0]['patient_id'];

		$email = Patient::where('id', $pacientePedido)->get();

		$emailPaciente = $email[0]['email'];

		$nomePaciente = $email[0]['name'];

		$protocolo = $orderArticles[0]['protocol'];

		$parcelOrders = ParcelOrder::where('order_id', $id)->paginate($this->totalPorPagina);

		//realiza a soma dos valores do peidido
		$precoTotalText = DB::table('order_articles')->where('order_id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->sum('price');

		//converte a soma para inteiro
		$precoTotal = intval($precoTotalText);

		$movs = Moviment::all();

		$boxs = Boxs::all();

		$orders = Order::where('id', $id)->where('id_unity',Auth::user()->id_unity)->get();

		$priceText = DB::table('order_articles')->where('order_id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->sum('price');

		//converte a soma para inteiro
		$prices = intval($priceText);

		$exames = OrderArticles::where('order_id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->get();

		if ($emailPaciente == "") {

		} else {

			$paciente = $nomePaciente;
			$assunto = 'Novidades ' . $nomePaciente;
			$descricao = 'Parabens ' . $nomePaciente . '. Seu pedido foi registrado em nosso sistema com protocolo ' . $protocolo . '';
			$emailremetente = 'contato@labsystem.net.br';
			$emaildestinatario = $emailPaciente; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web

			/* Montando a mensagem a ser enviada no corpo do e-mail. */
			$mensagemHTML = '<p><b>Para:</b> ' . $paciente . '.</p>
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
						['subject' => 'NOVO PEDIDO ' .$nomePaciente,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "ENVIADO"],

				]);
				return view('financeiro.detailOrderFim', ['orderArticles' => $orderArticles, 'parcelOrders' => $parcelOrders, 'movs' => $movs, 'boxs' => $boxs, 'precoTotal' => $precoTotal, 'exames' => $exames])->with('enviado', "SIM");
				//return back()->with('enviado', "SIM");
			} else {
				$notification = DB::table('notifications')->insert([
						['subject' => 'NOVO PEDIDO ' .$nomePaciente,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "NÃO ENVIADO"],

				]);
				return view('financeiro.detailOrderFim', ['orderArticles' => $orderArticles, 'parcelOrders' => $parcelOrders, 'movs' => $movs, 'boxs' => $boxs, 'precoTotal' => $precoTotal, 'exames' => $exames])->with('enviado', "NAO");

			}

		}

		return view('financeiro.detailOrderFim', ['orderArticles' => $orderArticles, 'parcelOrders' => $parcelOrders, 'movs' => $movs, 'boxs' => $boxs, 'precoTotal' => $precoTotal, 'exames' => $exames])->with('enviado', "SIM");
	}

	public function show($id) {

		$status = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		$status_pedido = $status['states_id'];

		//seleciono o ultimo id da table Pedido (Order)
		$ultimo = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		//Pego o Id no array
		$ultimoId = $ultimo['id'];

		$pricePedido = OrderArticles::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		$price = $pricePedido['price'];

		$date = date('Y-d-m');

		$data = date('Y-d-m');

		//trago todos os itens e ordeno pelo ultimo
		$itens = OrderArticles::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		//trago todos os pedidos e ordeno pelo ultimo
		$status = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		//seleciono a qtd de parcelas
		$qtd_pedido = $status['qtd'];

		//seleciono o preco do pedido
		$valor_pedido = $itens['price'];

		//calulo o valor da percela
		$valor_parcela = ($valor_pedido / $qtd_pedido);

		$data_venc = date('Y-m-d');

		set_time_limit(120);

		$orderArticles = Order::where('id', $id)->where('id_unity',Auth::user()->id_unity)->get();

		$parcelOrders = ParcelOrder::where('order_id', $id)->where('id_unity',Auth::user()->id_unity)->paginate($this->totalPorPagina);

		//realiza a soma dos valores do peidido
		$precoTotalText = DB::table('order_articles')->where('order_id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->sum('price');

		//converte a soma para inteiro
		$precoTotal = intval($precoTotalText);

		$movs = Moviment::all();

		$boxs = Boxs::all();

		return view('financeiro.detailOrder', ['orderArticles' => $orderArticles, 'parcelOrders' => $parcelOrders, 'movs' => $movs, 'boxs' => $boxs, 'precoTotal' => $precoTotal]);
	}

	public function pagaParcela($pedido, $parcela) {

		//recebo o dia do pagamento
		$recebidoEm = $_GET['dataPaga'];

		//recebo o valor informado no modal de pagamento
		$pagamentoTexto = $_GET['pagamento'];

		//converto para inteiro o valor do pagamento
		$pagamento = intval($pagamentoTexto);

		//recebo o id do pedido e da parcela mandados via GET
		$id_parcela = intval($parcela);
		$id_pedido = intval($pedido);

		//dd($pagamento);

		//gravo o valor recebido no banco
		DB::table('parcel_orders')
			->where('id', $id_parcela)
			->update(['price_settled' => $pagamento,
				'receive' => $recebidoEm]);

		//seleciono o pedido de acordo com o ID recebido
		$orderArticles = Order::where('id', $id_pedido)->get();

		//seleciono as parcelas referente ao pedido selecionado
		$parcelOrders = ParcelOrder::where('order_id', $id_pedido)->paginate($this->totalPorPagina);

		return back();
	}

	public function caixa() {

		$hoje = date('Y-m-d');

		$entradas = Moviment::where('type', 'ENTRADA')->where('id_unity',Auth::user()->id_unity)->get();
		$saidas = Moviment::where('type', 'SAIDA')->where('id_unity',Auth::user()->id_unity)->get();

		//realiza a soma dos valores das saidas
		$totalSaidaText = DB::table('moviments')->where('type', 'SAIDA')->where('id_unity',Auth::user()->id_unity)->sum('price');

		//converte a soma para inteiro
		$totalSaidas = intval($totalSaidaText);

		//realiza a soma dos valores das saidas
		$totalEntradaText = DB::table('moviments')->where('type', 'ENTRADA')->where('id_unity',Auth::user()->id_unity)->sum('price');

		//converte a soma para inteiro
		$totalEntradas1 = intval($totalEntradaText);

		//realiza a soma dos valores das parcelas
		$parcelaText = DB::table('parcel_orders')->where('price_settled', '<>', '')->where('id_unity',Auth::user()->id_unity)->sum('price_settled');

		//converte a soma para inteiro
		$totalParcelas = intval($parcelaText);

		//dd($totalParcelas);

		$totalBoxText = DB::table('boxs')->where('open', $hoje)->where('id_unity',Auth::user()->id_unity)->sum('sale_initinal');

		//converte a soma para inteiro (aqui e o caixa)
		$totalBox = intval($totalBoxText);

		$saldos = ($totalEntradas1 + $totalBox + $totalParcelas) - $totalSaidas;

		$status = Boxs::select('status')->where('open', $hoje)->where('id_unity',Auth::user()->id_unity)->get();

		//verifico se a caixa aberto na data atual
		$countador = Boxs::get()->where('open', '=', $hoje)->where('id_unity',Auth::user()->id_unity)->count();

		//seleciona as parcelas recebias
		$parcelOrders = ParcelOrder::where('price_settled', '<>', '00,00')->where('id_unity',Auth::user()->id_unity)->get();

		$parcelPays = ParcelPay::where('price_settled', '<>', '00,00')->where('id_unity',Auth::user()->id_unity)->get();

		$movs = Moviment::where('id_unity',Auth::user()->id_unity)->get();

		$boxs = Boxs::where('id_unity',Auth::user()->id_unity)->get();

		$totalEntradas = $totalEntradas1 + $totalParcelas;

		return view('financeiro.caixa', ['entradas' => $entradas, 'saidas' => $saidas, 'saldos' => $saldos, 'status' => $status, 'countador' => $countador, 'totalBox' => $totalBox, 'totalSaidas' => $totalSaidas, 'totalEntradas' => $totalEntradas, 'parcelOrders' => $parcelOrders, 'movs' => $movs, 'boxs' => $boxs, 'parcelPays' => $parcelPays]);
	}

	public function abreCaixa() {

		//data de abertura
		$open = date('Y-m-d');

		$hoje = date('Y-m-d H:m:s');

		//verifico se a caixa aberto no dia atual
		$countador = Boxs::get()->where('open', '=', $open)->where('id_unity',Auth::user()->id_unity)->count();

		if ($countador > 0) {
			return back()->with('caixaAberto', "SIM");
		} else {

			$caixa_inicial = $_POST['saldo_inicial'];

			$saldo_inicial = intval($caixa_inicial);

			$insert = DB::table('boxs')->insert([
				['sale_initinal' => $saldo_inicial,
					'sale_end' => "",
					'open' => $open,
					'closed' => "",
					'diference' => "",
					'status' => "ABERTO",
					'id_unity' => Auth::user()->id_unity],

			]);
			$registraMov = DB::table('moviments')->insert([
				['type' => 'ENTRADA',
					'price' => $saldo_inicial,
					'description' => "ABERTURA DO CAIXA",
					'created_at' => $hoje,
					'id_unity' => Auth::user()->id_unity],

			]);

			$funcionario = Auth::user()->name;
			$assunto = 'Abertura de Caixa';
			$descricao = 'Ola, o caixa acaba de ser aberto por ' . $funcionario . ' com saldo de R$: ' . $saldo_inicial;
			$emailremetente = 'financeiro@labsystem.net.br';
			$emaildestinatario = 'financeiro@labsystem.net.br'; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web
			/* Montando a mensagem a ser enviada no corpo do e-mail. */
			$mensagemHTML = $descricao . '
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
						['subject' => 'ABERTURA DE CAIXA',
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "ENVIADO"],

				]);
				return back()->with('status', "ABERTO");
			} else {
				$notification = DB::table('notifications')->insert([
						['subject' => 'ABERTURA DE CAIXA',
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "NÃO ENVIADO"],

				]);
				return back()->with('status', "ABERTO");
			}

			return back()->with('status', "ABERTO");
		}

	}

	public function fechaCaixa() {

		$entradas = Moviment::where('type', 'ENTRADA')->where('id_unity',Auth::user()->id_unity)->paginate($this->totalPorPagina);
		$saidas = Moviment::where('type', 'SAIDA')->where('id_unity',Auth::user()->id_unity)->paginate($this->totalPorPagina);

		$dif = $_POST['diferenca'];

		$close = date('Y-m-d');

		$diferenca = intval($dif);

		$totalEntradaText = DB::table('moviments')->where('type', 'ENTRADA')->where('id_unity',Auth::user()->id_unity)->sum('price');

		$totalEntradas = intval($totalEntradaText);

		$totalBoxText = DB::table('boxs')->where('open', $close)->where('id_unity',Auth::user()->id_unity)->sum('sale_initinal');

		//converte a soma para inteiro (aqui e o caixa)
		$totalBox = intval($totalBoxText);

		//realiza a soma dos valores das parcelas
		$parcelaText = DB::table('parcel_orders')->where('price_settled', '<>', '0')->where('id_unity',Auth::user()->id_unity)->sum('price_settled');

		//converte a soma para inteiro
		$totalParcelas = intval($parcelaText);

		//realiza a soma dos valores das saidas
		$totalSaidaText = DB::table('moviments')->where('type', 'SAIDA')->where('id_unity',Auth::user()->id_unity)->sum('price');

		//converte a soma para inteiro
		$totalSaidas = intval($totalSaidaText);

		$saldo_final = ($totalEntradas + $totalBox + $totalParcelas) - $totalSaidas;

		$saldos = $saldo_final;

		$status = Boxs::select('status')->where('open', $close)->where('id_unity',Auth::user()->id_unity)->get();

		$movs = Moviment::where('id_unity',Auth::user()->id_unity)->get();

		$boxs = Boxs::where('id_unity',Auth::user()->id_unity)->get();

		$parcelOrders = ParcelOrder::where('price_settled', '<>', '00,00')->where('id_unity',Auth::user()->id_unity)->paginate($this->totalPorPagina);

		$close = date('Y-m-d');

		//seleciono o ultimo id da table Pedido (Order)
		$ultimo = Boxs::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

		//Pego o Id no array
		$ultimoId = $ultimo['id'];

		//verifico se a caixa fechado no dia atual
		$countador = Boxs::get()->where('closed', '=', $close)->where('id_unity',Auth::user()->id_unity)->count();

		$status = Boxs::select('status')->where('closed', $close)->where('id_unity',Auth::user()->id_unity)->get();

		if ($countador > 0) {

			//return back()->with('caixaFechado', "SIM", ['countador' => $countador, 'status' => $status]);
			return view('financeiro.caixa', ['entradas' => $entradas, 'saidas' => $saidas, 'saldos' => $saldos, 'status' => $status, 'countador' => $countador, 'totalBox' => $totalBox, 'totalSaidas' => $totalSaidas, 'totalEntradas' => $totalEntradas, 'parcelOrders' => $parcelOrders, 'movs' => $movs, 'boxs' => $boxs])->with('caixaFechado', "SIM");
		} else {

			//data de fechamento
			$close = date('Y-m-d');

			$update = DB::table('boxs')
				->where('id', $ultimoId)
				->update(['sale_end' => $saldo_final,
					'closed' => $close,
					'diference' => $diferenca,
					'status' => "FECHADO",
					'id_unity' => Auth::user()->id_unity]);

			$funcionario = Auth::user()->name;
			$assunto = 'fechamento de Caixa';
			$descricao = 'Ola, o caixa acaba de ser fechado por ' . $funcionario . ' com saldo final de R$: ' . $saldo_final . ' e diferença de R$: ' . $diferenca;
			$emailremetente = 'financeiro@labsystem.net.br';
			$emaildestinatario = 'financeiro@labsystem.net.br'; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web
			/* Montando a mensagem a ser enviada no corpo do e-mail. */
			$mensagemHTML = $descricao . '
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
						['subject' => 'FECHAMENTO DE CAIXA',
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "ENVIADO"],

				]);
				return back()->with('status', "FECHADO");
			} else {
				$notification = DB::table('notifications')->insert([
						['subject' => 'FECHAMENTO DE CAIXA',
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "NÃO ENVIADO"],

				]);
				return back()->with('status', "FECHADO");
			}

			return view('financeiro.caixa', ['entradas' => $entradas, 'saidas' => $saidas, 'saldos' => $saldos, 'status' => $status, 'countador' => $countador, 'totalBox' => $totalBox, 'totalSaidas' => $totalSaidas, 'totalEntradas' => $totalEntradas, 'parcelOrders' => $parcelOrders, 'movs' => $movs, 'boxs' => $boxs])->with('mostraFechado', "SIM");

			//return back()->with('mostraFechado', "SIM");

		}

	}

}
