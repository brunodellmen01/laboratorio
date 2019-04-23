@extends('layouts.app')

@section('content')
<div class="row">

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                @if($somaVencidos >= 0)
                    <span class="label label-danger pull-right">R$: {{$somaVencidos}}</span>

                @else
                	<span class="label label-success pull-right">R$: {{$somaVencidos}}</span>
                @endif
                    <h5>
                    	<a data-toggle="tab" href="#vencidos" class="label label-danger pull-right">VENCIDOS</a>

                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins text-danger">{{$totalVencidos}}</h1>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">


                    	<span class="label label-success pull-right"></span>

                    <h5>
                    	<a data-toggle="tab" href="#avistas" class="label label-success pull-right">A VISTA</a>

                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalAVistas}}</h1>

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                   <span class="label label-success pull-right"></span>

                    <h5>
                    	<a data-toggle="tab" href="#abertos" class="label label-success pull-right">ABERTOS</a>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalAbertos}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

         <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-success pull-right"></span>

                    <h5>
                    	<a data-toggle="tab" href="#emanalises" class="label label-success pull-right">EM ANALISE</a>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalAnalises}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

         <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-success pull-right"></span>

                    <h5>
                    	<a data-toggle="tab" href="#finalizados" class="label label-success pull-right">FINALIZADO</a>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalFinalizados}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

         <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-success pull-right"></span>

                    <h5>
                    	<a data-toggle="tab" href="#entregues" class="label label-success pull-right">ENTREGUES</a>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalEntregues}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-success pull-right"></span>

                    <h5>
                        <a data-toggle="tab" class="label label-success pull-right">INTERNOS</a>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalInternos}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-success pull-right"></span>

                    <h5>
                        <a data-toggle="tab"  class="label label-success pull-right">EXTERNOS</a>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalExternos}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-md-12">
	        <div class="tab-content">

			  <div id="vencidos" class="tab-pane fade">
			  	<div class="ibox float-e-margins">
                	<div class="ibox-title">
					    <h3>VENCIDOS</h3>
					    <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PARCELA</th>
                                            <th>DATA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($vencidos as $vencido)
                                                    <td>{{$vencido->id}}</td>
                                                    <td>R: {{$vencido->price_parcel}}</td>
<td>
							<?php
   					   			$venc = $vencido->venc;
					   			echo date('d/m/Y H:m:s', strtotime($venc));
                                        		?>                                                     

</td>
                                            </tr>
                                            @empty
                                                <td colspan="3">Nenhum Exame Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
			    	</div>
			    </div>
			  </div>

			  <div id="avistas" class="tab-pane fade">
			    <div class="ibox float-e-margins">
                	<div class="ibox-title">
					    <h3>A VISTA</h3>
					        <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PROTOCOLO</th>
                                            <th>PACIENTE</th>
                                            <th>DATA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($avistas as $avista)
                                                    <td>{{$avista->id}}</td>
                                                    <td>{{$avista->protocol}}</td>
                                                    <td>{{$avista->patient->name}}</td>
                                                    <td>

							<?php
   					   			$vista = $avista->created_at;
					   			echo date('d/m/Y H:m:s', strtotime($vista));
                                        		?>


</td>
                                            </tr>
                                            @empty
                                                <td colspan="4">Nenhum Exame Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
			    	</div>
			    </div>
			  </div>



			  <div id="abertos" class="tab-pane fade">
			    <div class="ibox float-e-margins">
                	<div class="ibox-title">
					    <h3>ABERTO</h3>
					    <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PROTOCOLO</th>
                                            <th>PACIENTE</th>
                                            <th>DATA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($abertos as $aberto)
                                                    <td>{{$aberto->id}}</td>
                                                    <td>{{$aberto->protocol}}</td>
                                                    <td>{{$aberto->patient->name}}</td>
                                                    <td>
							<?php
   					   			$vista2 = $aberto->created_at;
					   			echo date('d/m/Y H:m:s', strtotime($vista2));
                                        		?>



</td>
                                            </tr>
                                            @empty
                                                <td colspan="4">Nenhum Exame Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
			    	</div>
			    </div>
			  </div>

			  <div id="emanalises" class="tab-pane fade">
			    <div class="ibox float-e-margins">
                	<div class="ibox-title">
					    <h3>EM ANALISE</h3>
					    <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PROTOCOLO</th>
                                            <th>PACIENTE</th>
                                            <th>DATA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($analises as $analise)
                                                    <td>{{$analise->id}}</td>
                                                    <td>{{$analise->protocol}}</td>
                                                    <td>{{$analise->patient->name}}</td>
                                                    <td>
							<?php
   					   			$analise1 = $analise->created_at;
					   			echo date('d/m/Y H:m:s', strtotime($analise1));
                                        		?>


</td>
                                            </tr>
                                            @empty
                                                <td colspan="4">Nenhum Exame Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
			    	</div>
			    </div>
			  </div>

			  <div id="finalizados" class="tab-pane fade">
			    <div class="ibox float-e-margins">
                	<div class="ibox-title">
					    <h3>FINALIZADOS</h3>
					    <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PROTOCOLO</th>
                                            <th>PACIENTE</th>
                                            <th>DATA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($finalizados as $finalizado)
                                                    <td>{{$finalizado->id}}</td>
                                                    <td>{{$finalizado->protocol}}</td>
                                                    <td>{{$finalizado->patient->name}}</td>
                                                    <td>
							<?php
   					   			$finalizado1 = $finalizado->created_at;
					   			echo date('d/m/Y H:m:s', strtotime($finalizado1));
                                        		?>



</td>
                                            </tr>
                                            @empty
                                                <td colspan="4">Nenhum Exame Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
			    	</div>
			    </div>
			  </div>

			  <div id="entregues" class="tab-pane fade">
			    <div class="ibox float-e-margins">
                	<div class="ibox-title">
					    <h3>ENTREGUES</h3>
					    <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PROTOCOLO</th>
                                            <th>PACIENTE</th>
                                            <th>DATA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($entregues as $entregue)
                                                    <td>{{$entregue->id}}</td>
                                                    <td>{{$entregue->protocol}}</td>
                                                    <td>{{$entregue->patient->name}}</td>
                                                    <td>
							<?php
   					   			$entregue1 = $entregue->created_at;
					   			echo date('d/m/Y H:m:s', strtotime($entregue1));
                                        		?>


</td>
                                            </tr>
                                            @empty
                                                <td colspan="4">Nenhum Exame Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
			    	</div>
			    </div>
			  </div>

			</div>
		</div>

    </div>
@endsection
