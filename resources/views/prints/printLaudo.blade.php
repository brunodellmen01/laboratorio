
<style>
	.conteudo{
		margin-top: 1%;
		margin: 0px;
	}
	.tabela{
	font-size: 12px;
	margin-left: -40px;
}
	.dados{
		margin-top: 110px;
	}
	.exames{
		border: 1px;
	}
	.exame{
	font-size: 16px;
	font-style: bold;
	}
	.resultado{
	font-size: 12px;
	}
	.logo{
		margin: 0px 0px 90px 0px;
		border-color:red;
	}
	.assinatura{
		font-size: 10px;
		margin-left: 75%;
		margin-top: 2%;
		width: 200px;
	}
	.referencia{
		text-align: right;
		margin-right: 90px;
		width: 100px;
	}
	.vr{
		text-align: left;
		margin-left: 90%;
	}
	.text-center{
		text-align: center;
	}

	.font-13{
		font-size: 13px;
	}
	.resultado{
		width: 10px;
		margin-right: 20px;
		color: black;
		border-style: none;
	}
</style>

@foreach($orders as $order)
@endforeach

<?php

$data = $order->created_at;

//calcula a idade em Anos, dias e meses
$data_nasc = $order->patient->dt_birth;
function calc_idade($data_nasc) {
	// formato da data yyyy-mm-dd
	$date = new DateTime($data_nasc);
	$interval = $date->diff(new DateTime(date("Y-m-d")));
	return $interval->format('%Y Anos, %m Meses e %d Dias');
}
$data_nasc = $data_nasc;
$idade = calc_idade($data_nasc);
$idade1 = "" . $idade;

?>
<title>Laudo - @foreach($orders as $order)
{{$order->patient->name}}
@endforeach
</title>
<link rel="icon" href="http://labsystem.net.br/clientes/oswaldocruz/public/img/favicon.png" type="image/x-icon"/>
<table class="table pull-left" width="500">
	<tr>
		<td align="right" colspan="3" class="logo" >
			<img src="http://laboratoriomult-test.com.br/Sistema/img/topo.png" align="left" class="img-responsive"/>
		</td>
		<td align="left">
			<img src="http://labsystem.net.br/clientes/multtest/public/img/pncq.png" width="100" height="115" align="right" class="img-responsive"/>
		</td>
		<td align="left">
			<img src="http://labsystem.net.br/clientes/multtest/public/img/sbac.png" width="100" height="115" align="right" class="img-responsive" />
		</td>
	</tr>
</table>
<table class="dados table-bordered" width="500">
	@foreach($orders as $order)
	<tr>
		<td class="tabela" align="left"  colspan="1"><b>NOME: </b> {{$order->patient->name}}  </td>
		@if($order->patient->sex == "M")
		<td class="tabela" align="right"><b>SEXO: </b> MASCULINO </td>
		@else
		<td class="tabela" align="right"><b>SEXO:  </b> FEMININO </td>
		@endif
	</tr>
	<tr>
		<td class="tabela" align="left" colspan="1"><b>IDADE: </b> <?php echo $idade1; ?>  </td>
		<td class="tabela" align="right"><b>PROTOCOLO: </b>  {{$order->protocol}}  </td>
	</tr>
	<tr>
		<td class="tabela" align="left" colspan="1"><b> ENDEREÇO: </b> {{$order->patient->street}}   -  {{$order->patient->city->name}} </td>
		<td class="tabela" align="right"><b>TELEFONE: </b>{{$order->patient->phone}}</td>
	</tr>
	<tr>
		<td class="tabela" align="left" colspan="1"><b> MÉDICO: </b> {{$order->medic->name}}  </td>
		<td class="tabela" align="right"><b>COLETA EM: </b> <?php echo date('d/m/Y', strtotime($data)); ?> </td>
	</tr>
	<tr>
		<td class="tabela" align="left" colspan="1"><b> CONVÊNIO: </b> {{$order->covenant->name}}  </td>
		<td class="tabela" align="right"><b> EMISSÃO: </b> {{$hoje}} </td>
	</tr>
	@endforeach
</table>

<br>

<table class="conteudo table" width="550">
	<thead>
		@foreach($orderArticles as $orderArticle)
		@endforeach

		@foreach($reports as $report)
		@endforeach

		@foreach($materials as $material)
		@endforeach

		@foreach($metodos as $metodo)
		@endforeach

		@foreach($results as $resultado)
		@endforeach

		
		<tr>
			<th colspan="3" align="left">
				<h5>
					EXAME: {{$resultado->exam->name}} <br>
					MATERIAL: <?php echo ucwords($material->name); ?> <br> 
					MÉTODO: <?php echo ucwords($metodo->name); ?>
				</h5> 
			</th>
		</tr>
		<tr>
			<th colspan="4" align="center" class="text-center">* RESULTADOS *</th>
		</tr>
		<tr>
			<th></th>
		</tr>
		<tr>
			<th colspan="4"  align="left">EXAMES</th>
			<th class="vr" align="left">V.R</th>
		</tr>
	</thead>
</table>

<br>

@foreach($reportsGroupedByCategory as $key => $reports)

	<i>
		{{ $key }}

	</i>


	<table class="conteudo table" width="550">
		<tbody>
		
		@forelse($reports as $report)
			<tr>
				
				<td class="font-13" width="65" > <?php echo ucwords($report->description); ?> </td>
				<td class="resultado font-13" align="center"> {{$report->price}} </td>
				<td class="referencia font-13" align="left" width="65"><?php echo wordwrap($report->reference, 40); ?></td>
				
			</tr>

		@empty
			<td colspan="3"> Este Exame Não Possui Itens de Resultado.</td>
		@endforelse
		</tbody>
	</table>
@endforeach
<div class="assinatura pull-right" align="center">
	<i>
		________________________________ <br>
		Dr. Elifas Mardegan<br/>
		CRF 6672<br/>
		Av. Endereço, 980 - Centro<br/>
		Fone/Fax: (44) 3665 - 115<br/>
		CEP: 87.530-000 - Icaraíma - Paraná</b>
	</i>
</div>