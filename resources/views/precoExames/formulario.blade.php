@extends('layouts.app')

@section('content')
<title>Cadastro de Preço de Exames</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Preços de Exames
                    <a href="{{ url('precoExames/listar') }}" class="pull-right">Listar Preços</a>
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
                        {!! Form::model($precoExame, ['method' => 'PATCH', 'url' => 'precoExames/'.$precoExame->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'precoExames/salvar']) !!}
                    @endif


                    	<div class="row">


  							<div class="col-sm-6">
                                <div class="form-group has-feedback">
        			                  <select class="form-control js-example-basic-single" name="exam_id" required>
                                      
        			                      <!-- verifica se tem o paciente(no caso, quando vai pro edita)
        			                      se for edição, tras a cidade ques esta no banco -->
        			                      @if(isset($precoExame))
        			                      <option value="{{$precoExame->exam->id}}">{{$precoExame->exam->name}}</option>
        			                      @endif
                                          <option value="">SELECIONE O EXAME</option>
        			                    @foreach($tipoExames as $tipoExame)
        			                      <option value="{{$tipoExame->id}}">{{$tipoExame->name}}</option>
        			                    @endforeach
        			                  </select>
                                      <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
	  							      <br/>
  							</div>

  							<div class="col-sm-6">
                                <div class="form-group has-feedback">
        			                  <select class="form-control js-example-basic-single" name="covenant_id" required>
                                         
        			                      <!-- verifica se tem o paciente(no caso, quando vai pro edita)
        			                      se for edição, tras a cidade ques esta no banco -->
        			                      @if(isset($precoExame))
        			                      <option value="{{$precoExame->covenant->id}}">{{$precoExame->covenant->name}}</option>
        			                      @endif
                                          <option value="">SELECIONE O CONVÊNIO</option>
        			                    @foreach($convenios as $convenio)
        			                      <option value="{{$convenio->id}}">{{$convenio->name}}</option>
        			                    @endforeach
        			                  </select>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
        	  							<br/>
  							</div>

  							<div class="col-sm-12">
                                <div class="form-group has-feedback">
	  							  {!! Form::text('value', NULL, ['class' => 'form-control', 'placeholder' => 'R$: 10,00', 'required' => 'required'])!!}
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
