<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <!-- Hotjar Tracking Code for labsystem.net.br/demo -->
  <!-- Hotjar Tracking Code for http://www.labsystem.net.br -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:616723,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LAB System 2.0</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/estilo.css')}}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/x-icon"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

  <script type="text/javascript">

  $(document).ready(function() {
    $('#tabela').DataTable( {
        responsive: true,
        "language": {
  				"lengthMenu": "Exibindo _MENU_ Registros Por Página",
  				"zeroRecords": "Nenhum Registro Encontrado",
  				"info": "Mostrando Página _PAGE_ de _PAGES_",
  				"infoEmpty": "Nenhum registro disponível",
  				"infoFiltered": "(Filtrado de _MAX_ total registros)",
  				"sSearch": "Filtrar",

  				"oPaginate":{
  					"sFirst": "Primeiro",
  					"sPrevious": "<",
  					"sNext": ">",
  					"sLast": "Ultimo"
  				}

  			}

    } );

} );

</script>

    <style type="text/css">
        .centro{
            margin-left: 40px;
        }
    </style>

    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

      });



    </script>

    <script type="text/javascript">
      function mascara(t, mask){
        var i = t.value.length;
        var saida = mask.substring(1,0);
        var texto = mask.substring(i)
        if (texto.substring(0,1) != saida){
            t.value += texto.substring(0,1);
        }
    }
    </script>


</head>

<body>





                <div class="row border-bottom">

                </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center m-t-lg">
                                @yield('content')

                            </div>
                        </div>
                    </div>

                <div class="footer">
                    <div class="pull-right">

                        Versão <strong>2.0</strong> .
                    </div>
                    <div align="center">
                        <strong>Copyright</strong> Lab System. Todos Os Direitos Reservados &copy; 2017
                    </div>
                </div>




        <!-- Mainly scripts -->
        <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
        <script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>



        <!-- Custom and plugin javascript -->
        <script src="{{asset('js/inspinia.js')}}"></script>
        <script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>
        <script type="text/javascript">
            @yield('scripts')
        </script>


        <!-- Modal sem acesso -->
          <div id="myModalSemAcesso" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><i class="fa fa-lock" aria-hidden="true"></i> Acesso Restrito</h4>
                </div>
                <div class="modal-body">
                  <div class="align-center">
                    <p><i class="fa fa-exclamation-triangle fa-3x text-warning" aria-hidden="true"></i></p>
                  </div>
                  <p>Você não possui privilégios para acessar este módulo.</p>
                  <p>Contate o seu superior.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                </div>
              </div>

            </div>
          </div>
          <!-- Modal acesso -->



  </script>

    </body>

    </html>
