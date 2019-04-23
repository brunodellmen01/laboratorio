@extends('layouts.app')

@section('content')


@forelse($procedimentos as $procedimento)  
@empty
@endforelse

@forelse($guia_tiss as $guia)  
@empty
@endforelse

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          Procedimentos Guia TISS Nº {{$guia->num_guia}} <br>
          {{$nome_paciente}}
        </div>
        <div class="panel-body">  
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th>Procedimento</th>
                <th>QTD</th>
                <th>Valor Unit.</th>
                <th>Valor Total</th>
              </tr>
            </thead>
            <tbody>
              @forelse($procedimentos as $procedimento)
                <tr>
                  <td align="left">{{$procedimento->procedimento}}</td>
                  <td align="left">{{$procedimento->qtd}}</td>
                  <td align="left">R$: {{$procedimento->valor}}</td>
                  <td align="left">R$: {{$procedimento->valor_total}}</td>
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