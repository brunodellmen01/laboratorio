@extends('layouts.app')

@section('content')
<title>Listagem de Preços</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Preços
                    <a href="{{ url('precoExame/novo') }}" class="pull-right">Novo Preço</a>
                </div>

                <div class="panel-body">
                   
                    <?php if(array_key_exists("certo", $_GET) && $_GET['certo']=='true') { ?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php } ?>                    
                    <div class="table-responsive">
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPrecoExameTipo" onkeyup="filtraPrecoExameTipo()"> <span class="input-group-btn" name="filtraPrecoExameTipo" >
                                        <button type="button" class="btn btn-sm btn-info"> TIPO</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPrecoExameConvenio" onkeyup="filtraPrecoExameConvenio()"> <span class="input-group-btn" name="filtraPrecoExameConvenio" >
                                        <button type="button" class="btn btn-sm btn-info"> CONVỄNIO</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPrecoExameValor" onkeyup="filtraPrecoExameValor()"> <span class="input-group-btn" name="filtraPrecoExameValor" >
                                        <button type="button" class="btn btn-sm btn-info"> VALOR</button> </span></div>
                                    </div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th>TIPO DE EXAME</th>
                                <th>CONVÊNIO</th>
                                <th>VALOR</th>
                                <th>AÇÃO</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($precoExames as $precoExame)
                                  <tr>                                  
                                    <td>{{ $precoExame->exam->name }}</td>
                                    <td>{{ $precoExame->covenant->name }}</td>
                                    <td>R$: {{ $precoExame->value }}</td>
                                    <td>
                                        <a href="../precoExames/{{$precoExame->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                    </td>
                                   <td>
                                        {!! Form::open(['method' => 'POST', 'url' => '/precoExames/'.$precoExame->id.'/inativar']) !!}
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
