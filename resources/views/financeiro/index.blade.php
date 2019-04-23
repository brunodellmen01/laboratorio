@extends('layouts.app')

@section('content')

<div class="wrapper wrapper-content">
        <div class="row">
		<div class="alert alert-info">
			EM DESENVOLVIMENTO
		</div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"></span>
                                <h5>Contas a receber</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">R$: </h1>
                                <div class="stat-percent font-bold text-success"><i class="fa fa-bolt"></i></div>
                                <small>Total de valores a receber.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Mensal</span>
                                <h5>Contas a pagar</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">R$275,00</h1>
                                <div class="stat-percent font-bold text-info"><i class="fa fa-level-up"></i></div>
                                <small>Total de valores a pagar</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Mensal</span>
                                <h5>Receita</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">R$106.120,00</h1>
                                <div class="stat-percent font-bold text-navy"><i class="fa fa-level-up"></i></div>
                                <small>Total de receita da clínica.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Mensal</span>
                                <h5>Boletos vencidos</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">3</h1>
                                <div class="stat-percent font-bold text-danger"><i class="fa fa-level-down"></i></div>
                                <small>Boletos com status vencidos</small>
                            </div>
                        </div>
            </div>
        </div>


         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>DESPESAS</h5>

                            </div>
        <div class="ibox-content">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Project </th>
                                            <th>Name </th>
                                            <th>Phone </th>
                                            <th>Company </th>
                                            <th>Completed </th>
                                            <th>Task</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Project <small>This is example of project</small></td>
                                            <td>Patrick Smith</td>
                                            <td>0800 051213</td>
                                            <td>Inceptos Hymenaeos Ltd</td>
                                            <td><span class="pie">0.52/1.561</span></td>
                                            <td>20%</td>
                                            <td>Jul 14, 2013</td>
                                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>RECEITAS</h5>

                            </div>
        <div class="ibox-content">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PACIENTE</th>
                                            <th>MÉDICO</th>
                                            <th>DATA RETIRADA</th>
                                            <th>STATUS</th>
                                            <th>VAOR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($receitas as $receita)
                                                    <td>{{$receita->id}}</td>
                                                    <td>{{$receita->patient->name}}</td>
                                                    <td>{{$receita->medic->name}}</td>
                                                    <td>
							<?php
$data = $receita->date;
echo date('d/m/Y', strtotime($data));
?>
						    </td>
                                                    <td>{{$receita->state}}</td>
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
                    </div>
@endsection
