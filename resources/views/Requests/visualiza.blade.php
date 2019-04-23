@extends('layouts.app')

@section('content')


<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                    	Detalhes do Pedido Nº.
                    	@forelse($orders as $order)
                    		{{$order->id}}
                    	@empty
                    	@endforelse
                    </h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Paciente</th>
                            <th>Médico</th>
                            <th>Retirar Em</th>
                            <th>Forma Pgto</th>
                            <th>Tipo</th>
                            <th>Clínica</th>
                            <th>Protocolo</th>
                            <th>Status</th>


                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse($orders as $order)
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->patient->name}}</td>
                                    <td>{{$order->medic->name}}</td>
                                    <td>
					<?php
$data = $order->date;
echo date('d/m/Y', strtotime($data));
?>
				    </td>
                                    <td>{{$order->states_id}}</td>
                                    <td>{{$order->type}}</td>
                                    <td>{{$order->clinic->name}}</td>
                                    <td>{{$order->protocol}}</td>
                                    <td>{{$order->status}}</td>
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
        <!-- exames -->
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Exames Solicitados</h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            @forelse($orderArticles as $orderArticle)
                                <td>{{$orderArticle->exam->name}}</td>
                                <td>R$: {{$orderArticle->price}}</td>
                        </tr>
                        @empty
                            <div class="alert alert-info">
                                Nenhum Exame Encontrado.
                            </div>
                        @endforelse
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- exames -->
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Total</h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>Valor</th>

                                <th>R$: {{$prices}}</th>
                        </tr>
                        </thead>
                    </table>
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
                                @forelse($orders as $order)

                                	@if($order->status == "ABERTO")
	                                   		<td class="pull-left">
	                                    		<a href="../../pedido/{{$order->id}}/laudo" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="LAUDO">
	                                    		<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
	                                    		</a>
	                                    </td>
	                                   	@endif

                                	@if($order->status == "PAGO")

                                		<td class="pull-left">
	                                    	<a href="../pedido/{{$order->id}}/comprovante" target="_blank" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="COMPROVENTE">
	                                    		<i class="fa fa-file-word-o" aria-hidden="true"></i>
	                                    	</a>
	                                    </td>

	                                    @endif

                                    	@if($order->status == "EM ANALISE")

                                    		<td class="pull-left">
	                                    		<a href="../pedido/{{$order->id}}/comprovante" target="_blank" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="COMPROVENTE">
	                                    			<i class="fa fa-file-word-o" aria-hidden="true"></i>
	                                    		</a>
	                                    	</td>

                                    	@endif

	                                   	@if($order->status == "FINALIZADO")
	                                   		<td class="pull-left">
	                                    		<a href="../pedido/{{$order->id}}/pdf" target="_blank" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="LAUDO">
	                                    			<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
	                                    		</a>
	                                    </td>
	                                   	@endif

                                        <td class="pull-left">
                                                <a href="../../pedido/{{$order->id}}/retirada" target="_blank" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="COMPROVANTE DE RETIRADA">
                                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                </a>
                                        </td>

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

        <!-- financeiro -->
   <!--      <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Ações</h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            @forelse($orders as $order)
                                <th>
                                    <a href="../financeiro/{{$order->id}}/gerar"><button type="button" class="btn btn-outline btn-primary" title="CLIQUE PARA GERAR O FINANCEIRO">

                                        <i class="fa fa-usd" aria-hidden="true"> GERAR FINANCEIRO</i>

                                    </a>
                                </th>

                            <th>
                            @empty
                                <div class="alert alert-info">
                                    Nenhum Exame Encontrado.
                                </div>
                            @endforelse

                            </th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>


@endsection
