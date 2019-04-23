@extends('layouts.app')

@section('content')


<div class="wrapper wrapper-content">

         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>
                                	PACIENTES CADASTRADOS NA CIDADE DE
                                	@forelse($pacientes as $paciente)
                                		<b> {{$paciente->city->name}} </b>
                                	@empty
                                	@endforelse
                                </h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
                    <div class="table-responsive">
<div class="col-sm-12 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraPacEmCidade" onkeyup="filtraPacEmCidade()"> <span 		class="input-group-btn" name="filtraPacEmCidade" >
       <button type="button" class="btn btn-sm btn-info"> NOME</button> </span>
     </div>
</div>
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>NOME</th>
                                            <th>E-MAIL</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($pacientes as $paciente)
                                                    <td>{{$paciente->name}}</td>
                                                    <td>{{$paciente->email}}</td>
                                            </tr>
                                            @empty
                                                <td colspan="2">Nenhum Paciente Cadastrado Para Esta Cidade.</td>

                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="pull-right" >
		                            	
		                          	</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>



@endsection
