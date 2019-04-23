@extends('layouts.app')

@section('content')


<div class="wrapper wrapper-content">
        <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right"></span>
                                <h5>Total de Exames</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">

                                		 {{$totalExames}}

                                </h1>
                                <div class="stat-percent font-bold text-success"></div>
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right"></span>
                                <h5>Valor Mínimo</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">


                                		R$: {{$valorMinimo}}

                                </h1>
                                <div class="stat-percent font-bold text-info"></i></div>
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right"></span>
                                <h5>Valor Máximo</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                	R$: {{$valorMaximo}}

                                </h1>
                                <div class="stat-percent font-bold text-navy"></div>
                                <small></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right"></span>
                                <h5>Ultimo Pedido</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                @forelse($ultimoPedido as $ultimo)
                                	{{$ultimo->created_at}}

                                @empty
                                	0
                                @endforelse

                                </h1>
                                <div class="stat-percent font-bold text-navy"></div>
                                <small>

                                </small>
                            </div>
                        </div>
                    </div>
        </div>


         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>EXAMES</h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>NOME</th>
                                            <th>VALOR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($exames as $exame)
                                                    <td>{{$exame->exam->name}}</td>
                                                    <td>R$: {{$exame->value}}</td>
                                            </tr>
                                            @empty
                                                <td colspan="2">Nenhum Exame Cadastrado Para Este Exame.</td>

                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="pull-right" >

		                          	</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>



@endsection