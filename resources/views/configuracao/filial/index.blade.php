@extends('layouts.app')

@section('content')

@if(!empty(Session::get('cadastrado')) && Session::get('cadastrado') == "SIM")
<script>
$(function() {
    $('#myModalCadastrado').modal('show');
});
</script>
@endif

<title>Cadastro de Unidades</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Unidades
                    <a href="{{ url('configuracao/empresa/unidades/listar') }}" class="pull-right">Listar Unidades</a>
                </div>

                <div class="panel-body">

                    @if(Session::has('mensagem_ok'))
                        <div class="alert alert-success">
                            {{Session::get('mensagem_ok')}}
                        </div>
                    @endif

                    


                	<?php if (array_key_exists("inserido", $_GET) && $_GET['inserido'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>

                    @if(Request::is('*/editar'))
                        {!! Form::model($unidade, ['method' => 'PATCH', 'url' => 'configuracao/empresa/unidades/'.$unidade->id.'/editar', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
                    @else
                        {!! Form::open(['url' => 'configuracao/empresa/unidades/salvar', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
                    @endif


                    	<div class="row">
        	  						<div class="col-sm-12 ">
                                        <div class="form-group has-feedback">
        	  							  {!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                        </div>
        	  							
        	  						</div>

        	  						<div class="col-sm-3">
					                  {!! Form::input('text', 'phone', NULL, ['class' => 'form-control', 'placeholder' => 'TELEFONE', 'onkeypress' => 'mascara(this, 
				    			"## # ###-####")', 'maxlength' => '14'])!!}
					                  
					                </div>

					                <div class="col-sm-3">
        	  							{!! Form::input('email', 'email', NULL, ['class' => 'form-control', 'placeholder' => 'E-MAIL'])!!}
          							</div>

          							<div class="col-sm-3">
        	  							{!! Form::input('text', 'cod_unidade', NULL, ['class' => 'form-control', 'placeholder' => 'CÓDIGO UNIDADE', 'maxlength' => '10'])!!}
        	  							<br>
          							</div>  

          							

        	  						<div class="col-sm-3">
                                        <div class="form-group has-feedback">
                    						<select required class="form-control" name="estado_id">
    		                              		@if(isset($unidade))
    		                              			<option value="{{$unidade->estado->id}}">{{$unidade->estado->initials}}</option>
    		                              		@endif
    		                              		<option value="">SELECIONE A LOCALIZAÇÃO</option>
    		                            		 	@foreach($estados as $estado)
    		                              				<option value="{{$estado->id}}">{{$estado->initials}}</option>
    		                            			@endforeach
                              				</select>
                                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                        </div>
                          				<br>
                      				</div>

        	  						       														
                
		  							<div class="col-sm-12">
			  							{!! Form::textarea('adress', null, ['class' => 'form-control', 'rows' => 4, 'style' => 'resize:none', 'placeholder' => 'ENDEREÇO']) !!}
			  							<br/>
							  		</div>

					                


	  							</div>

                          @if(Request::is('*/editar'))
                                <div class="col-sm-12">
                                    {!! Form::submit('EDITAR', ['class' => 'btn btn-outline btn-info pull-left'])!!}
                                    <br/>
                                </div>
                            @else
                                <div class="col-sm-12">
                                    {!! Form::submit('SALVAR', ['class' => 'btn btn-outline btn-info pull-left'])!!}
                                    <br/>
                                </div>
                            @endif
                          
						</div>


					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal caixa fechado -->
					<div id="myModalCadastrado" class="modal fade" role="dialog">
					  <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Caixa Aberto</h4>
					      </div>
					      <div class="modal-body">
					        <p>O Caixa foi aberto com Sucesso.</p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
					      </div>
					    </div>

					  </div>
					</div>
					<!-- Modal caixa fechado -->

@endsection
