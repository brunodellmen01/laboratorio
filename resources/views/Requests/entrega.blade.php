@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Detalhes da Entrega
                    <a href="{{ url('pedido/listar') }}" class="pull-right">Voltar</a>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
						<div class="col-sm-12 m-b-xs">
                            <table class="table" id="myTable">
	                            <thead>
	                              <tr>
	                              	<th>PEDIDO</th>
	                                <th>PACIENTE</th>
	                                <th>PROTOCOLO</th>
	                                <th>ENTREGUE POR</th>
	                                <th>RETIRADO POR</th>
	                                <th>RETIRADO EM</th>
	                              </tr>
	                            </thead>
	                            <tbody>
	                                @foreach($orders as $order)
	                                  <tr>
	                                  	<td>{{$order->id}}</td>
	                                    <td>{{$order->patient->name}}</td>
	                                    <td>{{$order->protocol}}</td>
	                                    <td>{{$order->delivery_user}}</td>
	                                   	<td>{{$order->delivery_person}}</td>
	                                   	<td>
	                                   		<?php
$data = $order->updated_at;
echo date('d/m/Y H:m:s', strtotime($data));
?>
	                                   	</td>
	                                  </tr>
	                                  @endforeach
	                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
