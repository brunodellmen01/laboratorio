@extends('layouts.app')

@section('content')



<div class="row">
	    <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    
                    <h5> <i class="fas fa-file-code"></i> GUIA TISS</h5>

                </div>

                <div class="ibox-content">

                    <a data-toggle="collapse" data-target="#tissSadat" class="btn btn-outline btn-info">SP-SADT</a>
                     

                    <br>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    
                    <h5> <i class="fas fa-file-code"></i> GUIA TISS</h5>

                </div>

                <div class="ibox-content">

                     
                     <a data-toggle="collapse" data-target="#tissConsulta" class="btn btn-outline btn-info">GUIA CONSULTA</a>

                    <br>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    
                    <h5> <i class="fas fa-file-code"></i> GUIA TISS</h5>

                </div>

                <div class="ibox-content">

                    <a data-toggle="collapse" data-target="#tissConsulta" class="btn btn-outline btn-info">SOLICITAÇÃO SP-SADT</a>

                     

                    <br>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>
</div>

<div class="alert alert-warning">
	Para Gerar Uma Guia TISS, informe os dados abaixo, em seguida clique em Salvar. <br>
	Em seguida, você será redirecionado para a pagina onde poderá informar os procedimentos.
</div>
<!-- cadastros tis -->

        <div class="collapse col-md-12" id="tissSadat">

        	<div class="ibox float-e-margins">

                <div class="ibox-title">

                    
                    <h5> <i class="fas fa-file-code"></i> GUIA TISS</h5>

                </div>

                @if(Request::is('*/editar'))
				    {!! Form::model($tiss, ['method' => 'PATCH', 'url' => 'tiss/'.$paciente->id.'/editar']) !!}
				@else
				    {!! Form::open(['url' => '/historico/paciente/'.$id.'/tiss/salvar', 'method' => 'POST']) !!}
				@endif

				@forelse($pacientes as $paciente)
				@empty
                @endforelse

                <div class="ibox-content">

                	 <div class="panel-group" id="accordion">
						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">DADOS DO EXECUTANTE - EMPRESA</a>
						        </h4>
						      </div>
						      <div id="collapse3" class="panel-collapse collapse">
						        <div class="panel-body">
						        	<div class="row" >
						        		<div class="col-md-3">
						        			@foreach($empresas as $empresa)
						        				<div class="form-group has-feedback">
						        					{!! Form::input('text', 'cod_operadora', $empresa->cnpj, ['class' => 'form-control', 'placeholder' => 'CÓDIGO NA OPERADORA *', 'required' => 'required', 'maxlength' => '14'])!!}
						        					<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                				</div>
						        		</div>

						        		<div class="col-md-3">
						        			<div class="form-group has-feedback">					        			
						        				{!! Form::input('text', 'nome_executante', $empresa->name, ['class' => 'form-control', 'placeholder' => 'NOME DO EXECUTANTE *', 'required' => 'required'])!!}
						        				<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                			</div>
						        		</div>
						        		
						        		<div class="col-md-3">
						        			<div class="form-group has-feedback">					        			
							        			{!! Form::input('text', 'cnes', $empresa->cnes, ['class' => 'form-control', 'placeholder' => 'CNES', 'maxlength' => '7', 'required' => 'required'])!!}
							        			<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                			</div>
						        			<br>
						        		</div>

						        		<div class="col-md-3">
						        			<div class="form-group has-feedback">					        			
						        				{!! Form::input('text', 'num_guia', NULL, ['class' => 'form-control', 'placeholder' => 'NUMERO DA GUIA *', 'required' => 'required', 'maxlength' => '20'])!!}
						        				<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                			</div>
						        			<br>
						        		</div>
						        		@endforeach

						        		<div class="col-md-3">
						        			<select class="form-control" name="tipo_atendimento">
						        				<option value="">Selecione o Tipo de Atendimento</option>
		                                        <option value="1">Remoção</option>
												<option value="2">Pequena Cirurgia</option>
												<option value="3">Terapias</option>
												<option value="4">Consulta</option>
												<option selected="select" value="5">Exame</option>
												<option value="6">Atend. Domiciliar</option>
												<option value="7">SADAT Internado</option>
												<option value="8">Quimioterapia</option>
												<option value="9">Radioterapia</option>
												<option value="10">TRS Terapia Renal Subs.</option>
											</select>
						        			<br>
						        		</div>

						        		<div class="col-md-3">
						        			<select class="form-control" name="indica_acidente">
						        				<option value="">Selecione a Indicação de Acidente</option>
						        				<option value="0">Acidente/Doença relacionado ao trabalho</option>
												<option value="1">Trânsito</option>
												<option selected="selected" value="2">Outros</option>
						        			</select>
						        		</div>

						        		<div class="col-md-3">
						        			<select class="form-control" name="indica_acidente">
						        				<option value="">Selecione o Tipo de Saida</option>
						        				<option selected="selected" value="1">Retorno</option>
												<option value="2">Retorno com SADAT</option>
												<option value="3">Referencia</option>
												<option value="4">Internação</option>
												<option value="5">Alta</option>
												<option value="6">Obto</option>
						        			</select>
						        		</div>
					        		

						        		<div class="col-md-3">
						        			<select class="form-control" name="tipo_consulta">
						        				<option value="">Selecione o Tipo de Consulta</option>
												<option selected="selected" value="1">Primeira</option>
												<option value="2">Seguimento</option>
												<option value="3">Pré-Natal</option>
											</select>
						        		</div>

						        		
						        	</div>
						        </div>
						      </div>
						    </div>

						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">DADOS PRINCIPAIS - PACIENTE</a>
						        </h4>
						      </div>
						      <div id="collapse4" class="panel-collapse collapse">
						        <div class="panel-body">
						        	<div class="row" >

						        		@foreach($empresas as $empresa)

							        		<div class="col-md-12">
							        			<div class="form-group has-feedback">
							        				
							        				{!! Form::input('text', 'ans', $empresa->ans, ['class' => 'form-control', 'placeholder' => 'ANS*'])!!}
							        				<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                				</div>
							        									        	
							        		</div>
							        	@endforeach

							        	

						        		<div class="col-md-9">
						        			<div class="form-group has-feedback">
						        				<input type="hidden" name="patient_id" value="<?php echo $paciente->id;?>">
						        				{!! Form::input('text', 'nome_paciente', $paciente->name, ['class' => 'form-control', 'placeholder' => 'NOME*', 'required' => 'required', 'maxlength' => '70'])!!}
						        				<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                			</div>
						        									        	
						        		</div>

						        		<div class="col-md-3">
						        			<select class="form-control" name="rescem_nascido">
						        				<option value="">Rescem Nascido</option>
												<option value="SIM">SIM</option>
												<option value="NAO" selected="">NÃO</option>
											</select>
											<br>
						        		</div>

						        		<div class="col-md-3">
						        			<div class="form-group has-feedback">
						        				{!! Form::input('text', 'num_carteira', $paciente->num_carteira, ['class' => 'form-control', 'placeholder' => 'Nº CARTEIRA*', 'required' => 'required', 'maxlength' => '20'])!!}
						        				<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                			</div>
						        			
						        	
						        		</div>

						        		<div class="col-md-3">
						        			{!! Form::input('date', 'validade_carteira', $paciente->validade_carteira, ['class' => 'form-control', 'placeholder' => 'VALIDADE CARTEIRA*', 'required' => 'required'])!!}
						        		</div>

						        		<div class="col-md-3">
						        			{!! Form::input('text', 'cns', $paciente->cns, ['class' => 'form-control', 'placeholder' => 'CNS', 'maxlength' => '15'])!!}
						        		</div>

						        		<div class="col-md-3">
						        			<div class="form-group has-feedback">
						        				{!! Form::input('text', 'plano', $paciente->convenio, ['class' => 'form-control', 'placeholder' => 'PLANO', 'required' => 'required','maxlength' => '40'])!!}
						        				
						        			<br>
						        		</div>



						        	</div>
						        </div>
						      </div>
						    </div>

						    <div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">DADOS DO SOLICITANTE MÉDICO QUE SOLICITOU O PEDIDO</a>
						        </h4>
						      </div>
						      <div id="collapse5" class="panel-collapse collapse">
						        <div class="panel-body">
						        	<div class="row" >

						        		<div class="col-md-4">
						        			<div class="form-group has-feedback">
						        				{!! Form::input('text', 'crm', NULL, ['class' => 'form-control', 'placeholder' => 'CÓDIGO NA OPERADORA', 'required' => 'required', 'maxlength' => '14'])!!}	
						        				
						        				<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                			</div>
						        		</div>

						        		<div class="col-md-4">
						        			<select required class="form-control " name="medical_id">
					                    		<option>Selecione o Médico</option>
					                    		@foreach($medicos as $medico)
				                              		<option value="{{$medico->id}}">{{$medico->crm}} - {{$medico->name}}</option>
				                            	@endforeach
					                    	</select>			
						        		</div>

						        		

						        		<div class="col-md-4">
						        			<select class="form-control" name="conselho">
						        				<option value="">Selecione o Conselho</option>
		                                        <option value="COREN">COREN - Conselho Federal de Enfermagem</option>
		                                        <option value="CRAS">CRAS - Conselho Regional de Assistência Social</option>
		                                        <option value="CRF">CRF - Conselho Regional de Farmácia</option>
		                                        <option value="CREFITO">CREFITO - Conselho Regional de Fisioterapia e Terapia Ocupacional</option>
		                                        <option value="CRFA">CRFA - Conselho Regional de Fonoaudiologia</option>
		                                        <option selected="selected" value="CRM">CRM - Conselho Regional de Medicina</option>
		                                        <option value="CRV">CRV - Conselho Regional de Medicina Veterinária</option>
		                                        <option value="CRN">CRN - Conselho Regional de Nutrição</option>
		                                        <option value="CRO">CRO - Conselho Regional de Odontologia</option>
		                                        <option value="CRP">CRP - Conselho Regional de Psicologia</option>
		                                        <option value="OUT">OUT - Outros Conselhos</option>
											</select>
						        			<br>
						        		</div>

						        		<div class="col-md-2">
						        			<div class="form-group has-feedback">
						        				{!! Form::input('text', 'num_conselho', NULL, ['class' => 'form-control', 'placeholder' => 'Nº CONSELHO', 'required' => 'required', 'maxlength' => '15'])!!}
						        				<span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                			</div>
						        			
						        		</div>

						        		<div class="col-md-2">
						        			{!! Form::input('text', 'cbos', NULL, ['class' => 'form-control', 'placeholder' => 'Nº CBOS', 'maxlength' => '5'])!!}
						        		</div>

						        		<div class="col-md-2">
						        			<input type="hidden" name="data_solicita" value="<?php echo $dia; ?>">
						        			{!! Form::input('date', 'data_solicita', $dia , ['class' => 'form-control', 'placeholder' => 'DATA SOLICITAÇÃO', 'required'])!!}
						        			<br>
						        	
						        		</div>

						        		<div class="col-sm-2">
		                                    <select required class="form-control" name="uf_conselho">
		                                      @if(isset($medico))
		                                        <option value="{{$medico->estado->id}}">{{$medico->estado->initials}}</option>
		                                      @endif
		                                      <option value="">SELECIONE O UF</option>
		                                        @foreach($estados as $estado)
		                                            <option value="{{$estado->id}}">{{$estado->initials}}</option>
		                                        @endforeach
		                          			</select>
		                          			<br>
                      					</div>

						        		
                      					<div class="col-md-4">
						        			<select class="form-control" name="carater_internacao">
						        				<option value="">Carater do Tipo de Atendimento</option>
		                                        <option selected="selected" value="E">Eletivo</option>
		                                        <option value="U">Emergencia</option>
											</select>
						        			<br>
						        		</div>
						        		
						        		<div class="col-md-12">
						        			{{ Form::textarea('obs', null, ['class' => 'form-control', 'size' => '30x5', 'placeholder' => 'EX: CONFORME SOLICTADO PELO MÉDICO', 'maxlength' => '255']) }}

						        			<br>
						        	
						        		</div>

						        		@if(Request::is('*/editar'))
			                                <div class="col-sm-12">
			                                    {!! Form::submit('EDITAR', ['class' => 'btn btn-outline btn-info pull-left btn-block'])!!}
			                                    <br/>
			                                </div>
			                            @else
			                                <div class="col-sm-12">
			                                    {!! Form::submit('SALVAR', ['class' => 'btn btn-outline btn-info pull-left btn-block'])!!}
			                                    <br/>
			                                </div>
			                            @endif

			                            
						        		

						        	</div>
						        </div>
						      </div>
						    </div>

						  </div> 
					</div>
			            
                    <br>
                    {!! Form::close() !!}
                    

                	</div>
                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                  </div>

              </div>
           
        

       



       

@endsection