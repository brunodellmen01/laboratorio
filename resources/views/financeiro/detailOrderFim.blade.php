@extends('layouts.app')

@section('content')

@if(!empty(Session::get('enviado')) && Session::get('enviado') == "SIM")
<script>
$(function() {
    $('#myModalSim').modal('show');
});
</script>
@endif

@if(!empty(Session::get('enviado')) && Session::get('enviado') == "NAO")
<script>
$(function() {
    $('#myModalNao').modal('show');
});
</script>
@endif

<div class="wrapper wrapper-content">


         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>PEDIDO Nº
                                	@forelse($orderArticles as $orderArticle)
                                		<b> {{$orderArticle->id}} </b>
                                	@empty
                                	@endforelse
                                </h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>


				                            <th>Paciente</th>
				                            <th>Médico</th>
				                            <th>Retirar Em</th>
				                            <th>FORMA PGTO</th>
				                            <th>Tipo</th>
				                            <th>Clínica</th>
				                            <th>Protocolo</th>
				                            <th>Valor Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
			                                @forelse($orderArticles as $orderArticle)


			                                    <td>{{$orderArticle->patient->name}}</td>
			                                    <td>{{$orderArticle->medic->name}}</td>

							    <td>
      							        <?php
$data = $orderArticle->date;
echo date('d/m/Y', strtotime($data));
?>

							    </td>

			                                    <td>{{$orderArticle->states_id}}</td>
			                                    <td>{{$orderArticle->type}}</td>
			                                    <td>{{$orderArticle->clinic->name}}</td>
			                                    <td>{{$orderArticle->protocol}}</td>
			                                    <td>R$: {{$precoTotal}}</td>

			                            </tr>
			                            @empty
			                                <div class="alert alert-info">
			                                    Nenhum Pedido Encontrado.
			                                </div>

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
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>TOTAL DE PARCELAS:
                                	@forelse($orderArticles as $orderArticle)
                                		<b> {{$orderArticle->qtd}} </b>
                                	@empty
                                	@endforelse
                                </h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>VALOR</th>
                                            <th>VALOR PAGO </th>
                                            <th>VALOR RESTANTE </th>
                                            <th>VENC. </th>
                                            <th>PAGO EM </th>
                                            <th>STATUS </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        	@forelse($parcelOrders as $parcelOrder)

                                        		<td>{{$parcelOrder->id}}</td>
                                        		<!-- valor -->
	                                            <td>R$: {{$parcelOrder->price_parcel}}</td>

	                                            <!-- valor pago -->
	                                            <td>R$: {{$parcelOrder->price_settled}}</td>

	                                            <!-- valor restante -->
	                                            <td>R$: <?php $resta = $parcelOrder->price_parcel - $parcelOrder->price_settled;
echo $resta;?> </td>

	                                            <!-- VENCIMENTO -->
	                                            <td>
						        <?php
$venc = $parcelOrder->venc;
echo date('d/m/Y', strtotime($venc));
?>
                                                    </td>

	                                            <!-- recebido em -->
	                                            <td>{{$parcelOrder->receive}}</td>

	                                            <!-- se valor pago for = valor parcela -->
	                                            @if( $resta == 0 )
	                                            <td><i class="fa fa-check text-success"></i></td>
	                                            <td>
	                                            	PAGO
	                                            </td>
	                                            @else
	                                            	<td><i class="fa fa-clock-o text-warning"></i></td>

	                                            <!-- pego o id da parcela e coloco na linha da tabela pra referencia do modal -->


	                                            @endif
                                        </tr>
                                        @empty
		                                <div class="alert alert-info">
		                                    Nenhum Pedido Encontrado.
		                                </div>

		                            	@endforelse

                                        </tbody>
                                    </table>
                                    <div class="pull-right" >
		                            {!! $parcelOrders->Links() !!}
		                          </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Ações</h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">

                	<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <tbody>
                            <tr>
	                            <td class="pull-left">
	                                    		<a href="../../pedidos/{{$orderArticle->id}}/detalhes" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="DETALHES" target="_blank">
                                                <br>
	                                    		<i class="fa fa-eye fa-3x"></i>
                                                    <br><br>DETALHES
	                                    		</a>
	                                    </td>

                                <td class="pull-left">
                                                <a href="../../pedidos/{{$orderArticle->id}}/resumo" target="_blank" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="RESUMO" target="_blank">
                                                <br>
                                                <i class="fa fa-print fa-3x"></i>                   
                                                    <br><br>RESUMO</i>
                                                </a>
                                        </td>
                            </tr>

                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>


                 </div>

                 <!-- Modal caixa fechado -->
                    <div id="myModalSim" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Alerta Enviado</h4>
                          </div>
                          <div class="modal-body">
                            <p>Alerta Enviado</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                    <!-- Modal caixa fechado -->
                    <div id="myModalNao" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Alerta Nao Enviado</h4>
                          </div>
                          <div class="modal-body">
                            <p>Alerta Nao Enviado</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->



@endsection
