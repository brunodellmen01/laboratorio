@extends('layouts.app')

@section('content')



<div class="wrapper wrapper-content">


         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>VOCÊ TEM UM TOTAL DE {{$totalRecebe}} PARCELAS A RECEBER HOJE, TOTALIZANDO R$: {{$total}}</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
<div class="col-sm-6 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraRecebePedido" onkeyup="filtraRecebePedido()"> <span 		class="input-group-btn" name="filtraRecebePedido" >
       <button type="button" class="btn btn-sm btn-info"> PEDIDO</button> </span>
     </div>
</div>

<div class="col-sm-6 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraRecebeValor" onkeyup="filtraRecebeValor()"> <span 		class="input-group-btn" name="filtraRecebeValor" >
       <button type="button" class="btn btn-sm btn-info"> VALOR</button> </span>
     </div>
</div>
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PEDIDO</th>
                                            <th>VALOR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($contaReceber as $cReceber)
                                                    <td>{{$cReceber->id}}</td>
                                                    <td>{{$cReceber->order_id}}</td>
                                                    <td>R$: {{$cReceber->price_parcel}}</td>
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
