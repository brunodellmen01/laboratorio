@extends('layouts.app')

@section('content')


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
			                                    <td>{{$orderArticle->date}}</td>
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
                                            <th class="pull-right">AÇÕES </th>
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
	                                            <td>{{$parcelOrder->venc}}</td>

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
	                                            <?php $id_parcela = $parcelOrder->id;?>
	                                            <td data-nome = <?php echo $id_parcela; ?> >
	                                            	<?php
if ($resta == 0) {
	echo "PAGO EM ";
} else {?>

	                                            			<button d type="button" class="btn btn-outline btn-primary pull-right" data-toggle="modal" data-target="#myModal<?php echo $id_parcela; ?>">RECEBER</button>

	                                            	<!-- Modal -->
	                                            	<!-- faço um ajuste técnico, coloco o nome do modal sendo o id da parcela -->
													<div id="myModal<?php echo $id_parcela; ?>" class="modal fade" role="dialog" data-backdrop="static" data-id="">
													  <div class="modal-dialog">

													    <!-- Modal content-->
													    <div class="modal-content">
													      <div class="modal-header">
													        <button type="button" class="close" data-dismiss="modal">&times;</button>
													        <h4 class="modal-title">PEDIDO
													        	@forelse($orderArticles as $orderArticle)
									                                <b> {{$orderArticle->id}} - Parcela Nº. {{$parcelOrder->id}} </b>
									                            @empty
									                            @endforelse
													        </h4>
													      </div>
													      <div class="modal-body">
													        <p>
													        	<form method="get" action="../receber/pedido/{{$orderArticle->id}}/parcela/{{$parcelOrder->id}}">

													        		<input class="form-control" value="<?php echo date('Y-d-m - H:m:s'); ?>" type="hidden" name="dataPaga"></input>

													        		<input class="form-control" placeholder="R$: 50,00" name="pagamento"></input>
													        </p>
													        <p>

													        </p>
													        <p>


													        		<button class="btn btn-default btn-block">RECEBER</button>
													        	</form>

													        </p>
													        <p>
													        	ATENÇÃO. AO REALIZAR O RECEBIMENTO DESTA PARCELA, A MESMA SERÁ REGISTRADA EM SEU CAIXA.
													        </p>
													      </div>
													      <div class="modal-footer">

													      </div>
													    </div>

													  </div>
													</div>
													<!-- Modal -->

	                                            		<?php }

?>


	                                            </td>
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
                 </div>



@endsection