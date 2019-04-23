
@extends('layouts.app')

@section('content')

@foreach($resultadoss as $resultado)

@endforeach

@if(!empty(Session::get('campoVazio')) && Session::get('campoVazio') == "SIM")
<script>
$(function() {
    $('#myModalVazio').modal('show');
});
</script>
@endif


    <title>Listagem de Itens do Pedidos</title>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Informe os Resultados

                    </div>

                    <div class="panel-body">


                        <div class="table-responsive">
                            <table class="footable table table-stripped table-hover" data-page-size="8" data-filter=#filter>

                                <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>EXAME</th>
                                    <th>NOVO RES.</th>
                                    <th>REF.</th>
                                    <th>RESULTADO</th>

                                </tr>

                                </thead>

                                <tbody>

                                <tr>


                                    @foreach($resultadoss as $resultado)

                                    	<td>{{$resultado->id}} </td>

                                        <td>{{$resultado->description}}</td>



                                        <td>
                                        	<!-- <form action="../{{$resultado->exam_id}}/resultado" method="post"> -->
                                        	{!! Form::open(['url' => '/pedido/'.$resultado->id.'/laudo/'.$resultado->exam_id.'/resultado', 'method' => 'post']) !!}


                                                <input type="text" name="price[]" value="{{$resultado->price}}" class="form-control"  onClick="this.value=''">


                                                    {!! Form::input('hidden', 'order_article_id', $id_pedido, ['class' => 'form-control', 'placeholder' => 'PEDIDO', 'value' => '{{$resultado->order_article_id}}'])!!}



                                                {!! Form::input('hidden', 'description', $resultado->description, ['class' => 'form-control', 'placeholder' => 'DESCRIÇÃO', 'value' => '{{$resultado->description}}'])!!}

                                                {!! Form::input('hidden', 'category_id', $resultado->category_id, ['class' => 'form-control', 'placeholder' => 'TIPO', 'value' => '{{$resultado->description}}'])!!}

                                                {!! Form::input('hidden', 'reference', $resultado->reference, ['class' => 'form-control', 'placeholder' => 'REFERENCIA', 'value' => '{{$resultado->reference}}'])!!}

                                                {!! Form::input('hidden', 'exam_id', $resultado->exam_id, ['class' => 'form-control', 'placeholder' => 'EXAME', 'value' => '{{$resultado->exam_id}}'])!!}

                                        		<!-- <input type="text" name="result" class="form-control" > -->
                                        </td>


                                        <td>{{$resultado->reference}}</td>
                                        <td>{{$resultado->price}}</td>
                                </tr>
                                @endforeach

                                </tbody>

                            </table>
                            <div class="pull-left" >

                            </div>
                            <div class="pull-right" >
                            		<!-- <button class="btn btn-outline btn-primary" onclick='marcardesmarcar();'>SALVAR</button> -->
                                	{!! Form::submit('SALVAR', ['class' => 'btn btn-outline btn-info pull-left'])!!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
                <div id="myModalVazio" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirma Enviar resultados com campo(s) vazios?</h4>
                      </div>
                      <div class="modal-body">
                        <p>Há campo(s) vazio(s). Deseja informa-los mesmo assim?</p>
                        <form action="?continua" method="post">
                            <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                            <input type="hidden" name="sim" value="sim">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">SIM</button>
                                        </td>
                                        <td>
                                            <input type="hidden" name="nao" value="nao">
                                            <button type="button" class="btn btn-default">NÃO</button>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                      </div>
                    </div>

                  </div>
                </div>

    <script>
    function marcardesmarcar() {
    $('.marcar').each(function () {
        if (this.checked) $(this).attr("checked", false);
        else $(this).prop("checked", true);
    });
}
</script>

@endsection