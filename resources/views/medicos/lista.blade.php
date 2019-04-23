@extends('layouts.app')

@section('content')
<title>Listagem de Médicos</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Médicos
                    <a href="{{ url('medicos/novo') }}" class="pull-right">Novo Médico</a>
                </div>

                <div class="panel-body">
                   
                    <?php if(array_key_exists("certo", $_GET) && $_GET['certo']=='true') { ?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php } ?>                    
                    <div class="table-responsive">
			<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraMedNome" onkeyup="filtraMedNome()"> <span class="input-group-btn" name="filtraMedome" >
                                        <button type="button" class="btn btn-sm btn-info"> NOME</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraMedEmail" onkeyup="filtraMedEmail()"> <span class="input-group-btn" name="filtraMedEmail" >
                                        <button type="button" class="btn btn-sm btn-info"> E-MAIL</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraMedCidade" onkeyup="filtraMedCidade()"> <span class="input-group-btn" name="filtraMedCidade" >
                                        <button type="button" class="btn btn-sm btn-info"> CIDADE</button> </span></div>
                                    </div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>                                
                                <th>NOME</th>
                                <th>TELEFONE</th>
                                <th>E-MAIL</th>
                                <th>AÇÃO</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($medicos as $medico)
                                  <tr>                                  
                                    <td class="pull-left">{{ $medico->name }}</td>
                                    <td> {{ $medico->fone }}</td>
                                    <td>{{ $medico->email }}</td>
                                    <td>
                                        <a href="../medicos/{{$medico->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                    </td>
                                   <td>
                                        {!! Form::open(['method' => 'POST', 'url' => '/medicos/'.$medico->id.'/inativar']) !!}
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
