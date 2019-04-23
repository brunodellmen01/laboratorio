<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Expenses;
use App\ParcelPay;
use DB;
use Auth;
use App\Unitys;

class ExpensesController extends Controller {
	
	public function index() {
		
		$expenses = Expenses::where('id_unity',Auth::user()->id_unity)->get();		
		$empresas = Companies::get();
		$despesas = ParcelPay::where('id_unity',Auth::user()->id_unity)->get();

		



		$hoje = date('Y-m-d');

		//realiza a soma dos valores das saidas
		$totalEntradaText = DB::table('moviments')->where('type', 'ENTRADA')->where('id_unity',Auth::user()->id_unity)->sum('price');

		//converte a soma para inteiro
		$totalEntradas1 = intval($totalEntradaText);

		$totalBoxText = DB::table('boxs')->where('open', $hoje)->where('id_unity',Auth::user()->id_unity)->sum('sale_initinal');

		//converte a soma para inteiro (aqui e o caixa)
		$totalBox = intval($totalBoxText);

		//realiza a soma dos valores das parcelas
		$parcelaText = DB::table('parcel_orders')->where('price_settled', '<>', '')->where('id_unity',Auth::user()->id_unity)->sum('price_settled');

		//converte a soma para inteiro
		$totalParcelas = intval($parcelaText);

		//realiza a soma dos valores das saidas
		$totalSaidaText = DB::table('moviments')->where('type', 'SAIDA')->where('id_unity',Auth::user()->id_unity)->sum('price');

		//converte a soma para inteiro
		$totalSaidas = intval($totalSaidaText);

		$saldos = ($totalEntradas1 + $totalBox + $totalParcelas) - $totalSaidas;

		//soma o total de despesa pra pagar no dia
		$totalDespesaValor = DB::table('expenses')->where('venc', $hoje)->where('status', '<>', 'PAGO')->where('id_unity',Auth::user()->id_unity)->sum('price');
		$totalDespesaHoje = DB::table('expenses')->where('venc', $hoje)->where('status', '<>', 'PAGO')->where('id_unity',Auth::user()->id_unity)->count(); 
		$dias = 5;
		$vence_semana = date('Y-m-d', strtotime("+" . $dias . " day"));
		$totalDespesaSemana = DB::table('expenses')->where('venc', $vence_semana)->where('id_unity',Auth::user()->id_unity)->count();
		$totalDespesaVencida = DB::table('expenses')->where('venc', '<', $hoje)->where('status', '<>', 'PAGO')->where('id_unity',Auth::user()->id_unity)->count();



		return view('despesas.index', ['expenses' => $expenses, 'empresas' => $empresas, 'despesas' => $despesas, 'saldos' => $saldos, 'totalDespesaHoje' => $totalDespesaHoje, 'totalDespesaSemana' => $totalDespesaSemana, 'totalDespesaVencida' => $totalDespesaVencida, 'vence_semana' => $vence_semana]);
	}

	public function despesa_rh() {
		
		$expenses = Expenses::get();		
		$empresas = Companies::get();
		$despesas = ParcelPay::get();

		

		$hoje = date('Y-m-d');

		//realiza a soma dos valores das saidas
		$totalEntradaText = DB::table('moviments')->where('type', 'ENTRADA')->sum('price');

		//converte a soma para inteiro
		$totalEntradas1 = intval($totalEntradaText);

		$totalBoxText = DB::table('boxs')->where('open', $hoje)->sum('sale_initinal');

		//converte a soma para inteiro (aqui e o caixa)
		$totalBox = intval($totalBoxText);

		//realiza a soma dos valores das parcelas
		$parcelaText = DB::table('parcel_orders')->where('price_settled', '<>', '')->sum('price_settled');

		//converte a soma para inteiro
		$totalParcelas = intval($parcelaText);

		//realiza a soma dos valores das saidas
		$totalSaidaText = DB::table('moviments')->where('type', 'SAIDA')->sum('price');

		//converte a soma para inteiro
		$totalSaidas = intval($totalSaidaText);

		$saldos = ($totalEntradas1 + $totalBox + $totalParcelas) - $totalSaidas;

		//soma o total de despesa pra pagar no dia
		$totalDespesaValor = DB::table('expenses')->where('venc', $hoje)->where('status', '<>', 'PAGO')->sum('price');
		$totalDespesaHoje = DB::table('expenses')->where('venc', $hoje)->where('status', '<>', 'PAGO')->count(); 
		$dias = 5;
		$vence_semana = date('Y-m-d', strtotime("+" . $dias . " day"));
		$totalDespesaSemana = DB::table('expenses')->where('venc', $vence_semana)->count();
		$totalDespesaVencida = DB::table('expenses')->where('venc', '<', $hoje)->where('status', '<>', 'PAGO')->count();



		return view('despesas.despesa_rh', ['expenses' => $expenses, 'empresas' => $empresas, 'despesas' => $despesas, 'saldos' => $saldos, 'totalDespesaHoje' => $totalDespesaHoje, 'totalDespesaSemana' => $totalDespesaSemana, 'totalDespesaVencida' => $totalDespesaVencida, 'vence_semana' => $vence_semana]);
	}

	public function gerar() {

		$hoje = date('Y-m-d');

		$empresa = $_POST['companies_id'];

		$venc = $_POST['venc'];

		$valor = $_POST['price'];

		$description = $_POST['description'];

		$valor_despesa = intval($valor);

		$qtd = $_POST['qtd'];

		$i = 1;

		while ($i <= $qtd):

			$insert = DB::table('expenses')->insert([
				['companies_id' => $empresa,
					'venc' => $venc,
					'price' => $valor,
					'description' => $description],

			]);

			$i++;
		endwhile;

		//seleciono o ultimo id da table Pedido (Order)
		$ultimo = Expenses::orderBy('id', 'desc')->first();

		//Pego o Id no array
		$ultimoId = $ultimo['id'];

		$i = 1;

		while ($i <= $qtd):
			$insert = DB::table('parcel_pays')->insert([
				['expenses_id' => $ultimoId,
					'price_parcel' => $valor,
					'price_remain' => $valor,
					'venc' => $venc,
					'status' => "AGUARDANDO",
					'receive' => ""],

			]);
			$i++;
		endwhile;

		$expenses = Expenses::all();
		$empresas = Companies::all();
		$despesas = ParcelPay::all();

		//realiza a soma dos valores das saidas
		$totalEntradaText = DB::table('moviments')->where('type', 'ENTRADA')->sum('price');

		//converte a soma para inteiro
		$totalEntradas1 = intval($totalEntradaText);

		$totalBoxText = DB::table('boxs')->where('open', $hoje)->sum('sale_initinal');

		//converte a soma para inteiro (aqui e o caixa)
		$totalBox = intval($totalBoxText);

		//realiza a soma dos valores das parcelas
		$parcelaText = DB::table('parcel_orders')->where('price_settled', '<>', '')->sum('price_settled');

		//converte a soma para inteiro
		$totalParcelas = intval($parcelaText);

		//realiza a soma dos valores das saidas
		$totalSaidaText = DB::table('moviments')->where('type', 'SAIDA')->sum('price');

		//converte a soma para inteiro
		$totalSaidas = intval($totalSaidaText);

		$saldos = ($totalEntradas1 + $totalBox + $totalParcelas) - $totalSaidas;

		return redirect()->action('ExpensesController@index');

		return view('despesas.index', ['expenses' => $expenses, 'empresas' => $empresas, 'despesas' => $despesas, 'saldos' => $saldos]);

		return back();

	}

	public function pagar() {
		$idParcela = $_POST['id'];

		$id = intval($idParcela);

		$data = $_POST['dataPaga'];

		$despesa = $_POST['despesa'];

		$hoje = date('Y-m-d H:m:s');

		$update_expenses = DB::table('expenses')
			->where('id', $id)
			->update(['status' => 'PAGO',
				'paid' => $despesa,
				'date_paid' => $hoje]);

		//$parcelaText = DB::table('parcel_pays')->select('expenses_id')->where('expenses_id', $id)->get();

		$parcelaText = ParcelPay::select('id')->where('expenses_id', $id)->get();

		$id_parcel_pays = $parcelaText[0]['id'];

		$id_parcela = intval($id_parcel_pays);

		$update_parcel = DB::table('parcel_pays')
			->where('id', $id_parcela)
			->update(['price_settled' => $despesa,
				'status' => 'PAGO',
				'receive' => $hoje]);

		$mov_parcel = DB::table('moviments')->insert([
			['type' => 'SAIDA',
				'price' => $despesa,
				'description' => "PAGAMENTO DESPESA " . $id],

		]);

		$expenses = Expenses::all();
		$empresas = Companies::all();
		$despesas = ParcelPay::all();

		//realiza a soma dos valores das saidas
		$totalEntradaText = DB::table('moviments')->where('type', 'ENTRADA')->sum('price');

		//converte a soma para inteiro
		$totalEntradas1 = intval($totalEntradaText);

		$totalBoxText = DB::table('boxs')->where('open', $hoje)->sum('sale_initinal');

		//converte a soma para inteiro (aqui e o caixa)
		$totalBox = intval($totalBoxText);

		//realiza a soma dos valores das parcelas
		$parcelaText = DB::table('parcel_orders')->where('price_settled', '<>', '')->sum('price_settled');

		//converte a soma para inteiro
		$totalParcelas = intval($parcelaText);

		//realiza a soma dos valores das saidas
		$totalSaidaText = DB::table('moviments')->where('type', 'SAIDA')->sum('price');

		//converte a soma para inteiro
		$totalSaidas = intval($totalSaidaText);

		$saldos = ($totalEntradas1 + $totalBox + $totalParcelas) - $totalSaidas;

		//return view('despesas.index', ['expenses' => $expenses, 'empresas' => $empresas, 'despesas' => $despesas, 'saldos' => $saldos]);
		return back();
	}

}