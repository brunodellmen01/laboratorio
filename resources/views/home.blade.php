@extends('layouts.app')

@section('content')
    <script>
        var clockid=new Array()
        var clockidoutside=new Array()
        var i_clock=-1
        var thistime= new Date()
        var hours=thistime.getHours()
        var minutes=thistime.getMinutes()
        var seconds=thistime.getSeconds()
        if (eval(hours) <10) {hours="0"+hours}
        if (eval(minutes) < 10) {minutes="0"+minutes}
        if (seconds < 10) {seconds="0"+seconds}
        var thistime = hours+":"+minutes+":"+seconds

        function writeclock() {
            i_clock++
            if (document.all || document.getElementById || document.layers) {
                clockid[i_clock]="clock"+i_clock
                document.write("<span id='"+clockid[i_clock]+"' style='position:relative'>"+thistime+"</span>")
            }
        }

        function clockon() {
            thistime= new Date()
            hours=thistime.getHours()
            minutes=thistime.getMinutes()
            seconds=thistime.getSeconds()
            if (eval(hours) <10) {hours="0"+hours}
            if (eval(minutes) < 10) {minutes="0"+minutes}
            if (seconds < 10) {seconds="0"+seconds}
            thistime = hours+":"+minutes+":"+seconds

            if (document.all) {
                for (i=0;i<=clockid.length-1;i++) {
                    var thisclock=eval(clockid[i])
                    thisclock.innerHTML=thistime
                }
            }

            if (document.getElementById) {
                for (i=0;i<=clockid.length-1;i++) {
                    document.getElementById(clockid[i]).innerHTML=thistime
                }
            }
            var timer=setTimeout("clockon()",1000)
        }
        window.onload=clockon
    </SCRIPT>



<div class="row">

        <!-- aviso novo modulo -->

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5> <i class="fas fa-user-secret"></i> Bem Vindo <i><strong class="text-info">{{Auth::user()->name}}</strong></i></h5>

                </div>

                <div class="ibox-content">
                    
                            <div class="alert alert-warning text-info">
                                Voce Esta Logado na filial {{Auth::user()->filial->name}}
                            </div>
                    <br>
                    <!--
                    <div class="alert alert-info">
                        <i class="fa fa-exclamation-triangle"></i>

                        Atenção. A verão 1.0 do manual foi liberada, <a href="http://www.labsystem.net.br/manual/Manual-1-0.pdf" target="_blank">clique aqui para vizualizar</a> ou clique no menu "SOBRE".
                    </div> -->

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><?php echo date('d/m/Y');?></span>

                    <h5> <i class="fab fa-facebook-messenger"></i> Mensagens do Sistema</h5>

                </div>

                <div class="ibox-content">
                    
                    <div class="alert alert-success">

                        Nenhuma mensagem a ser exibida. 
                    </div>

                    <br>
                    <!--
                    <div class="alert alert-info">
                        <i class="fa fa-exclamation-triangle"></i>

                        Atenção. A verão 1.0 do manual foi liberada, <a href="http://www.labsystem.net.br/manual/Manual-1-0.pdf" target="_blank">clique aqui para vizualizar</a> ou clique no menu "SOBRE".
                    </div> -->

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><a href="{{ url('/agenda') }}" data-toggle="tooltip" data-placement="left" title="VER AGENDA" title="VER AGENDA">IR PARA AGENDA</a></span>

                    <h5> <i class="far fa-calendar-alt"></i> Agenda</h5>

                </div>

                <div class="ibox-content">

                     <a href="{{ url('/agenda') }}" data-toggle="tooltip" data-placement="left" title="VER AGENDA" title="VER AGENDA">
                          <img src="{{asset('images/agenda.png')}}" width="300">
                     </a>

                    <br>
                    <!--
                    <div class="alert alert-info">
                        <i class="fa fa-exclamation-triangle"></i>

                        Atenção. A verão 1.0 do manual foi liberada, <a href="http://www.labsystem.net.br/manual/Manual-1-0.pdf" target="_blank">clique aqui para vizualizar</a> ou clique no menu "SOBRE".
                    </div> -->

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

         <!-- aviso novo modulo -->

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">Hoje</span>

                    <h5> <i class="fas fa-clipboard"></i> Exames Agendados</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$agendas}}</h1>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">Hoje</span>

                    <h5> <i class="fas fa-money-bill-alt"></i> Contas a Pagar</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$parcelasPagar}}</h1>

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right">Hoje</span>

                    <h5> <i class="fas fa-money-bill-alt"></i> Contas a Receber</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$parcelasReceber}}</h1>

                    <div class="stat-percent font-bold text-navy"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><a href="pedidos/hoje">Hoje</a></span>

                    <h5> <i class="fas fa-list-ul"></i> Total de Pedidos</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalpedidos}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5> <i class="fas fa-user-circle"></i> Total de Pacientes</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalclientes}}</h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5> <i class="fas fa-clock"></i> Hora</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins"><script>writeclock()</SCRIPT></h1>

                    <div class="stat-percent font-bold text-danger"></div>

                    <small></small>

                </div>

            </div>

        </div>


        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><?php echo date('d/m/Y'); ?></span>

                    <h5> <i class="fas fa-clipboard"></i> Pedidos A Serem Entregues Hoje - {{$totalparaentregar}}</h5>

                </div>

                <div class="ibox-content">

                    <div class="table-responsive">
                        <div class="col-sm-6 m-b-xs">
                            <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="pedidoPacienteHojeHome" onkeyup="pedidoPacienteHojeHome()"> <span class="input-group-btn" name="pedidoPacienteHojeHome" >
                                        <button type="button" class="btn btn-sm btn-info"> PACIENTE</button> </span></div>
                        </div>
                        <div class="col-sm-6 m-b-xs">
                            <div class="input-group"><input type="text" placeholder="FILTRAR" class="input-sm form-control" id="pedidoProtocoloHojeHome" onkeyup="pedidoProtocoloHojeHome()"> <span class="input-group-btn" name="pedidoProtocoloHojeHome" >
                                        <button type="button" class="btn btn-sm btn-info"> PROTOCOLO</button> </span></div>
                        </div>
                        <table class="table" id="myTable">
                        <thead>
                          <tr>
                            <th>PACIENTE</th>
                            <th>STATUS</th>
                            <th>PROTOCOLO</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse($pedidos as $pedido)
                              <tr>
                                <td>{{$pedido->patient->name}}</td>
                                <td>{{$pedido->status}}</td>
                                <td>{{$pedido->protocol}}</td>
                              </tr>
                            @empty
                              <tr>
                                  <td colspan="4">Nenhum Pedido a Ser Entregue Hoje</td>
                              </tr>
                            @endforelse
                        </tbody>
                      </table>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
