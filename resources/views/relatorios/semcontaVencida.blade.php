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
	              <h5>VOCÊ NÃO TEM PARCELAS VENCIDAS.</h5>

            </div>
            <div class="ibox-content">
                <div class="table-responsive">
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
                                <td colspan="6">Nenhuma Parcela Vencida</td>
                            </tr>
                        </tbody>
                    </table>
            	    <div class="text-center" ></div>
	       		</div>
    		</div>
		</div>
    </div>
</div>







@endsection
