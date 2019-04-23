@extends('layouts.app')

@section('content')
<title>Cadastro de Empresas</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Empresas
                    <a href="{{ url('empresas/listar') }}" class="pull-right">Listar Empresas</a>
                </div>

                <div class="panel-body">

                    @if(Session::has('mensagem_ok'))
                        <div class="alert alert-success">
                            {{Session::get('mensagem_ok')}}
                        </div>
                    @endif
                    
                	<?php if(array_key_exists("inserido", $_GET) && $_GET['inserido']=='true') { ?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php } ?>

                    @if(Request::is('*/editar'))
                        {!! Form::model($companie, ['method' => 'PATCH', 'url' => 'empresa/'.$companie->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'empresa/salvar']) !!}
                    @endif

                    
                    	<div class="row">
	  						<div class="col-sm-12">
                                <div class="form-group has-feedback">
	  							  {!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
	  							<br/>
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
</div>
@endsection
