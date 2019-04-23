@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    SELECIONE O PACIENTE PARA VISUALIZAR O RELATÓRIO
	                </a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
<div class="col-sm-12 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraHistorico" onkeyup="filtraHistorico()"> <span 		class="input-group-btn" name="filtraHistorico" >
       <button type="button" class="btn btn-sm btn-info"> NOME</button> </span>
     </div>
</div>
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($pacientes as $paciente)
                                  <tr>
                                    <td>
                                    	<a href="historico/paciente/{{$paciente->patient_id}}" class="btn btn-outline btn-info btn-block" data-toggle="tooltip" data-placement="bottom" title="CLIQUE PARA VER O HISTÓRICO DESTE PACIENTE">
	                    					{{$paciente->patient->name}}
	                					</a>
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
