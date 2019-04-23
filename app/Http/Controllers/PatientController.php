<?php

namespace App\Http\Controllers;

use App\Locale\City;
use App\Locale\Estate;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use \App\AuthorizedPerson;
use DB;
use Auth;


class PatientController extends Controller {


	private $totalPorPagina = 5;
	public function index() {

		//abre o formulario quando carrega a pagina
		
		$pacientes = Patient::all();
		$cidades = City::orderBy('name', 'asc')->get();
		$estados = Estate::orderBy('name', 'asc')->get();

		return view('pacientes.formulario', ['pacientes' => $pacientes, 'cidades' => $cidades]);
	}

	public function salvar(Request $request) {


		//troca a conexao
		//$db_ext  =  DB::connection(Auth::user()->banco);
		


		//pega os dados do formulario e salvar
		$paciente = new Patient();
		$cidades = City::all();

		$paciente = $paciente->create($request->all());
		
		
		$ultimo = $paciente->name;
		$email = $paciente->email;
		$id = $paciente->id;

		if ($request->hasFile('image') && $request->file('image')->isValid()) {

			// Define um aleatório para o arquivo baseado no timestamps atual
			//$name = uniqid(date('HisYmd'));

			$name = $request->image;



			// Recupera a extensão do arquivo

			$extension = $request->image->extension();

			// Define finalmente o nome
			$nameFile = "{$name}.{$extension}";
			$extensao = pathinfo($nameFile, PATHINFO_EXTENSION);
			$nome = $name . '.' . $extensao;
			$explode = explode('/', $nome);

			//$upload = $request->file('image')->storeAs('public', $nameFile);

			$request->file('image')->move(public_path("images/uploads/pacientes/" . $id), $explode[2]);

			$update = DB::table('patients')
				->where('id', $id)
				->update(['image' => $explode[2]]);

		}

		$emailremetente = 'contato@labsystem.net.br';
		$assunto = 'Seja Bem Vindo Ao Lab System ' . $ultimo;
		$descricao = '<p> Prezado Senhor(a) ' . $ultimo . ' </p>
					  <p> O Lab System tem o prazer de lhe dar boas-vindas, tendo em vista a sua recente inclusão em nosso cadastro de clientes. <p>

					  <p> Sinceramente, esperamos oferecer-lhe o melhor de nossos serviços, aprimorando nosso atendimento a cada dia. Informamos ainda que iremos fornecer produtos de alta qualidade e preços super competitivos, tudo com um serviço de entrega pontual e eficiente. </p>';

		$emaildestinatario = $email; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web
		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		if ($emaildestinatario == "") {


		} else {
			/* Montando a mensagem a ser enviada no corpo do e-mail. */
			$mensagemHTML = '<p><b>Para:</b> ' . $ultimo . '</p>
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
						['subject' => 'NOVO PACIENTE ' .$ultimo ,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "ENVIADO"],

				]);

				return back()->with('enviado', "SIM");
			} else {

				$notification = DB::table('notifications')->insert([
						['subject' => 'NOVO PACIENTE ' .$ultimo,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "NÃO ENVIADO"],

				]);

				return back()->with('enviado', "NAO");

			}
		}

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('pacientes.formulario', ['cidades' => $cidades]);

	}

	public function editar($id) {

		//pega o medico pelo id e passa pro formulario
		$paciente = Patient::findOrFail($id);

		//aqui pego a cidade
		$cidades = City::orderBy('name', 'asc')->get();

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('pacientes.formulario', ['paciente' => $paciente, 'cidades' => $cidades]);
		//return view('medicos.formulario');
	}

	public function atualizar($id, Request $request) {



		//seleciona o registro pelo id e atualiza
		$paciente = Patient::findOrFail($id);
		$cidades = City::orderBy('name', 'asc')->get();
		$paciente->update($request->all());

		$ultimo = $paciente->name;
		$email = $paciente->email;
		$id = $paciente->id;

		// Define o valor default para a variável que contém o nome da imagem
		$nameFile = null;

		// Verifica se informou o arquivo e se é válido
		if ($request->hasFile('image') && $request->file('image')->isValid()) {

			// Define um aleatório para o arquivo baseado no timestamps atual
			//$name = uniqid(date('HisYmd'));

			$name = $request->image;

			// Recupera a extensão do arquivo

			$extension = $request->image->extension();

			// Define finalmente o nome
			$nameFile = "{$name}.{$extension}";
			$extensao = pathinfo($nameFile, PATHINFO_EXTENSION);
			$nome = $name . '.' . $extensao;
			$explode = explode('/', $nome);
			$id = $paciente->id;

			//$upload = $request->file('image')->storeAs('public', $nameFile);

			$request->file('image')->move(public_path("images/uploads/pacientes/" . $id), $explode[2]);

			$update = DB::table('patients')
				->where('id', $id)
				->update(['image' => $explode[2]]);

		}

		$emailremetente = 'contato@labsystem.net.br';
		$assunto = 'Seus Dados Foram Atualizados ' . $ultimo;
		$descricao = '<p> Prezado Senhor(a) ' . $ultimo . ' </p>
					  <p> O Lab System informa que seus dados foram atualizados em nossa base de dados. <p>

					  <p> Para mais informações entre em contato conosco atraves dos meios abaixo. </p>

					  <p> Telefone: (44) 1234 - 5678 | Email: contato@laboratorio.com</p>';

		$emaildestinatario = $email; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web
		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		if ($emaildestinatario == "") {

		} else {
			/* Montando a mensagem a ser enviada no corpo do e-mail. */
			$mensagemHTML = '<p><b>Para:</b> ' . $ultimo . '</p>
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
						['subject' => 'ATUALIZAÇÃO DE DADOS ' .$ultimo,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "ENVIADO"],

				]);
				return back()->with('enviado', "SIM");
			} else {

				$notification = DB::table('notifications')->insert([
						['subject' => 'ATUALIZAÇÃO DE DADOS ' .$ultimo,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'status' => "NÃO ENVIADO"],

				]);
				return back()->with('enviado', "NAO");

			}
		}

		\Session::Flash('mensagem_ok', 'Operação Realizada Com Sucesso.');
		return view('pacientes.formulario', ['paciente' => $paciente, 'cidades' => $cidades]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$paciente = Patient::find($id);
		$paciente->active = "N";
		$paciente->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect('paciente/listar?certo=true');

	}

	public function listar() {
		//troca a conexao
		//$db_ext  =  DB::connection(Auth::user()->banco);

		

		$pacientes = Patient::where('active', 'S')->get();


		return view('pacientes.lista', ['pacientes' => $pacientes]);
	}

	public function autoriza(Request $request) {
		$autorizacao = new AuthorizedPerson();
		$cidades = Patient::orderBy('name', 'asc')->get();
		$autorizacao = $autorizacao->create($request->all());

		return back()->with('autorizado', "SIM");
	}

	public function cadastroRapido(Request $request){
		
		$paciente = new Patient();
		$paciente = $paciente->create([
			'name' => $request->name,
			'dt_birth' => $request->dt_birth,
			'sex' => $request->sex,
			'city_id' => $request->city_id,

		]);
		$nome = $paciente->name;
		$pacientes = Patient::where('name', 'like', '%'.$nome.'%')->get();
		$total = Patient::where('name', 'like', '%'.$nome.'%')->count();
		$cidades = City::where('id', '2927')
					   ->orWhere('id',   '3172')
					   ->orWhere('id',   '2949')
					   ->orWhere('id',   '4348')
					   ->orderBy('name', 'asc')->get();

		
		return view('buscas.paciente', ['pacientes' => $pacientes, 'total' => $total, 'nome' => $nome, 'cidades' => $cidades])->with('cadastrado', "SIM");
		
	}

}
