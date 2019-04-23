@extends('layouts.app')

@section('content')
<title>Cadastro de Médicos</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Médico
                    <a href="{{ url('medicos') }}" class="pull-right">Listar Médico</a>
                </div>

                <div class="panel-body">
                	@if(Session::has('mensagem_ok'))
                		<div class="alert alert-success">
  							{{Session::get('mensagem_ok')}}
						</div>
                	@endif

                    @if(Request::is('*/editar'))
                        {!! Form::model($cliente, ['method' => 'PATCH', 'url' => 'clientes/'.$cliente->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'clientes/salvar']) !!}
                    @endif

                    
                    	<div class="row">
	  						<div class="col-sm-12">
	  							{!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
	  							<br/>
	  						</div>
	  						<div class="col-sm-6">
	  							{!! Form::input('email', 'email', NULL, ['class' => 'form-control', 'placeholder' => 'E-MAIL'])!!}
	  							<br/>
	  						</div>
	  						<div class="col-sm-4">
	  							{!! Form::input('number', 'crm', NULL, ['class' => 'form-control', 'placeholder' => 'CRM'])!!}
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
                                    {!! Form::submit('SALVAR', ['class' => 'btn btn-info'])!!}
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
