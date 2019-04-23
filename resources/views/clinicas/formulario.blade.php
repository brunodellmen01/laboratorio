@extends('layouts.app')

@section('content')
<title>Cadastro de Clínicas</title>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Clínicas
                    <a href="{{ url('clinicas/listar') }}" class="pull-right">Listar Clínicas</a>
                    <br/>
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
                        {!! Form::model($clinica, ['method' => 'PATCH', 'url' => 'clinicas/'.$clinica->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'clinicas/salvar']) !!}
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
                            <div class="form-group has-feedback">
                              <select class="form-control js-example-basic-single" name="city_id" required>
                                  <!-- verifica se tem o paciente(no caso, quando vai pro edita)
                                  se for edição, tras a cidade ques esta no banco -->
                                  @if(isset($clinica))
                                  <option value="{{$clinica->city->id}}">{{$clinica->city->name}}</option>
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

                            <div class="col-sm-6">
                                    {!! Form::input('text', 'number', NULL, ['class' => 'form-control', 'placeholder' => 'TELEFONE'])!!}
                                    <br/>
                                    </div>

        							<div class="col-sm-12">
      	  							{!! Form::input('text', 'street', NULL, ['class' => 'form-control', 'placeholder' => 'ENDEREÇO'])!!}
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
