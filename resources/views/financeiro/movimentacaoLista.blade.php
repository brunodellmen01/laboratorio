@extends('layouts.app')

@section('content')
<title>Listagem de Preços</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Movimentação Financeira
                    <a href="{{ url('financeiro/movimentacao/novo') }}" class="pull-right">Nova Movimentação</a>
                </div>

                <div class="panel-body">
                   
                    <?php if(array_key_exists("certo", $_GET) && $_GET['certo']=='true') { ?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php } ?>                    
                    <div class="table-responsive">
<div class="col-sm-3 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraMovTipo" onkeyup="filtraMovTipo()"> <span 		class="input-group-btn" name="filtraMovTipo" >
       <button type="button" class="btn btn-sm btn-info"> TIPO</button> </span>
     </div>
</div>

<div class="col-sm-3 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraMovValor" onkeyup="filtraMovValor()"> <span 		class="input-group-btn" name="filtraMovValor" >
       <button type="button" class="btn btn-sm btn-info"> VALOR</button> </span>
     </div>
</div>

<div class="col-sm-3 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraMovDescricao" onkeyup="filtraMovDescricao()"> <span 		class="input-group-btn" name="filtraMovDescricao" >
       <button type="button" class="btn btn-sm btn-info"> DESCRIÇÃO</button> </span>
     </div>
</div>

<div class="col-sm-3 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraMovData" onkeyup="filtraMovData()"> <span 		class="input-group-btn" name="filtraMovData" >
       <button type="button" class="btn btn-sm btn-info"> DATA</button> </span>
     </div>
</div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>TIPO</th>
                                <th>VALOR</th>
                                <th>DESCRIÇÃO</th>
                                <th>DATA</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($movs as $mov)
                                  <tr>                                  
                                    <td>{{ $mov->type }}</td>
                                    <td>R$: {{ $mov->price }}</td>
                                    <td>{{ $mov->description }}</td>
                                    <td>
					<?php
   					   $data = $mov->created_at;
					   echo date('d/m/Y H:m:s', strtotime($data));
                                        ?>
				   </td>
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
