@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-sm-4">

            <h2><i class="fa fa-shopping-cart"></i> Pedidos</h2>

        </div>

        <div class="col-sm-8">

            <div class="title-action">

                <a href="{{ url('pedido/listar') }}" class="btn btn-outline btn-info"><i class="fa fa-list" aria-hidden="true"></i>

                    Listar Pedidos</a>

            </div>

        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

            <div class="col-lg-12">

                <div class="ibox float-e-margins">

                    <div class="ibox-title">

                        <h5>Cadastro de Exame Nº <?php $_SESSION['ultimo'] = $ultimo;
echo $ultimo;?>

                            <div class="col-md-12">
                                    @if(Session::has('mensagem_ok'))
                            <div class="alert alert-success">
                                {{Session::get('mensagem_ok')}}
                            </div>
                        @endif
                                </div>
                        </h5>



                    </div>
                    <div class="ibox-content">

<ul class="nav nav-tabs nav-justified">

                            <li><i class="fa fa-user-o" aria-hidden="true"></i></li>

                            <li><i class="fa fa-file-text-o" aria-hidden="true"></i></li>

                            <li><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>

                        </ul>
	<div class="table-responsive">

                            <table class="footable table table-stripped table-hover" data-page-size="8" data-filter=#filter>

                                <thead>

                                <tr>



                                    <th>Exame</th>

                                    <th class="text-center">Convênio</th>

                                    <th>Valor</th>

                                    <th>Ações</th>

                                </tr>

                                </thead>

                                <tbody>

                                <tr>

                                    @foreach($values as $value)

                                        <td class="pull-left">{{$value->exam->name}}</td>
                                        <td class="text-center">{{$value->covenant->name}}</td>
                                        <td>R$: {{$value->value}}</td>


                                    <td>
                                    	<a href="../pedido/{{$value->id}}/adicionar?pedido=<?php echo $ultimo; ?>"><button type="button" class="btn btn-outline btn-info" title="CLIQUE PARA ADICIONAR">

                                    		<i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>

                            </table>

                        </div>
</div>
</div></div></div></div>
@endsection