@extends('layouts.app')

@section('content')
<title>Cadastro de Resultados</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Resultados
                    <a href="{{ url('resultados/listar') }}" class="pull-right">Listar Resultados</a>
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
                        {!! Form::model($resultado, ['method' => 'PATCH', 'url' => 'resultados/'.$resultado->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'resultados/salvar']) !!}
                    @endif


                    	<div class="row">

                    		<div class="col-sm-12">
                                <div class="form-group has-feedback">
	  							  {!! Form::input('text', 'description', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'DESCRIÇÃO', 'required' => 'required'])!!}
                                  <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
	  							<br/>
	  						</div>



  							<div class="col-sm-6">
                                <div class="form-group has-feedback">
    			                  <select class="form-control js-example-basic-single" name="exam_id" required>

    			                      <!-- verifica se tem o paciente(no caso, quando vai pro edita)
    			                      se for edição, tras a cidade ques esta no banco -->
    			                      @if(isset($resultado))
    			                      <option value="{{$resultado->exam->id}}">{{$resultado->exam->name}}</option>
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
    			                  <select class="form-control js-example-basic-single" name="category_id" required>

    			                      <!-- verifica se tem o paciente(no caso, quando vai pro edita)
    			                      se for edição, tras a cidade ques esta no banco -->
    			                      @if(isset($resultado))
    			                      <option value="{{$resultado->exam->id}}">{{$resultado->exam->name}}</option>
    			                      @endif
                                      <option value="">SELECIONE O TIPO</option>
    			                    @foreach($TipoResultados as $TipoResultado)
    			                      <option value="{{$TipoResultado->id}}">{{$TipoResultado->name}}</option>
    			                    @endforeach
    			                  </select>
                                  <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
	  							<br/>
  							</div>

  							<div class="col-sm-12">
                                @foreach($TipoResultados as $TipoResultado)
                                @endforeach


                                <br>

                                {!! Form::textarea('reference', NULL, ['class' => 'form-control', 'placeholder' => 'REFERENCIA', 'id' => 'reference'])!!}

                        <script type="text/javascript">
                                        CKEDITOR.replace("reference");
                                    </script>

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
