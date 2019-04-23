@foreach($orders as $order)
@endforeach
<?php

$data = $order->created_at;
$retirar = $order->dt_retire;

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
<style>
	.tabela{
	    font-size: 14px;
	    margin-left: -40px;
    }

    .dados{
	   	margin-top: 130px;
	}

	.exame{
	    font-size: 19px;
	    font-style: bold;
	}

	.resultado{
	    font-size: 14px;
	}

    .logo{
	   	margin: 0px 0px 90px 0px;
	  	border-color:red;
	}

	.assinatura{
	  	font-size: 10px;
	   	margin-top: 155px;
	   	margin-right: -450px;

	}

</style>

<table class="tabelaexame">
	<tr>
		<td align="right" colspan="3" class="logo" >
			<img src="http://labsystem.net.br/images/logoHDT.png" width="494" height="89" align="left" class="img-responsive" />
		</td>
		<td align="left">
			<img src="http://laboratoriomult-test.com.br/Sistema/img/laudo/pncq.png" width="100" height="115" align="right" class="img-responsive"/>
		</td>
		<td align="left">
			<img src="http://laboratoriomult-test.com.br/Sistema/img/laudo/sbac.png" width="100" height="115" align="right" class="img-responsive" />
		</td>
	</tr>
</table>

<table class="dados table-bordered" width="100%">
		<tr>
			<td class="tabela" align="center"  colspan="3"><b> DADOS PESSOAIS<br></b></td>
			<th colspan="3" align="center"><p></p></th>
		</tr>

	@foreach($orders as $order)

		<tr>
			<td class="tabela" align="left"  colspan="2"><b>NOME: </b> {{$order->patient->name}}  </td>
			@if($order->sex == "M")
		    	<td class="tabela" align="right"><b>SEXO: </b> MASCULINO </td>
		    @else
		    	<td class="tabela" align="right"><b>SEXO: </b> FEMININO </td>
		    @endif
		</tr>

		<tr>
	        <td class="tabela" align="left" colspan="2"><b>IDADE: </b> <?php echo $idade1; ?>  </td>
	        <td class="tabela" align="right"><b>PROTOCOLO: </b>  {{$order->protocol}}  </td>
		</tr>

		<tr>
		    <td class="tabela" align="left" colspan="2"><b> ENDEREÇO: </b> {{$order->patient->street}}   -  {{$order->patient->city->name}} </td>
		    <td class="tabela" align="right"><b>TELEFONE: </b>{{$order->patient->phone}}</td>
	    </tr>

	    <tr>
	        <td class="tabela" align="left" colspan="2"><b> MÉDICO: </b> {{$order->medic->name}}  </td>
	        <td class="tabela" align="right"><b>COLETA EM: </b> <?php echo date('d/m/Y H:m:s', strtotime($data)); ?> </td>
	    </tr>

	    <tr>
			<td class="tabela" align="left" colspan="2"><b> CONVÊNIO: </b> {{$order->covenant->name}}  </td>
			<td class="tabela" align="right"><b> RETIRAR EM: </b> <?php echo date('d/m/Y', strtotime($retirar)); ?> </td>
		</tr>
	@endforeach
</table>
<br>
<hr>
<br>
<table class="table" width="100%">
	<thead>
	  @foreach($orderArticles as $orderArticle)
	  @endforeach

	  @foreach($reports as $report)
	  @endforeach


		<tr>
			<th colspan="3" align="center">EXAMES</th>
			<th colspan="3" align="center"><p></p></th>
		</tr>

		<tr>
			<th></th>
		</tr>

	</thead>

	<tbody>
		@foreach($orderArticles as $orderArticle)
			<tr>
				<td> {{$orderArticle->exam->name}} </td>
			</tr>
		@endforeach
	</tbody>
</table>
<br>
<hr>
<br>
<p align="center">
	É OBRIGATÓRIA A APRESENTAÇÃO DESTE DOCUMENTO PARA A RETIRADA DE SEU EXAME
</p>
