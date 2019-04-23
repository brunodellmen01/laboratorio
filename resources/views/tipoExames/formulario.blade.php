@extends('layouts.app')

@section('content')
<title>Cadastro de Tipos de Exames</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Tipos de Exames
                    <a href="{{ url('tipoExame/listar') }}" class="pull-right">Listar Tipos de Exames</a>
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
                        {!! Form::model($tipoExame, ['method' => 'PATCH', 'url' => 'tipoExames/'.$tipoExame->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'tipoExames/salvar']) !!}
                    @endif

                    
                    	<div class="row">
	  						<div class="col-sm-12">
                                <div class="form-group has-feedback">
	  							  {!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                                  <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
	  							<br/>
	  						</div>
	  						<div class="col-md-4">
	  							{!! Form::input('text', 'synonymous', NULL, ['class' => 'form-control', 'placeholder' => 'SINÔNIMO'])!!}
	  							<br/>
	  						</div>
	  						
                            <br>
  							
                            <div class="col-sm-4">
                                {!! Form::input('text', 'routine', NULL, ['class' => 'form-control', 'placeholder' => 'ROTINA'])!!}
                                
                            </div>
                            <div class="col-sm-4">
                                {!! Form::input('text', 'use', NULL, ['class' => 'form-control', 'placeholder' => 'USO'])!!}
                                <br/>
                            </div>
                            <div class="col-sm-4">
                                {!! Form::input('text', 'fasting', NULL, ['class' => 'form-control', 'placeholder' => 'JEJUM'])!!}
                                <br/>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                     <select class="form-control js-example-basic-single" name="category_id" required >
                                        @if(Request::is('*/editar'))
                                            <option value="{{$tipoExame->category_id}}">{{$tipoExame->categorie->name}}</option>
                                        @endif
                                        <option value="">SELECIONE O MÉTODO</option>

                                            @foreach($categorias as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                    </select>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                                <br/>
                                <br/>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <select class="form-control js-example-basic-single" name="material_id" required>
                                        @if(Request::is('*/editar'))
                                            <option value="{{$tipoExame->material_id}}">{{$tipoExame->material->name}}</option>
                                        @endif
                                        <option value="">SELECIONE O MATERIAL</option>

                                            @foreach(\App\Material::all() as $material)
                                                <option value="{{$material->id}}">{{$material->name}}</option>
                                            @endforeach
                                    </select>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
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
</div>
@endsection
