@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if( $total == 0 )

                      O SISTEMA DE BUSCA NÃO LOCALIZOU NENHUM PEDIDO COM O PROTOCOLO <b><i>{{$protocolo}}</i></b>.
                    
                    @else                      

                      O SISTEMA DE BUSCA LOCALIZOU O PEDIDO PERTENCENTE AO PROTOCOLO <b><i>{{$protocolo}}</i></b>.
                    @endif

	                </a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse($protocolos as $protocolo)
                                  <tr>
                                    <td>
                                    	<a href="../pedidos/{{$protocolo->id}}/detalhes" class="btn btn-outline btn-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="CLIQUE PARA VER OS DETALHES">
        	                    					Paciente: {{$protocolo->patient->name}} <br> 
                                        Retirar em: 
                                        <?php
                                          $data = $protocolo->date;
                                          echo date('d/m/Y', strtotime($data));
                                        ?>
                                        <br>
                                        Status: {{$protocolo->status}}
	                           					</a>
                                    </td>


                                  </tr>
                                  @empty
                                    <td>
                                      
                                        NENHUM RESULTADO ENCONTRADO
                                      
                                    </td>
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
</div>
@endsection
