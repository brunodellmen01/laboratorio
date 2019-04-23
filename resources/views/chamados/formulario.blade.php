@extends('layouts.app')

@section('content')
@if(!empty(Session::get('aberto')) && Session::get('aberto') == "SIM")
<script>
$(function() {
    $('#myModalAberto').modal('show');
});
</script>
@endif
@if(!empty(Session::get('aberto')) && Session::get('aberto') == "NAO")
<script>
$(function() {
    $('#myModalFechado').modal('show');
});
</script>
@endif
<title>Registro de chamados</title>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registro de Chamados
                    <a href="{{ url('chamados/lista') }}" class="pull-right">Listar Chamados</a>
                    <br/>
                </div>

                <div class="panel-body">

                    @if(Session::has('mensagem_ok'))
                        <div class="alert alert-success">
                            {{Session::get('mensagem_ok')}}
                        </div>
                    @endif

                	<?php if (array_key_exists("inserido", $_GET) && $_GET['inserido'] == 'true') {?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php }?>



                        {!! Form::open(['url' => 'chamados/salvar']) !!}

                    	<div class="row">


        	  						<div class="col-md-12 form-group has-error has-feedback">
        	  							{!! Form::input('text', 'title', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'DIGITE O TÍTULO DO CHAMADO', 'required' => 'required'])!!}
        	  							<br/>
        	  						</div>

                                    <div class="col-md-12 form-group has-error has-feedback">
                                      <textarea name="message" rows="6" placeholder="DIGITE SUA MENSAGEM" class="form-control" required=""></textarea>
                                      <br/>
                                    </div>

                                    <div class="col-md-12">

                                        <input type="text" name="url" class="form-control" placeholder="URL: EXEMPLO: labsystem.net.br/pacientes/3/editar">
                                        <P></P>
                                        <br/>

                                    </div>

                                    <div class="col-md-5 form-group has-error has-feedback">

                                            <label>NÍVEL DO CHAMADO</label><P></P>
                                            <label class="radio-inline danger"><input type="radio" name="level" required value="GRAVE">GRAVE</label>
                                            <label class="radio-inline"><input type="radio" name="level" value="ALTO">ALTO</label>
                                            <label class="radio-inline"><input type="radio" name="level" value="MÉDIO">MÉDIO</label>
                                            <label class="radio-inline"><input type="radio" name="level" value="BAIXO">BAIXO</label>
                                        <br/>
                                    </div>
                                    <P></P>
                                    <div class="col-md-7 form-group has-error has-feedback">

                                            <label>TIPO DE ATENDIMENTO</label><P></P>
                                            <label class="radio-inline"><input type="radio" name="type" required value="PERGUNTA">PERGUNTA</label>
                                            <label class="radio-inline"><input type="radio" name="type" value="PROBLEMA">PROBLEMA</label>
                                            <label class="radio-inline"><input type="radio" name="type" value="SUGESTÃO">SUGESTÃO</label>
                                            <label class="radio-inline"><input type="radio" name="type" value="INCIDENTE">INCIDENTE</label>
                                        <br/>
                                    </div>

                                    <div class="col-md-12">
                                        <P></P>
                                        <br/>
                                        {!! Form::submit('ABRIR CHAMADO', ['class' => 'btn btn-outline btn-info pull-left'])!!}

                                    </div>
						</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal caixa fechado -->
                    <div id="myModalAberto" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Chamado Aberto</h4>
                          </div>
                          <div class="modal-body">
                            <p>Nossa equipe</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

                    <!-- Modal caixa fechado -->
                    <div id="myModalFechado" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Erro ao Arir Chamado</h4>
                          </div>
                          <div class="modal-body">
                            <p>Erro ao abrir chamado</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->


@endsection
