@extends('layouts.app')

@section('content')
<title>Listagem de Convênios</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Chamados
                    <a href="{{ url('chamados') }}" class="pull-right">Novo Chamado</a>
                </div>

                <div class="panel-body">

                    <?php if (array_key_exists("certo", $_GET) && $_GET['certo'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>
                    <div class="table-responsive">
<div class="col-md-4 m-b-xs pull-right">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraChamadoProtocolo" onkeyup="filtraChamadoProtocolo()"> <span class="input-group-btn" name="filtraChamadoProtocolo" >
                                        <button type="button" class="btn btn-sm btn-info"> PROTOCOLO</button> </span></div>
                                    </div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>TITULO</th>
                                <th>NÍVEL</th>
                                <th>TIPO</th>
                                <th>PROTOCOLO</th>
                                <th>STATUS</th>
                                <th>ACOMPANHAR</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($chamados as $chamado)
                                  <tr>
	                                   <td class="pull-left">
	                                   		<a data-toggle="modal" href="#myModalMensagem{{ $chamado->id }}">{{ $chamado->title }}</a>
	                                   	</td>
	                                   <td >{{ $chamado->level }}</td>
	                                   <td >{{ $chamado->type }}</td>
	                                   <td >{{ $chamado->protocol }}</td>
	                                   <td >{{ $chamado->status }}</td>
	                                   <td ><button type="button" data-toggle="modal" data-target="#myModalDetalhe{{ $chamado->id }}" class="btn btn-outline btn-info">DETALHES</button></td>
	                                   <!-- Modal caixa fechado -->
					                    <div id="myModalMensagem{{ $chamado->id }}" class="modal fade" role="dialog">
					                      <div class="modal-dialog">
					                        <!-- Modal content-->
					                        <div class="modal-content">
					                          <div class="modal-header">
					                            <button type="button" class="close" data-dismiss="modal">&times;</button>
					                            <h4 class="modal-title">Chamado Protocolo Nº {{ $chamado->protocol }}</h4>
					                          </div>
					                          <div class="modal-body">
					                            <p>
					                            	<textarea name="message" rows="6" placeholder="SUA MENSAGEM" class="form-control" readonly=""><?php echo $chamado->message; ?></textarea>
					                            </p>
					                            <p>
					                            	<input type="text" name="url" class="form-control" value="{{ $chamado->url }}" readonly="">
					                            </p>
					                          </div>
					                          <div class="modal-footer">
					                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
					                          </div>
					                        </div>

					                      </div>
					                    </div>
					                    <!-- Modal caixa fechado -->

					                    <!-- Modal caixa detalhe -->
					                    <div id="myModalDetalhe{{ $chamado->id }}" class="modal fade" role="dialog">
					                      <div class="modal-dialog">
					                        <!-- Modal content-->
					                        <div class="modal-content">
					                          <div class="modal-header">
					                            <button type="button" class="close" data-dismiss="modal">&times;</button>
					                            <h4 class="modal-title">Resposta ao Chamado Protocolo Nº {{ $chamado->protocol }}</h4>
					                          </div>
					                          <div class="modal-body">
					                            <p>
					                            	<textarea name="message" rows="8" placeholder="RESPOSTA DO TIME DE SUPORTE" class="form-control" readonly=""></textarea>
					                            </p>

					                          </div>
					                          <div class="modal-footer">
					                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
					                          </div>
					                        </div>

					                      </div>
					                    </div>
					                    <!-- Modal caixa detalhe -->

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
