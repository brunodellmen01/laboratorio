@extends('layouts.app')

@section('content')
<title>Cadastro de Preço de Exames</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Movimentaçoes Financeiras
                    <a href="{{ url('financeiro/movimentacao') }}" class="pull-right">Listar Movimentações</a>
                </div>

                <div class="panel-body">

                    @if(Session::has('mensagem_ok'))
                        <div class="alert alert-success">
                            {{Session::get('mensagem_ok')}}
                        </div>
                    @endif
                    
                    <?php if(array_key_exists("inserido", $_GET) && $_GET['inserido']=='true') { ?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                    <?php } ?>

                        {!! Form::open(['url' => 'financeiro/movimentacao/salvar']) !!}
                    

                    
                        <div class="row">
                            
                            
                            <div class="col-sm-6">                              
                                <div class="form-group has-feedback">
                                    <input type="text" name="price" placeholder="VALOR" class="form-control">
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                                <br/>
                            </div>

                            <div class="col-sm-6"> 
                                <div class="form-group has-feedback">                            
                                  <select class="form-control js-example-basic-single" id="select2" name="type" required>
                                     <option value="">SELECIONE O TIPO</option>
                                     <option value="ENTRADA">ENTRADA</option>
                                     <option value="SAIDA">SAIDA</option>                                
                                  </select>
                                  <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                                <br/>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group has-feedback">
                                    {!! Form::text('description', NULL, ['class' => 'form-control', 'placeholder' => 'DESCRIÇÃO', 'required' => 'required'])!!}
                                    <span class="glyphicon glyphicon-asterisk text-warning form-control-feedback"></span>
                                </div>
                                <br/>
                            </div>


                            
                                <div class="col-sm-12">
                                    {!! Form::submit('REGISTRAR', ['class' => 'btn btn-outline btn-info pull-left'])!!}
                                    <br/>
                                </div>
                            
                        </div>
                        
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
