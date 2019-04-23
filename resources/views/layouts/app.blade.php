<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LAB System 3.0</title>


    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    

    

    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/x-icon"/>

    <script src="//cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>

     <!-- Mainly scripts -->

        <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
        <script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
        

 <!-- calendario -->
        
         <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
        <!-- <script src="{{asset('js/fullcalendar.js')}}"></script>  -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
        
      
        <!-- calendario -->



        
        <!-- Custom and plugin javascript -->
        <script src="{{asset('js/inspinia.js')}}"></script>
        <script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>


        

        <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    
    <link href="{{asset('css/estilo.css')}}" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet">

<!-- <script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'cd01a922-234d-4495-b299-cdbc41781b6c', f: true }); done = true; } }; })();</script> -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

  


@if(!empty(Session::get('agendaVazia')) && Session::get('agendaVazia') == "SIM")
  <script>
  $(function() {
      $('#myModalAgendaVazia').modal('show');
  });
  </script>
@endif


@if(!empty(Session::get('operacao')) && Session::get('operacao') == "SIM")
  <script>
  $(function() {
      $('#myModalOperacaoOK').modal('show');
  });
  </script>
@endif
<script>


    // In your Javascript (external .js resource or <script> tag) 

    $(document).ready(function() {
      $('.js-example-basic-single').select2(); 
      }
    );

     $('.js-example-basic-single').select2();
    /*$("#js-example-basic-hide-search").select2({
    minimumResultsForSearch: 0
    });*/

    $('#js-example-basic-hide-search-multi').select2();

    $('#js-example-basic-hide-search-multi').on('select2:opening select2:closing', function( event ) {
     minimumResultsForSearch: -1
    var $searchfield = $(this).parent().find('.select2-search__field');
    $searchfield.prop('enable', true);

});


    

    
    function filtraProcedimentoTUSSId() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("filtraProcedimentoTUSSId");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function filtraProcedimentoTUSS() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("filtraProcedimentoTUSS");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }


    //busca home
    function pedidoPacienteHojeHome() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("pedidoPacienteHojeHome");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function pedidoProtocoloHojeHome() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("pedidoProtocoloHojeHome");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

//busca pedido
function pedidoPaciente() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("pedidoPaciente");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function pedidoStatus() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("pedidoStatus");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function pedidoMedico() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("pedidoMedico");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function pedidoProtocolo() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("pedidoProtocolo");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
//busca clinica
function filtraClinicaNome() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraClinicaNome");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraClinicaFone() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraClinicaFone");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraClinicaCidade() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraClinicaCidade");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//busca convenio
function filtraConvenio() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraConvenio");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//busca lab

function filtraLabNome() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraLabNome");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraLabEmail() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraLabEmail");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraLabCidade() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraLabCidade");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


//busca medico

function filtraMedNome() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraMedNome");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraMedEmail() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraMedEmail");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraMedCidade() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraMedCidade");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
//filtra paciente

function filtraPacNome() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPacNome");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraPacFone() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPacFone");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraPacCidade() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPacCidade");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//filtra resultados

function filtraResultTipoExame() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraResultTipoExame");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraResultTipoRes() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraResultTipoRes");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraResultTipoDesc() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraResultTipoDesc");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//filtra tipo exame
function filtraTipoExameNome() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraTipoExameNome");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//filtra tipo resultados
function filtraTipoResultadosNome() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraTipoResultadosNome");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//preço de exame

function filtraPrecoExameTipo() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPrecoExameTipo");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraPrecoExameConvenio() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPrecoExameConvenio");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraPrecoExameValor() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPrecoExameValor");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//empresa
function filtraEmpresa() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraEmpresa");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//despesa
function filtraDespesaEmpresa() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraDespesaEmpresa");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraDespesaVencimento() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraDespesaVencimento");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraDespesaValor() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraDespesaValor");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraDespesaDescricao() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraDespesaDescricao");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraDespesaStatus() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraDespesaStatus");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[5];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//filtra movimentação

function filtraMovTipo() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraMovTipo");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraMovValor() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraMovValor");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraMovDescricao() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraMovDescricao");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraMovData() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraMovData");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//aiversariantes rel

function filtraNiver() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraNiver");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//preco exame rel

function filtraRelPrecoExame() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraRelPrecoExame");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//pacientecidade rel

function filtraPacCidade() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPacCidade");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraPacEmCidade() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPacEmCidade");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraResultEmExame() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraResultEmExame");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraRecebePedido() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraRecebePedido");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraRecebeValor() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraRecebeValor");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraPagaPedido() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPagaPedido");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraPagaValor() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraPagaValor");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//resultdo exame rel

function filtraResultadoExameRel() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraResultadoExameRel");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraHistorico() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraHistorico");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraHistoricoExame() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraHistoricoExame");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraHistoricoStatus() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraHistoricoStatus");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraHistoricoProtocolo() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraHistoricoProtocolo");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraHistoricoEntrega() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraHistoricoEntrega");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraUidadeNome() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraUidadeNome");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraUnidadeFone() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraUnidadeFone");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraUnidadeCidade() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraUnidadeCidade");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraHistoricoRetirada() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraHistoricoRetirada");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function filtraChamadoProtocolo() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("filtraChamadoProtocolo");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
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

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a href="{{ url('/usuarios/').'/'.Auth::user()->id}}/editar">

                              <img src="{{asset('images/uploads/profile/').'/'.Auth::user()->id}}/{{Auth::user()->image}}" width="90" class="img-responsive img-circle" title="Trocar Foto">

                            </a>
                            <a href="{{ url('/home') }}">

                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Bem vindo {{Auth::user()->name }} </strong>
                                </span> <span class="text-muted text-xs block">{{ Auth::user()->nivel }} <b ></b></span> </span> </a>
                                <?php echo strftime('%a, %d de %B de %Y', strtotime('today')); ?>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="{{ route('logout') }}">Sair</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                LS
                            </div>
                        </li>
                        <li class="active">
                            <a href="{{ url('/home') }}" data-toggle="tooltip" data-placement="right" title="DASHBOARD" title="DASHBOARD"><i class="fas fa-tachometer-alt"></i> <span class="fonte-preta nav-label preto">Dashboard</span></a>
                        </li>

                        <li>
                            <a href="{{ url('/agenda') }}" data-toggle="tooltip" data-placement="right" title="AGENDA" title="AGENDA"><i class="far fa-calendar-plus"></i> <span class="nav-label preto"> AGENDA</span></a>
                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" ><i class="fas fa-plus-square"></i><span class="nav-label"> CADASTROS</span>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="{{ url('/clinica') }}"><i class="fab fa-cuttlefish"></i> <span class="fonte-preta nav-label preto"> CLÍNICAS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/convenio') }}"><i class="fas fa-archive"></i> <span class="nav-label"> CONVÊNIOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/laboratorio') }}"><i class="fas fa-briefcase"></i> <span class="nav-label"> LABORATÓRIOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/medico') }}"><i class="fas fa-user-md"></i> <span class="nav-label"> MÉDICOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/paciente') }}"><i class="fas fa-user-circle"></i> <span class="nav-label"> PACIENTES</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/resultado') }}"><i class="far fa-file-pdf"></i> <span class="nav-label"> RESULTADOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/tipoExame') }}"><i class="fas fa-clipboard"></i> <span class="nav-label"> TIPOS DE EXAMES</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/tipoResultado') }}"><i class="fas fa-paste"></i> <span class="nav-label"> TIPOS DE RESULTADOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/precoExame') }}"><i class="far fa-credit-card"></i> <span class="nav-label"> PREÇOS DE EXAMES</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/empresa') }}"><i class="fas fa-hospital"></i> <span class="nav-label"> EMPRESAS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/material') }}"><i class="fas fa-shopping-bag"></i> <span class="nav-label"> MATERIAIS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/metodo') }}"><i class="fas fa-heartbeat"></i> <span class="nav-label"> MÉTODOS</span> </a>
                               </li>

                            </ul>
                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fab fa-searchengin"></i><span class="nav-label"> CONSULTAS</span>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="{{ url('/clinica/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> CLÍNICAS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/convenio/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> CONVÊNIOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/laboratorio/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> LABORATÓRIOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/medico/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> MÉDICOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/paciente/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> PACIENTES</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/resultado/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> RESULTADOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/tipoExame/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> TIPOS DE EXAMES</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/tipoResultado/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> TIPOS DE RESULTADOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/precoExame/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> PREÇO DE EXAMES</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/empresa/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> EMPRESAS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/material/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> MATERIAIS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/metodo/listar') }}"><i class="fab fa-searchengin"></i> <span class="nav-label"> MÉTODOS</span> </a>
                               </li>
                        



                    </ul>
                   @if(Auth::user()->nivel == "AVANÇADO")
                    <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-credit-card"></i><span class="nav-label"> FINANCEIRO</span>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <!-- <li>
                                <a href="{{ url('/financeiro') }}"><i class="fa fa-usd"></i> <span class="nav-label">FINANCEIRO</span> </a>
                               </li> -->
                              <li>
                                <a href="{{ url('/financeiro/despesa/') }}"><i class="fas fa-credit-card"></i> <span class="nav-label"> DESPESAS FIXAS</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('/financeiro/movimentacao/novo') }}"><i class="fas fa-credit-card"></i> <span class="nav-label"> MOVIMENTAÇÃO</span> </a>
                               </li>


                               <li>
                                <a href="{{ url('/financeiro/caixa') }}"><i class="fas fa-credit-card"></i> <span class="nav-label"> CAIXA</span> </a>
                               </li>
                              </ul>
                      </li>


                      @else
                        <li>
                          <a data-toggle="modal" href="#myModalSemAcesso"><i class="fa fa-book"></i> <span class="nav-label">FINANCEIRO</span></a>
                        </li>
                      @endif


                      <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-book"></i><span class="nav-label"> PEDIDOS</span>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="{{ route('openNewOrders') }}"><i class="fa fa-book"></i> <span class="nav-label">NOVO</span> </a>
                               </li>

                               <li>
                                <a href="{{ route('openOrders') }}"><i class="fa fa-book"></i> <span class="nav-label">CONSULTAS</span> </a>
                               </li>

                               <li>
                                <a href="{{ route('pedidosInternos') }}"><i class="fa fa-book"></i> <span class="nav-label">PEDIDOS INTERNOS</span> </a>
                               </li>

                               <li>
                                <a href="{{ route('pedidosExternos') }}"><i class="fa fa-book"></i> <span class="nav-label">PEDIDOS EXTERNOS</span> </a>
                               </li>

                              </ul>
                      </li>


                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-chart-pie"></i><span class="nav-label"> RELATÓRIOS</span>
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="{{ url('/relatorios/precoExame') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> PREÇO DE EXAME</span> </a>
                          </li>

                          <li>
                            <a href="{{ url('/relatorios/aniversariantes') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> ANIVERSARIANTES</span> </a>
                          </li>

                          <li>
                            <a href="{{ url('/relatorio/paciente/cidade') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> PACIENTE POR CIDADE</span> </a>
                          </li>

                          <li>
                            <a href="{{ url('/relatorio/resultado/exame') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> RESULTDO POR EXAME</span> </a>
                          </li>

                          <li>
                            <a href="{{ url('/relatorio/conta-receber/hoje') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> RECEBER HOJE</span> </a>
                          </li>

                          <li>
                            <a href="{{ url('/relatorio/conta-pagar/hoje') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> PAGAR HOJE</span> </a>
                          </li>

                          <li>
                            <a href="{{ url('/relatorios/contas-vencidas') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> PARCELAS ATRASADAS</span> </a>
                          </li>

                          <li>
                            <a href="{{ url('/relatorio/pedido') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> PEDIDOS</span> </a>
                          </li>

                          <li>
                            <a href="{{ url('/relatorio/convenio/') }}"><i class="fas fa-chart-pie"></i> <span class="nav-label"> DESPESAS POR CONVÊNIO</span> </a>
                          </li>



                        </ul>
                      </li>
                      @if(Auth::user()->nivel == "AVANÇADO")
                      <li>
                            <a href="{{ url('/usuarios') }}"><i class="fa fa-user-plus"></i> <span class="nav-label">USUÁRIOS</span></a>
                      </li>
                      @else

                      @endif

                      <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-file-code"></i><span class="nav-label"> GUIA TISS</span>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="{{ url('tiss/consulta') }}"><i class="fas fa-file-code"></i> <span class="nav-label">CONSULTA</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('tiss/lote') }}"><i class="fas fa-file-code"></i> <span class="nav-label">LOTES E XML</span> </a>
                               </li>

                              </ul>
                      </li>

                      <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-wrench"></i><span class="nav-label"> CONFIG.</span>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="{{ url('configuracao/empresa/') }}"><i class="fas fa-wrench"></i> <span class="nav-label">EMPRESA</span> </a>
                               </li>

                               <li>
                                <a href="{{ url('configuracao/empresa/unidades') }}"><i class="fas fa-wrench"></i> <span class="nav-label">UNIDADES</span> </a>
                               </li>                              

                              </ul>
                      </li>

                      @if(Auth::user()->filial->sede == "SEDE")

                        <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-audio-description"></i><span class="nav-label"> ADMINISTRAÇÃO</span>
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li>
                                  <a href="{{ url('/rh/home') }}"><i class="fas fa-audio-description"></i> <span class="nav-label">RESUMO</span> </a>
                                 </li>

                                 <li>
                                  <a href="{{ url('rh/despesa') }}"><i class="fas fa-audio-description"></i> <span class="nav-label">FINANCEIRO</span> </a>
                                 </li>                              

                                </ul>
                        </li>
                      @endif

                      <li>
                            <a href="{{ url('/estatisticas-para-nerd/') }}"><i class="fas fa-smile"></i> <span class="nav-label"> PARA NERD</span> </a>
                      </li>

                      <li>
                          <a data-toggle="modal" href="#myModalInfoSistema"><i class="fab fa-speakap"></i> <span class="nav-label"> SOBRE</span></a>
                      </li>

                
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            <form role="search" class="navbar-form-custom" method="post" action="{{ route('busca-protocolo') }}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="PROTOCOLO" id="top-search" name="protocolo" required=""  data-toggle="tooltip" data-placement="bottom" title="INFORME UM PROTOCOLO ">

                                <span class="input-group-btn">
                                  <button class="btn btn-outline btn-primary pull-right" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>

                                </div>
                            </form> 

                            <form role="search" class="navbar-form-custom" method="post" action="{{ route('busca-paciente') }}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="NOME" id="top-search" name="nome" required="" data-toggle="tooltip" data-placement="bottom" title="INFORME UM NOME">

                                <span class="input-group-btn">
                                  <button class="btn btn-outline btn-primary pull-right" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>

                                </div>
                            </form> 

                            <button class=" hidden btn btn-success btn-lg pull-right" id="btn_gravar_audio">Gravar Audio</button>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">

                          <ul class="nav navbar-nav navbar-right">

                            <li>
                              <a href="{{ url('/pedidos') }}" data-toggle="tooltip" data-placement="bottom" title="PEDIDOS" ><i class="fa fa-book"></i></a>
                            </li>

                             @if(Auth::user()->nivel == "AVANÇADO")

                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="USUÁRIOS ATIVOS / INATIVOS"><i class="fa fa-unlock-alt"></i>
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu">

                                <li><a href="{{ url('/usuarios/listar/ativos') }}"><i class="fa fa-unlock-alt"></i> <span class="nav-label">USUÁRIOS ATIVOS</span> </a></li>

                                 <li><a href="{{ url('/usuarios/listar/inativos') }}"><i class="fa fa-lock"></i> <span class="nav-label">USUÁRIOS INATIVOS</span> </a></li>
                              </ul>
                            </li>
                                                        
                                    
                                 
                            @endif
                            <li>
                              <a href="{{ url('/notificacoes') }}" data-toggle="tooltip" data-placement="bottom" title="NOTIFICAÇÕES" ><i class="fa fa-bell"></i></a>
                            </li>

                            <li>
                              <a href="{{ url('/historico') }}" data-toggle="tooltip" data-placement="bottom" title="HISTÓRICO MÉDICO" ><i class="fa fa-history"></i></a>
                            </li>

                            <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="SUPORTE"><i class="fa fa-ambulance"></i>

                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="{{ url('/chamados') }}"><i class="fa fa-plus"></i> <span class="nav-label"> NOVO CHAMADO</span> </a></li>
                                <li><a href="{{ url('/chamados/lista') }}"><i class="far fa-hourglass"></i> <span class="nav-label"> ACOMPANHAR CHAMADO</span> </a></li>
                              </ul>
                            </li>
                            <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="bottom" title="SAIR DO SISTEMA"><span class="glyphicon glyphicon-log-in"></span> SAIR</a></li>
                          </ul>

                           <li>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                <input type="hidden" name="email" value="{{Auth::user()->email }}">
                                {{ csrf_field() }}
                              </form>
                          </li>


                        </ul>



                    </nav>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center m-t-lg">
                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="pull-right">

                        Versão <strong>3.0</strong> .
                    </div>
                    <div>
                        <strong>Copyright</strong> Lab System. Todos Os Direitos Reservados &copy; 2017 - <?php echo date('Y'); ?>
                    </div>
                </div>

            </div>
        </div>



       





       





        <script type="text/javascript">
            @yield('scripts')
        </script>

        <script src="{{asset('js/comandos-voz/speechapi.js')}}"></script>

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

          <!-- Modal sobre -->
          <div id="myModalInfoSistema" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">SOBRE O SISTEMA</h4>
                </div>
                <div class="modal-body">
                  <p>
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>VERSÃO</th>
                                <th>RELEASE</th>
                                <th>ESPECIALIDADE</th>
                                <th>SUPORTE</th>
                                <th>MANUAL</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>3.0</td>
                                <td>Fevereiro</td>
                                <td>Laboratórios</td>
                                <td><a href="#demo" data-toggle="collapse">suporte@labsystem.net.br</a></td>
                                <td><a href="http://www.labsystem.net.br/manual/Manual-1-0.pdf" target="_blank"><i class="fas fa-file-pdf"></i> Visualizar
</a></td>
                              </tr>
                            </tbody>
                          </table>
                          <div id="demo" class="collapse">
                            <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>NOME</th>
                                <th>TELEFONE</th>
                                <th>CIDADE</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>LUIZ HENRIQUE</td>
                                <td>(44) 9 8432 - 4300</td>
                                <td>ICARAÍMA - PR</td>
                              </tr>
                              <tr>
                                <td>BRUNO DELLMEN</td>
                                <td>(41) 9 8431 - 1224</td>
                                <td>RIO GRANDE DO SUL - RS</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                          </div>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                </div>
              </div>

            </div>
          </div>



          <!-- Modal agenda vazia -->
          <div id="myModalAgendaVazia" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Agenda Vazia</h4>
                </div>
                <div class="modal-body">
                  <p>Ops. Sua Agenda esta Vazia.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
                </div>
              </div>

            </div>
          </div>
          <!-- Modal caixa fechado -->

          <!-- Modal -->
<div id="myModalOperacaoOK" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Operação Realizada.</h4>
      </div>
      <div class="modal-body">
        <p>
            Operação Realizada com Sucesso.
            
        </p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </form>
      </div>
    </div>

  </div>
</div>

    </body>

    </html>
