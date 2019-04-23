<?php

namespace App\Http\Controllers;

use DB;

//referencia o DOMPDF
use PDF;
use \App\Category;
use \App\Exam;
use \App\Material;
use \App\Order;
use \App\OrderArticles;
use \App\ParcelOrder;
use \App\Patient;
use \App\Report;
use \App\Result;
use App\Configuration;

class pdfController extends Controller {
	public function index($id) {

		$orders = Order::where("id", $id)->get();
		$order = Order::find($id);

		// aki vc tem o pedido
		// dd($order);

		// aki vc tem os reports
		// dd($order->reports);

		// aki vc tem a category de um report
		//dd($order->reports->first()->result->category->name);

		$orderArticles = OrderArticles::where("order_id", $id)->get();

		$empresas = Configuration::all();


		$pacientePedido = $orderArticles[0]["patient_id"];

		$pedido = $orderArticles[0]["order_id"];

		$exame = $orderArticles[0]["exam_id"];

		$results = Result::where("exam_id", $exame)->groupBy('category_id')->orderBy('id', 'asc')->get();

		$reports = Report::where('order_article_id', '=', $pedido)->orderby('result_id', 'asc')->get();

		

		$patients = Patient::where("id", $pacientePedido)->get();

		$exames = Exam::where("id", $exame)->get();

		$idmaterial = $exames[0]["material_id"];
		$idcategoria = $exames[0]["category_id"];

		$materials = Material::where("id", $idmaterial)->get();

		$metodos = Category::where("id", $idcategoria)->get();

		$hoje = date('d/m/Y - H:m:s:m');

		$laudo = date('d/m/Y-H:m:s');
		

		$data['orders'] = $orders;
		$data['orderArticles'] = $orderArticles;
		$data['reports'] = $reports;
		$data['patients'] = $patients;
		$data['hoje'] = $hoje;
		$data['exames'] = $exames;
		$data['materials'] = $materials;
		$data['metodos'] = $metodos;
		$data['results'] = $results;
		$data['empresas'] = $empresas;

		/*foreach ($results as $result) {
			dump($result->reports()->toSql(), $result->reports()->getBindings());
		}

		exit;*/

		$data['reportsGroupedByCategory'] = $order->reports->groupBy('result.category.name');
		
		// $data['reportsGroupedByCategory'] = $order->reports->groupBy('category.name');
		
		//gera o hml do laudo
		//return view('prints.laudohtml', $data);

		//vai pra view com o conteudo em HTML e gera o pdf
		$pdf = PDF::loadView('prints.laudo', $data);



		return $pdf->stream(
			'laudo' . $laudo . '.pdf',

			array(
				"Attachment" => false, //pra baixar deixar true
			));

	}

	public function retirada($id) {

		$orders = Order::where("id", $id)->get();
		$orderArticles = OrderArticles::where("order_id", $id)->get();

		$pedido = $orderArticles[0]["order_id"];
		$reports = Report::where('order_article_id', '=', $pedido)->get();

		$empresas = Configuration::all();

		$hoje = date('d/m/Y H:m:s');

		$temp = "";
		$data['orders'] = $orders;
		$data['hoje'] = $hoje;
		$data['reports'] = $reports;
		$data['orderArticles'] = $orderArticles;
		$data['temp'] = $temp;
		$data['empresas'] = $empresas;

		$pdf = PDF::loadView('prints.printRetirada', $data);

		//$pdf->setPaper('a4');

		return $pdf->stream(
			'retirada.pdf',

			array(
				"Attachment" => false, //pra baixar deixar true
			));
	}

	public function resumo($id) {
		$orderArticles = Order::where('id', $id)->get();
		$parcelOrders = ParcelOrder::where('order_id', $id)->get();
		$precoTotalText = DB::table('order_articles')->where('order_id', $id)->sum('price');
		$precoTotal = intval($precoTotalText);
		$reports = OrderArticles::where('order_id', $id)->get();
		$empresas = Configuration::all();
		

		$data['orderArticles'] = $orderArticles;
		$data['parcelOrders'] = $parcelOrders;
		$data['precoTotal'] = $precoTotal;
		$data['reports'] = $reports;
		$data['empresas'] = $empresas;

		$pdf = PDF::loadView('prints.printResumo', $data);

		

		return $pdf->stream(
			'Resumo.pdf',

			array(
				"Attachment" => false, //pra baixar deixar true
			));
	}

	public function laudoCliente() {

		$protocolo = $prot;

		$orders = Order::where("protocol", $protocolo)->get();

		$id = $orders[0]['id'];

		$orderArticles = OrderArticles::where("order_id", $id)->get();

		$pacientePedido = $orderArticles[0]["patient_id"];

		$pedido = $orderArticles[0]["order_id"];

		$exame = $orderArticles[0]["exam_id"];

		$reports = Report::where('order_article_id', '=', $pedido)->get();

		$patients = Patient::where("id", $pacientePedido)->get();

		$exames = Exam::where("id", $exame)->get();

		$idmaterial = $exames[0]["material_id"];

		$idcategoria = $exames[0]["category_id"];

		$materials = Material::where("id", $idmaterial)->get();

		$metodos = Category::where("id", $idcategoria)->get();

		$hoje = date('d/m/Y H:m:s');

		$laudo = date('d/m/Y-H:m:s');

		$data['orders'] = $orders;
		$data['orderArticles'] = $orderArticles;
		$data['reports'] = $reports;
		$data['patients'] = $patients;
		$data['hoje'] = $hoje;
		$data['exames'] = $exames;
		$data['materials'] = $materials;
		$data['metodos'] = $metodos;

		//vai pra view com o conteudo em HTML e gera o pdf
		$pdf = PDF::loadView('prints.printLaudo', $data);

		

		return $pdf->stream(
			'laudo' . $laudo . '.pdf',

			array(
				"Attachment" => false, //pra baixar deixar true
			));
	}
}
