@extends('layouts.app')

@section('content')
<title>Cadastro de Usuários</title>

@if(!empty(Session::get('ativar')) && Session::get('ativar') == "SIM")
<script>
$(function() {
    $('#myModalAtivado').modal('show');
});
</script>
@endif

@if(!empty(Session::get('ativar')) && Session::get('ativar') == "NAO")
<script>
$(function() {
    $('#myModalNaoAtivado').modal('show');
});
</script>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                        Cadastro de Usuários

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

                        @if(Request::is('*/editar'))
                        {!! Form::model($usuario, ['method' => 'PATCH', 'url' => 'usuarios/'.$usuario->id.'/editar', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
                        {{ csrf_field() }}
                    @else
                        {!! Form::open(['url' => 'usuarios/salvar', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
                        {{ csrf_field() }}
                    @endif



                    	<div class="row">
	  						<div class="col-sm-12">
                                <div class="form-group has-feedback">
                                    {!! Form::input('text', 'name', NULL, ['class' => 'form-control', 'autofocus', 'placeholder' => 'NOME', 'required' => 'required'])!!}
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>

	  							<br/>
	  						</div>

                            <div class="col-sm-6">
                                <div class="form-group has-feedback">
                                    {!! Form::input('email', 'email', NULL, ['class' => 'form-control', 'placeholder' => 'E-MAIL', 'required' => 'required'])!!}
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                                <br/>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group has-feedback">
                                    {!! Form::input('password', 'password', NULL, ['class' => 'form-control', 'placeholder' => 'SENHA', 'required' => 'required'])!!}
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>

                                <br/>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group has-feedback">
                                    <select class="form-control" name="sexo" required="">
                                        @if(isset($usuario))
                                            <option value="{{$usuario->sexo}}">{{$usuario->sexo}}</option>
                                        @endif
                                        <option value=""> SELECIONE O SEXO</option>
                                        <option value="FEMININO" name="sexo">FEMININO</option>
                                        <option value="MASCULINO" name="sexo">MASCULINO</option>
                                    </select>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group has-feedback">
                                    <select required class="form-control" name="id_unity">
                                        @if(isset($usuario))
                                            <option value="{{$usuario->id_unity}}">{{$usuario->filial->name}}</option>
                                        @endif
                                        <option value="">SELECIONE A UNIDADE</option>
                                            @foreach($unidades as $unidade)
                                                <option value="{{$unidade->id}}">{{$unidade->name}}</option>
                                            @endforeach
                                    </select>
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                                <br/>
                            </div>


                                </div>


                                <div class="col-sm-12">
                                    <input type="file" name="image" class="btn btn-outline btn-info pull-right">
                                <br/>

                                </div>

                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-outline btn-info pull-left">
                                        SALVAR
                                    <br/>
                                    </button>
                                </div>
                                {!! Form::close() !!}
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>



                    <!-- Modal caixa fechado -->
                    <div id="myModalAtivado" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Usuário Cadastrado</h4>
                          </div>
                          <div class="modal-body">
                            <p>Usuário Cadastrado com Sucesso. Um link para ativação da conta do usuário foi enviado no e-mail informado.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->


                    <!-- Modal caixa fechado -->
                    <div id="myModalNaoAtivado" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Usuário Cadastrado</h4>
                          </div>
                          <div class="modal-body">
                            <p>Usuário Cadastrado com Sucesso. Porŕem não foi possivel enviar um email com o link para ativação. Caso queira ativa-lo manualmente <a href="">clique aqui</a>.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Modal caixa fechado -->

@endsection
