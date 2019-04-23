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

	        	@forelse($inativos as $inativo)
		        	<div class="col-md-3">
	                    <div class="ibox-content text-center">
	                        <h1></h1>
	                	    <div class="m-b-sm">

	                    	    <img src="{{asset('images/uploads/profile/').'/'.$inativo->id}}/{{$inativo->image}}" width="96" height="96" class="img-circle"  data-toggle="tooltip" data-placement="top" title="{{$inativo->name}}">
	                        </div>
	                        <p class="font-bold">{{$inativo->name}}</p>
	                        <div class="text-center">
	                            <a href="../ativar/{{$inativo->id}}" class="btn btn-xs btn-white"" data-toggle="tooltip" data-placement="bottom" title="Ativar / Inativar {{$inativo->name}}"><i class="fa fa-unlock-alt"></i> Ativar / Inativar </a>
	                        </div>
		                </div>
	                </div>
                @empty
                	<div class="col-md-12">
	                    <div class="ibox-content text-center">
	                        <h1></h1>
	                	    <div class="m-b-sm">
                           <i class="fas fa-user-times fa-5x"></i>
	                    	   
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

        			<!-- Modal caixa fechado -->
                    <div id="myModalAtivado" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Usuário Ativo.</h4>
                          </div>
                          <div class="modal-body">
                            <p>O Usuário foi ativo com sucesso. Lembre-se, agora ele poderá ter acesso ao sistema.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                    <!-- Modal caixa fechado -->
                    <div id="myModalDesativado" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Usuário Desativado.</h4>
                          </div>
                          <div class="modal-body">
                            <p>O Usuário foi desaativado com sucesso. Lembre-se, você pode ativa-lo a qualquer momento.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->


                    <!-- Modal caixa fechado -->
                    <div id="myModalNaoDisponivel" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Módulo Não Disponiel.</h4>
                          </div>
                          <div class="modal-body">
                            <p>Desculpe, este módulo não esta disponível no momento pois ele se encontra em desenvolvimento.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

@endsection