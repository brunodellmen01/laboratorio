@extends('layouts.app')

@section('content')
<title>Despesas Por Convênios</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Convênios
                </div>

                <div class="panel-body">                    
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                        	<thead>
                              <tr>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($convenios as $convenio)
                                  <tr>                                  
                                    <td class="col-md-12">
                                        <a href="convenio/{{$convenio->id}}" class="btn btn-outline btn-info btn-block">{{ $convenio->covenant->name }}</a>
                                    </td>                                   
                                  </tr>
                                  @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
