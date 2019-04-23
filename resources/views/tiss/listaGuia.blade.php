@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    SELECIONE A GUIA PARA VISUALIZAR OU CLICK NO BOTÃO PARA IMPRIMIR
	                </a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($guias as $guia)
                                  <tr>
                                    <td>
                                    	<a href="consulta/guia/{{$guia->id}}" class="btn btn-outline btn-info btn-block" data-toggle="tooltip" data-placement="bottom" title="VISUALIZAR GUIA">
        	                    					
                                        Nª GUIA:  {{$guia->num_guia}} <br>
        	                    					PACIENTE: {{$guia->nome_paciente}}<br><br>
	                					          </a>
                                    </td>

                                    <td>
                                      <a href="consulta/guia/{{$guia->id}}/pdf" target="_blank" class="btn btn-outline btn-info btn-block" data-toggle="tooltip" data-placement="bottom" title="GERAR GUIA">
                                        
                                        <i class="fas fa-print fa-3x"></i> <br><br>
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
