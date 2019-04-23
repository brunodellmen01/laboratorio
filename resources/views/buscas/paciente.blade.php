@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                    @if( $total == 0 )

                      O SISTEMA DE BUSCA NÃO LOCALIZOU NENHUM PACIENTE COM O NOME <b><i>{{$nome}}</i></b>.
                    
                    @else                      

                      O SISTEMA DE BUSCA LOCALIZOU {{$total}} PACIENTES COM O NOME <b><i>{{$nome}}</i></b>.
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
                                @forelse($pacientes as $paciente)
                                  <tr>
                                    <td>
                                    	<a href="../pacientes/{{$paciente->id}}/editar" class="btn btn-outline btn-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="CLIQUE PARA EDITAR">
        	                    					{{$paciente->name}}
	                           					</a>
                                    </td>
                                  </tr>
                                  @empty
                                    <td>
                                      
                                        <b><i>{{$nome}}</i></b> NÃO SE ENCONTRA EM SUA BASE DE DADOS. 
                                        <a data-toggle="modal" href="#myModalCad" title="CLIQUE AQUI PARA CADASTRA-LO">DESEJA CADASTRA-LO?</a>
                                      
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


<!-- Modal -->
<div id="myModalCad" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastro Rápido </h4>
      </div>
      <div class="modal-body">
        <p>
          {!! Form::open(['url' => 'pacientes/cadastro/rapido']) !!}
          <div class="row">
              <div class="col-sm-6">
                <input type="text" name="name" value="{{$nome}}" class="form-control" required="" placeholder="NOME">
                 <br/>
            </div>

            <div class="col-sm-6">
                  {!! Form::input('date', 'dt_birth', NULL, ['class' => 'form-control', 'placeholder' => 'DATA DE NASCIMENTO'])!!}
                  <br/>
                </div>

            <div class="col-sm-6">
              <select class="form-control" name="sex" required>
                <option value="" >SELECIONE O SEXO</option>
                <option value="F" selected="">FEMININO</option>
                <option value="M">MASCULINO</option>
              </select>
              <br/>
            </div>

            <div class="col-sm-6">
              <select class="form-control" name="city_id" required>
                  <option value="">SELECIONE A CIDADE</option>
                  @foreach($cidades as $cidade)
                    <option value="{{$cidade->id}}">{{$cidade->name}}</option>
                  @endforeach
              </select>
              <br/>
            </div>

            <div class="col-sm-12">
              @if(Session::has('mensagem_ok'))
                  <div class="alert alert-success">
                    {{Session::get('mensagem_ok')}}
                  </div>
              @endif
            </div>

            
          </div>
        </p>
      </div>
      <div class="modal-footer">
        {!! Form::submit('SALVAR', ['class' => 'btn btn-default'])!!}
        {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>


@endsection
