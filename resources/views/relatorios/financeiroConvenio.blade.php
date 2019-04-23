@extends('layouts.app')

@section('content')

@foreach($convenios as $convenio)
@endforeach

<div class="row">

		<div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5>
                    	<small class="label label-info pull-right">
                    		CADASTRADO EM 
                    	<?php
							$data = $convenio->created_at;
							echo date('d/m/Y', strtotime($data));
						?>
                    	</small>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">
                    	@foreach($convenios as $convenio)
							{{$convenio->name}}	
						@endforeach
					</h1>					

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>


         <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">
                    	REGISTRADO
                    </span>

                    <h5>
                    	<small class="label label-info pull-right">ATÉ HOJE</small>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">R$: <?php echo number_format($valorTotal, 2, ',', '.'); ?></h1>

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>

         <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">
                    	<?php
							$hoje = date('d/m');
							echo date('d/m', strtotime($total_30));
						?>

						Á

						<?php 
							echo $hoje;
						?>
                    </span>

                    <h5>
                    	<small class="label label-info pull-right">ULTIMOS 30 DIAS</small>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">R$: <?php echo number_format($valor_mes, 2, ',', '.'); ?></h1>

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">
                    	<?php
							$hoje = date('d/m');
							echo date('d/m', strtotime($total_7));
						?>

						Á

						<?php 
							echo $hoje;
						?>
                    </span>

                    <h5>
                    	<small class="label label-info pull-right">ESTA SEMANA</small>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">R$: <?php echo number_format($valor_semana, 2, ',', '.'); ?></h1>

                    <div class="stat-percent font-bold text-danger">
                    	
                    </div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">
                    	REGISTRADO
                    </span>

                    <h5>
                    	<small class="label label-info pull-right">ATÉ HOJE</small>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$total}}</h1>

                    <div class="stat-percent font-bold text-danger">
                    	
                    </div>

                    <small></small>

                </div>

            </div>

        </div>

         <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">
                    	<?php
							$hoje = date('d/m');
							echo date('d/m', strtotime($total_30));
						?>

						Á

						<?php 
							echo $hoje;
						?>
                    </span>

                    <h5>
                    	<small class="label label-info pull-right">ULTIMOS 30 DIAS</small>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$total_pedido_30}}</h1>

                    <div class="stat-percent font-bold text-danger">
                    	
                    </div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">
                    	<?php
							$hoje = date('d/m');
							echo date('d/m', strtotime($total_7));
						?>

						Á

						<?php 
							echo $hoje;
						?>
                    </span>

                    <h5>
                    	<small class="label label-info pull-right">ESTA SEMANA</small>
                    </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$total_pedido_7}}</h1>

                    <div class="stat-percent font-bold text-danger">
                    	
                    </div>

                    <small></small>

                </div>

            </div>

        </div>


        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">
                    	ULTIMOS 3
                    </span>

                    <h5>
                    	<small class="label label-info pull-right">ULTIMOS PEDIDOS</small>
                    </h5>

                </div>

                <div class="ibox-content">

                    <table class="table table-hover">
						    <tbody>
						    	@forelse($ultimosPedidos as $ultimosPedido)
							      <tr>
							      	<td >
							      		@if($ultimosPedido->patient->image == "profile.png")
							      			<img src="{{asset('images/uploads/pacientes/sem-foto.png')}}" width="90" height="90" class="img-responsive thumbnail circle" data-toggle="tooltip" data-placement="right" title="<?php echo $ultimosPedido->patient->name; ?>">

							      		@else
							      			<img src="{{asset('images/uploads/pacientes/').'/'.$ultimosPedido->patient->id}}/{{$ultimosPedido->patient->image}}" width="90" height="90" class="img-responsive thumbnail circle" data-toggle="tooltip" data-placement="right" title="<?php echo $ultimosPedido->patient->name; ?>">
							      		@endif
							      	</td>
							        <td>{{$ultimosPedido->patient->name}}</td>
							        <td>
							        	<?php
											$data = $ultimosPedido->created_at;
											echo date('d/m/Y', strtotime($data));
										?>
							        </td>
							        <td>
							        	<a href="../../pedidos/{{$ultimosPedido->id}}/detalhes" class="btn btn-outline btn-info" data-toggle="tooltip" data-placement="bottom" title="VER PEDIDO" target="_blank" >
                                           
                                            <i class="fa fa-eye fa-3x"></i>
                                                
                                        </a>
							        </td>
							      </tr>
						      	@empty
							      	<tr colsplan="4">
							      		<td>Nenhum Pedido Registrado</td>
							     	</tr>
						     	@endforelse 
						    </tbody>
						  </table>

                    <div class="stat-percent font-bold text-info">----------</div>

                    <small></small>

                </div>

            </div>

        </div>



    </div>


@endsection
