@extends('layouts.app')

@section('content')
<title>Cadastro de Laboratórios</title>

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-4">
    <h2><i class="fa fa-shopping-cart"></i> Pedidos</h2>
  </div>
  <div class="col-sm-8">
    <div class="title-action">
      <a href="{{ url('pedidos/listar') }}" class="btn btn-outline btn-primary"><i class="fa fa-list" aria-hidden="true"></i>
       Listar Pedidos</a>
     </div>
   </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>REGISTRO DE EXAMES</h5>
        </div>
        <div class="ibox-content">
          <ul class="nav nav-tabs nav-justified">
            <li><a data-toggle="tab" href="#home"><i class="fa fa-user-o" aria-hidden="true"></i>
            </a></li>
            <li><a data-toggle="tab" href="#menu1"><i class="fa fa-file-text-o" aria-hidden="true"></i>
            </a></li>
            <li><a data-toggle="tab" href="#menu2"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">

              <p>
                <div class="row">
                  <div class="col-md-3">
                    @if(Session::has('mensagem_ok'))
                        <div class="alert alert-success">
                            {{Session::get('mensagem_ok')}}
                        </div>
                    @endif
                    
                  @if(array_key_exists("inserido", $_GET) && $_GET['inserido']=='true') { ?>
                        <div class="alert alert-success">
                          <p><i class="fa fa-check" aria-hidden="true"></i> Operação Realizada com Sucesso. </p>
                        </div>
                  @endif

                    @if(Request::is('*/editar'))
                        {!! Form::model($tipoResultado, ['method' => 'PATCH', 'url' => 'tipoResultado/'.$tipoResultado->id.'/editar']) !!}
                    @else
                        {!! Form::open(['url' => 'tipoResultado/salvar']) !!}
                    @endif

                    {!! Form::input('text', 'date_ped', NULL, ['class' => 'form-control', 'required' => 'required'])!!}

                    <!-- campo date acima -->
                  
                  </div>

                  <div class="col-md-3">
                    <input type="date" class="form-control" placeholder="DATA E HORA DE RETIRADA">
                  </div>


                  <div class="col-md-3">
                    <select class="form-control" id="sel1">
                      <option>SELECIONE O STATUS</option>
                      <option>ABERTO</option>
                      <option>PARCIAL</option>
                      <option>PAGO</option>
                    </select>
                  </div>


                  <div class="col-md-3">
                    <select class="form-control" id="sel1">
                      <option>SELECIONE A CIDADE</option>
                      <option>CIDADE 1</option>
                      <option>CIDADE 2</option>
                      <option>CIDADE 3</option>
                    </select>
                  </div>

                  <br>
                </p>
                <p>
                  <br>

                  <div class="col-md-3">
                    <select class="form-control" id="sel1">
                      <option>SELECIONE A CIDADE PRIMEIRO</option>
                      <option>PACIENTE 1</option>
                      <option>PACIENTE 2</option>
                      <option>PACIENTE 3</option>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <select class="form-control" id="sel1">
                      <option>SELECIONE O MÉDICO</option>
                      <option>MÉDICO 1</option>
                      <option>MÉDICO 2</option>
                      <option>MÉDICO 3</option>
                    </select>
                  </div>



                  <div class="col-md-3">
                    <select class="form-control" id="sel1">
                      <option>SELECIONE O TIPO</option>
                      <option>EXTERNO</option>
                      <option>INTERNO</option>
                    </select>
                  </div>

                  <br>
                </p>
                <p>
                  <br>

                  <div class="col-md-3">
                    <select class="form-control" id="sel1">
                      <option>SELECIONE A CLÍNICA</option>
                      <option>CÍNICA 1</option>
                      <option>CÍNICA 2</option>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <select class="form-control" id="sel1">
                      <option>SELECIONE O TIPO</option>
                      <option>PARTICULAR</option>
                      <option>CONVÊNIO</option>
                    </select>
                  </div>



                  <div class="col-md-3">
                    <select class="form-control" id="sel1">
                      <option>SELECIONE O CONVÊNIO</option>
                      <option>CONVÊNIO 1</option>
                      <option>CONVÊNIO 2</option>
                      <option>CONVÊNIO 3</option>
                    </select>
                  </div>

                  <div class="col-md-12">
                    <br>

                    <a data-toggle="tab" href="#menu1" class="btn btn-outline btn-primary pull-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>

                  </div>

                </div>
              </p>
            </div>


            <div id="menu1" class="tab-pane fade">

              <p>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>EXAME</th>
                        <th>VALOR</th>
                        <th>AÇÃO</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>ABO</td>
                        <td>R$: 20,00</td>
                        <td>
                          <a href="#menu2" data-toggle="tab"><button type="button" class="btn btn-outline btn-primary"><span class="fa fa-plus-square" aria-hidden="true"> </button></span></a>
                        </td>
                      </tr>
                      <tr>
                        <td>URINALISE</td>
                        <td>R$: 10,00</td>
                        <td>
                          <a href="#menu2" data-toggle="tab"><button type="button" class="btn btn-outline btn-primary"><span class="fa fa-plus-square" aria-hidden="true"> </button></span></a>
                        </td>
                      </tr>
                      <tr>
                        <td>GRAVIDES</td>
                        <td>R$: 4,00</td>
                        <td>
                          <a href="#menu2" data-toggle="tab"><button type="button" class="btn btn-outline btn-primary"><span class="fa fa-plus-square" aria-hidden="true"> </button></span></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>  
                </div>
                <div class="col-md-12">
                  <a data-toggle="tab" href="#menu2" class="btn btn-outline btn-primary pull-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div> 
              </p>
              <br/>
            </div>


            <div id="menu2" class="tab-pane fade">

              <p>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th width="70%">EXAMES</th>
                        <th align="center"  >VALOR</th>
                        <th >AÇÕES</th>
                      </tr>
                    </thead>
                    <form action="?acao=up" method="post">
                      <tbody>
                        <tr>       
                          <td>Urinalise<br / ></td>
                          <td>R$: 200,00<br / ></td>
                          <td>
                            <a href="?acao=del&id=17"><button type="button" class="btn btn-outline btn-primary"><span class="fa fa-minus-square-o" aria-hidden="true"> </button></span></a>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><b>Total</b></td>
                          <td><b>R$ 200,00</b></td>
                        </tr>
                      </tbody>        
                    </td>
                  </table>
                  <div class="col-md-12">
                    <a href="finalizado.html" class="btn btn-outline btn-primary pull-right"><i class="fa fa-check" aria-hidden="true"> FINALIZAR</i></a>
                  </div> 
                </div>


              </p>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>


@endsection
