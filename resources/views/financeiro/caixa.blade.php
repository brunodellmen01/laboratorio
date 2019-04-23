@extends('layouts.app')

@section('content')

@if(!empty(Session::get('caixaFechado')) && Session::get('caixaFechado') == "SIM")
<script>
$(function() {
    $('#myModalFechado').modal('show');
});
</script>
@endif

@if(!empty(Session::get('status')) && Session::get('status') == "ABERTO")
<script>
$(function() {
    $('#myModalAberto').modal('show');
});
</script>
@endif

@if(!empty(Session::get('status')) && Session::get('status') == "FECHADO")
<script>
$(function() {
    $('#myModalFechado').modal('show');
});
</script>
@endif

<div class="wrapper wrapper-content">
        <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"></span>
                                <h5>Entradas</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">

                                		R$: {{$totalEntradas}}

                                </h1>
                                <div class="stat-percent font-bold text-success"><i class="fa fa-bolt"></i></div>
                                <small>Total de entradas.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right"></span>
                                <h5>Saidas</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">


                                		R$: {{$totalSaidas}}

                                </h1>
                                <div class="stat-percent font-bold text-info"><i class="fa fa-level-up"></i></div>
                                <small>Total de saidas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right"></span>
                                <h5>Saldo</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                	R$: {{$saldos}}

                                </h1>
                                <div class="stat-percent font-bold text-navy"><i class="fa fa-level-up"></i></div>
                                <small>Saldo Atual.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right"></span>
                                <h5>Caixa</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                	R$: {{$totalBox}}

                                </h1>
                                <div class="stat-percent font-bold text-navy"></div>
                                <small>
	                               @if($countador > 0)
	                               		<a class="" data-toggle="modal" href="#myModalFechar" class="btn btn-outline btn-primary">
	                               	FECHAR
	                               	</a>
	                               	@else
	                               			<a class="" data-toggle="modal" href="#myModalAbrir" class="btn btn-outline btn-primary">ABRIR CAIXA</a>

	                               	@endif
                                </small>
                            </div>
                        </div>
                    </div>
        </div>


         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>ENTRADAS</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>TIPO</th>
                                            <th>VALOR</th>
                                            <th>DESCRIÇÃO</th>
                                            <th>DATA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($entradas as $entrada)
                                                    <td>{{$entrada->type}}</td>
                                                    <td>{{$entrada->price}}</td>
                                                    <td>{{$entrada->description}}</td>
                                                    <td>
							<?php
   					   			$data = $entrada->created_at;
					   			echo date('d/m/Y H:m:s', strtotime($data));
                                        		?>
						   </td>
                                            </tr>
                                            @empty
                                                <td colspan="4">Nenhum Registro Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="text-center" >

                          </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>SAIDAS</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>TIPO</th>
                                            <th>VALOR</th>
                                            <th>DESCRIÇÃO</th>
                                            <th>DATA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($saidas as $saida)
                                                    <td>{{$saida->type}}</td>
                                                    <td>{{$saida->price}}</td>
                                                    <td>{{$saida->description}}</td>
                                                    <td>
							<?php
   					   			$created = $saida->created_at;
					   			echo date('d/m/Y H:m:s', strtotime($created));
                                        		?>

						    </td>
                                            </tr>
                                            @empty

                                                    <td colspan="4">Nenhum Registro Encontrado.</td>


                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="text-center" >

                          </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>PARCELAS RECEBIDAS</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PEDIDO</th>
                                            <th>VALOR</th>
                                            <th>VALOR PAGO </th>
                                            <th>VALOR RESTANTE </th>
                                            <th>RECEBIDO EM </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($parcelOrders as $parcelOrder)
                                                    <td>{{$parcelOrder->id}}</td>
                                                    <td>{{$parcelOrder->order_id}}</td>
                                        		<!-- valor -->
	                                            <td>R$: {{$parcelOrder->price_parcel}}</td>

	                                            <!-- valor pago -->
	                                            <td>R$: {{$parcelOrder->price_settled}}</td>

	                                            <!-- valor restante -->
	                                            <td>R$: <?php $resta = $parcelOrder->price_parcel - $parcelOrder->price_settled;
echo $resta;?> </td>


	                                            <!-- recebido em -->
	                                            <td>
<?php
   					   			$receive1 = $parcelOrder->receive;
					   			echo date('d/m/Y H:m:s', strtotime($receive1));
                                        		?>

</td>
                                            </tr>
                                            @empty
                                                <td colspan="7">Nenhum Registro Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="text-center" >
                            
                          </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>PARCELAS PAGAS</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PEDIDO</th>
                                            <th>VALOR</th>
                                            <th>VALOR PAGO </th>
                                            <th>VALOR RESTANTE </th>
                                            <th>RECEBIDO EM </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($parcelPays as $parcelPay)
                                                    <td>{{$parcelPay->id}}</td>
                                                    <td>{{$parcelPay->order_id}}</td>
                                                    <!-- valor -->
                                                    <td>R$: {{$parcelPay->price_parcel}}</td>

                                                    <!-- valor pago -->
                                                    <td>R$: {{$parcelPay->price_settled}}</td>

                                                    <!-- valor restante -->
                                                    <td>
                                                        R$: <?php $resta = $parcelPay->price_parcel - $parcelPay->price_settled;
                                                        //echo $resta;
                                                        echo 'R$' . number_format($resta, 2, ',', '.');
                                                        ?>                                                    
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $receive2 = $parcelPay->receive;
                                                            echo date('d/m/Y H:m:s', strtotime($receive2));
                                                        ?>
                                                    </td>
                                            </tr>
                                            @empty
                                                <td colspan="7">Nenhum Registro Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="text-center" >
                            
                          </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>MOVIMENTAÇÃO DO CAIXA</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table">
                            <thead>
                              <tr>
                                <th>TIPO</th>
                                <th>VALOR</th>
                                <th>DESCRIÇÃO</th>
                                <th>DATA</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($movs as $mov)
                                  <tr>
                                    <td>{{ $mov->type }}</td>
                                    <td>R$: {{ $mov->price }}</td>
                                    <td>{{ $mov->description }}</td>
                                    <td>
<?php
   					   			$mov1 = $mov->created_at;
					   			echo date('d/m/Y H:m:s', strtotime($mov1));
                                        		?> 

</td>
                                  </tr>
                                @empty
                                    <td colspan="4">Nenhum Registro Encontrado.</td>
                                @endforelse
                            </tbody>
                          </table>

                                </div>
                            </div>
                        </div>
                    </div>



                    </div>

                    <!-- Modal Abrir-->
					<div id="myModalAbrir" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Abrir Caixa</h4>
					      </div>
					      <div class="modal-body">
					      	<form method="post" action="caixa/abrir">
					      		<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group has-feedback">
					      		   <p><input type="text" name="saldo_inicial" placeholder="R$: 400,00" required="" class="form-control"></p>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
					        	<p>Para Realizar a Abertura do Caixa Informe Um Valor.</p>
					      </div>
					      <div class="modal-footer">
					        <button type="submit" class="btn btn-default">ABRIR</button>
					        </form>
					      </div>
					    </div>

					  </div>
					</div>
					<!-- Modal Abrir-->

					<!-- Modal Fechar-->
					<div id="myModalFechar" class="modal fade" role="dialog">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Fechar Caixa</h4>
					      </div>
					      <div class="modal-body">
					      	<form method="post" action="../financeiro/caixa/fechar">
					      		<input type="hidden" name="_token" value="{{ csrf_token() }}">

					      		<p><input type="text" name="diferenca" placeholder="R$: 400,00" class="form-control" value="00,00"></p>

					        	<p>Para Realizar o fechamento do Caixa Informe a diferença, caso haja.</p>
					      </div>
					      <div class="modal-footer">
					        <button type="submit" class="btn btn-default">FECHAR</button>
					        </form>
					      </div>
					    </div>

					  </div>
					</div>
					<!-- Modal Fechar-->

					<!-- Modal caixa fechado -->
					<div id="myModalFechado" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Caixa Fechado</h4>
					      </div>
					      <div class="modal-body">
					        <p>O Caixa foi fechado com Sucesso.</p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
					      </div>
					    </div>

					  </div>
					</div>
					<!-- Modal caixa fechado -->

					<!-- Modal caixa fechado -->
					<div id="myModalAberto" class="modal fade" role="dialog">
					  <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Caixa Aberto</h4>
					      </div>
					      <div class="modal-body">
					        <p>O Caixa foi aberto com Sucesso.</p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
					      </div>
					    </div>

					  </div>
					</div>
					<!-- Modal caixa fechado -->
@endsection
