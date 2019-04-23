@extends('layouts.app')

@section('content')
@if(!empty(Session::get('inserido')) && Session::get('inserido') == "SIM")
<script>
	$(function() {
    	$('#myModalInserido').modal('show');
	});
</script>
@endif

@if(!empty(Session::get('removido')) && Session::get('removido') == "SIM")
<script>	
	$(function() {
    	window.setTimeout("history.back(-2)", 1000);
    	//window.location.reload();
	});
</script>
@endif


    <title>Procedimentos Tabela TISS</title>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Procedimentos Tabela TISS
                        
                    </div>

                    <div class="panel-body">

                        
                        <div class="table-responsive">
									<div class="col-sm-6 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraProcedimentoTUSSId" onkeyup="filtraProcedimentoTUSSId()"> <span class="input-group-btn" name="filtraProcedimentoTUSSId" >
                                        <button type="button" class="btn btn-sm btn-info"> CÓDIGO TUSS</button> </span></div>
                                    </div>
                        
									<div class="col-sm-6 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraProcedimentoTUSS" onkeyup="filtraProcedimentoTUSS()"> <span class="input-group-btn" name="filtraProcedimentoTUSS" >
                                        <button type="button" class="btn btn-sm btn-info"> PROCEDIMENTO</button> </span></div>
                                    </div>

                                    <div class="col-sm-3 m-b-xs">
                                        <a href="javascript:window.history.go(-1)" class="btn btn-sm btn-info">VOLTAR</a>
                                        
                                    </div>

                                    
                                    
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                	<th>#</th>
                                    <th>TISS</th>
                                    <th>PROCED.</th>
                                    <th>TABELA</th>
                                    <th>QTD</th>
                                    <th>VALOR</th>
                                    <th>AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody> 
                                	@forelse($procedimentos as $procedimento)


                                    <tr>                                    	
                                    	<td>{{$procedimento->id}}</td>
                                    	<td>{{$procedimento->id_procedimento}}</td>
                                        <td>{{$procedimento->cod_termo}}</td>
                                        <td>{{$procedimento->termo}}</td>
                                        <td>{{$procedimento->numero_tabela}}</td>
                                        
                                        <td>
                                        	
                                        	{!! Form::open(['method' => 'POST', 'url' => '/historico/paciente/'.$id_paciente.'/tiss/'.$guia.'/procedimentos/'.$procedimento->id.'/adicionar']) !!}

                                        	<input type="number" name="qtd" value="1" class="form-control" minlength="1">
                                        </td>

                                        <td>
                                        	<input type="text" name="valor" value="00.00" class="form-control">
                                        	<input type="hidden" name="id_procedimento" value="<?php echo $procedimento->id;?>">
                                        		<input type="hidden" name="id_paciente" value="<?php echo $id_paciente;?>">
                                        		<input type="hidden" name="paciente" value="<?php echo $nome_paciente;?>">
                                        		<input type="hidden" name="id_tiss" value="<?php echo $guia;?>">
                                        		<input type="hidden" name="procedimento" value="<?php echo $procedimento->termo;?>">
                                        		<input type="hidden" name="cod_termo" value="<?php echo $procedimento->cod_termo;?>">
                                        		<input type="hidden" name="numero_tabela" value="<?php echo $procedimento->numero_tabela;?>">
                                        </td>

                                   		<td>
                                   				
                                        		

                                        		<button type="submit" class="btn btn-info btn-md">
                                        			<i class="fas fa-plus-circle"></i>
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
                    <div id="myModalInserido" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Procedimento Inserido Com Sucesso</h4>
                          </div>
                          <div class="modal-body">
                            <p>O Procedimento foi inserido com sucesso na guia.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->



@endsection