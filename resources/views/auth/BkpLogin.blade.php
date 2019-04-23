@if(!empty(Session::get('ativar')) && Session::get('ativar') == "SIM")
  <script>
    $(function() {
      $('#myModalFechado').modal('show');
  });
  </script>
@endif
   @if(!empty(Session::get('inativo')) && Session::get('inativo') == "SIM")
   
<script>
$(function() {
    $('#myModalInativo').modal('show');
});
</script>
@endif



@if ($errors->has('email'))
    <script>
        $(function() {
            $('#myModalErroLogin').modal('show');
        });
    </script>
@endif
@if ($errors->has('password'))
    <script>
        $(function() {
            $('#myModalErroLogin').modal('show');
        });
    </script>
@endif


@if(!empty(Session::get('ativado')) && Session::get('ativado') == "SIM")
<script>
$(function() {
    $('#myModalAtivado').modal('show');
});
</script>
@endif


<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Lab System :: Login :: 3.0</title>
	<link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="{{ asset('entrar/style.css') }}">
</head>
<body>

	<br><br><br><br>
	<div class="main">
  <h1><i>Lab System</i></h1>
  Esqueceu a senha? <a data-toggle="modal" href="#myModalRecuperaSenha"> Clique para recuperar</a><br><br>
  	<form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
    	{!! csrf_field() !!}
		<input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}"><br><br>
		<input type="password" placeholder="Senha" name="password"><br><br>


		 

		 <?php if (array_key_exists("deslogado", $_GET) && $_GET['deslogado'] == 'SIM') {?>
					<script>
					$(function() {
					    $('#myModalDeslogado').modal('show');
					});
					</script>
					<?php }?>

					 <?php if (array_key_exists("logado", $_GET) && $_GET['logado'] == 'true') {?>
					<script>
					$(function() {
					    $('#myModalLogado').modal('show');
					});
					</script>

					<?php }?>

					   <?php if (array_key_exists("sair", $_GET) && $_GET['sair'] == 'SIM') {?>
					<script>
					$(function() {
					    $('#myModalSair').modal('show');
					});
					</script>
					<?php }?>


					    
					    <?php if (array_key_exists("enviado", $_GET) && $_GET['enviado'] == 'false') {?>
					                        <script>
					$(function() {
					    $('#myModalRecuperaSenha').modal('show');
					});
					</script>
                    <?php }?>
	  
	  	
	  	<br><br><br><br>
	  	
	  	<button>ACESSAR</button>
	  	<br><br><br><br>
  	  	
	  	</form>
  	  	<span class="text-info pull-left">Versão 3.0 Release Fevereiro 2018</span>
  	  	<br><br>

  	  	@if ($errors->has('email'))
  	  		<script>
					$(function() {
					    $('#myModalErroLogin').modal('show');
					});
					</script>
            
        @endif

        @if ($errors->has('password'))
        	
            <div class="erro">
            	<br>
                <script>
					$(function() {
					    $('#myModalErroLogin').modal('show');
					});
					</script>
            </div>
        @endif
  	
  
  <div class="path">
    
    <h2 class="title-path"><img src="{{ asset('img/favicon.png') }}" class="img-responsive img-circle" width="150"> <br> BEM VINDO<h2>
    
    
  </div>
</div>

<!-- Modal myModalRecuperaSenha -->
                    <div id="myModalRecuperaSenha" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            
                            <h4 class="modal-title">Recupere Sua Senha</h4>
                          </div>
                          <div class="modal-body">
                            <p>

                                <form class="form-horizontal" method="POST" action="recuperar-senha">
                                    {{ csrf_field() }}
                                  
                                    <div class="container-fluid">									  
									  <div class="row">
									    <div class="col-md-12" >
									    	<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="INFORME O E-MAIL CADASTRADO">
                        
									    </div>
									    
									    
									  </div>
									</div>

                                  	
                                    <br>
                                      
                                    
                                  
                                      <?php if (array_key_exists("enviado", $_GET) && $_GET['enviado'] == 'false') {?>
                                            <p class="text-danger">
                                                <br>
                                                Não encontramos o email informado em nossa base de dados. Favor verificar se o mesmo foi digitado corretamente.
                                            </p>
                                    <?php }?>


                                  <?php if (array_key_exists("enviado", $_GET) && $_GET['enviado'] == 'true') {?>
                                    <p class="text-succes">
                                        <br>
                                        Sua senha foi redefinida e enviada para o email informado.
                                    </p>
                                    <?php }?>
                                
                            </p>
                          </div>
                          <div class="modal-footer">
                          	<button  class="btn btn-default" >RECUPERAR</button>
                          	</form>
                            <form action="{{ route('inicio') }}">
                          		
                            	<button type="submit" class="btn btn-default" >FECHAR</button>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal myModalRecuperaSenha -->


                     <!-- Modal myModalErroLogin -->
                    <div id="myModalErroLogin" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            
                            <h4 class="modal-title">                                
                                Ops. Ocorreu Um Erro ao Realizar Login.
                            </h4>
                          </div>
                          <div class="modal-body">
                            <p  class="help-block">
                                <i class="fa fa-exclamation-triangle text-danger"></i>
                                <strong>{{ $errors->first('email') }}</strong>
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('inicio') }}">
                          		
                            	<button type="submit" class="btn btn-default" >FECHAR</button>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal myModalErroLogin -->

                    <!-- Modal myModalInativo -->
                    <div id="myModalInativo" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            
                            <h4 class="modal-title">                                
                                Usuário Inativo.
                            </h4>
                          </div>
                          <div class="modal-body">
                            <p  class="help-block">
                                <i class="fa fa-exclamation-triangle text-warning"></i>
                                <strong>Encontramos seu usuário, porém o mesmo não se encontra inativo.</strong>
                            </p>

                            <p>
                                <strong>Para Ativar seu usuário entre em contato com o administrador.</strong>
                            </p>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal myModalInativo -->

                     <!-- Modal myModallogado -->
                    <div id="myModalLogado" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            
                            <h4 class="modal-title">                                
                                Usuário Já Se Encontra Logado. Faça logof para continuar.
                            </h4>
                          </div>
                          <div class="modal-body">
                            

                            <p>
                              
                                <form action="{{ route('deslogar') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="email" name="email" class="form-control">
                                    <br>
                                    <button type="submit">Realizar Logof</button>
                                </form>
                              
                            </p>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal myModalInativo -->

                    <!-- Modal myModalDeslogado -->
                    <div id="myModalDeslogado" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            
                            <h4 class="modal-title">                                
                                Usuário Deslogado
                            </h4>
                          </div>
                          <div class="modal-body">
                            <p  class="help-block">
                                <i class="fa fa-exclamation-triangle text-warning"></i>
                                <strong>Usuário Deslogado Com Sucesso. Volte a Pagína de login e tente novamente.</strong>
                            </p>

                            
                          </div>
                          <div class="modal-footer">
                          	<form action="{{ route('inicio') }}">
                          		
                            	<button type="submit" class="btn btn-default" >FECHAR</button>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal myModalDeslogado -->


                     <!-- Modal myModalDeslogado -->
                    <div id="myModalSair" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            
                            <h4 class="modal-title">                                
                                Logof Realizado.
                            </h4>
                          </div>
                          <div class="modal-body">
                            <p  class="help-block">
                                <i class="fa fa-exclamation-triangle text-succes"></i>
                                <strong>Logof Realizado com Sucesso.</strong>
                            </p>

                            
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('inicio') }}">
                          		
                            	<button type="submit" class="btn btn-default" >FECHAR</button>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal myModalDeslogado -->


                     <!-- Modal myModalDeslogado -->
                    <div id="myModalAtivado" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            
                            <h4 class="modal-title">                                
                                Usuário Ativado.
                            </h4>
                          </div>
                          <div class="modal-body">
                            <p  class="help-block">
                                
                                <strong>Usuário Ativado com Sucesso. Agora Seu login esta liberado. Basta Acessar a tela de login e informar os dados de cadastro.</strong>
                            </p>

                            
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('inicio') }}">
                          		
                            	<button type="submit" class="btn btn-default" >FECHAR</button>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal myModalDeslogado -->


</body>
</html>