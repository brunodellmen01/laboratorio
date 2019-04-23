@extends('layouts.app')

@section('content')


@if(!empty(Session::get('parcela')) && Session::get('parcela') == "SIM")
<div class="alert alert-info">
teste
</div>
<script>
$(function() {
    $('#myModalParcela').modal('show');
});
</script>
@endif

@if(!empty(Session::get('parcela')) && Session::get('parcela') == "NAO")
<div class="alert alert-danger">
teste NAO
</div>
<script>
$(function() {
    $('#myModalParcela').modal('show');
});
</script>
@endif

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pedido Realizado Com Sucesso. </h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Paciente</th>
                            <th>Médico</th>
                            <th>Retirar Em</th>
                            <th>Forma Pgto</th>
                            <th>Tipo</th>
                            <th>Clínica</th>
                            <th>Protocolo</th>


                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse($orders as $order)
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->patient->name}}</td>
                                    <td>{{$order->medic->name}}</td>
                                    <td>
                                        <?php
						$data = $order->date;
						echo date('d/m/Y', strtotime($data)); 
					?>
                                    </td>


                                    <td>{{$order->date}}</td>
                                    <td>{{$order->states_id}}</td>
                                    <td>{{$order->type}}</td>
                                    <td>{{$order->clinic->name}}</td>
                                    <td>{{$order->protocol}}</td>
                            </tr>
                            @empty
                                <div class="alert alert-info">
                                    Nenhum Pedido Encontrado.
                                </div>

                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- exames -->
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Exames</h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            @forelse($orderArticles as $orderArticle)
                                <td>{{$orderArticle->exam->name}}</td>
                                <td>R$: {{$orderArticle->price}}</td>
                        </tr>
                        @empty
                            <div class="alert alert-info">
                                Nenhum Exame Encontrado.
                            </div>
                        @endforelse
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- exames -->
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Total</h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>Valor</th>

                                <th>R$: {{$prices}}</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- financeiro -->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Financeiro</h5>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            @forelse($orders as $order)
                                <th>
                                    <a href="../../financeiros/pedido/{{$order->id}}/visualizar"><button type="button" class="btn btn-outline btn-info" title="CLIQUE PARA GERAR O FINANCEIRO">

                                        <i class="fa fa-usd" aria-hidden="true"> VER FINANCEIRO</i>

                                    </a>
                                </th>

                                <th>
                                    <a href="../financeiro/{{$order->id}}/gerar"><button type="button" class="btn btn-outline btn-info" title="CLIQUE PARA GERAR O FINANCEIRO">
                                        <i class="fa fa-usd" aria-hidden="true"> GERAR PARCELAS</i>
                                    </a>
                                </th>

                            <th>
                            @empty
                                <div class="alert alert-info">
                                    Nenhum Exame Encontrado.
                                </div>
                            @endforelse

                            </th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Fechar-->
                    <div id="myModalParcela" class="modal fade" role="dialog" data-backdrop="static">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Pedido Realizado Com Sucesso </h4>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="../financeiro/caixa/fechar">

                                <p>Para gerar as parcelas deste pedido, click no botão abaixo.</p>
                                @forelse($orders as $order)
                                <p>
                                    <a href="../../financeiros/{{$order->id}}/gerar"><button type="button" class="btn btn-outline btn-primary" title="CLIQUE PARA GERAR O FINANCEIRO">
                                        <i class="fa fa-usd" aria-hidden="true"> GERAR PARCELAS</i>
                                    </a>
                                @empty
                                <div class="alert alert-info">
                                    Nenhum Exame Encontrado.
                                </div>
                                @endforelse
                            </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-default">FECHAR</button>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal Fechar-->


    </div>
</div>




@endsection
