@extends('layouts.app')

@section('content')
<title>Listagem de Clínicas</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Clínicas
                    <a href="{{ url('clinica/novo') }}" class="pull-right">Nova Clínica</a>
                </div>

                <div class="panel-body">

                    <?php if (array_key_exists("certo", $_GET) && $_GET['certo'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>
                    <div class="table-responsive">
			<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraClinicaNome" onkeyup="filtraClinicaNome()"> <span class="input-group-btn" name="filtraClinicaNome" >
                                        <button type="button" class="btn btn-sm btn-info"> NOME</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraClinicaFone" onkeyup="filtraClinicaFone()"> <span class="input-group-btn" name="filtraClinicaFone" >
                                        <button type="button" class="btn btn-sm btn-info"> TELEFONE</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraClinicaCidade" onkeyup="filtraClinicaCidade()"> <span class="input-group-btn" name="filtraClinicaCidade" >
                                        <button type="button" class="btn btn-sm btn-info"> CIDADE</button> </span></div>
                                    </div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>NOME</th>
                                <th>TELEFONE</th>
                                <th>CIDADE</th>
                                <th>AÇÃO</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($clinicas as $clinica)
                                  <tr>
                                    <td>{{ $clinica->name }}</td>
                                    <td>{{ $clinica->number }}</td>
                                    <td>{{ $clinica->city->name }}</td>
                                    <td>
                                        <a href="../clinicas/{{$clinica->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                    </td>
                                   <td>
                                        {!! Form::open(['method' => 'POST', 'url' => '/clinicas/'.$clinica->id.'/inativar']) !!}
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
