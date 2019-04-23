@extends('layouts.labsystem')

@section('content')
<title>Cadastro de Convênios</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Convênios
                    <a href="{{ url('convenios/listar') }}" class="pull-right">Listar Convênio</a>
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
                        {!! Form::model($convenio, ['method' => 'PATCH', 'url' => 'convenios/'.$convenio->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'convenios/salvar']) !!}
                    @endif

                    
                    	<div class="row">
	  						<div class="col-sm-12">
	  							{!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
	  							<br/>
	  						</div>
                            </div>
                            @if(Request::is('*/editar'))
                                <div class="col-sm-12">
                                    {!! Form::submit('EDITAR', ['class' => 'btn btn-info'])!!}
                                    <br/>
                                </div>
                            @else
                                <div class="col-sm-12">
                                    {!! Form::submit('SALVAR', ['class' => 'btn btn-info pull-left'])!!}
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
