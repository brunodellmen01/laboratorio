@extends('layouts.labsystem')

@section('content')
<title>Listagem de Convênios</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Convênios
                    <a href="{{ url('convenios/novo') }}" class="pull-right">Novo Convênio</a>
                </div>

                <div class="panel-body">
                   
                    <?php if(array_key_exists("certo", $_GET) && $_GET['certo']=='true') { ?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php } ?>                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>                                
                                <th>NOME</th>
                                <th>AÇÃO</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($convenios as $convenio)
                                  <tr>                                  
                                    <td class="pull-left">{{ $convenio->name }}</td>
                                    <td>
                                        <a href="/convenios/{{$convenio->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                    </td>
                                   <td>
                                        {!! Form::open(['method' => 'POST', 'url' => '/convenios/'.$convenio->id.'/inativar']) !!}
                                            <button type="submit" class="btn btn-info btn-md"><span class="  glyphicon glyphicon-eye-close" alt="Inativar" title="Inativar"></span></buttons>
                                        {!! Form::close() !!}
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
