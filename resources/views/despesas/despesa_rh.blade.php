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
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><?php echo date('d/m/Y'); ?></span>
                                <h5>A Vencer Hoje</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">

                                		{{$totalDespesaHoje}}

                                </h1>
                                <div class="stat-percent font-bold text-success"></div>
                                <small>Quitar Hoje</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">De <?php echo date('d/m/Y'); ?> á <?php
$data = $vence_semana;
echo date('d/m/Y', strtotime($data));
?></span>
                                <h5>A Vencer</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                		{{$totalDespesaSemana}}
                                </h1>
                                <div class="stat-percent font-bold text-info"></div>
                                <small>Esta Semana</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Anterior a <?php echo date('d/m/Y'); ?></span>
                                <h5>Vencidas</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                	{{$totalDespesaVencida}}
                                </h1>
                                <div class="stat-percent font-bold text-navy"></div>
                                <small>
                                	Despesas Vencidas.
                                </small>
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
                                    <div class="col-sm-3 m-b-xs">
                                          <div class="input-group">
                                    	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraDespesaEmpresa" onkeyup="filtraDespesaEmpresa()"> <span 		class="input-group-btn" name="filtraDespesaEmpresa" >
                                           <button type="button" class="btn btn-sm btn-info"> EMPRESA</button> </span>
                                         </div>
                                    </div>

                                    <div class="col-sm-2 m-b-xs">
                                          <div class="input-group">
                                    	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraDespesaVencimento" onkeyup="filtraDespesaVencimento()"> <span 		class="input-group-btn" name="filtraDespesaVencimento" >
                                           <button type="button" class="btn btn-sm btn-info"> VENC.</button> </span>
                                         </div>
                                    </div>

                                    <div class="col-sm-2 m-b-xs">
                                          <div class="input-group">
                                    	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraDespesaValor" onkeyup="filtraDespesaValor()"> <span 		class="input-group-btn" name="filtraDespesaValor" >
                                           <button type="button" class="btn btn-sm btn-info"> VALOR</button> </span>
                                         </div>
                                    </div>

                                    <div class="col-sm-3 m-b-xs">
                                          <div class="input-group">
                                    	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraDespesaDescricao" onkeyup="filtraDespesaDescricao()"> <span 		class="input-group-btn" name="filtraDespesaDescricao" >
                                           <button type="button" class="btn btn-sm btn-info"> DESCRIÇÃO</button> </span>
                                         </div>
                                    </div>

                                    <div class="col-sm-2 m-b-xs">
                                          <div class="input-group">
                                    	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraDespesaStatus" onkeyup="filtraDespesaStatus()"> <span 		class="input-group-btn" name="filtraDespesaStatus" >
                                           <button type="button" class="btn btn-sm btn-info"> STATUS</button> </span>
                                         </div>
                                    </div>

                                    
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>EMPRESA</th>
                                            <th>VENCIMENTO </th>
                                            <th>VALOR</th>
                                            <th>DESCRIÇÃO</th>
                                            <th>STATUS</th>
                                            <th>UNIDADE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($expenses as $expense)
                                                <tr>
                                                    <td>{{$expense->id}}</td>
                                                    <td>{{$expense->company->name}}</td>
                                                    <td>
							                            <?php
                                                            $data = $expense->venc;
                                                            echo date('d/m/Y', strtotime($data));
                                                        ?>

						                            </td>
                                                    <td>R$: {{$expense->price}}</td>
                                                    <td>{{$expense->description}}</td>

                                                    @if($expense->venc == date('Y-m-d'))

                                                        <td>VENCIDO</td>
                                                    @else
                                                        <td>{{$expense->status}}</td>
                                                    @endif

                                                    <td>{{$expense->filial->name}}</td>

                                                </tr>
                                            @empty
                                                <td colspan="6">Nenhum Registro Encontrado.</td>

                                            @endforelse
                                        </tbody>
                                    </table>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                            


					
                



@endsection
