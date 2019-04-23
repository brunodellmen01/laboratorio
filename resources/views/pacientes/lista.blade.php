@extends('layouts.app')

@section('content')
@if(!empty(Session::get('autorizado')) && Session::get('autorizado') == "SIM")
<script>
$(function() {
    $('#myModalAutorizado').modal('show');
});
</script>
@endif




    <title>Listagem de Pacientes</title>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Lista de Pacientes
                        <a href="{{ url('paciente/novo') }}" class="pull-right">Novo Paciente</a>
                    </div>

                    <div class="panel-body">

                        <?php if (array_key_exists("certo", $_GET) && $_GET['certo'] == 'true') {?>
                        <div class="alert alert-success">
                            <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                        <?php }?>
                        <div class="table-responsive">
			<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPacNome" onkeyup="filtraPacNome()"> <span class="input-group-btn" name="filtraPacome" >
                                        <button type="button" class="btn btn-sm btn-info"> NOME</button> </span></div>
                                    </div>
                                    <div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPacFone" onkeyup="filtraPacFone()"> <span class="input-group-btn" name="filtraPacFone" >
                                        <button type="button" class="btn btn-sm btn-info"> TELEFONE</button> </span></div>
                                    </div>
<div class="col-sm-4 m-b-xs">
                                        <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPacCidade" onkeyup="filtraPacCidade()"> <span class="input-group-btn" name="filtraPacCidade" >
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
                                @foreach($pacientes as $paciente)
                                    <tr>
                                        <td>{{ $paciente->name }}</td>
                                        <td>
                                            {{ $paciente->phone }}
                                        </td>
                                        <td>{{ $paciente->city->name }}</td>
                                        <td>
                                            <a href="../pacientes/{{$paciente->id}}/editar" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil" alt="Editar"  title="Editar"></span></a>
                                        </td>
                                        <td>
                                            {!! Form::open(['method' => 'POST', 'url' => '/pacientes/'.$paciente->id.'/inativar']) !!}
                                            <button type="submit" class="btn btn-info btn-md"><span class="  glyphicon glyphicon-eye-close" alt="Inativar" title="Inativar"></span></button>
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a data-toggle="modal" href="#myModalAutoriza{{$paciente->id}}" class="btn btn-info btn-md"><span class="glyphicon glyphicon-lock" alt="Pessoas Autorizadas" title="Pessoas Autorizadas"></span></a>

                                            <!-- Modal -->
                                                <div id="myModalAutoriza{{$paciente->id}}" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Cadastro de Pessoas Autorizadas</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <form action="../autoriza/novo" method="post">
                                                         <p>
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                            <input type="hidden" name="patient_id" value="{{$paciente->id}}">

                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <p>
                                                                        <input type="text" name="name" class="form-control" placeholder="INFORME O NOME COMPLETO">
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <p>
                                                                        <input type="text" name="cpf" class="form-control" placeholder="INFORME O CPF"  onkeypress="mascara(this, '###.###.###-##')" maxlength="14">
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <p>
                                                                        <input type="text" name="rg" class="form-control" placeholder="INFORME O RG"  onkeypress="mascara(this, '##.###.###-#')" maxlength="12">
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <p>
                                                                        <select class="form-control" id="sel1" name="relation">
                                                                            <option>PARENTESCO</option>
                                                                            <option value="PAI">PAI</option>
                                                                            <option value="MÃE">MÃE</option>
                                                                            <option value="FILHO">FILHO</option>
                                                                            <option value="ESPOSO">ESPOSO</option>
                                                                            <option value="ESPOSA">ESPOSA</option>
                                                                            <option value="VIZINHO">VIZINHO</option>
                                                                            <option value="OUTRO">OUTRO</option>
                                                                        </select>
                                                                    </p>
                                                                </div>

                                                            </div>


                                                                    </p>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <p class="pull-left">
                                                                        Somente estas pessoas poderam retirar os exames do(a) {{$paciente->name}}.
                                                                    </p>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <p class="pull-right">
                                                                        <button type="submit" class="btn btn-outline btn-primary">AUTORIZAR</button>

                                                                    </p>
                                                                        </div>
                                                                    </div>
                                                            </form>

                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>






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

    <!-- Modal caixa fechado -->
                    <div id="myModalAutorizado" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Autorização Realizada Com Sucesso</h4>
                          </div>
                          <div class="modal-body">
                            <p>Autorização realizada com sucesso. A partir de hoje esta pessoa esta autorizada a retirar exames para este paciente.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->



@endsection
