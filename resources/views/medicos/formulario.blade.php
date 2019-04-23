@extends('layouts.app')

@section('content')
<title>Cadastro de Médicos</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastro de Médicos
                    <a href="{{ url('medicos/listar') }}" class="pull-right">Listar Médico</a>
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
                        {!! Form::model($medico, ['method' => 'PATCH', 'url' => 'medicos/'.$medico->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'medicos/salvar']) !!}
                    @endif

                    
                    	<div class="row">
	  						<div class="col-sm-12">
                                <div class="form-group has-feedback">
    	  							{!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>

                                </div>
	  							<br/>
	  						</div>
	  						<div class="col-sm-8">
	  							{!! Form::input('email', 'email', NULL, ['class' => 'form-control', 'placeholder' => 'E-MAIL'])!!}
	  							<br/>
	  						</div>

                            <div class="col-sm-4">
                                <div class="form-group has-feedback">
                                    <select class="form-control" name="tipo_doc">
                                        @if(isset($medico))
                                          <option value="{{$medico->tipo_doc}}">{{$medico->tipo_doc}}</option>
                                        @endif
                                        <option value="">Selecione o Conselho</option>
                                        <option value="COREN">COREN - Conselho Federal de Enfermagem</option>
                                        <option value="CRAS">CRAS - Conselho Regional de Assistência Social</option>
                                        <option value="CRF">CRF - Conselho Regional de Farmácia</option>
                                        <option value="CREFITO">CREFITO - Conselho Regional de Fisioterapia e Terapia Ocupacional</option>
                                        <option value="CRFA">CRFA - Conselho Regional de Fonoaudiologia</option>
                                        <option value="CRM">CRM - Conselho Regional de Medicina</option>
                                        <option value="CRV">CRV - Conselho Regional de Medicina Veterinária</option>
                                        <option value="CRN">CRN - Conselho Regional de Nutrição</option>
                                        <option value="CRO">CRO - Conselho Regional de Odontologia</option>
                                        <option value="CRP">CRP - Conselho Regional de Psicologia</option>
                                        <option value="OUT">OUT - Outros Conselhos</option>
                                    </select>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                                <br>
                            </div>

	  						<div class="col-sm-4">
                                <div class="form-group has-feedback">
	  							  {!! Form::input('number', 'crm', NULL, ['class' => 'form-control', 'placeholder' => 'NUMERO CONSELHO', 'required' => 'required'])!!}
                                  <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
	  							<br/>
  							</div>

                            <div class="col-sm-4">
                                <div class="form-group has-feedback">
                                    {!! Form::input('text', 'cbos', NULL, ['class' => 'form-control', 'placeholder' => 'CBOS', 'required' => 'required'])!!}
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                                <br/>
                            </div>


                            

                            <div class="col-sm-4">
                                <div class="form-group has-feedback">
                                    <select required class="form-control  js-example-basic-single" name="estado_id">
                                      @if(isset($medico))
                                        <option value="{{$medico->estado->id}}">{{$medico->estado->initials}}</option>
                                      @endif
                                      <option value="">SELECIONE O UF</option>
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->initials}}</option>
                                        @endforeach
                                    </select>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                            </div>

  							<div class="col-sm-12">
	  							{!! Form::input('text', 'note', NULL, ['class' => 'form-control', 'placeholder' => 'OBSERVAÇOES', 'rows' => '4', 'resizable' => 'none'])!!}
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
