@extends('layouts.app')

@section('content')

@if(!empty(Session::get('enviado')) && Session::get('enviado') == "SIM")
<div class="alert alert-success">
  <strong>Notificação Enviada.</strong> O Paciente foi notificado.
</div>
@endif

@if(!empty(Session::get('enviado')) && Session::get('enviado') == "NAO")
<div class="alert alert-danger">
  <strong>Notificação Não Enviada.</strong> Ocorreu um Erro ao Enviar Notificação. Tente Novamente Mais Tarde.
</div>
@endif


<div class="wrapper wrapper-content">


         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>VOCÊ TEM UM TOTAL DE {{$totalRecebe}} PARCELAS VENCIDAS, TOTALIZANDO R$: {{$total}}</h5>

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
                                            <th>PARCELA</th>
                                            <th>PEDIDO</th>
                                            <th>VALOR</th>
                                            <th>VENCIMENTO</th>
                                            <th>PACIENTE</th>
                                            <th>AÇÕES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($contaReceber as $cReceber)
                                                    <td>{{$cReceber->id}}</td>
                                                    <td>{{$cReceber->order_id}}</td>
                                                    <td>R$: {{$cReceber->price_parcel}}</td>
                                                    <td>
                                                    	<?php
$data = $cReceber->venc;
echo date('d/m/Y', strtotime($data));
?>
                                                    </td>
                                                    @foreach($nomePaciente as $paciente)
                                                    <td>{{$paciente->name}}</td>
                                                    @endforeach
                                                    @if($paciente->email == "")
                                                    	<td>
                                                    		<a data-toggle="modal" href="#myModalSemEmail" class="btn btn-outline btn-info pull-right">COBRAR</a>
                                                    	</td>
                                                    @else

                                                    <td>
                                                    	<a data-toggle="modal" href="#myModal{{$cReceber->id}}" class="btn btn-outline btn-info pull-right">COBRAR</a>

                                                    <!-- Modal cobrar -->
													<div id="myModal{{$cReceber->id}}" class="modal fade" role="dialog">
													  <div class="modal-dialog">

													    <!-- Modal content-->
													    <div class="modal-content">
													      <div class="modal-header">
													        <button type="button" class="close" data-dismiss="modal">&times;</button>
													        <h4 class="modal-title">Aviso de Cobrança Para {{$paciente->name}}</h4>
													      </div>
													      <div class="modal-body">
													        <p>Confira abaixo a mensagem que será enviada ao senhor(a) {{$paciente->name}}.</p>
													        {!! Form::open(['url' => 'relatorios/contas-vencidas/notificar', 'method' => 'POST']) !!}
													        <p>
													        	<input type="hidden" name="email" value="{{$paciente->email}}">

													        	<input type="hidden" name="paciente" value="{{$paciente->name}}">

													        	<textarea class="form-control" rows="5" id="comment" name="mensagem">{{$paciente->name}}, tudo em ordem para o pagamento? Estamos alguns dias atrasados pelo que vi aqui, me avise se houver algum problema.  	</textarea>
													        </p>
													        <p>
													        	Caso prefira pode enviar um SMS ou realizar uma ligação. O telefone é {{$paciente->phone}}.
													        </p>
													      </div>
													      <div class="modal-footer">
													        <button class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom"  title="ENVIAR COBRANÇA">

                                                                		ENVIAR

                                                                	</button>
													    {!! Form::close() !!}
													      </div>
													    </div>

													  </div>
													</div>
                                                    </td>
                                                    @endif


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



                 <!-- Modal cobrar -->
													<div id="myModalSemEmail" class="modal fade" role="dialog">
													  <div class="modal-dialog">

													    <!-- Modal content-->
													    <div class="modal-content">
													      <div class="modal-header">
													        <button type="button" class="close" data-dismiss="modal">&times;</button>
													        <h4 class="modal-title">Aviso de Cobrança Para {{$paciente->name}}</h4>
													      </div>
													      <div class="modal-body">
													        <p>
													        	Não é possivel enviar cobrança para o senhor {{$paciente->name}}, pois o mesmo não possui e-mail cadastrado.
													        </p>
													        <p>
													        	Para notificar este paciente, insira o e-mail do mesmo.
													        </p>

													      </div>
													      <div class="modal-footer">
													        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
													      </div>
													    </div>

													  </div>
													</div>




@endsection
