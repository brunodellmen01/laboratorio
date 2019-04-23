
@extends('layouts.app')

@section('content')
    <title>Listagem de Itens do Pedidos</title>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Lista de Exames
                        
                    </div>

                    <div class="panel-body">

                        
                        <div class="table-responsive">
                            <table class="footable table table-stripped table-hover" data-page-size="8" data-filter=#filter>

                                <thead>

                                <tr>

                                	<th>ID</th>

                                    <th>Exame</th>

                                    <th>PREÇO</th>

                                </tr>

                                </thead>

                                <tbody>

                                <tr>

                                    @foreach($exams as $exame)
                                    	<td>{{$exame->id}}</td> 
                                        <td>{{$exame->exam->name}}</td>
                                        <td>R$: {{$exame->price}}</td>      
                                    	<td>
                                    		<a href="../<?php echo $id_pedidos;?>/laudo/{{$exame->exam_id}}/novo" class="btn btn-outline btn-info">LAUDO</a>
                                    	</td>
                                </tr>
                                @endforeach
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