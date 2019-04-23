@extends('layouts.labsystem')

@section('content')
    <div class="row">

        <div class="col-lg-3">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-success pull-right">Hoje</span>

                    <h5>Pacientes</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">15</h1>

                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>

                    <small>Pacientes que estão aguardando</small>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">Hoje</span>

                    <h5>Atendidos</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">10</h1>

                    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>

                    <small>Pacientes que já foram atendidos.</small>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-primary pull-right">Mensal</span>

                    <h5>Contas a receber</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">6</h1>

                    <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>

                    <small>contas para receber.</small>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-danger pull-right">Mensal</span>

                    <h5>Contas a pagar</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">4</h1>

                    <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>

                    <small>Contas em abertos</small>

                </div>

            </div>

        </div>
    </div>

@endsection
