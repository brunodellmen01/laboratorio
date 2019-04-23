<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use \App\AuthorizedPerson;
use \App\Exam;
use \App\Locale\City;
use \App\Order;
use \App\OrderArticles;
use \App\Patient;
use \App\Result;
use \App\State;
use \App\Value;
use \App\Medic;

class OrderController extends Controller {
    
    public function index() {

        //abre o formulario quando carrega a pagina
        
        $pedido = Order::where('id_unity',Auth::user()->id_unity)->get();
        $cidades = City::orderBy('name', 'asc')->get();
        return view('Requests.newRequest', ['pedidos' => $pedido, 'cidades' => $cidades]);
    }

    

    public function listar() {

        $orders = Order::get();
        $states = State::get();
        $autorizados = AuthorizedPerson::orderBy('name', 'asc')->get();
        return view('Requests.Request', ['orders' => $orders, 'states' => $states, 'autorizados' => $autorizados]);
    }

    public function finish() {

        //seleciono o ultimo id da table Pedido (Order)
        $ultimo = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

        $ultimoArticle = OrderArticles::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

        //Pego o Id no array
        $ultimoId = $ultimo['id'];
        $ultimoIdArticle = $ultimoArticle['id'];

        $status = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

        $status_pedido = $status['states_id'];

        $tipo_exame = $status['type'];

        //se o tipo e exame for 1, isso siginifica q e do tipo INTERNO
        if ($tipo_exame == 1) {

            $update = DB::table('orders')
                ->where('id', $ultimoId)
                ->update(['type' => 'INTERNO']);

            //senao e do tipo EXTERNO
        } else {

            $update = DB::table('orders')
                ->where('id', $ultimoId)
                ->update(['type' => 'EXTERNO']);
        }

        //se o id o status for 1, siginifica q e A VISTA
        if ($status_pedido == 1) {

            $update = DB::table('orders')
                ->where('id', $ultimoId)
                ->update(['qtd' => 1, 'states_id' => 'A VISTA']);

            //senao, siginifica q e A PRAZO
        } else {
            $update = DB::table('orders')
                ->where('id', $ultimoId)
                ->update(['states_id' => 'A PRAZO']);
        }

        //trago o ultimo pedido inserido
        $orders = Order::where('id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->get();

        //trago os itens de exames pertencentes ao ultimo pedido inserido
        $orderArticles = OrderArticles::where('order_id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->get();

        //realiza a soma dos valores do peidido
        $priceText = DB::table('order_articles')->where('order_id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->sum('price');

        //converte a soma para inteiro
        $prices = intval($priceText);

        $id = $ultimoId;

        return redirect()->action('financesController@geraParcela', ['id' => $id]);
        //return redirect('FinancesController@geraParcela', $id);

        //return view('Requests.finish', ['status_pedido' => $status_pedido, 'orders' => $orders, 'orderArticles' => $orderArticles, 'prices' => $prices])->with('parcela', "SIM");
    }

    public function salvar(Request $request) {

        //pega os dados do formulario e salva
        $orders = new Order();
        $cidades = City::orderBy('name', 'asc')->get();
        $status = State::all();
        //$values = Value::all();

        $orders = $orders->create($request->all());

        //gera o protocolo com 13 digitos unicos
        $protocolo = uniqid();

        //pega o ultimo id inserido
        $ultimo = $orders->id;
        $convenio = $orders->covenant_id;
        $pgto = $orders->status;

        $covenant_id = intval($convenio);

        $values = Value::where('covenant_id', $covenant_id)->get();

        //$values = DB::table('values')->where('id', $convenio)->get();

        //insere o protocolo no pedido
        $inserePotocolo = DB::table('orders')
            ->where('id', $ultimo)
            ->update(['protocol' => $protocolo]);

        $id = $ultimo;

        return view('Requests.list', ['values' => $values, 'ultimo' => $ultimo]);

    }

    public function adicionaExame($id) {

        //seleciono o ultimo id da table Pedido (Order)
        $ultimo = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

        //Pego o Id no array
        $ultimoId = $ultimo['id'];

        //verifico se pego o id pela url
        if (array_key_exists("pedido", $_GET) && $_GET['pedido'] == $ultimoId) {
            $url = $_GET['pedido'];
            $url = intval($url);
            //print_r ($url);

        } else {
            echo ("erro ao pegar o id do pedido");
        }

        //faço um select trazendo o id do exame
        $variavel = Value::select('exam_id')->where('id', $id)->get();

        $exameID = intval(preg_replace("#\D#", '', $variavel));

        //dd($exameID);

        //faço um select trazendo o exame da table order_articles
        $orderText = OrderArticles::select('order_id')->where('order_id', $ultimoId)->where('id_unity',Auth::user()->id_unity)->get();

        //converto a as letras e converto pra inteiro
        $order = intval(preg_replace("#\D#", '', $orderText));

        //faço um select trazendo o tipo da table value
        $typeText = Exam::select('category_id')->where('id', $id)->get();

        //converto a as letras e converto pra inteiro
        $type = intval(preg_replace("#\D#", '', $typeText));

        //faço um select trazendo o tipo da table value
        $priceText = Value::select('value')->where('id', $id)->get();

        //converto a as letras e converto pra inteiro
        $price = intval(preg_replace("#\D#", '', $priceText));

        $evitaDuplicidade = OrderArticles::where('order_id', $ultimoId)
                                           ->where('exam_id', $exameID)
                                           ->where('id_unity',Auth::user()->id_unity)
                                           ->count();

        if ($evitaDuplicidade == 1) {
            
        } else {
            //salvo no banco
            $orderArticleSave = DB::table('order_articles')->insert([
                ['order_id' => $ultimoId, 
                'price' => $price, 
                'qtd' => 1, 
                'type_id' => $type, 
                'exam_id' => $exameID],

            ]);

        }
        
        

        

        //trago os itens de exames pertencentes ao ultimo pedido inserido
        $orderArticles = OrderArticles::where('order_id', intval($_GET['pedido']))->where('id_unity',Auth::user()->id_unity)->get();

        $countador = Result::get()->where('exam_id', '=', $exameID)->count();

        $pegaResultado = Result::where('exam_id', '=', $exameID)->get();



        $i = 1;
        $a = 0;
        while ($i <= $countador):

            $description = $pegaResultado[$a]['description'];
            $reference = $pegaResultado[$a]['reference'];
            $idResult = $pegaResultado[$a]['id'];
            $category_id = $pegaResultado[$a]['category_id'];
            $interpretation = $pegaResultado[$a]['interpretation'];

            


            $insere = DB::table('reports')->insert(
                ['order_article_id' => $ultimoId,
                    'description' => $description,
                    'reference' => $reference,                  
                    'exam_id' => $exameID,
                    'price' => 'RESULTADO*AQUI',
                    'category_id' => $category_id,
                    'result_id' => $idResult,
                    'interpretation' => $interpretation]
            );
            //}

            $i++;
            $a++;
        endwhile;

        //die();
        //retorno os dados pra view

        return view('Requests.carrinho', ['orderArticles' => $orderArticles, 'ultimoId' => $ultimoId]);
    }

    public function removerExame($id) {

        $pedidoExames = $id;
        $itemId = $_GET['pedido'];

        $idItem = intval($itemId);
        $idPedido = intval($pedidoExames);

        //dd($idPedido);

        $deleteExame = DB::table('order_articles')->where(['order_id' => $idItem, 'id' => $idPedido])->delete();

        $deleteLaudo = DB::table('reports')->where(['order_article_id' => $idItem])->delete();

        $orderArticles = OrderArticles::where('order_id', intval($_GET['pedido']))->where('id_unity',Auth::user()->id_unity)->get();

        //seleciono o ultimo id da table Pedido (Order)
        $ultimo = Order::orderBy('id', 'desc')->where('id_unity',Auth::user()->id_unity)->first();

        //Pego o Id no array
        $ultimoId = $ultimo['id'];

        return view('Requests.carrinho', ['orderArticles' => $orderArticles, 'ultimoId' => $ultimoId]);

    }

    public function listaExame() {

        $ultimo = Order::orderBy('id', 'desc')->first();

        //Pego o Id no array
        $covenant_id = $ultimo['covenant_id'];

        $values = DB::table('values')->where('id', $covenant_id)->get();

      

        //$values = Value::all();
        return view('Requests.list', ['values' => $values]);

    }

    public function detalhes($pedido) {

        $orders = Order::where('id', $pedido)->where('id_unity',Auth::user()->id_unity)->get();

        $orderArticles = OrderArticles::where('order_id', $pedido)->where('id_unity',Auth::user()->id_unity)->get();

        $priceText = DB::table('order_articles')->where('order_id', $pedido)->where('id_unity',Auth::user()->id_unity)->sum('price');

        $prices = intval($priceText);

        //$status_pedido = $orders['states_id'];

        return view('Requests.visualiza', ['orders' => $orders, 'orderArticles' => $orderArticles, 'prices' => $prices]);
    }

    public function mudaStatus($id) {

        $statusNovo = $_POST['status'];

        $novoStatus = DB::table('orders')
            ->where('id', $id)
            ->update(['status' => $statusNovo]);

        $orderArticles = Order::where('id', $id)->where('id_unity',Auth::user()->id_unity)->get();

        $pacientePedido = $orderArticles[0]['patient_id'];

        $medicoPedido = $orderArticles[0]['medic_id'];

        $email = Patient::where('id', $pacientePedido)->get();

        $emailMedic = Medic::where('id', $medicoPedido)->get();

        $emailPaciente = $email[0]['email'];

        $emailMedico = $emailMedic[0]['email'];

        $nomeMedico = $emailMedic[0]['name'];
        
        $paciente = $email[0]['name'];

        $protocolo = $orderArticles[0]['protocol'];

        if ($statusNovo == "FINALIZADO") {
            
            $link = "<a href='http://www.labsystem.net.br/clientes/multtest/public/pedido/".$id."/pdf'>aqui</a>";
            
            $assunto = "O exame solicitado se encontra finalizado ";
            $descricao = $nomeMedico . " , o exame que solicitara para o paciente " . $paciente . " encontra-se pronto. Para visualiza-lo basta clicar " . $link.".";
            $emailremetente = 'contato@labsystem.net.br';
            $emaildestinatario = $emailPaciente; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web

            /* Montando a mensagem a ser enviada no corpo do e-mail. */
            $mensagemHTML = '<p><b>Para:</b> ' . $nomeMedico . '</p>
                            ' . $descricao . '
                            <br><br>Atenciosamente, Equipe Lab System. ';

            // O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
            // O return-path deve ser ser o mesmo e-mail do remetente.
            $headers = "MIME-Version: 1.1\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: $emailremetente\r\n"; // remetente
            $headers .= "Return-Path: $emaildestinatario \r\n"; // return-path
            $envioMedico = mail($emailMedico, $assunto, $mensagemHTML, $headers);

            if ($envioMedico) {

            $notification = DB::table('notifications')->insert([
                        ['subject' => 'NOVO STATUS - PEDIDO - NOTIFICA MÉDICO',
                         'description' => $descricao,
                         'destination' => $emaildestinatario,
                         'created_at' => date('Y-m-d H:m:s'),
                         'status' => "ENVIADO"],

                ]);

            
        } else {

            $notification = DB::table('notifications')->insert([
                        ['subject' => 'NOVO STATUS - PEDIDO - NOTIFICA MÉDICO',
                         'description' => $descricao,
                         'destination' => $emaildestinatario,
                         'created_at' => date('Y-m-d H:m:s'),
                         'status' => "NÃO ENVIADO"],

                ]);

            

            }
        }

        $assunto = 'Novidades ' . $paciente;
        $descricao = $paciente . ' o seu pedido foi modificado. Seu novo status é ' . $statusNovo . '.';
        $emailremetente = 'contato@labsystem.net.br';
        $emaildestinatario = $emailPaciente; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web

        /* Montando a mensagem a ser enviada no corpo do e-mail. */
        $mensagemHTML = '<p><b>Para:</b> ' . $paciente . '</p>
                        ' . $descricao . '
                        <br><br>Atenciosamente, Equipe Lab System. ';

        // O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
        // O return-path deve ser ser o mesmo e-mail do remetente.
        $headers = "MIME-Version: 1.1\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: $emailremetente\r\n"; // remetente
        $headers .= "Return-Path: $emaildestinatario \r\n"; // return-path
        $envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers);

        if ($envio) {

            $notification = DB::table('notifications')->insert([
                        ['subject' => 'NOVO STATUS - PEDIDO',
                         'description' => $descricao,
                         'destination' => $emaildestinatario,
                         'created_at' => date('Y-m-d H:m:s'),
                         'status' => "ENVIADO"],

                ]);

            return back()->with('enviado', "SIM");
        } else {

            $notification = DB::table('notifications')->insert([
                        ['subject' => 'NOVO STATUS - PEDIDO',
                         'description' => $descricao,
                         'destination' => $emaildestinatario,
                         'created_at' => date('Y-m-d H:m:s'),
                         'status' => "NÃO ENVIADO"],

                ]);

            return back()->with('enviado', "NAO");

        }

        

    }

    public function entregaLaudo($id) {

        $statusNovo = "ENTREGUE";

        $tiradoPor = $_POST['tiradoPor'];

        $funcionario = $_POST['funcionario'];

        $dia = $_POST['dia'];

        $hora = $_POST['hora'];

        $user = Auth::user()->id;

        $dia_entregue = date('d/m/Y H:m:s');

        $novoStatus = DB::table('orders')
            ->where('id', $id)
            ->update(['status' => $statusNovo,
                'entregue' => $dia_entregue,
                'delivery_user' => $user,
                'delivery_person' => $tiradoPor]);

        $orderArticles = Order::where('id', $id)->where('id_unity',Auth::user()->id_unity)->get();

        $pacientePedido = $orderArticles[0]['patient_id'];

        $email = Patient::where('id', $pacientePedido)->get();

        $emailPaciente = $email[0]['email'];

        $paciente = $email[0]['name'];

        $protocolo = $orderArticles[0]['protocol'];

        $ultimoId = $orderArticles[0]['id'];

        $pacId = $email[0]['id'];

        $dia = date('Y-m-d H:m:s');

        $user = Auth::user()->name;

        if ($tiradoPor != "PACIENTE") {

            $assunto = 'Atenção. Seu Laudo foi entregue a ' . $tiradoPor;

            $descricao = $paciente . ', o resultado de seu pedido foi retirado por ' . $tiradoPor . ', as ' . $hora . ' do dia ' . $dia . ' entregue pelo funcionario ' . $funcionario . '.';

            $insertPerson = DB::table('orders')->where('id', $id)->update(['delivery_person' => $tiradoPor, 'delivery_user' => $user]);

        } else {

            $assunto = $paciente . ' podemos lhe ajudar com o laudo?';

            $descricao = 'Bom ' . $paciente . ', agora que voce já esta de posse de seu laudo, estamos a disposição para auxilia-lo na interpretação dos resultados. Caso tenha alguma duvida, entre em contato conosco. Teremos o maior prazer em ajuda-lo.';

            $insertPerson = DB::table('orders')->where('id', $id)->update(['delivery_person' => $tiradoPor, 'delivery_user' => $user]);

        }

        $emailremetente = 'contato@labsystem.net.br';
        $emaildestinatario = $emailPaciente; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web

        /* Montando a mensagem a ser enviada no corpo do e-mail. */
        $mensagemHTML = '<p><b>Para:</b> ' . $paciente . '</p>
                        ' . $descricao . '
                        <br><br>Atenciosamente, Equipe Lab System. ';

        // O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
        // O return-path deve ser ser o mesmo e-mail do remetente.
        $headers = "MIME-Version: 1.1\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: $emailremetente\r\n"; // remetente
        $headers .= "Return-Path: $emaildestinatario \r\n"; // return-path
        $envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers);

        if ($envio) {

            $notification = DB::table('notifications')->insert([
                        ['subject' => 'ENTREGA DE LAUDO',
                         'description' => $descricao,
                         'destination' => $emaildestinatario,
                         'created_at' => date('Y-m-d H:m:s'),
                         'status' => "ENVIADO"],

                ]);

            return back()->with('entregue', "SIM");
        } else {

            $notification = DB::table('notifications')->insert([
                        ['subject' => 'ENTREGA DE LAUDO',
                         'description' => $descricao,
                         'destination' => $emaildestinatario,
                         'created_at' => date('Y-m-d H:m:s'),
                         'status' => "NÃO ENVIADO"],

                ]);

            return back()->with('entregue', "NAO");

        }

    }

    public function detalheEntregaPedido($id) {

        $orders = Order::where('id', $id)->where('id_unity',Auth::user()->id_unity)->get();
        return view('Requests.entrega', ['orders' => $orders]);

    }

    public function pedidosHoje() {

        $pedidosHoje = DB::table('orders')->whereDate('created_at', DB::raw('CURDATE()'))->where('id_unity',Auth::user()->id_unity)->get();

        return view('relatorios.pedidosHoje', ['pedidosHoje' => $pedidosHoje]);

    }

    public function internos() {

        $orders = Order::where('type', 'INTERNO')->where('id_unity',Auth::user()->id_unity)->get();
        $states = State::all();
        $autorizados = AuthorizedPerson::orderBy('name', 'asc')->get();
        return view('Requests.Request', ['orders' => $orders, 'states' => $states, 'autorizados' => $autorizados]);
    }

    public function externos() {

               
        $orders = Order::where('type', 'EXTERNO')->where('id_unity',Auth::user()->id_unity)->get();
        $states = State::all();
        $autorizados = AuthorizedPerson::orderBy('name', 'asc')->get();
        return view('Requests.Request', ['orders' => $orders, 'states' => $states, 'autorizados' => $autorizados]);
    }

}