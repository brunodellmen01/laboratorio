@extends('layouts.app')

@section('content')
@if(!empty(Session::get('foi')) && Session::get('foi') == "SIM")
<div class="alert alert-warning">
    foi
</div>
<script>
$(function() {
    $('#myModalFoi').modal('show');
});
</script>
@endif







    <title>Procedimentos Tabela TISS</title>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Procedimentos Adicionados
                        
                    </div>

                    <div class="panel-body">

                        
                        <div class="table-responsive">
									
                        
									<div class="col-sm-4 m-b-xs">                                        
                                        <a href="javascript:window.history.go(-1)" class="btn btn-sm btn-info">ADICIONAR</a>
                                    </div>

                                    <div class="col-sm-4 m-b-xs">                                        
                                        <a href="javascript:window.history.go(-2)" class="btn btn-sm btn-info">ADICIONAR APÓS DELETE</a>
                                    </div>

                                    <div class="col-sm-4 m-b-xs">

                                    	<a href="../../finalizar" class="btn btn-sm btn-info">FINALIZAR</a>
                                    	
                                    </div>
                                    
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                	<th>#</th>
                                    <th>CÓDIGO TUSS/TISS</th>
                                    <th>PROCEDIMENTO</th>
                                    <th>QTD</th>
                                    <th>VALOR</th>
                                    <th>AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody> 
                                	@forelse($adicionados as $adicionado) 
                                    <tr>
                                    	<td>{{$adicionado->id}}</td>
                                        <td>{{$adicionado->cod_termo}}</td>
                                        <td>{{$adicionado->procedimento}}</td>
                                        <td>{{$adicionado->qtd}}</td>
                                        <td>R$: {{$adicionado->valor_total}}</td>
                                        
                                        
                                   		<td>
                                   				{!! Form::open(['method' => 'POST', 'url' => '/historico/paciente/'.$id_paciente.'/tiss/'.$id_tiss.'/procedimentos/'.$adicionado->id_procedimento.'/remover']) !!}
	                                        		<button type="submit" class="btn btn-danger btn-md">
	                                        			<i class="fas fa-minus"></i>
	                                        		</button>
                                        		{!! Form::close() !!}
                                       		 
                                        </td>
                                    </tr> 
                                    @empty
                                    <tr>
                                    	<td>
                                    		<div class="alert alert-warning">
                                    			Nenhum registro encontrado.	
                                    		</div>
                                    	</td>
                                    </tr>
                                    @endforelse

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

    <!-- Modal caixa fechado -->
                    <div id="myModalFoi" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Operação Realizada Com Sucesso</h4>
                          </div>
                          <div class="modal-body">
                            <p>A Operação foi concluida com sucesso :).</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->



@endsection