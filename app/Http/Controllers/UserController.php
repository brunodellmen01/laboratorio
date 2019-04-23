<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use \App\User;
use \App\Unitys;


class UserController extends Controller {
	public function index() {

		
		$unidades = Unitys::orderBy('name', 'desc')->get();

		return view('usuarios.formulario', ['unidades' => $unidades]);
		
	}

	public function salvar(Request $request) {
		$usuario = new User();
		$usuario = $usuario->create([
			'name' => $request->name,
			'email' => $request->email,
			'sexo' => $request->sexo,
			'id_unity' => $request->id_unity,
			'password' => bcrypt($request->password),

		]);

		//$usuario->create(array_merge(['password' => bcrypt($request->password)]));

		$id = $usuario->id;

		// Define o valor default para a variável que contém o nome da imagem
		$nameFile = null;

		// Define um aleatório para o arquivo baseado no timestamps atual
		//$name = uniqid(date('HisYmd'));

		$name = $request->image;
		$usuario = $request->name;
		$emaildestinatario = $request->email;

		// Recupera a extensão do arquivo

		$extension = $request->image->extension();

		// Define finalmente o nome
		$nameFile = "{$name}.{$extension}";
		$extensao = pathinfo($nameFile, PATHINFO_EXTENSION);
		$nome = $name . '.' . $extensao;
		$explode = explode('/', $nome);
		$user_id = $request->id;

		//$upload = $request->file('image')->storeAs('public', $nameFile);

		$request->file('image')->move(public_path("images/uploads/profile/" . $user_id . "/"), $explode[2]);

		$update = DB::table('users')
			->where('id', $user_id)
			->update(['image' => $explode[2]]);


		$link = "<a href='http://www.labsystem.net.br/clientes/multtest/public/ativar-usuario/".$id."'>aqui</a>";
		$emailremetente = 'contato@labsystem.net.br';
		$assunto = $usuario . ' Ative seu cadastro.';
		$descricao = $usuario . " , o seu usuário foi cadastrado com sucesso. Para ativa-lo basta clicar " . $link.".";

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
						['subject' => 'ATIVAÇÃO DE USUÁRIO ' .$usuario,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "ENVIADO"],

				]);
				return back()->with('ativar', 'SIM');
				//return redirect()->action('UserController@index')->with('ativar', 'SIM');
			} else {

				$notification = DB::table('notifications')->insert([
						['subject' => 'ATIVAÇÃO DE USUÁRIO ' .$usuario,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'status' => "NÃO ENVIADO"],

				]);
				return back()->with('ativar', 'NAO');
				return redirect()->action('UserController@index')->with('ativar', 'NAO');
				//header("refresh: 0; login?enviado=false");

			}

		return back()->with('ativar', 'SIM');
		return redirect()->action('UserController@index')->with('ativar', 'SIM');
	}

	public function editar($id) {

		$usuario = User::findOrFail($id);
		$unidades = Unitys::orderBy('name', 'desc')->get();

		return view('usuarios.formulario', ['usuario' => $usuario, 'unidades' => $unidades]);

	}

	public function atualizar($id, Request $request) {

		//seleciona o registro pelo id e atualiza
		$usuario = User::findOrFail($id);
		$usuario->update($request->all());
		$unidades = Unitys::orderBy('name', 'desc')->get();

		$usuario->update(array_merge($request->all(), ['password' => bcrypt($request->password)]));

		$id = $usuario->id;

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
			$user_id = Auth::user()->id;

			//$upload = $request->file('image')->storeAs('public', $nameFile);

			$request->file('image')->move(public_path("images/uploads/profile/" . $user_id), $explode[2]);

			$update = DB::table('users')
				->where('id', $user_id)
				->update(['image' => $explode[2]]);

		}

		return view('usuarios.formulario', ['usuario' => $usuario, 'unidades' => $unidades]);
	}

	public function inativar($id) {

		//seleciona o médico onde o id e = o id passado e muda o ativo pra 0
		$usuario = User::find($id);
		$usuario->active = "N";
		$usuario->save();

		//$medico = Medico::findOrFail($id);
		//$medico->delete();

		return redirect()->action('UserController@index');

	}

	public function mudaSenha() {

		$email = $_POST['email'];

		$contaUsuario = User::where('email', $email)->count();
		$dados = User::where('email', $email)->get();

		$id = $dados[0]['id'];
		$nome = $dados[0]['name'];

		$senha = uniqid();
		$senha_criptografada = bcrypt($senha);

		if ($contaUsuario >= 1) {
			$mudaSenha = DB::table('users')
				->where('id', $id)
				->update(['password' => $senha_criptografada]);

			$assunto = 'Recuperação de Senha ';

			$descricao = $nome . ", sua senha foi redefinida com sucesso. <br>
						 A sua nova senha é: <br>"
				. $senha;

			$emailremetente = 'contato@labsystem.net.br';
			$emaildestinatario = $email; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web

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
						['subject' => 'TROCA DE SENHA ' .$nome,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "ENVIADO"],

				]);
				return redirect('login?enviado=true');

			} else {
				$notification = DB::table('notifications')->insert([
						['subject' => 'TROCA DE SENHA ' .$nome,
						 'description' => $descricao,
						 'destination' => $emaildestinatario,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "NÃO ENVIADO"],

				]);
				return redirect('login?enviado=false');

			}

			return redirect('login?enviado=true');

		} else {

			return redirect('login?enviado=false');

		}

	}

	public function deslogar(Request $request)
	{
		$id = User::where('email', $request->email)->get();
	

		$sair = User::where('id', $id[0]['id'])
          			->update(['loged' => "0"]);

        header("refresh: 0; login?deslogado=SIM");

	}

	public function ativaUsuario($id)
	{
		$ativar = User::where('id', $id)
          			->update(['active' => "1"]);

         return redirect()->route('usuarioAtivo');
		
	}


	public function listarInativos()
	{
		$inativos = User::where('active', '0')->get();
		
		return view('usuarios.inativos', ['inativos' => $inativos]);
	}

	public function listarAtivos()
	{
		$ativos = User::where('active', '1')->get();
		
		return view('usuarios.ativos', ['ativos' => $ativos]);
	}

	public function ativarUsuarioInterno($id)
	{

		$user = User::where('id', $id)->get();

		$status = $user[0]['active'];

		$nome = $user[0]['name'];

		$email = $user[0]['email'];

		if ($status == "0") {

			$ativar = User::where('id', $id)
          			->update(['active' => "1"]);

          	$notification = DB::table('notifications')->insert([
						['subject' => 'ATIVAÇÃO DE USUÁRIO',
						 'description' => 'ATIVAÇÃO USUÁRIO: ' . $nome . 'POR: ' . Auth::user()->name,
						 'destination' => $email,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "NÃO ENVIADO"],

				]);

         return back()->with('ativado', 'SIM');

		} else {

			$desativar = User::where('id', $id)
          			->update(['active' => "0"]);

          	$notification = DB::table('notifications')->insert([
						['subject' => 'DESATIVAÇÃO DE USUÁRIO',
						 'description' => 'DESATIVAÇÃO USUÁRIO: ' . $nome . 'POR: ' . Auth::user()->name,
						 'destination' => $email,
						 'created_at' => date('Y-m-d H:m:s'),
						 'status' => "NÃO ENVIADO"],

				]);

         return back()->with('desativado', 'SIM');
		}
		

		
		
	}

	
		
	
}