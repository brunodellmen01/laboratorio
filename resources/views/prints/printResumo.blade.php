
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
	   	margin-top: 220px;
	   	margin-right: -450px;

	}

	.footer { 
	 	margin: auto;
		width: 100%;
		bottom: 0;
		position: fixed;
		
	 }

</style>

<title>Resumo</title>

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

	@foreach($orderArticles as $orderArticle)

		<tr>
			<td class="tabela" align="left"  colspan="2"><b>NOME: </b> {{$orderArticle->patient->name}}  </td>

		    <td class="tabela" align="right"><b>MÉDICO: </b> {{$orderArticle->medic->name}} </td>

		</tr>

		<tr>
	        <td class="tabela" align="left" colspan="2"><b>RETIRAR EM: </b> <?php $data = $orderArticle->date;
echo date('d/m/Y', strtotime($data));?>  </td>
	        <td class="tabela" align="right"><b>FORMA DE PGTO: </b>  {{$orderArticle->states_id}}  </td>
		</tr>

		<tr>
		    <td class="tabela" align="left" colspan="2"><b> TIPO: </b> {{$orderArticle->type}}</td>
		    <td class="tabela" align="right"><b>CLÍNICA: </b>{{$orderArticle->clinic->name}}</td>
	    </tr>

	    <tr>
	        <td class="tabela" align="left" colspan="2"><b> PROTOCOLO: </b> {{$orderArticle->protocol}}  </td>
	        <td class="tabela" align="right"><b>VALOR A PAGAR: </b> R$: {{$precoTotal}} </td>
	    </tr>
	@endforeach
</table>

<hr>

<table class="table" width="100%">
	<thead>

		<tr>
			<th colspan="3" align="center">EXAMES</th>
			<th colspan="3" align="center"><p></p></th>
		</tr>

		<tr>
			<th align="left">NOME</th>
		</tr>

	</thead>

	<tbody>
		@foreach($reports as $report)
			<tr>
				<td> {{$report->exam->name}} </td>
			</tr>
		@endforeach
	</tbody>
</table>

<hr>

<table class="table-borded" width="100%">
    <thead>
    	<tr>
			<th colspan="6" align="center">PARCELAS <br></th>
		</tr>
		<tr>
			
			<th colspan="6" align="center"><br></th>
		</tr>
        <tr>
        	<th  align="center">ID</th>
    	    <th  align="center">VALOR</th>
            <th  align="center">PAGO </th>
            <th  align="center">RESTANTE </th>
            <th  align="center">VENC. </th>
            <th  align="right">PAGO EM </th>
        </tr>
    </thead>
    <tbody>
    	@foreach($parcelOrders as $parcelOrder)
        	<tr>
           		<?php $resta = $parcelOrder->price_parcel - $parcelOrder->price_settled;?>
           		<td align="center">{{$parcelOrder->id}}</td>
	            <td align="center">R$: {{$parcelOrder->price_parcel}}</td>
	            <td align="center">R$: {{$parcelOrder->price_settled}}</td>
	            <td align="center">R$: <?php echo $resta; ?></td>
	            <td align="center">
				    <?php
$venc = $parcelOrder->venc;
echo date('d/m/Y', strtotime($venc));
?>
                </td>
                <td align="right">
                	@if($parcelOrder->receive =="")
                	@else

                	<?php
$recebido = $parcelOrder->receive;
echo date('d/m/Y', strtotime($recebido));
?>
@endif
				</td>

        </tr>
		@endforeach
	</tbody>
</table>

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

