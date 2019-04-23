@extends('layouts.app')

@section('content')



<div class="wrapper wrapper-content">


         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>VOCÊ TEM UM TOTAL DE {{$totalPaga}} PARCELAS A PAGAR HOJE, TOTALIZANDO R$: {{$total}}</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
<div class="col-sm-6 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPagaPedido" onkeyup="filtraPagaPedido()"> <span 		class="input-group-btn" name="filtraPagaPedido" >
       <button type="button" class="btn btn-sm btn-info"> PEDIDO</button> </span>
     </div>
</div>

<div class="col-sm-6 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPagaValor" onkeyup="filtraPagaValor()"> <span 		class="input-group-btn" name="filtraPagaValor" >
       <button type="button" class="btn btn-sm btn-info"> VALOR</button> </span>
     </div>
</div>
                                    <table class="table table-striped" id="myTables">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PEDIDO</th>
                                            <th>VALOR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($contaPagar as $cPagar)
                                                    <td>{{$cPagar->id}}</td>
                                                    <td>{{$cPagar->order_id}}</td>
                                                    <td>R$: {{$cPagar->price_parcel}}</td>
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


                    </div>

@endsection
