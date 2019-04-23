@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pedidos Realizados no dia <?php echo date('d/m/Y'); ?>
                    <a href="{{ url('pedido') }}" class="pull-right">Novo Pedido</a>
                </div>

                <div class="panel-body">


                    <div class="table-responsive">

<div class="col-sm-12 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraLabEmail" onkeyup="filtraLabEmail()"> <span class="input-group-btn" name="filtraLabEmail" >
                                        <button type="button" class="btn btn-sm btn-info"> PROTOCOLO</button> </span></div>
                                    </div>

		                        <table class="table" id="myTable">
								    <thead>
								      <tr>
								        <th>PROTOCOLO</th>
								        <th>STATUS</th>
								        <th>RETIRADO POR</th>
								      </tr>
								    </thead>
								    <tbody>
								    	@foreach($pedidosHoje as $order)
								      		<tr>

										        <td class="pull-left">{{$order->protocol}}</td>
										        <td>{{$order->status}}</td>
										        <td class="pull-right">{{$order->delivery_person}}</td>
								      		</tr>
								      	@endforeach
								    </tbody>
		  						</table>
                          <div class="pull-right" >

                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
