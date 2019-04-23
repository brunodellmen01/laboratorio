@extends('layouts.app')

@section('content')
@if(!empty(Session::get('salvo')) && Session::get('salvo') == "SIM")
<script>
$(function() {
    $('#myModalSalvo').modal('show');
});
</script>
@endif

@if(!empty(Session::get('salvo')) && Session::get('salvo') == "NAO")
<script>
$(function() {
    $('#myModalNSalvo').modal('show');
});
</script>
@endif


@foreach($pacientes as $paciente)

@endforeach

<?php

//calcula a idade em Anos, dias e meses
$data_nasc = $paciente->dt_birth;
function calc_idade($data_nasc) {
	// formato da data yyyy-mm-dd
	$date = new DateTime($data_nasc);
	$interval = $date->diff(new DateTime(date("Y-m-d")));
	return $interval->format('%Y Anos, %m Meses e %d Dias');
}
$data_nasc = $data_nasc;
$idade = calc_idade($data_nasc);
$idade1 = "" . $idade;

?>

<div class="row">
     

        <div class="col-md-2">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><a data-toggle="modal" href="#myModalCarteirinha">CARTEIRINHA</a></span>

                    <h5>FOTO</h5>

                </div>

                <div class="ibox-content">
                    @if($paciente->image <> "sem-foto.png")                    
                        <img src="{{asset('images/uploads/pacientes/').'/'.$paciente->id}}/{{$paciente->image}}" width="90" height="90" class="img-responsive thumbnail circle"> 
                    @else
                        <img src="{{asset('images/uploads/pacientes/sem-foto.png')}}" width="80" height="80" class="img-responsive thumbnail center circle">
                    @endif

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-md-10">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5>
                    	
                    	@foreach($pacientes as $paciente)
                    		<b>{{ $paciente->name }}</b>
                    	@endforeach
                    </h5>

                </div>

                <div class="ibox-content">

                    <div class="table-responsive">

                        <table class="table">
                                <thead>
                                <tr>
                                    
                                    <th>NASC.</th>
                                    <th>IDADE</th>
                                    <th>ENDEREÇO</th>
                                    <th>CIDADE</th>
                                    <th>SEXO</th>
                                    <th>ULTIMO PEDIDO</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pacientes as $paciente)
                                    <tr>
                                        
                                        <td>

                                            <?php
$receive2 = $paciente->dt_birth;
echo date('d/m/Y', strtotime($receive2));
?>
                                        </td>
                                        <td> <?php echo $idade1; ?></td>
                                        <td>{{ $paciente->street }}</td>
                                        <td>{{ $paciente->city->name }}</td>
                                        @if($paciente->sex == "M")
                                        	<td>MASCULINO</td>
                                        @else
                                        	<td>FEMININO</td>
                                       	@endif
                                        <td>
                                            <?php
$ultimo = $paciente->creatd_at;
echo date('d/m/Y H:m:s ', strtotime($ultimo));
?>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>
        

               

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    
                    <h5> <i class="fas fa-file-code"></i> SOLICITAR GUIA TISS</h5>

                </div>

                <div class="ibox-content">

                    <a href="{{$paciente->id}}/tiss" class="btn btn-outline btn-info">SOLICITAÇÃO DE GUIAS</a>
                    
                    <br>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    
                    <h5> <i class="fas fa-file-code"></i> VISUALIZAR GUIA TISS</h5>

                </div>

                <div class="ibox-content">

                    <a href="{{$paciente->id}}/tiss/ver" class="btn btn-outline btn-info">VISUALIZAR GUIA</a>
                    
                    <br>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>



        

        <!-- cadastros tis -->

        <div class="col-lg-3">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-primary pull-right"></span>

                    <h5>ABERTOS</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$abertos}}</h1>

                    <div class="stat-percent font-bold text-navy"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-danger pull-right"></span>

                    <h5>EM ANALISE</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$analises}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

         <div class="col-lg-3">
            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-danger pull-right"></span>

                    <h5>FINALIZADO</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$finalizados}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

         <div class="col-lg-3">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-danger pull-right"></span>

                    <h5>ENTREGUES</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$entregues}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-danger pull-right"></span>

                    <h5>QPDAT</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">
                        <button data-toggle="collapse" data-target="#demo" class="btn btn-outline btn-info btn-block" >QPDAT</button>
                    </h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>


        <div id="demo" class="collapse">


         <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-danger pull-right"></span>

                    <h5>QPDAT</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">

                    <form method="post" action="dados/salvar">
                        @foreach($pacientes as $paciente)
                        @endforeach
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="paciente" value="{{$paciente->id}}">
                        <textarea name="historico" placeholder="INFORME O QPDTA" class="form-control" rows="6" id="historico">{{$paciente->qpta}}</textarea>

                        <script type="text/javascript">
                                        CKEDITOR.replace("historico");
                                    </script>

                        <br>
                        <button class="btn btn-outline btn-info pull-right ckeditor" type="submit">SALVAR</button>
                    </form>
                        <br>
                    </h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

    </div>


        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5>EXAMES REALIZADOS</h5>

                </div>

                <div class="ibox-content">

                    <div class="table-responsive">
<div class="col-sm-2 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraHistoricoExame" onkeyup="filtraHistoricoExame()"> <span 		class="input-group-btn" name="filtraHistoricoExame" >
       <button type="button" class="btn btn-sm btn-info"> EXAME</button> </span>
     </div>
</div>


<div class="col-sm-2 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraHistoricoStatus" onkeyup="filtraHistoricoStatus()"> <span 		class="input-group-btn" name="filtraHistoricoStatus" >
       <button type="button" class="btn btn-sm btn-info"> STATUS</button> </span>
     </div>
</div>

<div class="col-sm-3 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraHistoricoProtocolo" onkeyup="filtraHistoricoProtocolo()"> <span 		class="input-group-btn" name="filtraHistoricoProtocolo" >
       <button type="button" class="btn btn-sm btn-info"> PROTOCOLO</button> </span>
     </div>
</div>

<div class="col-sm-2 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraHistoricoEntrega" onkeyup="filtraHistoricoEntrega()"> <span 		class="input-group-btn" name="filtraHistoricoEntrega" >
       <button type="button" class="btn btn-sm btn-info"> ENTREGA</button> </span>
     </div>
</div>

<div class="col-sm-3 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraHistoricoRetirada" onkeyup="filtraHistoricoRetirada()"> <span 		class="input-group-btn" name="filtraHistoricoRetirada" >
       <button type="button" class="btn btn-sm btn-info"> RETIRADO</button> </span>
     </div>
</div>


                        <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th>EXAME</th>
                                    <th>MÉDICO</th>
                                    <th>STATUS</th>
                                    <th>PROTOCOLO</th>
                                    <th>PREVISÃO DE ENTREGA</th>
                                    <th>RETIRADO</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                	@foreach($orderArticles as $orderArticle)
                                    <tr>
                                    	<td>{{ $orderArticle->exam->name }}</td>
                                        <td>{{ $order->medic->name }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->protocol }}</td>
                                        <td>

                                            <?php
$receive = $order->dt_retire;
echo date('d/m/Y', strtotime($receive));
?>
                                        </td>
                                        <td>

                                            <?php
$receive3 = $order->entregue;
echo date('d/m/Y H:m:s ', strtotime($receive3));
?>
- {{ $order->delivery_person }}
                                        </td>


                                    </tr>
                                	@endforeach
                                @endforeach
                                </tbody>
                            </table>

                    </div>

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>

    </div>

                    <!-- Modal caixa fechado -->
                    <div id="myModalSalvo" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Dados Salvos</h4>
                          </div>
                          <div class="modal-body">
                            <p>Os Dados Foram Salvos Com Sucesso.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                    <!-- Modal caixa fechado -->
                    <div id="myModalNSalvo" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Ocorreu um Erro ao Salvar os Dados</h4>
                          </div>
                          <div class="modal-body">
                            <p>Não Foi Possivel salvar os dados. Tente Novamente.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                    <!-- ModalCarteirinha -->
                    <div id="myModalCarteirinha" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                          </div>
                          <div class="modal-body">
                            <p>Some text in the modal.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>

@endsection
