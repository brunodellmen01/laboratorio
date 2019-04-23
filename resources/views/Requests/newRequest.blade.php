@extends('layouts.app')

@section('content')

<?php

session_start();
$user_id = Auth::user()->id;

?>

</script>
    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-sm-4">

            <h2><i class="fa fa-shopping-cart"></i> Pedidos</h2>

        </div>

        <div class="col-sm-8">

            <div class="title-action">

                <a href="{{ url('pedido/listar') }}" class="btn btn-outline btn-info"><i class="fa fa-list" aria-hidden="true">     </i>

                    Listar Pedidos</a>

            </div>

            <br>

        </div>

    

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

            <div class="col-lg-12">

                <div class="ibox float-e-margins">

                    <div class="ibox-title">

                        <h5>Cadastro de Exame


                        </h5>



                    </div>

                    <div class="ibox-content">

                       


                        <div class="tab-content">

                            <div id="home" class="tab-pane fade in active">



                                <p>

                                <div class="row">

                                    <div class="col-md-12">

                                            {!! Form::open(['url' => 'pedidos/salvar']) !!}

                                    </div>



                                    <div class="col-md-3">

                                        <input type="hidden" value="ABERTO">

                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                                            <input type="hidden" name="date" class="form-control" value="<?php echo Date('Y-m-d'); ?>" readonly>



                                        {!! Form::input('date', 'dt_retire', NULL, ['class' => 'form-control', 'required' => 'required'])!!}

                                    </div>


                                    <div class="col-md-3 form-group has-error has-feedback">

                                        <select class="form-control js-example-basic-single"  name="states_id" required>
                                        <option value="">SELECIONE A FORMA PGTO</option>
                                            @foreach(\App\State::all() as $state)
                                                <option value="{{$state->id}}">{{$state->title}}</option>
                                            @endforeach

                                        </select>

                                    </div>





                                    <div class="col-md-3 form-group has-error has-feedback">
                                        <select class="form-control js-example-basic-single"  name="city_id" required>
                                            <option value="">SELECIONE A CIDADE</option>
                                            @foreach(\App\Locale\City::all() as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                <div class="col-md-3 form-group has-error has-feedback">

                                    <select class="form-control js-example-basic-single" name="medic_id" required>

                                        <option value="">SELECIONE O MÉDICO</option>

                                        @foreach(\App\Medic::all() as $medic)
                                            <option value="{{$medic->id}}">{{$medic->name}}</option>
                                        @endforeach

                                    </select>

                                </div>



                                <br>


                                </p>

                                <p>

                                    <br>



                                <div class="col-md-3 form-group has-error has-feedback">

                                    <select class="form-control js-example-basic-single"  name="type" required>

                                        <option value="">SELECIONE O TIPO</option>
                                            @foreach(\App\Type::all() as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach

                                        </select>

                                    </select>

                                </div>




                                <div class="col-md-3 form-group has-error has-feedback">

                                    <select class="form-control js-example-basic-single"  name="clinic_id" required>

                                        <option value="">SELECIONE A CÍNICA</option>

                                        @foreach(\App\Clinic::all() as $clinic)
                                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                        @endforeach

                                    </select>

                                </div>



                                <div class="col-md-3 form-group has-error has-feedback">

                                    <select class="form-control js-example-basic-single" required>

                                        <option value="">SELECIONE O TIPO DE CONVÊNIO</option>

                                        <option>PARTICULAR</option>

                                        <option>CONVÊNIO</option>

                                    </select>

                                </div>

                                <div class="col-md-3 form-group has-error has-feedback">


                                    <select class="form-control js-example-basic-single" name="covenant_id" required>

                                        <option value="">SELECIONE O CONVÊNIO</option>

                                        @foreach(\App\Covenant::all() as $covenant)
                                            <option value="{{$covenant->id}}">{{$covenant->name}}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <br>


                                </p>

                                <p>

                                    <br>

                                <div class="col-md-3">

                                    <select class="form-control js-example-basic-single" id="sel1" name="patient_id" required>

                                        <option value="">SELECIONE O PACIENTE</option>

                                        @foreach(\App\Patient::all() as $patient)
                                            <option value="{{$patient->id}}">{{$patient->name}}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="col-md-3">


                                    <input type="number" name="qtd" value="1" class="form-control" placeholder="QUANTIDADE DE PARCELAS" required="">

                                </div>

                                <div class="col-md-6">

                                    <label>ATENÇÃO. SE A FORMA DE PAGAMENTO FOR "A PRAZO", AUTERAR A QUANTIDADE DE PARCELAS.</label>

                                </div>

                                

                                <div class="col-md-12">

                                    <br>

                                    {!! Form::input('hidden', 'id_unity', Auth::user()->id_unity, ['class' => 'form-control'])!!}
                                    {!! Form::submit('SALVAR', ['class' => 'btn btn-outline btn-info pull-right'])!!}


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

                                        <th class="pull-left">EXAME</th>


                                    </tr>

                                    </thead>

                                    <tbody>


                                    <tr>

                                        <td>




                                            </a>
                                        </td>

                                    </tr>


                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-12">

                                <a data-toggle="tab" href="#menu2" class="btn btn-outline btn-info pull-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>

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

                                        <th>EXAMES</th>

                                    </tr>

                                    </thead>

                                    <form action="" method="post">

                                        <tbody>

                                        <tr>

                                            <td>

                                                <a href="?acao=del&id=17"><button type="button" class="btn btn-outline btn-info btn-block" title="CLIQUE PARA REMOVER">



                                                </a>
                                            </td>


                                        </tr>

                                        <tr>


                                        </tbody>

                                        </td>

                                </table>

                                <div class="col-md-12">

                                    <a href="{{ url('pedidos/finalizar') }}" class="btn btn-outline btn-info pull-right"><i class="fa fa-check" aria-hidden="true"> FINALIZAR</i></a>

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


