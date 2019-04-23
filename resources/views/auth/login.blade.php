<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang="pt-BR" > <!--<![endif]-->

  
<!-- Mirrored from www.ad-says.com/themes/login-pack1/login2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Feb 2018 00:22:19 GMT -->
<head>  	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="description" content="fresh Gray Bootstrap 3.0 Responsive Theme "/>
	<meta name="keywords" content="Lab System Sistema para Laboratório, Lab System, Laboratório, Sistema web, Sistema" />
	<meta name="author" content="Lab System"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/> 
    
	<title>Lab System :: 3.0</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('entrar/css/bootstrap.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="{{ asset('entrar/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('entrar/css/animate-custom.css') }}" rel="stylesheet">
   

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    
     <script src="{{ asset('entrar/js/custom.modernizr.html') }}" type="text/javascript" ></script>
   
  </head>
    <body>


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


    	<!-- start Login box -->
    	<div class="container" id="login-block">
    		<div class="row">
			    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
			    	 
			       <div class="login-box clearfix animated flipInY">
			       		<div class="page-icon animated bounceInDown">
			       			<img class="img-responsive" src="{{ asset('entrar/img/login-key-icon.png') }}" alt="Key icon" />
			       		</div>
			        	<div class="login-logo">
			        		<a href="#"><img src="http://labsystem.net.br/images/logoHDT.png" alt="Lab System" width="340" class="img-responsive" /></a>
			        	</div> 
			        	<hr />
			        	<div class="login-form">
			        		<div class="alert alert-error hide">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Erro!</h4>
								   Ocorreu um Erro ao Logar
							</div>
			        		<form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
    							 {!! csrf_field() !!}

						   		 <input type="text" placeholder="E-MAIL" class="input-field" required name="email" data-toggle="tooltip" data-placement="left" title="E-mail é Obrigatório" /> 
						   		 <input type="password"  placeholder="SENHA" class="input-field" name="password" required data-toggle="tooltip" data-placement="left" title="Senha é Obrigatório"/>

						   		 @if ($errors->has('password'))        	
            						<strong>{{ $errors->first('email') }}</strong>
                                	<strong>{{ $errors->first('password') }}</strong>
        						 @endif
						   		 
						   		 <button type="submit" class="btn btn-login" data-toggle="tooltip" data-placement="left" title="Acessar Sistema">ACESSAR</button> 
							</form>	
							<div class="login-links"> 
					            <a data-toggle="modal" href="#myModalRecuperaSenha" >
					          	   Esqueceu a Senha?
					            </a>
					            <br />
					            <a data-toggle="tooltip" data-placement="left" title="Release Julho">
					              Versão 3.0
					            </a>
							</div>      		
			        	</div> 			        	
			       </div>
			    </div>
			</div>
    	</div>
     
      	<!-- End Login box -->
     	<footer class="container">
     		<p id="footer-text"><small><a href="http://www.labsystem.net.br/" target="_blank">Copyright &copy; 2017 - <?php echo date('Y'); ?> Lab System -Sistema Para Laboratórios</a></small></p>
     	</footer>

        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="{{ asset('entrar//js/jquery-1.9.1.min.js') }}"></script> 
        <script src="{{ asset('entrar/js/bootstrap.min.js') }}"></script> 
        <script src="{{ asset('entrar/js/placeholder-shim.min.js') }}"></script>        
        <script src="{{ asset('entrar/js/custom.js') }}"></script>
        <script>
      		$(document).ready(function(){
        		$('[data-toggle="tooltip"]').tooltip();
      		});
    	</script>

    	        
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
									    	<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="INFORME O E-MAIL CADASTRADO" data-toggle="tooltip" data-placement="bottom" title="Informe o E-mail Cadastrado">
                        					<br>
									    </div>
									    <div class="col-md-12">
									    	<button  class="btn btn-default btn-block">RECUPERAR</button>
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
                                    <input type="email" name="email" class="form-control"  data-toggle="tooltip" data-placement="bottom" title="Informe o E-mail Cadastrado">
                                    <br>
                                    <button type="submit" class="btn btn-default btn-block">Realizar Logof</button>
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

<!-- Mirrored from www.ad-says.com/themes/login-pack1/login2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Feb 2018 00:22:32 GMT -->
</html>
