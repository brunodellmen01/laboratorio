@extends('layouts.app')

@section('content')


<?php

//calcula a idade em Anos, dias e meses

$idadeMaisVelho = $idadeMenor;
$idadeMaisNovo = $idadeMaior;
function calc_idadeVelho($idadeMaisVelho) {
	// formato da data yyyy-mm-dd
	$date = new DateTime($idadeMaisVelho);
	$interval = $date->diff(new DateTime(date("Y-m-d")));
	return $interval->format('%Y Anos, %m Meses e %d Dias');
}
$data_nasc = $idadeMaisVelho;
$idade = calc_idadeVelho($idadeMaisVelho);
$idadeVelho = "" . $idade;

function calc_idadeNovo($idadeMaisNovo) {
	// formato da data yyyy-mm-dd
	$date = new DateTime($idadeMaisNovo);
	$interval = $date->diff(new DateTime(date("Y-m-d")));
	return $interval->format('%Y Anos, %m Meses e %d Dias');
}
$data_nasc = $idadeMaisNovo;
$idade = calc_idadeNovo($idadeMaisNovo);
$idadeNovo = "" . $idade;

?>

<div class="row">

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5>Pacientes Femininos</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalFeminino}}</h1>

                    <div class="stat-percent font-bold text-success"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"></span>

                    <h5>Pacientes Masculinos</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$totalMasculino}}</h1>

                    <div class="stat-percent font-bold text-info"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><?php echo $idadeNovo; ?></span>

                    <h5>Paciente Mais Velho</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$nomeMaisNovo}}</h1>

                    <div class="stat-percent font-bold text-navy"></div>

                    <small></small>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <span class="label label-info pull-right"><?php echo $idadeVelho; ?></span>

                    <h5>Paciente Mais Novo</h5>

                </div>

                <div class="ibox-content">

                    <h1 class="no-margins">{{$nomeMaisVelho}}</h1>

                    <div class="stat-percent font-bold text-navy"></div>

                    <small></small>

                </div>

            </div>

        </div>



    </div>
@endsection
