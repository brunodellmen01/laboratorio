@extends('layouts.app')

@section('content')

@if(!empty(Session::get('enviado')) && Session::get('enviado') == "SIM")
<script>
$(function() {
    $('#myModalSim').modal('show');
});
</script>
@endif

@if(!empty(Session::get('enviado')) && Session::get('enviado') == "NAO")
<script>
$(function() {
    $('#myModalNao').modal('show');
});
</script>
@endif

@if(!empty(Session::get('entregue')) && Session::get('entregue') == "SIM")
<script>
$(function() {
    $('#myModalEntregueSim').modal('show');
});
</script>
@endif

@if(!empty(Session::get('entregue')) && Session::get('entregue') == "NAO")
<script>
$(function() {
    $('#myModalEntregueNao').modal('show');
});
</script>
@endif

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

            <div class="col-lg-12">

                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        @if(Request::is('*/internos'))
                            <h5>Lista de pedidos cadastrados Internamente</h5>
                            <a href="{{ url('/pedido') }}" class="pull-right btn btn-sm btn-info">NOVO</a>
                        
                         @endif

                        @if(Request::is('*/externos'))
                            <h5>Lista de pedidos cadastrados Externamente</h5>
                            <a href="{{ url('/pedido') }}" class="pull-right btn btn-sm btn-info">NOVO</a>
                        
                         @endif

                         @if(Request::is('*/listar'))
                            <h5>Lista de pedidos cadastrados</h5>
                            <a href="{{ url('/pedido') }}" class="pull-right btn btn-sm btn-info">NOVO</a>
                        
                         @endif
                        
                    </div>

                    <div class="ibox-content">


			<div class="row">
                                    <div class="col-sm-3 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="pedidoPaciente" onkeyup="pedidoPaciente()"> <span class="input-group-btn" name="pedidoPaciente" >
                                        <button type="button" class="btn btn-sm btn-info"> PACIENTE</button> </span></div>
                                    </div>

				    <div class="col-sm-3 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="pedidoStatus" onkeyup="pedidoStatus()"> <span class="input-group-btn" name="pedidoStatus" >
                                        <button type="button" class="btn btn-sm btn-info"> STATUS</button> </span></div>
                                    </div>

				   <div class="col-sm-3 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="pedidoMedico" onkeyup="pedidoMedico()"> <span class="input-group-btn" name="pedidoMedico" >
                                        <button type="button" class="btn btn-sm btn-info"> MÉDICO</button> </span></div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="pedidoProtocolo" onkeyup="pedidoProtocolo()"> <span class="input-group-btn" name="pedidoProtocolo" >
                                        <button type="button" class="btn btn-sm btn-info"> PROTOCOLO</button> </span></div>
                                    </div>
                                </div>


                        <div class="table-responsive">
                            <table class="footable table table-stripped" id="myTable">


                                <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Paciente</th>

                                    <th>Status</th>

                                    <th>Tipo</th>

                                    <th>Médico</th>

                                    <th>Protocolo</th>

                                    <th>Ações</th>

                                </tr>

                                </thead>

                                <tbody>

                                <tr>

                                    @foreach($orders as $order)
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->patient->name}}</td>
                                        <td>
                                            @if($order->status == "ENTREGUE")
                                                <a href="../pedido/detalhe/entrega/{{$order->id}}" class="btn btn-outline btn-info">ENTREGUE</a>
                                            @else
                                                <a data-toggle="modal" href="#myModalStatus{{$order->id}}" class="btn btn-link btn-outline">{{$order->status}}</a></td>
                                            @endif
                                        <td>{{$order->type}}</td>
                                        <td>{{$order->medic->name}}</td>
                                        <td>{{$order->protocol}}</td>




                                    <td>
                                          
                                        
                                            <!-- Modal -->
                                                <div id="myModalEntregar{{$order->id}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Entrega do Laudo Pedido Nº. {{$order->id}}</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <form action="../pedido/{{$order->id}}/status/entregar" method="post">
                                                         <p>
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <p>

                                                                        <input type="hidden" name="dia" value="<?php echo date('d/m/Y'); ?>">

                                                                        <input type="hidden" name="hora" value="<?php echo date('H:m:s'); ?>">

                                                                        <input type="hidden" name="funcionario" value="{{ Auth::user()->name }}">

                                                                        <select class="form-control" name="tiradoPor" required>
                                                                          <option value="">SELECIONAR...</option>
                                                                          <optgroup label="PACIENTE" >
                                                                            <option value="PACIENTE">{{$order->patient->name}}</option>
                                                                          </optgroup>
                                                                          <optgroup label="PESSOAS AUTORIZADAS" data-max-options="2">
                                                                            @foreach($autorizados as $autorizado)

                                                                            <option value="{{$autorizado->name}}">{{$autorizado->name}}</option>

                                                                                @endforeach
                                                                          </optgroup>
                                                                        </select>

                                                                    </p>
                                                                </div>


                                                            </div>


                                                                    </p>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p class="pull-right">
                                                                        <button type="submit" class="btn btn-outline btn-info">ENTREGAR</button>

                                                                    </p>
                                                                        </div>
                                                                    </div>
                                                            </form>

                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>

                                                <!-- Modal -->
                                                <div id="myModalStatus{{$order->id}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Novo Status Para o Pedido Nº. {{$order->id}}</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <form action="../pedido/{{$order->id}}/status/novo" method="post">
                                                         <p>
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <select class="form-control" name="status" required>
                                                                            <option value=""> SELECIONE O NOVO STATUS</option>

                                                                            <option value="EM ANALISE"> EM ANALISE</option>
                                                                            <option value="FINALIZADO"> FINALIZADO </option>

                                                                        </select>
                                                                    </p>
                                                                    <p class="pull-left">
                                                                        Status atual: <b>{{$order->status}}</b>
                                                                    </p>
                                                                    <p class="pull-right">
                                                                        <button type="submit" class="btn btn-outline btn-primary">SALVAR</button>

                                                                    </p>
                                                                    <br>
                                                            </form>

                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>


                                        <a data-toggle="modal" href="#myModal{{$order->id}}" class="btn btn-outline btn-info">AÇÕES</a>
                                        <!-- Modal -->
                                            <div id="myModal{{$order->id}}" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Pedido Nº. {{$order->id}}</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                @if($order->status == "ENTREGUE")
                                                                <p>
                                                                    <button class="btn btn-outline btn-info" disabled="" data-toggle="tooltip" data-placement="bottom" title="RESULTADO" target="_blank" >
                                                                        <br>
                                                                        <i class="fa fa-address-book fa-5x"></i>
                                                                        <br><br>RESULTADO
                                                                    </button>
                                                                </p>
                                                                @else
                                                                    <a href="../pedido/{{$order->id}}/laudo" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="RESULTADO" target="_blank" >
                                                                        <br>
                                                                        <i class="fa fa-address-book fa-5x"></i>
                                                                        <br><br>RESULTADO
                                                                    </a>
                                                                @endif

                                                            </div>

                                                            <div class="col-md-3">

                                                                <p>
                                                                    <a href="../pedido/{{$order->id}}/pdf" target="_blank" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="IMPRIMIR">
                                                                        <br>
                                                                        <i class="fa fa-print fa-5x"></i>
                                                                        <br><br>IMPRIMIR
                                                                    </a>
                                                                </p>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <p>
                                                                    <a href="../pedidos/{{$order->id}}/detalhes" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="VISUALIZAR" target="_blank" >
                                                                        <br>
                                                                        <i class="fa fa-eye fa-5x"></i>
                                                                        <br><br>DETALHES
                                                                    </a>
                                                                </p>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <p>
                                                                    @if(Auth::user()->nivel == "AVANÇADO")
                                                                        <a href="../financeiros/pedido/{{$order->id}}/visualizar" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="FINANCEIRO" target="_blank" >
                                                                            <br>
                                                                            <i class="fa fa-credit-card fa-5x"></i>
                                                                            <br><br>FINANCEIRO
                                                                        </a>
                                                                    @else
                                                                        <a href="#myModalSemAcesso" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="FINANCEIRO" target="_blank" >
                                                                            <br>
                                                                            <i class="fa fa-credit-card fa-5x"></i>
                                                                            <br><br>FINANCEIRO
                                                                        </a>
                                                                    @endif
                                                                </p>

                                                            </div>

                                                            <div class="col-md-12">

                                                                <p>
                                                                    <a href="../pedidos/{{$order->id}}/retirada" class="btn btn-outline btn-info btn-block" target="_blank" data-toggle="tooltip" data-placement="bottom" title="COMPROVANTE DE RETIRADA">
                                                                        <br>
                                                                        <i class="far fa-file-alt fa-5x"></i>
                                                                        <br><br>RETIRADA
                                                                    </a>
                                                                </p>

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

                                    </td>
                                    <td>
                                    @if($order->status == "ENTREGUE")
                                        <button class="btn btn-outline btn-info" disabled="">ENTREGAR</button>
                                    @else
                                            <a data-toggle="modal" href="#myModalEntregar{{$order->id}}" class="btn btn-outline btn-info">ENTREGAR</a>
                                    @endif
                                    </td>
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

    <!-- Modal caixa fechado -->
                    <div id="myModalSim" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Status Auterado Com Sucesso</h4>
                          </div>
                          <div class="modal-body">
                            <p>Um novo status foi atribuido ao pedido, assim como uma notificação via e-mail para o paciente.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                    <!-- Modal caixa fechado -->
                    <div id="myModalNao" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Status Auterado Com Sucesso</h4>
                          </div>
                          <div class="modal-body">
                            <p>O status do pedido foi auterado com sucesso, porem não foi possivel enviar o email para o paciente. Provavelmente o mesmo não possui um e-mail cadastrado.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                      <!-- Modal caixa fechado -->
                    <div id="myModalEntregueSim" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Laudo Entregue</h4>
                          </div>
                          <div class="modal-body">
                            <p>O Laudo foi entregue com sucesso. Uma notificação foi enviada para o paciente.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                    <!-- Modal caixa fechado -->
                    <div id="myModalEntregueNao" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Laudo Entregue</h4>
                          </div>
                          <div class="modal-body">
                            <p>O laudo foi entregue com sucesso, porem não foi possivel enviar o email para o paciente. Provavelmente o mesmo não possui um e-mail cadastrado.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->





@endsection
