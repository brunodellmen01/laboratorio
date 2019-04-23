@extends('layouts.app')

@section('content')


<div class="wrapper wrapper-content">

         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>
                                	RESULTADADOS CADASTRADOS PARA O EXAME
                                	@forelse($resultados as $resultado)
                                	@empty
                                	@endforelse
                                    <b> {{$resultado->exam->name}} </b>
                                </h5>

                            </div>
        <div class="ibox-content">
                                <div class="table-responsive">
<div class="col-sm-12 m-b-xs">
      <div class="input-group">
	<input type="text" placeholder="FILTRAR" class="input-sm form-control" id="filtraResultEmExame" onkeyup="filtraResultEmExame()"> <span 		class="input-group-btn" name="filtraResultEmExame" >
       <button type="button" class="btn btn-sm btn-info"> NOME</button> </span>
     </div>
</div>
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>NOME</th>
                                            <th>TIPO</th>
                                            <th>REFERENCIA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse($resultados as $resultado)
                                                	<td>{{$resultado->description}}</td>
                                                    <td>{{$resultado->category->name}}</td>
                                                    <td>{{$resultado->reference}}</td>
                                            </tr>
                                            @empty
                                                <td colspan="3">Nenhum Paciente Cadastrado Para Esta Cidade.</td>

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
