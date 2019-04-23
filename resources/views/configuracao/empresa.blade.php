@extends('layouts.app')

@section('content')


@if(!empty(Session::get('editado')) && Session::get('editado') == "SIM")
<script>
$(function() {
    $('#myModalEditado').modal('show');
});
</script>
@endif

<title>Configurações da EMpresa</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Configurações da empresa
                    
                </div>

                <div class="panel-body">

                    

                	<?php if (array_key_exists("inserido", $_GET) && $_GET['inserido'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>

                    	{!! Form::model($empresa, ['method' => 'PATCH', 'url' => 'configuracao/empresa/'.$empresa->id.'/editar']) !!}
                        
                    


                    	<div class="row">
        	  						<div class="col-sm-12">
                          <div class="form-group has-feedback">
        	  							  {!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                          </div>

        	  							<br/>
        	  						</div>

        	  						<div class="col-sm-6 ">
                          <div class="form-group has-feedback">
	  							          {!! Form::input('text', 'razao', NULL, ['class' => 'form-control', 'placeholder' => 'RAZÃO SOCIAL'])!!}
                          <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                          </div>
      	  							<br/>
        							</div>

        							<div class="col-sm-3">
                        <div class="form-group has-feedback">
      	  							    {!! Form::input('text', 'cnpj', NULL, ['class' => 'form-control', 'placeholder' => 'CNPJ', 'onkeypress' => 'mascara(this, 
      				    			"##.###.###/####-##")', 'maxlength' => '18'])!!}
                          <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                        </div>
      	  							
        							</div>

                <div class="col-sm-3">
                  <div class="form-group has-feedback">
                    {!! Form::input('text', 'cnes', NULL, ['class' => 'form-control', 'placeholder' => 'CÓDIGO CNES'])!!}
                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
                  <br>
                </div>
  							
                
  							<div class="col-sm-4">
                  <div class="form-group has-feedback">
	  							  {!! Form::input('text', 'ans', NULL, ['class' => 'form-control', 'placeholder' => 'REGISTRO ANS'])!!}
                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
	  							
  							</div>

  							<div class="col-sm-4 ">
                  <div class="form-group has-feedback">
	  							  {!! Form::input('text', 'medico', NULL, ['class' => 'form-control', 'placeholder' => 'MÉDICO'])!!}
                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
	  							
  							</div>
                
  							<div class="col-sm-4">
                  <div class="form-group has-feedback">
      								<select class="form-control " name="tipo_doc">
      									@if(isset($empresa))
                          <option value="{{$empresa->tipo_doc}}">{{$empresa->tipo_doc}}</option>
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
	  							  {!! Form::input('text', 'fone', NULL, ['class' => 'form-control', 'placeholder' => 'TELEFONE', 'onkeypress' => 'mascara(this, 
				    			"## # ###-####")', 'maxlength' => '14'])!!}
	  							  <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
  							</div>

  							<div class="col-sm-4">
                  <div class="form-group has-feedback">
	  							  {!! Form::input('text', 'cep', NULL, ['class' => 'form-control', 'placeholder' => 'CEP', 'onkeypress' => 'mascara(this, 
				    			"##.###-###")', 'maxlength' => '10'])!!}
                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
	  							
  							</div>

  							<div class="col-sm-4">
                  <div class="form-group has-feedback">
	  							  {!! Form::input('text', 'num_doc', NULL, ['class' => 'form-control', 'placeholder' => 'Nº DOCUMENTO'])!!}
                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
	  							<br>
  							</div>
  							

  							<div class="col-sm-6">
                  <div class="form-group has-feedback">
                					<select required class="form-control  js-example-basic-single" name="estado_id">
		                              @if(isset($empresa))
		                              	<option value="{{$empresa->estado->id}}">{{$empresa->estado->name}}</option>
		                              @endif
		                              <option value="">SELECIONE O ESTADO</option>
                            		 	@foreach($estados as $estado)
                              				<option value="{{$estado->id}}">{{$estado->name}}</option>
                            			@endforeach
                          </select>
                          <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                  </div>
                      </div>
  							<div class="col-sm-6">
                    <div class="form-group has-feedback">
                					<select required class="form-control js-example-basic-single" name="city_id">
		                              @if(isset($empresa))
		                              	<option value="{{$empresa->city->id}}">{{$empresa->city->name}}</option>
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
                    
  									<br>
                    <div class="form-group has-feedback">
  									{!! Form::textarea('endereco', null, ['class' => 'form-control', 'rows' => 4, 'style' => 'resize:none', 'placeholder' => 'ENDEREÇO']) !!}
                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                        </div>
        	  							
        	  							<br/>
        	  						</div>
                            
                                <div class="col-sm-12">
                                    {!! Form::submit('SALVAR', ['class' => 'btn btn-outline btn-info pull-left'])!!}
                                    <br/>
                                </div>
                            
                            </div>
                            </div>

						</div>


					{!! Form::close() !!}
                </div>
            </div>
        </div>



        <!-- Modal caixa fechado -->
					<div id="myModalEditado" class="modal fade" role="dialog">
					  <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Dados Atualizados</h4>
					      </div>
					      <div class="modal-body">
					        <p>Dados da empresa atualizados com sucesso.</p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
					      </div>
					    </div>

					  </div>
					</div>
					<!-- Modal caixa fechado -->

@endsection
