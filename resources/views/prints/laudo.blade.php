<style>
.footer { 
	 	margin: auto;
		width: 100%;
		bottom: 0;
		position: fixed;
		
	 } 
	 .pagenum:before { content: counter(page); }
.conteudo{
		margin-top: 1%;
		margin: 0px;
	}
	.tabela{
	font-size: 12px;
	margin-left: -40px;
}
	.dados{
		margin-top: 20px;
	}
	.exames{
		border: 1px;
	}
	.exame{
	font-size: 10px;
	font-style: bold;
	}
	.resultado{
	font-size: 10px;
	}
	.logo{
		margin: 0px 0px 90px 0px;
		border-color:red;
	}
	.assinatura{
		font-size: 10px;
		margin-left: 75%;
		margin-top: 1%;
		width: 200px;
	}
	.referencia{
		text-align: right;
		margin-right: 90px;
		
	}
	.vr{
		text-align: left;
		margin-left: 90%;
	}
	.text-center{
		text-align: center;
	}

	.font-13{
		font-size: 10px;
	}
	.resultado{
		width: 5px;
		margin-right: 20px;
		color: black;
		border-style: none;
	}
	.interpreta{
		margin-top: 3%;
		height: 200px;
		width: 700px;
		text-align: justify;
	}

	/*table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	}*/
	.ref-class{
		text-align: left;
		text-decoration: none;

	}
	.descricao{
		font-size: 10px;
	}

	.tabelaexame{
		width: 700px;
		padding: 0;
		margin: 0;
		margin-top: 10px;
		font-size: 10px;
	}

	.subtitulo{
		display: block;
		margin: 0;
		padding: 0;
		font-weight: bold;
	}

	.subtituloex{
		width: 65%;
		float: left;
		text-align: left;
	}

	.subtitulovr{
		width: 35%;
		float: right;
		text-align: left;
	}

	.pri-col{
		width: 170px;
		font-size: 10px;
	}

	.seg-col{
		width: 120px;
		font-size: 10px;
	}

	.penult-col{
		width: 130px;
		padding: 0;
		margin: 0;
		font-size: 10px;
		text-align: left;
	}

	.ult-col{
		width: 170px;
		padding: 0;
		margin: 0;
		margin-left: 50px;
		font-size: 10px;
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


<div class="col-xs-12 table">
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
</div>
<div class="table">
<table class="dados table-bordered" width="100%">
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
</div>

<table class="conteudo table" width="100%">
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
			<th colspan="5" align="left">
				<h5 style="font-size: 10px; margin: 0">
					EXAME: {{$resultado->exam->name}}
					MATERIAL: <?php echo ucwords($material->name); ?>
					MÉTODO: <?php echo ucwords($metodo->name); ?>
				</h5> 
			</th>
		</tr>
		
		
	</thead>
</table>

<p></p>
<!-- titulo exame e VR -->
<div class="subtitulo">
	<div class="subtituloex">EXAMES</div>

	@if($report->interpretation == "0")
		<div class="subtitulovr">V.R</div>
	@else
		
	@endif
</div>

@foreach($reportsGroupedByCategory as $key => $reports)

	<table class="tabelaexame">
		<tbody>
		
			<tr>
				<td colspan='6' style="font-weight: bold">
					{{ $key }}
				</td>
			</tr>
		@forelse($reports as $report)
			
			<tr>				
				<td class="pri-col">
					<?php echo ucwords($report->description); ?> 
                </td>
				@if($report->interpretation == "0")					
					<?php $report->price; $result = explode("*", $report->price);  ?>

                <td class="seg-col">
					<?php  echo $result[0]; ?>
				</td>
				<td  class="penult-col">
	               	<?php  echo $result[1]; ?>
	            </td>
				@else
					
				@endif
				<!-- Ultima coluna -->
				@if($report->reference <> "")
					<td class="ult-col">
						<u class="ref-class"><?php echo wordwrap($report->reference, 40); ?></u>
					
					</td>
				@else
					<td class='resultado' align='left' style="width:25%" height="10"  style='font-size: 10px;'>&nbsp;</td>
				@endif				
			
			@if($report->interpretation == "0")					
			@else
				
				<td class='resultado' align='left' height="2" style="width:25%"  style='font-size: 10px;' class="descricao">
						{{$report->price}} 
				</td>
				
				
					<td>
						<p class="interpreta">{{$report->interpretation}}</p>
					</td>													
			@endif

			
		@empty
			<td colspan="3"> Este Exame Não Possui Itens de Resultado.</td>
		</tr>
		@endforelse
		</tbody>
	</table>
@endforeach
<div class="pull-right footer assinatura">
<div class="footer assinatura pull-right" style="font-size: 8px" align="center">
	<i>
		__________________________________ <br>
		@foreach($empresas as $empresa)
			{{$empresa->medico}}<br/>
			{{$empresa->tipo_doc}}  {{$empresa->num_doc}}<br/>
			{{$empresa->endereco}}<br/>
			Fone/Fax: {{$empresa->fone}}<br/>
			CEP: {{$empresa->cep}} - {{$empresa->city->name}} - {{$empresa->estado->name}}</b>
		@endforeach
	</i>
</div>
</div>