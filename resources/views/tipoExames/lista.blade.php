@extends('layouts.app')

@section('content')
<title>Listagem de Tipo de Exames</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Tipos de Exames
                    <a href="{{ url('tipoExame/novo') }}" class="pull-right">Novo Tipo de Exame</a>
                </div>

                <div class="panel-body">

                    <?php if (array_key_exists("certo", $_GET) && $_GET['certo'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>
                    <div class="table-responsive">
			<div class="col-sm-12 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraTipoExameNome" onkeyup="filtraTipoExameNome()"> <span class="input-group-btn" name="filtraTipoExameNome" >
                                        <button type="button" class="btn btn-sm btn-info"> NOME</button> </span></div>
                                    </div>

                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>NOME</th>
                                <th>AÇÃO</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($tipoExames as $tipoExame)
                                  <tr>
                                    <td class="pull-left">{{ $tipoExame->name }}</td>
                                    <td>
                                        <a href="../tipoExames/{{$tipoExame->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                    </td>
                                   <td>
                                        {!! Form::open(['method' => 'POST', 'url' => '/tipoExames/'.$tipoExame->id.'/inativar']) !!}
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
