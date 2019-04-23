<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>OOPS, ALGO DE ERRADO NÃO ESTA CERTO...</title>
  <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/x-icon"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <meta charset="utf-8">
 <link rel="stylesheet" type="text/css" media="all" href="{{asset('errors/css/404.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>


  <div class="wrapper row2">
  <div id="container" class="clear">
    <section id="fof" class="clear">
      <div class="positioned">
        <div class="hgroup">
          <h1>ERRO 404 </h1>
          <h2>DOH! Página Não Encontrada&hellip;</h2>
        </div>
        <p>A Página Que Você Procura Não Se Encontra Disponível.</p>
        <div id="respond">
          
            <fieldset>
              <legend><a href="home"></a></legend>
              <a href="{{ url('/home') }}">
                 <button type="button" class="btn btn-default btn-block" title="VOLTAR PARA A PAGINA INICIAL">
                  <i class="fa fa-home fa-3x"></i>
                </button>
              </a>

               <p></p>
            </fieldset>
          
        </div>
      </div>
    </section>
  </div>
</div>


</body>
</html>