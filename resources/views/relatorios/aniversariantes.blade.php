@extends('layouts.app')

@section('content')




<div class="wrapper wrapper-content">

         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>ANIVERSARIANTES NO DIA DE HOJE</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
<div class="col-sm-12 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraNiver" onkeyup="filtraNiver()"> <span 		class="input-group-btn" name="filtraNiver" >
       <button type="button" class="btn btn-sm btn-info"> NOME</button> </span>
     </div>
</div>
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>NOME</th>
                                            <th>AÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($aniversariantes as $aniversariante)
                                                    <td  class="pull-left">{{$aniversariante->name}}</td>


                                                    <td>
                                                    	<a data-toggle="modal" href="#myModal{{$aniversariante->id}}" class="btn btn-outline btn-info pull-right">AÇÕES</a>

                                                <!-- Modal -->
                                            <div id="myModal{{$aniversariante->id}}" class="modal fade" role="dialog">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Parabenizar {{$aniversariante->name}}</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            	{!! Form::open(['url' => 'relatorios/aniversariante/email', 'method' => 'POST']) !!}
	                                                                <p>
	                                                                    <button class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom"  title="ENVIAR FELICITAÇÕES VIA EMAIL">
	                                                                        <i class="fa fa-envelope-o" aria-hidden="true"><br><br>EMAIL</i>
	                                                                    </button>
	                                                                </p>

	                                                                <input type="hidden" name="paciente" value="{{$aniversariante->name}}">

	                                                                <input type="hidden" name="pacienteEmail" value="{{$aniversariante->email}}">



	                                                                <input type="hidden" name="mensagem" value="Nesta data de grande significado, temos o prazer de lhe desejar um feliz aniversário, estimado  {{$aniversariante->name}}! Que o próximo ano de vida traga muita felicidade, amor e saúde.">

																	{!! Form::close() !!}
                                                            </div>

                                                            <div class="col-md-6">
                                                            	{!! Form::open(['url' => 'relatorios/aniversariante/sms', 'method' => 'POST']) !!}
                                                                <p>

                                                                    <button class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom"  title="ENVIAR FELICITAÇÕES VIA SMS">

                                                                		<i class="fa fa-mobile" aria-hidden="true"><br><br>SMS</i>

                                                                	</button>
                                                                </p>

                                                            </div>

                                                            <div class="col-md-12">
                                                            	<div>
                                                            		<p>
																		Confira A baixo a mensageem que sera enviada.
																	</p>
																	<p>
																		<input type="hidden" name="paciente" value="{{$aniversariante->id}}">

																		<textarea class="form-control" name="mensagem" placeholder="MENSAGEM DE ANIVERSARIO" maxlength="200" rows="5" readonly="">Nesta data de grande significado, temos o prazer de lhe desejar um feliz aniversário, estimado  {{$aniversariante->name}}! Que o próximo ano de vida traga muita felicidade, amor e saúde.
																		</textarea>
																	</p>
																	<p class="pull-left">

																	</p>

																	{!! Form::close() !!}
																</div>
                                                            </div>
                                                        </div>
                                                    </p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                                                  </div>
                                                </div>

                                                    </td>
                                            </tr>
                                            @empty
                                                <td colspan="2">Nenhum Aniversariante Hoje.</td>

                                            @endforelse
                                        </tbody>
                                    </table>
                                    <p>
																		@if(!empty(Session::get('enviado')) && Session::get('enviado') == "SIM")
																		<div class="alert alert-success">
																		  Mensagem Enviada.
																		</div>
																		@endif

																		@if(!empty(Session::get('enviado')) && Session::get('enviado') == "NAO")
																		<div class="alert alert-danger">
																		  Erro ao Enviar Mensagem Enviada.
																		</div>
																		@endif
																	</p>
                                    <div class="pull-right" >

		                          	</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>



@endsection
