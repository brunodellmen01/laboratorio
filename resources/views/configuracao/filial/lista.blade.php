@extends('layouts.app')

@section('content')
<title>Listagem de Unidades</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Unidades
                    <a href="{{ url('configuracao/empresa/unidades') }}" class="pull-right">Nova Unidade</a>
                </div>

                <div class="panel-body">

                    <?php if (array_key_exists("certo", $_GET) && $_GET['certo'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>
                    <div class="table-responsive">
			<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraUnidadeNome" onkeyup="filtraUnidadeNome()"> <span class="input-group-btn" name="filtraUnidadeNome" >
                                        <button type="button" class="btn btn-sm btn-info"> NOME</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraUnidadeFone" onkeyup="filtraUnidadeFone()"> <span class="input-group-btn" name="filtraUnidadeFone" >
                                        <button type="button" class="btn btn-sm btn-info"> TELEFONE</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraUnidadeCidade" onkeyup="filtraUnidadeCidade()"> <span class="input-group-btn" name="filtraUnidadeCidade" >
                                        <button type="button" class="btn btn-sm btn-info"> CIDADE</button> </span></div>
                                    </div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>COD. UNID.</th>
                                <th>NOME</th>
                                <th>TELEFONE</th>
                                <th>LOCAL</th>
                                <th>AÇÕES</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($unidades as $unidade)
                                  <tr>
                                  	<td>{{ $unidade->cod_unidade}}</td>
                                    <td>{{ $unidade->name }}</td>
                                    <td>{{ $unidade->phone }}</td>
                                    <td>{{ $unidade->estado->name }}</td>
                                    <td>
                                        <a href="../unidades/{{$unidade->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                    </td>
                                    <td>
                                        <a href="../unidades/{{$unidade->id}}/deletar" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-trash" alt="deletar"  title="deletar"></span></a>
                                    </td>
                                  </tr>
                                  @endforeach
                            </tbody>
                          </table>
                          <div class="pull-right" >
                           
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
