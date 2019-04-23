@extends('layouts.app')

@section('content')
<title>Listagem de Resultados</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Resultados
                    <a href="{{ url('resultado/novo') }}" class="pull-right">Novo Resultado</a>
                </div>

                <div class="panel-body">

                    <?php if (array_key_exists("certo", $_GET) && $_GET['certo'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>
                    <div class="table-responsive">
			<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraResultTipoExame" onkeyup="filtraResultTipoExame()"> <span class="input-group-btn" name="filtraResultTipoExame" >
                                        <button type="button" class="btn btn-sm btn-info"> EXAME</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraResultTipoRes" onkeyup="filtraResultTipoRes()"> <span class="input-group-btn" name="filtraResultTipoRes" >
                                        <button type="button" class="btn btn-sm btn-info"> RESULTADO</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraResultTipoDesc" onkeyup="filtraResultTipoDesc()"> <span class="input-group-btn" name="filtraResultTipoDesc" >
                                        <button type="button" class="btn btn-sm btn-info"> DESCRIÇÃO</button> </span></div>
                                    </div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>TIPO DE EXAME</th>
                                <th>TIPO DE RESULTADO</th>
                                <th>DESCRIÇÃO</th>
                                <th>AÇÃO</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($resultados as $resultado)
                                  <tr>
                                    <td>{{ $resultado->exam->name }}</td>
                                    <td>{{ $resultado->category->name }}</td>
                                    <td>{{ $resultado->description }}</td>
                                    <td>
                                        <a href="../resultados/{{$resultado->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                    </td>
                                   <td>
                                        {!! Form::open(['method' => 'POST', 'url' => '/resultados/'.$resultado->id.'/inativar']) !!}
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
