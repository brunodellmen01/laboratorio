
@extends('layouts.app')

@section('content')

<?php
session_start();
//$ultimo = $_SESSION['ultimo'];
$_SESSION['ultimo'] = $ultimoId;
?>


    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-sm-4">

            <h2><i class="fa fa-shopping-cart"></i> Carrinho </h2>

        </div>

        <div class="col-sm-8">

            <div class="title-action">

                <a href="{{ url('pedido/listar') }}" class="btn btn-outline btn-info"><i class="fa fa-list" aria-hidden="true"></i>

                    Listar Pedidos </a>

            </div>

        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

            <div class="col-lg-12">

                <div class="ibox float-e-margins">

                    <div class="ibox-title">

                        <h5>Exames Adicionados </h5>

                    </div>
                    <div class="ibox-content">

<ul class="nav nav-tabs nav-justified">

                            <li><i class="" aria-hidden="true"></i></li>

                            <li><i class="" aria-hidden="true"></i></li>

                            <li><i class="" aria-hidden="true"></i></li>

                        </ul>
	<div class="table-responsive">

                            <table class="footable table table-stripped table-hover" data-page-size="8" data-filter=#filter>

                                <thead>

                                <tr>
                                    <th>Exame</th>

                                    <th>Valor</th>

                                    <th>Ações</th>

                                </tr>

                                </thead>

                                <tbody>

                                <tr>
                                     @forelse($orderArticles as $orderArticle)
                                        <td>{{$orderArticle->exam->name}}</td>
                                        <td>R$: {{$orderArticle->price}}</td>

                                    <td>
                                        <a href="../{{$orderArticle->id}}/remover?pedido=<?php echo $ultimoId; ?>"><button type="button" class="btn btn-outline btn-info" title="CLIQUE PARA REMOVER">

                                            <i class="fas fa-minus" aria-hidden="true"></i>

                                        </button>

                                        </a>

                                    </td>
                                </tr>

                                @empty
                                    <div class="alert alert-info">
                                        Voçê Ainda Não Adcionou Nenhum Exame.
                                    </div>

                                @endforelse
                                </tbody>

                            </table>
                            <div class="col-md-6 pull-left">
                            	<a href="javascript:history.back()" class="btn btn-outline btn-info pull-left">

                                    ADICIONAR

                                </a>

                            </div>
                            <div class="col-md-6 pull-right">

                            	<a href="{{ url('pedido/finalizar') }}" class="btn btn-outline btn-info pull-right">
                            		FINALIZAR

                                </a>
                            </div>
                        </div>

</div></div></div></div></div>

@endsection