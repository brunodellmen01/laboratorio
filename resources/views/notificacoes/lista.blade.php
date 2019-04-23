@extends('layouts.app')

@section('content')
<title>Listagem de Métodos</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Central de Notificações
                </div>

                <div class="panel-body">

                    <?php if (array_key_exists("certo", $_GET) && $_GET['certo'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>
                    <div class="table-responsive">
                    	<div class="row">
                    		<div class="col-md-4">
                    			<span class="label label-info">
                    				Total de Notificações: {{$total}}
                    			</span>
                    		</div>
                    		<div class="col-md-4">
                    			<span class="label label-success">
                    				Notificações Enviadas: {{$enviado}}
                    			</span>
                    		</div>
                    		<div class="col-md-4">
                    			<span class="label label-danger">
                    				Notificações Não Enviadas: {{$naoEnviado}}
                    			</span>
                    		</div>
                    	</div>

                    	<hr>
                    	
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>ASSUNTO</th>
                                <th>DESTINO</th>
                                <th>DIA</th>
                                <th>STATUS</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($notificacoes as $notificacao)
                                  <tr>
                                    <td class="pull-left">{{ $notificacao->subject }}</td>
                                    <td>{{ $notificacao->destination }}</td>
                                    <td>
                                    	<?php
   					   						$data = $notificacao->created_at;
					   						echo date('d/m/Y H:m:s', strtotime($data));
                                        ?>
                                    </td>
                                    @if($notificacao->status == "NÃO ENVIADO")
                                    	<td>
                                            <button type="button" data-toggle="modal" data-target="#myModal{{ $notificacao->id }}" class="btn btn-default label-danger"><i class="fa fa-times-circle" ></i></button>
                                        </td>
                                    @else
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#myModal{{ $notificacao->id }}" class="btn btn-default label-info"><i class="fa fa-check-circle-o" ></i></button>
                                        </td>
                                    	
                                    @endif

                                    <!-- modal -->
                                    <div id="myModal{{ $notificacao->id }}" class="modal fade" role="dialog">
									  <div class="modal-dialog modal-lg">

									    <!-- Modal content-->
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal">&times;</button>
									        <h4 class="modal-title">Detalhes</h4>
									      </div>
									      <div class="modal-body">
									        
									        <p>
									        	<textarea class="form-control" rows="6" name="description" readonly="">
									        		{{$notificacao->description}}
									        	</textarea>
									        	
									        </p>
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
									      </div>
									    </div>

									  </div>
									</div>
									 <!-- modal -->
                                    

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
