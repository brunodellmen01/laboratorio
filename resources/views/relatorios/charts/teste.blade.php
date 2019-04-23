@extends('layouts.app')

@section('content')


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Paciente', 'Protocolo'],
            @foreach ($pedidos as $pedido)
              ['{{ $pedido->patient->name}} ', {{$hoje}}],
            @endforeach
        ]);
        var options = {
          title: 'Relatório de Pacientes'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }

    </script>
  
  	<div id="piechart" style="width: 100%; height: 100%; border-color: red;"></div>
  
@endsection
