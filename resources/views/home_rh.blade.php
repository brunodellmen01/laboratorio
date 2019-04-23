@extends('layouts.app')

@section('content')




<div class="row">

		<div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5>  </h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">
                    	<div class="alert alert-info">
                    		DADOS DE TODAS AS UNIDADES
                    	</div>
                    </h1>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

         <!-- aviso novo modulo -->

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">Hoje</span>

                    <h5> <i class="fas fa-clipboard"></i> Exames Agendados</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$agendas}}</h1>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">Hoje</span>

                    <h5> <i class="fas fa-money-bill-alt"></i> Contas a Pagar</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$parcelasPagar}}</h1>

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">Hoje</span>

                    <h5> <i class="fas fa-money-bill-alt"></i> Contas a Receber</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$parcelasReceber}}</h1>

                    <div class="stat-percent font-bold text-navy"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><a href="pedidos/hoje">Hoje</a></span>

                    <h5> <i class="fas fa-list-ul"></i> Total de Pedidos</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalpedidos}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5> <i class="fas fa-user-circle"></i> Total de Pacientes</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalclientes}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

        


        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><?php echo date('d/m/Y'); ?></span>

                    <h5> <i class="fas fa-clipboard"></i> Pedidos A Serem Entregues Hoje - {{$totalparaentregar}}</h5>

                </div>

                <div class="ibox-content">

                    <div class="table-responsive">
                        <div class="col-sm-6 m-b-xs">
                            <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="pedidoPacienteHojeHome" onkeyup="pedidoPacienteHojeHome()"> <span class="input-group-btn" name="pedidoPacienteHojeHome" >
                                        <button type="button" class="btn btn-sm btn-info"> PACIENTE</button> </span></div>
                        </div>
                        <div class="col-sm-6 m-b-xs">
                            <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="pedidoProtocoloHojeHome" onkeyup="pedidoProtocoloHojeHome()"> <span class="input-group-btn" name="pedidoProtocoloHojeHome" >
                                        <button type="button" class="btn btn-sm btn-info"> PROTOCOLO</button> </span></div>
                        </div>
                        <table class="table" id="myTable">
                        <thead>
                          <tr>
                            <th>PACIENTE</th>
                            <th>STATUS</th>
                            <th>PROTOCOLO</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse($pedidos as $pedido)
                              <tr>
                                <td>{{$pedido->patient->name}}</td>
                                <td>{{$pedido->status}}</td>
                                <td>{{$pedido->protocol}}</td>
                              </tr>
                            @empty
                              <tr>
                                  <td colspan="4">Nenhum Pedido a Ser Entregue Hoje</td>
                              </tr>
                            @endforelse
                        </tbody>
                      </table>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
