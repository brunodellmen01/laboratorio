@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Guias TISS Emitidas
                </div>
                <div class="panel-body">  
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Nº GUIA</th>
                                <th>PACIENTE</th>
                                <th>DATA SOLICITAÇÃO</th>
                                <th colspan="3">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guia_tiss as $guia)
                                <tr>
                    	            <td align="left">{{$guia->num_guia}}</td>
                                    <td align="left">{{$guia->nome_paciente}}</td>
                                    <td align="left">
                                    	<?php
   					   						$data = $guia->data_solicita;
					   						echo date('d/m/Y', strtotime($data));
                                        ?> 
                                    </td>
                                    <td align="left">
                                    	<a href="ver/{{$guia->num_guia}}" class=" btn btn-info btn-md">
                                    		<span class="fas fa-eye"></span>
                                    	</a>
                                    </td>
                                    <td align="left">
                                    	<a href="pdf/{{$guia->id}}" target="_blanck" class=" btn btn-info btn-md">
                                    		<span class="far fa-file-pdf"></span>
                                    	</a>
                                    </td>
                                </tr>
                                @empty
                                 	<tr>
                                 		<td>
                                 			<div class="alert alert-nfo">
                                 				NENHUM REGISTRO ENCONTRADO.
                                 			</div>
                                 		</td>
                                 	</tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection