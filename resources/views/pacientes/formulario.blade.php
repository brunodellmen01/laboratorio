@extends('layouts.app')

@section('content')
<title>Cadastro de Pacientes</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Pacientes
                    <a href="{{ url('pacientes/listar') }}" class="pull-right">Listar Pacientes</a>
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
                        {!! Form::model($paciente, ['method' => 'PATCH', 'url' => 'pacientes/'.$paciente->id.'/editar', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
                    @else
                        {!! Form::open(['url' => 'pacientes/salvar', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
                    @endif


                    	<div class="row">
        	  						<div class="col-sm-12">
                          <div class="form-group has-feedback">
        	  							  {!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                          </div>
        	  							<br/>
        	  						</div>

        	  						<div class="col-sm-2">
                  	  							{!! Form::radio('sex', 'M')!!} Masculino
        	  							<br/>
        	  						</div>

                        <div class="col-sm-2">
                          {!! Form::radio('sex', 'F')!!} Feminino
                          <br/>
                        </div>

        	  						<div class="col-sm-4">
        	  							{!! Form::input('number', 'cpf', NULL, ['class' => 'form-control', 'placeholder' => 'CPF'])!!}
        	  							<br/>
          							</div>
          							<div class="col-sm-4">
        	  							{!! Form::input('number', 'rg', NULL, ['class' => 'form-control', 'placeholder' => 'RG'])!!}
        	  							<br/>
          							</div>

  							<div class="col-sm-6">
                  <div class="form-group has-feedback">
	  							  {!! Form::input('date', 'dt_birth', NULL, ['class' => 'form-control', 'placeholder' => 'DATA DE NASCIMENTO'])!!}
                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
	  							<br/>
  							</div>

                <div class="col-sm-6">
                  <div class="form-group has-feedback">
                    {!! Form::input('date', 'validade_carteira', NULL, ['class' => 'form-control', 'placeholder' => 'VALIDADE CARTEIRA'])!!}
                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
                  <br/>
                </div>

                <div class="col-sm-4">
                  {!! Form::input('text', 'phone', NULL, ['class' => 'form-control', 'placeholder' => 'TELEFONE'])!!}
                  <br/>
                </div>
  							<div class="col-sm-4">
	  							{!! Form::input('email', 'email', NULL, ['class' => 'form-control', 'placeholder' => 'E-MAIL'])!!}
	  							<br/>
  							</div>
                
  							<div class="col-sm-4">
	  							{!! Form::input('text', 'street', NULL, ['class' => 'form-control', 'placeholder' => 'ENDEREÇO'])!!}
	  							<br>
  							</div>

                <div class="col-sm-4">
                  {!! Form::input('text', 'cns', NULL, ['class' => 'form-control', 'placeholder' => 'CNS'])!!}
                  
                </div>

                <div class="col-sm-4">
                  {!! Form::input('text', 'num_carteira', NULL, ['class' => 'form-control', 'placeholder' => 'NUMERO CARTEIRA'])!!}
                  <br/>
                </div>

                <div class="col-sm-4">
                  {!! Form::input('number', 'num_cartao', NULL, ['class' => 'form-control', 'placeholder' => 'NUMERO DO  CARTÃO'])!!}
                  <br/>
                </div>

  							<div class="col-sm-12">

                  <div class="form-group has-feedback">
                <select required class="form-control js-example-basic-single" name="city_id">
                  
                              @if(isset($paciente))
                              <option value="{{$paciente->city->id}}">{{$paciente->city->name}}</option>
                              @endif
                              <option value="">SELECIONE A CIDADE</option>
                            @foreach($cidades as $cidade)

                              <option value="{{$cidade->id}}">{{$cidade->name}}</option>
                            @endforeach
                          </select>
                          <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
                          <br/>
                        </div>


	  							</div>
  							
                  


                <div class="col-sm-12">
                                    <input type="file" name="image" class="btn btn-outline btn-info btn-block">
                                

                                </div>


                          @if(Request::is('*/editar'))
                                <div class="col-sm-12">
                                  <br/>
                                    {!! Form::submit('EDITAR', ['class' => 'btn btn-outline btn-info pull-left'])!!}
                                    <br/>
                                </div>
                            @else
                                <div class="col-sm-12">
                                  <br/>
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

@endsection
