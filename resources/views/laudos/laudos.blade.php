@extends('layouts.app')

@section('content')




@if ($errors->any())
 <ul class="alert alert-warning">
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 @endif



<div class="container">
 <h1>Novo Laudo</h1>

 
 
<!-- Nome Form Input -->

 <div class="form-group">

 </divv>


 <div class="form-group">
 
</div>



</div>


                            <table class="footable table table-stripped table-hover" data-page-size="8" data-filter=#filter>

                                <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>DESCRIÇÃO</th>
                                    <th>EXAME</th>
                                    <th>RESULTADO</th>
                                    <th>TIPO</th>
                                    <th>REF.</th>

                                </tr>

                                </thead>

                                <tbody>

                                <tr>
                                	
                                	
                                    @foreach($resultados as $resultado)
                                    	<td>{{$resultado->id}}</td>
                                        <td>{{$resultado->description}}</td>
                                        <td>{{$resultado->exam->name}}</td>
                                        <td>
                                        	{!! Form::open(['url' => 'store']) !!}
                                        		<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        		{!! Form::text('price', null) !!}
                                        		
                                        </td>
                                        <td>{{$resultado->category->name}}</td>
                                        <td>{{$resultado->reference}}</td>
                                        <td>
                                        	<input type='checkbox' class='marcar' name='check[]' />
                                        </td>
                                    	
                                </tr>
                                @endforeach
                               
                                </tbody>

                            </table>
                            {!! Form::submit('salvar', ['class'=>'btn btn-info']) !!}
                          {!! Form::close() !!}

@endsection