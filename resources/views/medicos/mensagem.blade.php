@extends('layouts.app')

@section('content')
<title>Operação Consluida</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('medicos) }}" class="pull-right">Novo Médico</a>
                </div>

                <div class="panel-body">                    
                        <div class="alert alert-success">
                            Operação Realizada Com Sucesso.
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
