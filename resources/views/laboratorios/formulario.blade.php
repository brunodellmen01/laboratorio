@extends('layouts.app')

@section('content')
<title>Cadastro de Laboratórios</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Laboratórios
                    <a href="{{ url('laboratorios/listar') }}" class="pull-right">Listar Laboratorios</a>
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
                        {!! Form::model($laboratorio, ['method' => 'PATCH', 'url' => 'laboratorios/'.$laboratorio->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'laboratorios/salvar']) !!}
                    @endif


                    	<div class="row">
        	  						<div class="col-sm-12">
                          <div class="form-group has-feedback">
        	  							  {!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                          </div>
        	  							<br/>
        	  						</div>

        							<div class="col-sm-6">
      	  							{!! Form::input('number', 'cnpj', NULL, ['class' => 'form-control', 'placeholder' => 'CNPJ'])!!}
      	  							<br/>
        							</div>


        							<div class="col-sm-6">
      	  							{!! Form::input('email', 'email', NULL, ['class' => 'form-control', 'placeholder' => 'E-MAIL'])!!}
      	  							<br/>
        							</div>


        							<div class="col-sm-8">
      	  							{!! Form::input('text', 'street', NULL, ['class' => 'form-control', 'placeholder' => 'ENDEREÇO'])!!}
      	  							<br/>
        							</div>


  							     <div class="col-sm-4">
                        <div class="form-group has-feedback">
                          <select class="form-control js-example-basic-single" name="city_id" required>
                              @if(isset($laboratorio))
                              <option value="{{$laboratorio->city->id}}">{{$laboratorio->city->name}}</option>
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
                            </div>

						</div>


					{!! Form::close() !!}
                </div>
            </div>
        </div>

@endsection
