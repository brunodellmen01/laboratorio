@extends('layouts.app')

@section('content')

@if(!empty(Session::get('finalizado')) && Session::get('finalizado') == "SIM")
	<script>
		$(function() {
    		$('#myModalFinalizado').modal('show');
		});
	</script>
@endif

<script>
	$(function() {
    	$('#myModalFinalizado').modal('show');
	});
</script>

@foreach($procedimentos as $procedimento)

@endforeach

	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Guia TISS Nº
                    
                    	{{$procedimento->id_tiss}}
                    
                    
                </div>
                <div class="panel-body">  
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>Nº Guia</th>
                                <th>Paciente</th>
                                <th>Data Solicitação</th>
                                <th>Imprmir Guia</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($guia_tiss as $guia)
                                  <tr>
                                    <td align="left">{{$guia->num_guia}}</td>
                                    <td align="left">{{$guia->nome_paciente}}</td>
                                    <td align="left">
                                    	<?php
   					   						$data = $guia->data_solicita;
					   						echo date('d/m/Y', strtotime($data));
                                        ?> 
                                    </td>
                                    <td align="left">
                                    	<a href="/pdf" class=" btn btn-info btn-md">
                                    		<span class="far fa-file-pdf"></span>
                                    	</a>
                                    </td>
                                  </tr>
                                 @empty
                                 	<tr>
                                 		<td>
                                 			<div class="alert alert-nfo">
                                 				NENHUM REGISTRO ENCONTRADO.
                                 			</div>
                                 		</td>
                                 	</tr>
                                 @endforelse
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Procedimentos Guia TISS Nº {{$procedimento->id_tiss}}
                    
                </div>
                <div class="panel-body">  
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>Procedimento</th>
                                <th>QTD</th>
                                <th>Valor Unit.</th>
                                <th>Valor Total</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($procedimentos as $procedimento)
                                  <tr>
                                    <td align="left">{{$procedimento->procedimento}}</td>
                                    <td align="left">{{$procedimento->qtd}}</td>
                                    <td align="left">R$: {{$procedimento->valor}}</td>
                                    <td align="left">R$: {{$procedimento->valor_total}}</td>
                                  </tr>
                                @empty
                                 	<tr>
                                 		<td>
                                 			<div class="alert alert-nfo">
                                 				NENHUM REGISTRO ENCONTRADO.
                                 			</div>
                                 		</td>
                                 	</tr>
                                @endforelse 
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>


    </div>








    <!-- Modal caixa fechado -->
                    <div id="myModalFinalizado" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Guia TISS Concluida Com Sucesso</h4>
                          </div>
                          <div class="modal-body">
                            <p>Nº Guia : {{$guia->num_guia}} <br>
                               Solicitado em: <?php echo date('d/m/Y', strtotime($data)); ?> <br>
                               Paciente: {{$guia->nome_paciente}} <br>
                            </p>
                          </div>
                          <div class="modal-footer">
                          	
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->



@endsection