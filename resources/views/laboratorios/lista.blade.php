@extends('layouts.app')

@section('content')
<title>Listagem de LLaboratórios</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Laboratórios
                    <a href="{{ url('laboratorios/novo') }}" class="pull-right">Novo Laboratório</a>
                </div>

                <div class="panel-body">

                    <?php if (array_key_exists("certo", $_GET) && $_GET['certo'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>
                    <div class="table-responsive">
			<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraLabNome" onkeyup="filtraLabNome()"> <span class="input-group-btn" name="filtraLabNome" >
                                        <button type="button" class="btn btn-sm btn-info"> NOME</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraLabEmail" onkeyup="filtraLabEmail()"> <span class="input-group-btn" name="filtraLabEmail" >
                                        <button type="button" class="btn btn-sm btn-info"> E-MAIL</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraLabCidade" onkeyup="filtraLabCidade()"> <span class="input-group-btn" name="filtraLabCidade" >
                                        <button type="button" class="btn btn-sm btn-info"> CIDADE</button> </span></div>
                                    </div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>NOME</th>
                                <th>E-MAIL</th>
                                <th>CIDADE</th>
                                <th>AÇÃO</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($laboratorios as $laboratorio)
                                  <tr>
                                    <td>{{ $laboratorio->name }}</td>
                                    <td>{{ $laboratorio->email }}</td>
                                    <td>{{ $laboratorio->city->name }}</td>
                                    <td>
                                        <a href="../laboratorios/{{$laboratorio->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                    </td>
                                   <td>
                                        {!! Form::open(['method' => 'POST', 'url' => '/laboratorios/'.$laboratorio->id.'/inativar']) !!}
                                            <button type="submit" class="btn btn-info btn-md"><span class="  glyphicon glyphicon-eye-close" alt="Inativar" title="Inativar"></span></buttons>
                                        {!! Form::close() !!}
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
