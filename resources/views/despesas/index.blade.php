@extends('layouts.app')

@section('content')


<div class="row">
                    <div class="col-lg-3">
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
                    <div class="col-lg-3">
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
                    <div class="col-lg-3">
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

                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right"></span>
                                <h5>Nova Despesa</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">

                                <a data-toggle="modal" href="#myModalNovaDespesa" class="btn btn-outline btn-info"> CRIAR </a>
                                </h1>
                                <div class="stat-percent font-bold text-navy"></div>
                                <small>
	                              Criar Nova Despesa

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
                                            <th>AÇÕES </th>
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

                                                    <?php
                                                        $id_conta = $expense->id;
                                                        $vencimento = $expense->venc;
                                                        $hoje = date('Y-d-m');
                                                        $status_cp = $expense->status;
                                                        $saldo = $saldos;
                                                        $parcela = $expense->price;
                                                        $codigo = $expense->id;
                                                        $date_paid = $expense->date_paid;

                                                    ?>


                                                    <td  data-nome = <?php echo $id_conta; ?> >
                                                        <?php

                                                            if ($status_cp == "PAGO") {
	                                                           echo "PAGO EM " . date('d/m/Y H:m:s', strtotime($date_paid));
                                                            } else {?>

                                                         <!-- Modal -->
                                                    <!-- faço um ajuste técnico, coloco o nome do modal sendo o id da parcela -->
                                                    <div id="myModal<?php echo $id_conta; ?>" class="modal fade" role="dialog" data-backdrop="static" data-id="">
                                                      <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">DESPESA Nº.

                                                                    <b> {{$expense->id}}</b>
                                                                        <br>
                                                                        {{$expense->description}} - R$: {{$expense->price}}
                                                                    </h4>

                                                            </h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <p>
                                                                <form method="post" action="despesa/pagar">

                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                                    <input type="hidden" name="id" value="<?php echo $codigo; ?>">

                                                                    <input class="form-control" value="<?php echo date('Y-d-m - H:m:s'); ?>" type="hidden" name="dataPaga"></input>

                                                                    <input type="text" name="despesa" value="<?php echo $parcela; ?>" class="form-control">


                                                            </p>
                                                           <p>Confirma Pagamento da despesa <b> {{$expense->description}} </b> no valor de R$:  {{$expense->price}} ?</p>


                                                            <p>


                                                                    <button class="btn btn-default btn-block">CONFIRMAR</button>
                                                                </form>

                                                            </p>

                                                          </div>
                                                          <div class="modal-footer">

                                                          </div>
                                                        </div>

                                                      </div>
                                                    </div>
                                                    <!-- Modal -->

                                                        @if($saldos > $parcela)
                                                            <button type="button" class="btn btn-outline btn-primary pull-right" data-toggle="modal" data-target="#myModal<?php echo $id_conta; ?>">QUITAR</button>


                                                    @else
                                                        <button type="button" class="btn btn-outline btn-primary pull-right disabled" >SEM SALDO</button>



                                                    @endif




                                                        <?php }

?>
                                                    </td>


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
                    


					<!-- Modal nova despesa-->
					<div id="myModalNovaDespesa" class="modal fade" role="dialog">
					  <div class="modal-dialog modal-lg">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Nova Despesa Fixa</h4>
					      </div>
					      <div class="modal-body">
					      	<form method="post" action="despesa/gerar">
					      		<input type="hidden" name="_token" value="{{ csrf_token() }}">

					      		<div class="row">
						      		<div class="col-md-4">
                                        <div class="form-group has-feedback">
    						      			<select class="form-control" name="companies_id" required>
    						                    <option value="">SELECIONE UMA EMPRESA</option>
    						                      @foreach($empresas as $empresa)
    						                      <option value="{{$empresa->id}}">{{$empresa->name}}</option>
    						                    @endforeach
    						                  </select>
                                              <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                        </div>
						      		</div>

						      		<div class="col-md-4">
    						      		<?php
                                            $venc = date('Y-m-d', strtotime("+1 month", strtotime(date('Y-m-d'))));
                                        ?>
                                        <div class="form-group has-feedback">
						      			     <input type="date" name="venc" class="form-control" placeholder="VENCIMENTO" value="<?php echo $venc; ?>">
                                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                        </div>
						      		</div>

						      		<div class="col-md-2">
                                        <div class="form-group has-feedback">
    						      			<input type="text" name="price" class="form-control" placeholder="VALOR">
                                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                        </div>
						      		</div>

                                    <div class="col-md-2">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="qtd" class="form-control" placeholder="QUANTIDADE">
                                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                        </div>
                                    </div>

						      		<hr>

						      		<div class="col-md-12">
                                        <div class="form-group has-feedback">
						      			     <textarea name="description" class="form-control" placeholder="DESCRIÇÃO" rows="4"></textarea>
                                            <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                        </div>
						      		</div>
					      		</div>
                            

					      <div class="modal-footer">
					        <button type="submit" class="btn btn-default">GERAR DESPESA</button>
					        </form>
					      </div>


					  


					<!-- Modal nova despesa-->

                    
                



@endsection
