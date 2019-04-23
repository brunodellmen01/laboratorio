<?php

namespace App\Http\Controllers;

use App\OrderArticles;
use App\Report;
use App\Result;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller {
	private $totalPorPagina = 5;
	public function index($id) {
		$pedido = $id;
		

		$id_pedidos = intval($pedido);

		$exams = OrderArticles::where('order_id', $id_pedidos)->get();

		return view('laudos.index', ['exams' => $exams, 'id_pedidos' => $id_pedidos]);
	}

	public function novo($id_pedido, $id_item) {
		$pedidos = $id_pedido;
		$id_pedido = intval($pedidos);

		$itens = $id_item;
		$id_item = intval($itens);

		$item_pedidos = OrderArticles::where('exam_id', $id_item)->get();

		$countador = Result::get()->where('exam_id', '=', $id_item)->count();

		$reports = Report::where('order_article_id', $id_pedido)->get();

		$resultadoss = DB::table('reports')->where([
			['exam_id', '=', $id_item],
			['order_article_id', '=', $id_pedido],
		])->get();

		$resultados = Report::where(
			['exam_id' => $id_item],
			['order_article_id' => $id_pedido])->get();

		//dd($resultados);

		$exams = OrderArticles::where('order_id', $id_pedido)->get();

		//$reportes = Report::where('exam_id', $id_item)->get();

		$reportes = DB::table('reports')->where([
			['exam_id', '=', $id_item],
			['order_article_id', '=', $id_pedido],
		])->get();

		return view('laudos.resultado', ['resultadoss' => $resultadoss, 'reports' => $reports, 'exams' => $exams, 'reportes' => $reportes, 'id_pedido' => $id_pedido]);
	}

	public function resultado($id_pedido, $id_item) {

		$pedidos = $id_pedido;
		$id_pedido = intval($pedidos);

		$itens = $id_item;
		$id_item = intval($itens);

		$resultado = $_POST['result'];

		//fazer um for aqui pra pegar os dados do array??

		$countador = Result::get()->where('exam_id', '=', $id_item)->count();

		$r = Result::get()->where('exam_id', '=', $id_item)->get();

		dd($r);

		$i = 1;

		while ($i <= $countador):
			$insert = DB::table('reports')->insert([
				['order_article_id' => $id_pedido,
					'description' => '',
					'price' => $resultado,
					'reference' => '',
					'category_id' => '',
					'exam_id' => $id_item,
					'result_id' => $result_id],

			]);
			$i++;
		endwhile;

		//$resultados = Result::where('exam_id', $id_item)->get();

		$resultados = Report::where(['exam_id' => $id_item], ['order_article_id' => $id_pedido])->get();
		//$resultados = Report::where('exam_id', $id_item)->get();

		//tem q arrumar esse sql aqui
		$reportes = DB::table('reports')->where([
			['exam_id', '=', $id_item],
			['order_article_id', '=', $id_item],
		])->get();

		return back();
	}

	public function create() {

		return view('laudos.laudos');
	}
	public function store(Request $request) {

		//recebo os dados do form
		$id = $_POST['exam_id'];
		$order_article_id = $_POST['order_article_id'];

		$description = $_POST['description'];

		//recebo o campo price (resultado) q é um array
		$resultados = $_POST['price'];

		$reference = $_POST['reference'];
		$category_id = $_POST['category_id'];
		$exam_id = $_POST['exam_id'];

		$pega_id_result = Report::where('order_article_id', $order_article_id)
								  ->where('exam_id', $exam_id)
								  ->get();


		//converto para inteiro
		$id_item = intval($id);
		$orderArticle = intval($order_article_id);

		$categorie = intval($category_id);
		$exam = intval($exam_id);

		//verifico se tem resultado informado
		$verificaResults = Report::where('exam_id', $exam)->get();

		$pegaId = Report::where('order_article_id', '=', $id_item)->get();

		//crio um array com os campos q recebi do form
		$arrayInsert = array($description, $reference, $categorie, $exam, $resultados, $orderArticle);

		//dd($arrayInsert);

		$result = count($resultados);

		$id = DB::table('reports')->where('order_article_id', $order_article_id)->get();

		$idResults = Result::where(['exam_id' => $id_item], ['order_article_id' => $order_article_id])->get();




		//verifico se esta vazio, se estiver abre um modal pedindo pra confirma
		/*foreach ($resultados as $a) {
			if (empty($a)) {
				return back()->with('campoVazio', "SIM");
			}

		}*/

		$resultadoss = DB::table('reports')->where([
			['exam_id', '=', $id_item],
			['order_article_id', '=', $orderArticle],
		])->get();

		

		//Inicia o contador
		$c = 0;

		
		foreach ($resultados as $resultado) {

			$idResultadoFK = $idResults[$c]['id'];

			
			/*
			$update = DB::table('reports')
				->where('order_article_id', $orderArticle)
				->where('id', $id[$c]->id)
				->update(
					[
						'price' => $resultado,
					]);*/

			$update = DB::table('reports')
				->where('order_article_id', $orderArticle)
				->where('exam_id', $id_item)
				->where('id', $pega_id_result[$c]['id'])
				->update(
					[
						'price' => $resultado,
					]);

			$c++;

		}

		$reportes = DB::table('reports')->where([
			['exam_id', '=', $id_item],
			['order_article_id', '=', $orderArticle],
		])->get();

		return back();
	}

}
