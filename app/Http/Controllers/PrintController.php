<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

//referencia o DOMPDF
use \App\Order;
use \App\OrderArticles;
use \App\Patient;
use \App\Report;

@require_once "../dompdf/autoload.inc.php";

class PrintController extends Controller {

	public function laudo($id) {

		//busco os dados do pedido
		$orders = Order::where("id", $id)->get();

		$orderArticles = OrderArticles::where("order_id", $id)->get();

		$pacientePedido = $orderArticles[0]["patient_id"];

		$pedido = $orderArticles[0]["order_id"];

		$exame = $orderArticles[0]["exam_id"];

		$reports = Report::where('order_article_id', '=', $pedido)->get();

		$patients = Patient::where("id", $pacientePedido)->get();

		$hoje = date('d/m/Y H:m:s');

		//instancio o objeto e seto para permitir usar as img
		$options = new Options();
		$options->set("isRemoteEnabled", TRUE);
		$dompdf = new Dompdf($options);
		$contxt = stream_context_create([
			"ssl" => [
				"verify_peer" => FALSE,
				"verify_peer_name" => FALSE,
				"allow_self_signed" => TRUE,
			],
		]);

		$data['orders'] = $orders;
		$data['orderArticles'] = $orderArticles;
		$data['reports'] = $reports;
		$data['patients'] = $patients;
		$data['hoje'] = $hoje;

		//$view = view('prints.printLaudo', ['data' => $data, 'orderArticles' => $orderArticles, 'reports' => $reports, 'orders' => $orders, 'hoje' => $hoje]);

		$view = view('prints.printLaudo', $data);

		dd($view);

		$dompdf->load_html($view);

		$contente = $view->render();

		//$dompdf->loadView('prints.printLaudo', $data);
		$dompdf->stream(
			'laudo.pdf',

			array(
				"Attachment" => false, //pra baixar deixar true
			));

		return view('prints.printLaudo', ['data' => $data, 'orderArticles' => $orderArticles, 'reports' => $reports, 'orders' => $orders, 'hoje' => $hoje]);

	}

}