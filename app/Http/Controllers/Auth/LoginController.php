<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use DB;


class LoginController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Login Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles authenticating users for the application and
		    | redirecting them to your home screen. The controller uses a trait
		    | to conveniently provide its functionality to your applications.
		    |
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct() {

		
		$this->middleware('guest')->except('logout');

		

	}

	//verifica se o usuario esta ativo, c nao tiver o mesmo nao consegue logar
/*
	protected  function credentials(Request $request)
	{
		$credentials = $request->only($this->username(), 'password');
		$credentials['active'] = '1';
		return $credentials;
	}*/

	protected function credentials(Request $request)
	{

		
		
		$logado = $request->only($this->username(), 'loged');		
		$usuario_id = DB::table('users')->select('id')->where('email', $logado['email'])->get();

		

		$active = User::where('email', $request->email)->get();

		$credentials = $request->only($this->username(), 'password');
		$credentials['active'] = "1";


		if ($active[0]['active'] <> "1") {
			
			header("refresh: 0; login?inativo=true");

		} else {
			if ($active[0]['loged'] == "1") {
				
				header("refresh: 0; login?logado=true");
			} else {
				$entrar = User::where('id', $active[0]['id'])
          			->update(['loged' => "1", 'last_login' => date('d/m/Y H:m:s')]);
         		return $credentials;
			}
			
		}
	
		
	}

	


	public function logout(Request $request) { 
				
		$deslogar = User::where('id', Auth::user()->id)
          			->update(['loged' => "0"]);

		Auth::logout();

		return redirect('https://www.labsystem.net.br/demo/public/login?sair=SIM'); 
	} 

	public function usuarioAtivo()
	{
		return view("usuarios.ativado");
	}


}
