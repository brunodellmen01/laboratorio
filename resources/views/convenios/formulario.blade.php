@extends('layouts.app')

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
                        {!! Form::model($covenant, ['method' => 'PATCH', 'url' => 'convenios/'.$covenant->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'convenios/salvar']) !!}
                    @endif

                    
                    	<div class="row">
	  						<div class="col-sm-12">
                                <div class="form-group has-feedback">
	  							  {!! Form::input('text', 'name', NULL, ['class' => 'form-control has-error', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                                  <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
	  							<br/>
	  						</div>

                            <div class="col-sm-4">
                                {!! Form::input('text', 'doc', NULL, ['class' => 'form-control', 'placeholder' => 'CPF/CNPJ'])!!}
                                
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group has-feedback">
                                    {!! Form::input('text', 'ans', NULL, ['class' => 'form-control', 'placeholder' => 'CÓDIGO ANS'])!!}
                                <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                {!! Form::input('text', 'site', NULL, ['class' => 'form-control', 'placeholder' => 'SITE'])!!}
                                <br>                               
                            </div>

                            <div class="col-sm-4">
                                {!! Form::input('email', 'email', NULL, ['class' => 'form-control', 'placeholder' => 'E-MAIL'])!!}                                
                            </div>

                            <div class="col-sm-4">
                                {!! Form::input('text', 'cod_clinica', NULL, ['class' => 'form-control', 'placeholder' => 'CÓDIGO REGISTRO NA CLÍNICA'])!!}                                
                            </div>

                            <div class="col-sm-4">
                                {!! Form::input('text', 'fone', NULL, ['class' => 'form-control', 'placeholder' => 'TELEFONE'])!!}
                                <br>                              
                            </div>

                            <div class="col-sm-4">
                                {!! Form::input('text', 'cep', NULL, ['class' => 'form-control', 'placeholder' => 'CEP'])!!}                                
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group has-feedback">
                                    <select required class="js-example-basic-single form-control" name="estado_id">
                                      @if(isset($covenant))
                                        <option value="{{$covenant->estado->id}}">{{$covenant->estado->initials}}</option>
                                      @endif
                                      <option value="">SELECIONE O UF</option>
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->initials}}</option>
                                        @endforeach
                                    </select>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                {!! Form::input('text', 'bairro', NULL, ['class' => 'form-control', 'placeholder' => 'BAIRRO'])!!}
                                <br>                              
                            </div>

                            <div class="col-sm-4">
                                {!! Form::input('text', 'numero', NULL, ['class' => 'form-control', 'placeholder' => 'NUMERO'])!!}
                                <br>                              
                            </div>

                            <div class="col-sm-4">
                                {!! Form::input('text', 'complemento', NULL, ['class' => 'form-control', 'placeholder' => 'COMPLEMENTO'])!!}
                                <br>                              
                            </div>

                             <div class="col-sm-4">
                                <div class="form-group has-feedback">
                                    <select required class="form-control js-example-basic-single" name="city_id">
                                        @if(isset($covenant))
                                            <option value="{{$covenant->city->id}}">{{$covenant->city->name}}</option>
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

                            <div class="col-sm-12">
                                {!! Form::textarea('end', NULL, ['class' => 'form-control', 'placeholder' => 'ENDEREÇO', 'rows' => 6])!!}
                                <br>                              
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

@endsection
