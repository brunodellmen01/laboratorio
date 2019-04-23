@extends('layouts.app')

@section('content')

@if(!empty(Session::get('ativado')) && Session::get('ativado') == "SIM")
<script>
$(function() {
    $('#myModalAtivado').modal('show');
});
</script>
@endif

@if(!empty(Session::get('desativado')) && Session::get('desativado') == "SIM")
<script>
$(function() {
    $('#myModalDesativado').modal('show');
});
</script>
@endif

        <div class="wrapper wrapper-content">
        	
	        <div class="row">

	        	@forelse($ativos as $ativo)
		        	<div class="col-md-3">
	                    <div class="ibox-content text-center">
	                        <h1></h1>
	                	    <div class="m-b-sm">

	                    	    <img src="{{asset('images/uploads/profile/').'/'.$ativo->id}}/{{$ativo->image}}" width="96" height="96" class="img-circle"  data-toggle="tooltip" data-placement="top" title="{{$ativo->name}}">
	                        </div>
	                        <p class="font-bold">{{$ativo->name}}</p>
	                        <div class="text-center">
	                        	<a data-toggle="modal" href="#myModal{{$ativo->id}}" class="btn btn-xs btn-white"" data-toggle="tooltip" data-placement="bottom" title="Ver Detalhes "><i class="fa fa-eye"></i> Ver Detalhes </a>
	                        </div>
		                </div>
	                </div>

	                <!-- Modal caixa fechado -->
                    <div id="myModal{{$ativo->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Dados Do Usuário {{$ativo->name}}</h4>
                          </div>
                          <div class="modal-body">
                            <p>
                            	<div class="row">
                            		
                            		<div class="col-md-12">
                            			<img src="{{asset('images/uploads/profile/').'/'.$ativo->id}}/{{$ativo->image}}" width="96" height="96" class="img-circle"  data-toggle="tooltip" data-placement="top" title="{{$ativo->name}}">
                            		</div>

                            		<div class="col-md-12">
                            			<div class="table-responsive">
	                            			<table class="table">
											    <thead>
											      <tr>
											        <th>NOME</th>
											        <th>NIVEL</th>
											        <th>ULTIMO LOGIN</th>
											        <th>STATUS</th>
											      </tr>
											    </thead>
											    <tbody>
											      <tr>
											        <td>{{$ativo->name}}</td>
											        <td>{{$ativo->nivel}}</td>
											        <td>{{$ativo->last_login}}</td>
											        @if($ativo->loged == '1')
			                            				<td>
			                            					<span class="label label-info">ONLINE</span>
			                            				</td>
		                            				@else
			                            				<td>
			                            					<span class="label label-default">OFFLINE</span>
			                            				</td>		                            				
		                            				@endif	
											      </tr>
											    </tbody>
											  </table>
										</div>                            			
                            		</div>

                            	</div>
                            </p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                @empty
                	<div class="col-md-12">
	                    <div class="ibox-content text-center">
	                        <h1></h1>
	                	    <div class="m-b-sm">
	                    	   <i class="fa fa-picture-o fa-5x"></i>

	                        </div>
	                        <p class="font-bold">Não foi locaizado nenhum usuário inativo no sistema.</p>
	                        <div class="text-center">
	                            <a href="{{ url('/home') }}" class="btn btn-xs btn-white"><i class="fa fa-home"></i> Voltar Para o Início </a>
	                            
	                        </div>
		                </div>
                	</div>
                @endforelse
	        </div>
        </div>

        			

                   

@endsection
