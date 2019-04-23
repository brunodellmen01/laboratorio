<?php

//$reports = \App\Report::all();
//$grouped = $reports->mapToGroups(function ($item, $key) {
//    return [$item['category_id'] => $item['description']];
//});
//
//dd($grouped);

//$categories = \App\Category::all();
//foreach ($categories as $category) {
//    echo $category->id. ' - '.$category->name;
//    echo '<ul>';
//    foreach ($category->reports as $item) {
//        echo '<li>'. $item->description . ' - ' . $item->price . '</li>';
//    }
//    echo '</ul>';
//}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
	return view('auth/login');
})->name('inicio');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

//se nao tiver logado, vai pra tela de login
Route::get('/register', ['middleware' => 'auth'], function () {
	return view('auth/login');
});

Route::get('/register', function () {
	return view('usuarios.formulario');
});

Route::get('/usuario/novo', function () {
	return view('usuarios.formulario');
});

//se tiver logado, vai pra tela de usuarios
//Route::get(('/register', ['registers' => 'UserController@index', 'middleware' => 'auth'])->name('register'));

Route::get('/ativar-usuario/{usuario}', 'UserController@ativaUsuario')->name('ativar-usuario');

Route::get('/ativado', 'LoginController@ativado')->name('ativado');

Route::get('/usuarioAtivo', '\App\Http\Controllers\Auth\LoginController@usuarioAtivo')->name('usuarioAtivo');



Route::post('/deslogar', 'UserController@deslogar')->name('deslogar');

//resetar senha
Route::post('/recuperar-senha', 'UserController@mudaSenha');

//bkp
	Route::get('/backup', 'BackupSQLController@index');
	Route::get('/bkp', 'BackupSQLController@index');

// rotas pdf
	Route::get('/pedido/{pedido}/pdf', 'pdfController@index');
	Route::get('/pedidos/{pedido}/pdf', 'pdfController@index');

Route::group(['middleware' => 'auth'], function () {

	Route::get('/usuarios/ativar', 'UserController@listar')->name('usuario');	

	Route::get('/usuarios/listar/inativos', 'UserController@listarInativos')->name('listarInativos');

	Route::get('/usuarios/listar/ativos', 'UserController@listarAtivos')->name('listarAtivos');

	Route::get('/usuarios/ativar/{usuario}', 'UserController@ativarUsuarioInterno')->name('ativarUsuarioInterno');	

	Route::get('/register', 'UserController@index')->name('register');

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/rh/home', 'HomeController@rhHome');
	Route::get('/rh/despesa', 'ExpensesController@despesa_rh');

	Route::get('/usuarios', 'UserController@index')->name('usuarios');
	Route::get('/usuarios/{id}/editar', 'UserController@editar');
	Route::patch('/usuarios/{id}/editar', 'UserController@atualizar');
	Route::post('/usuarios/salvar', 'UserController@salvar');

	//rotas modulos medico
	Route::get('/medico', 'MedicController@index');
	Route::get('/medicos', 'MedicController@index');
	Route::get('/medicos/novo', 'MedicController@index');
	Route::get('/medico/novo', 'MedicController@index');

	Route::post('/medicos/salvar', 'MedicController@salvar');
	Route::post('/medico/salvar', 'MedicController@salvar');

	Route::get('/medico/listar', 'MedicController@listar');
	Route::get('/medicos/listar', 'MedicController@listar');

	Route::patch('/medicos/{medico}/editar', 'MedicController@atualizar');

	Route::get('/medicos/{medico}/editar', 'MedicController@editar');
	Route::get('/medico/{medico}/editar', 'MedicController@editar');

	Route::post('/medicos/{medico}/inativar', 'MedicController@inativar');
	Route::post('/medico/{medico}/inativar', 'MedicController@inativar');

	//rotas modulos convenio
	Route::get('/covenants.formulario', 'CovenantController@index');
	Route::get('/covenants.formulario', 'CovenantController@index');
	Route::get('/convenios/novo', 'CovenantController@index');
	Route::get('/convenio/novo', 'CovenantController@index');

	Route::post('/convenios/salvar', 'CovenantController@salvar');
	Route::post('/convenio/salvar', 'CovenantController@salvar');

	Route::get('/convenio/listar', 'CovenantController@listar');
	Route::get('/convenios/listar', 'CovenantController@listar');

	Route::patch('/convenios/{convenio}/editar', 'CovenantController@atualizar');

	Route::get('/convenios/{convenio}/editar', 'CovenantController@editar');
	Route::get('/convenio/{convenio}/editar', 'CovenantController@editar');

	Route::post('/convenios/{convenio}/inativar', 'CovenantController@inativar');
	Route::post('/convenio/{convenio}/inativar', 'ConveniosController@inativar');

	//rotas tipo de Resultado
	Route::get('/tipoResultado', 'TipoResultadoController@index');
	Route::get('/tipoResultados', 'TipoResultadoController@index');
	Route::get('/tipoResultados/novo', 'TipoResultadoController@index');
	Route::get('/tipoResultado/novo', 'TipoResultadoController@index');

	Route::post('/tipoResultados/salvar', 'TipoResultadoController@salvar');
	Route::post('/tipoResultado/salvar', 'TipoResultadoController@salvar');

	Route::get('/tipoResultado/listar', 'TipoResultadoController@listar');
	Route::get('/tipoResultados/listar', 'TipoResultadoController@listar');

	Route::patch('/tipoResultados/{tipoResultado}/editar', 'TipoResultadoController@atualizar');
	Route::patch('/tipoResultado/{tipoResultado}/editar', 'TipoResultadoController@atualizar');

	Route::get('/tipoResultados/{tipoResultado}/editar', 'TipoResultadoController@editar');
	Route::get('/tipoResultado/{tipoResultado}/editar', 'TipoResultadoController@editar');

	Route::post('/tipoResultados/{tipoResultado}/inativar', 'TipoResultadoController@inativar');
	Route::post('/tipoResultado/{tipoResultado}/inativar', 'TipoResultadoController@inativar');

	//rotas tipo de Exame
	Route::get('/tipoExame', 'ExamController@index');
	Route::get('/tipoExames', 'ExamController@index');
	Route::get('/tipoExames/novo', 'TipoRExameController@index');
	Route::get('/tipoExame/novo', 'ExamController@index');

	Route::post('/tipoExames/salvar', 'ExamController@salvar');
	Route::post('/tipoExame/salvar', 'ExamController@salvar');

	Route::get('/tipoExame/listar', 'ExamController@listar');
	Route::get('/tipoExames/listar', 'ExamController@listar');

	Route::patch('/tipoExames/{tipoExame}/editar', 'ExamController@atualizar');
	Route::patch('/tipoExame/{tipoExame}/editar', 'ExamController@atualizar');

	Route::get('/tipoExames/{tipoExame}/editar', 'ExamController@editar');
	Route::get('/tipoExame/{tipoExame}/editar', 'ExamController@editar');

	Route::post('/tipoExames/{tipoExame}/inativar', 'ExamController@inativar');
	Route::post('/tipoExame/{tipoExame}/inativar', 'ExamController@inativar');

	//rotas modulos medico
	Route::get('/paciente', 'PatientController@index')->name('paciente');
	Route::get('/pacientes', 'PatientController@index');
	Route::get('/pacientes/novo', 'PatientController@index');
	Route::get('/paciente/novo', 'PatientController@index');

	Route::post('/pacientes/salvar', 'PatientController@salvar');
	Route::post('/paciente/salvar', 'PatientController@salvar');

	Route::get('/paciente/listar', 'PatientController@listar');
	Route::get('/pacientes/listar', 'PatientController@listar');

	Route::patch('/pacientes/{paciente}/editar', 'PatientController@atualizar');

	Route::get('/pacientes/{paciente}/editar', 'PatientController@editar');
	Route::get('/paciente/{paciente}/editar', 'PatientController@editar');

	Route::post('/pacientes/{paciente}/inativar', 'PatientController@inativar');
	Route::post('/paciente/{paciente}/inativar', 'PatientController@inativar');

	//pessoas autorizadas
	Route::post('/autoriza/novo', 'PatientController@autoriza');

	//rotas modulos clinica
	Route::get('/clinica', 'ClinicController@index');
	Route::get('/clinicas', 'ClinicController@index');
	Route::get('/clinicas/novo', 'ClinicController@index');
	Route::get('/clinica/novo', 'ClinicController@index');

	Route::post('/clinicas/salvar', 'ClinicController@salvar');
	Route::post('/clinica/salvar', 'ClinicController@salvar');

	Route::get('/clinica/listar', 'ClinicController@listar');
	Route::get('/clinicas/listar', 'ClinicController@listar');

	Route::patch('/clinicas/{clinica}/editar', 'ClinicController@atualizar');

	Route::get('/clinicas/{clinica}/editar', 'ClinicController@editar');
	Route::get('/clinica/{clinica}/editar', 'ClinicController@editar');

	Route::post('/clinicas/{clinica}/inativar', 'ClinicController@inativar');
	Route::post('/clinica/{clinica}/inativar', 'ClinicController@inativar');

	//rotas modulos laboratorio
	Route::get('/laboratorio', 'LaboratoryController@index');
	Route::get('/laboratorios', 'LaboratoryController@index');
	Route::get('/laboratorios/novo', 'LaboratoryController@index');
	Route::get('/laboratorio/novo', 'LaboratoryController@index');

	Route::post('/laboratorios/salvar', 'LaboratoryController@salvar');
	Route::post('/laboratorio/salvar', 'LaboratoryController@salvar');

	Route::get('/laboratorio/listar', 'LaboratoryController@listar');
	Route::get('/laboratorios/listar', 'LaboratoryController@listar');

	Route::patch('/laboratorios/{laboratorio}/editar', 'LaboratoryController@atualizar');

	Route::get('/laboratorios/{laboratorio}/editar', 'LaboratoryController@editar');
	Route::get('/laboratorio/{laboratorio}/editar', 'LaboratoryController@editar');

	Route::post('/laboratorios/{laboratorio}/inativar', 'LaboratoryController@inativar');
	Route::post('/laboratorio/{laboratorio}/inativar', 'LaboratoryController@inativar');

	//rotas modulos resultado
	Route::get('/resultado', 'ResultController@index');
	Route::get('/resultados', 'ResultController@index');
	Route::get('/resultados/novo', 'ResultController@index');
	Route::get('/resultado/novo', 'ResultController@index');

	Route::post('/resultados/salvar', 'ResultController@salvar');
	Route::post('/resultado/salvar', 'ResultController@salvar');

	Route::get('/resultado/listar', 'ResultController@listar');
	Route::get('/resultados/listar', 'ResultController@listar');

	Route::patch('/resultados/{resultado}/editar', 'ResultController@atualizar');
	Route::patch('/resultado/{resultado}/editar', 'ResultController@atualizar');

	Route::get('/resultados/{resultado}/editar', 'ResultController@editar');
	Route::get('/resultado/{resultado}/editar', 'ResultController@editar');

	Route::post('/resultados/{resultado}/inativar', 'ResultController@inativar');
	Route::post('/resultado/{resultado}/inativar', 'ResultController@inativar');

	//rotas modulos preco Exame
	Route::get('/precoExame', 'ValueController@index');
	Route::get('/precoExames', 'ValueController@index');
	Route::get('/precoExames/novo', 'ValueController@index');
	Route::get('/precoExame/novo', 'ValueController@index');

	Route::post('/precoExames/salvar', 'ValueController@salvar');
	Route::post('/precoExame/salvar', 'ValueController@salvar');

	Route::get('/precoExame/listar', 'ValueController@listar');
	Route::get('/precoExames/listar', 'ValueController@listar');

	Route::patch('/precoExames/{precoExame}/editar', 'ValueController@atualizar');
	Route::patch('/precoExame/{precoExame}/editar', 'ValueController@atualizar');

	Route::get('/precoExames/{precoExame}/editar', 'ValueController@editar');
	Route::get('/precoExame/{precoExame}/editar', 'ValueController@editar');

	Route::post('/precoExames/{precoExame}/inativar', 'ValueController@inativar');
	Route::post('/precoExame/{precoExame}/inativar', 'ValueController@inativar');

	//rotas modulos pedido
	Route::get('/pedido', 'OrderController@index')->name('openNewOrders');
	Route::get('/pedidos', 'OrderController@index');
	Route::get('/pedidos/novo', 'OrderController@index');
	Route::get('/pedido/novo', 'OrderController@index');

	Route::get('/pedido/listar', 'OrderController@listar')->name('openOrders');
	Route::get('/pedidos/listar', 'OrderController@listar');

	Route::post('/pedido/salvar', 'OrderController@salvar');
	Route::post('/pedidos/salvar', 'OrderController@salvar');

	Route::get('/pedido/{pedido}/adicionar', 'OrderController@adicionaExame');
	Route::get('/pedidos/{pedido}/adicionar', 'OrderController@adicionaExame');

	Route::get('/pedido/{pedido}/remover', 'OrderController@removerExame');
	Route::get('/pedidos/{pedido}/remover', 'OrderController@removerExame');

	Route::get('/pedido/exames', 'OrderController@listaExame');
	Route::get('/pedido/exame', 'OrderController@listaExame');
	Route::get('/pedidos/exames', 'OrderController@listaExame');

	Route::get('/pedidos/finalizar', 'OrderController@finish');
	Route::get('/pedido/finalizar', 'OrderController@finish');

	Route::get('/pedidos/{pedido}/detalhes', 'OrderController@detalhes');
	Route::get('/pedido/{pedido}/detalhe', 'OrderController@detalhes');

	Route::get('/pedido/{ultimo}/exame/{pedido}/adicionar', 'OrderController@adicionaExame');
	Route::get('/pedido/{ultimo}/exame/{pedido}/remover', 'OrderController@removerExame');

	Route::get('/pedido/detalhe/entrega/{pedido}', 'OrderController@detalheEntregaPedido');

	Route::get('/pedidos/internos', 'OrderController@internos')->name('pedidosInternos');

	Route::get('/pedidos/externos', 'OrderController@externos')->name('pedidosExternos');

	Route::get('/public', function () {
		return;
	});

	//rotas modulos convenio
	Route::get('/convenio', 'CovenantController@index');
	Route::get('/convenios', 'CovenantController@index');
	Route::get('/convenios/novo', 'CovenantController@index');
	Route::get('/convenio/novo', 'CovenantController@index');

	Route::post('/convenios/salvar', 'CovenantController@salvar');
	Route::post('/convenio/salvar', 'CovenantController@salvar');

	Route::get('/convenio/listar', 'CovenantController@listar');
	Route::get('/convenios/listar', 'CovenantController@listar');

	Route::patch('/convenios/{convenio}/editar', 'CovenantController@atualizar');

	Route::get('/convenios/{convenio}/editar', 'CovenantController@editar');
	Route::get('/convenio/{convenio}/editar', 'CovenantController@editar');

	Route::post('/convenios/{convenio}/inativar', 'CovenantController@inativar');
	Route::post('/convenio/{convenio}/inativar', 'CovenantController@inativar');

	//rotas financeiro
	Route::get('/financeiro', 'FinancesController@index');
	Route::get('/financeiros', 'FinancesController@index');

	Route::get('/financeiro/pedido', 'FinancesController@financesOrder');
	Route::get('/financeiros/pedidos', 'FinancesController@financesOrder');

	Route::get('/financeiro/{pedido}/gerar', 'financesController@geraParcela');
	//Route::get('/financeiro/{pedido}/gerar', 'FinancesController@geraParcela');

	Route::get('/financeiros/pedido/{finance}/visualizar', 'financesController@show');
	Route::get('/financeiro/pedido/{finance}/visualizar', 'financesController@show');

	//rotas paga parcela
	Route::get('/financeiros/{finance}/conta-receber', 'FinancesController@pagaParcela');
	Route::get('/financeiro/{finance}/conta-receber', 'FinancesController@pagaParcela');

	Route::get('/financeiros/pedido/receber/pedido/{pedido}/parcela/{finance}', 'FinancesController@pagaParcela');

	//rotas movimentacao
	Route::get('/financeiro/movimentacao', 'MovimentController@index');
	Route::get('/financeiros/movimentacao', 'MovimentController@index');

	Route::get('/financeiro/movimentacao/novo', 'MovimentController@movimentacao');
	Route::get('/financeiros/movimentacao/novo', 'MovimentController@movimentacao');

	Route::post('/financeiro/movimentacao/salvar', 'MovimentController@movimentar');
	Route::post('/financeiros/movimentacaos/salvar', 'MovimentController@movimentar');

	//rotas caixa
	Route::get('/financeiro/caixa', 'financesController@caixa');
	Route::get('/financeiros/caixa', 'financesController@caixa');

	Route::post('/financeiro/caixa/abrir', 'FinancesController@abreCaixa');
	Route::post('/financeiros/caixa/abrir', 'FinancesController@abreCaixa');

	Route::post('/financeiro/caixa/fechar', 'FinancesController@fechaCaixa');
	Route::post('/financeiros/caixa/fechar', 'FinancesController@fechaCaixa');

	//rotas caixa
	Route::get('/empresa', 'CompaniesController@index');
	Route::get('/empresas', 'CompaniesController@index');

	//rotas empresas (despesas fixas)
	Route::get('/empresa/novo', 'CompaniesController@novo');
	Route::get('/empresas/novo', 'CompaniesController@novo');

	Route::post('/empresa/salvar', 'CompaniesController@salvar');
	Route::post('/empresas/salvar', 'CompaniesController@salvar');

	Route::get('/empresas/listar', 'CompaniesController@listar');
	Route::get('/empresa/listar', 'CompaniesController@listar');

	Route::get('/empresas/{empresa}/editar', 'CompaniesController@editar');
	Route::get('/empresa/{empresa}/editar', 'CompaniesController@editar');

	Route::post('/empresas/{empresa}/inativar', 'CompaniesController@inativar');
	Route::post('/empresa/{empresa}/inativar', 'CompaniesController@inativar');

	Route::patch('/empresas/{empresa}/editar', 'CompaniesController@atualizar');
	Route::patch('/empresa/{empresa}/editar', 'CompaniesController@atualizar');

	//rotas para os materiais
	Route::get('/material', 'MaterialController@index');
	Route::get('/material', 'MaterialController@index');

	//criação de materias para clinica/laboratorio
	Route::get('/material/novo', 'MaterialController@novo');
	Route::get('/material/novo', 'MaterialController@novo');

	Route::post('/material/salvar', 'MaterialController@salvar');

	Route::get('/material/listar', 'MaterialController@listar');
	Route::get('/material/listar', 'MaterialController@listar');

	Route::get('/material/{material}/editar', 'MaterialController@editar');

	Route::patch('/materials/{material}/editar', 'MaterialController@atualizar');
	Route::patch('/material/{material}/editar', 'MaterialController@atualizar');

	Route::post('/material/{material}/inativar', 'MaterialController@inativar');

	//rota despesas fixas
	Route::get('/financeiros/despesas', 'ExpensesController@index');
	Route::get('/financeiro/despesa/', 'ExpensesController@index');


	Route::post('/financeiros/despesas/gerar', 'ExpensesController@gerar');
	Route::post('/financeiro/despesa/gerar', 'ExpensesController@gerar');

	Route::post('/financeiros/despesas/pagar', 'ExpensesController@pagar');
	Route::post('/financeiro/despesa/pagar', 'ExpensesController@pagar');

	//rota laudo
	Route::get('/pedidos/{pedido}/laudos', 'ReportController@index');
	Route::get('/pedido/{pedido}/laudo', 'ReportController@index');

	Route::get('/pedidos/{pedido}/laudos/{item}/novo', 'ReportController@novo');
	Route::get('/pedido/{pedido}/laudo/{item}/novo', 'ReportController@novo');

	Route::post('/pedidos/{pedido}/laudos/{item}/resultado', 'ReportController@resultado');
	Route::post('/pedido/{pedido}/laudo/{item}/resultado', 'ReportController@resultado');

	Route::post('/pedidos/{pedido}/laudos/{item}/resultado', 'ReportController@store');
	Route::post('/pedido/{pedido}/laudo/{item}/resultado', 'ReportController@store');

	

	Route::get('/pedido/{pedido}/retirada', 'pdfController@retirada');
	Route::get('/pedidos/{pedido}/retirada', 'pdfController@retirada');

	Route::get('/pedido/{pedido}/resumo', 'pdfController@resumo');
	Route::get('/pedidos/{pedido}/resumo', 'pdfController@resumo');

	Route::get('/pedidos/hoje', 'OrderController@pedidosHoje');

	//rotas relatorios
	Route::get('/relatorios/precoExame', 'RelatorioController@preco');
	Route::get('/relatorio/precoExame', 'RelatorioController@preco');

	Route::get('/relatorios/precoExame/convenio/{convenio}', 'RelatorioController@convenio');

	Route::get('/relatorios/aniversariantes', 'RelatorioController@aniversariantes');

	Route::get('/relatorio/aniversariantes', 'RelatorioController@aniversariantes');

	Route::post('/relatorios/aniversariantes/email', 'RelatorioController@enviaParabens');

	Route::post('/relatorio/aniversariantes/email', 'RelatorioController@enviaParabens');

	Route::post('/relatorios/aniversariante/email', 'RelatorioController@enviaParabens');

	Route::post('/relatorio/aniversariante/email', 'RelatorioController@enviaParabens');

	Route::get('/relatorios/pacientes/cidades', 'RelatorioController@cidades');

	Route::get('/relatorio/paciente/cidade', 'RelatorioController@cidades');

	Route::get('/relatorios/pacientes/cidades/{cidade}', 'RelatorioController@pacienteCidade');
	Route::get('/relatorio/paciente/cidade/{cidade}', 'RelatorioController@pacienteCidade');

	Route::get('/relatorio/resultado/exame', 'RelatorioController@resultadoExame');

	Route::get('/relatorio/resultado/exame/{exame}', 'RelatorioController@resultado');
	Route::get('/relatorios/resultados/exames/{exame}', 'RelatorioController@resultado');

	Route::get('/relatorios/contas-receber/hoje', 'RelatorioController@contaReceberHoje');

	Route::get('/relatorio/conta-receber/hoje', 'RelatorioController@contaReceberHoje');

	Route::get('/relatorios/contas-pagar/hoje', 'RelatorioController@contaPagarHoje');

	Route::get('/relatorio/conta-pagar/hoje', 'RelatorioController@contaPagarHoje');

	Route::get('/relatorio/pedido/', 'RelatorioController@pedido');
	Route::get('/relatorios/pedidos/', 'RelatorioController@pedido');

	Route::get('/relatorio/contas-vencidas', 'RelatorioController@contaVencida');
	Route::get('/relatorios/contas-vencidas', 'RelatorioController@contaVencida');
	Route::get('/relatorio/conta-vencida', 'RelatorioController@contaVencida');

	Route::post('/relatorio/contas-vencidas/notificar', 'RelatorioController@notificaParcela');
	Route::post('/relatorios/contas-vencidas/notificar', 'RelatorioController@notificaParcela');
	Route::post('/relatorio/conta-vencida/notificar', 'RelatorioController@notificaParcela');

	Route::get('/relatorio/convenio/', 'RelatorioController@despesaConvenio');
	Route::get('/relatorio/convenio/{id_convenio}/', 'RelatorioController@despesaConvenioResumo');

	Route::get('/estatisticas-para-nerd', 'RelatorioController@nerd');

	Route::post('pedido/{pedido}/status/novo', 'OrderController@mudaStatus');
	Route::post('pedidos/{pedido}/status/novo', 'OrderController@mudaStatus');

	Route::post('pedido/{pedido}/status/entregar', 'OrderController@entregaLaudo');
	Route::post('pedidos/{pedido}/status/entregar', 'OrderController@entregaLaudo');

	//historico

	Route::get('historico', 'HistoryController@index');
	Route::get('historicos', 'HistoryController@index');

	Route::get('historico/paciente/{paciente}', 'HistoryController@historico');
	Route::get('historicos/paciente/{paciente}', 'HistoryController@historico');

	Route::post('historico/paciente/dados/salvar', 'HistoryController@dados');

	//busca
	Route::post('/busca/protocolo', 'SearchController@index')->name('busca-protocolo');
	Route::post('/busca/paciente', 'SearchController@paciente')->name('busca-paciente');
	Route::post('/pacientes/cadastro/rapido', 'PatientController@cadastroRapido');
	

	

	//bkp
	Route::get('/chamados', 'SuportController@index');
	Route::post('/chamados/novo', 'SuportController@index');
	Route::get('/chamados/lista', 'SuportController@listar');
	Route::post('/chamados/salvar', 'SuportController@abrirChamado');

	//calendario
	//Route::get('/agenda', 'CalendarController@index');
	Route::resource('/agenda', 'TasksController');
	Route::resource('/agenda/novo', 'TasksController@create');
	Route::post('/agenda/salvar', 'TasksController@store');
	Route::get('/agenda/{agenda}/detalhe', 'TasksController@detalhe');
	Route::patch('/agenda/{agenda}/editar', 'TasksController@atualizar');
	Route::post('/agenda/{agenda}/excluir', 'TasksController@excluir');
	Route::get('rh/agenda', 'TasksController@indexAdm');

	//rota laudo cliente
	//esta rota e acessada fora do sistema

	Route::post('/protocolo/', 'pdfController@laudoCliente');

	// rotas metodos
	//rotas para os materiais
	Route::get('/metodo', 'MethodController@index');
	Route::get('/metodos', 'MethodController@index');

	Route::get('/metodo/novo', 'MethodController@novo');
	Route::get('/metodos/novo', 'MethodController@novo');

	Route::post('/metodo/salvar', 'MethodController@salvar');

	Route::get('/metodo/listar', 'MethodController@listar');
	Route::get('/metodos/listar', 'MethodController@listar');

	Route::get('/metodo/{metodo}/editar', 'MethodController@editar');

	Route::patch('/metodo/{metodo}/editar', 'MethodController@atualizar');
	Route::patch('/metodos/{metodo}/editar', 'MethodController@atualizar');

	Route::post('/metodo/{metodo}/inativar', 'MethodController@inativar');

	//rotas notificacoes
	Route::get('/notificacoes', 'NotificationController@index')->name('notificacoes');

	//rotas para guia tiss
	Route::get('/tiss/consulta/', 'GuideController@consulta');
	Route::get('/tiss/consulta/guia/{id_tiss}', 'GuideController@detalheGuia');
	Route::get('/tiss/consulta/guia/{id_tiss}/pdf', 'GuideController@imprimir_guia');
	Route::get('/tiss/solicita-sp-sdat/', 'GuideController@solicita-sp-sdat');
	Route::get('/tiss/sp-sdat/', 'GuideController@sp-sdat');
	Route::get('/tiss/lote/', 'GuideController@lote');
	Route::get('/historico/paciente/{id}/tiss', 'GuideController@index');
	Route::get('/historico/paciente/{id}/tiss/ver/', 'GuideController@verGuia');
	Route::get('/historico/paciente/{id}/tiss/ver/{id_guia}', 'GuideController@verGuiaProc');

	Route::post('/historico/paciente/{id}/tiss/salvar/', 'GuideController@salvar');
	Route::get('/historico/paciente/{id_patient}/tiss/{id_tiss}/procedimentos', 'GuideController@procedimentos');
	Route::post('/historico/paciente/{id_patient}/tiss/{id_tiss}/procedimentos/{id_proc}/adicionar', 'GuideController@add_procedimentos');
	Route::post('/historico/paciente/{id_patient}/tiss/{id_tiss}/procedimentos/{id_proc}/remover', 'GuideController@remove_procedimentos');

	Route::get('/historico/paciente/{id_patient}/tiss/{id_tiss}/procedimentos/{id_proc}/removido', 'GuideController@voltar');

	Route::get('/historico/paciente/{id_patient}/tiss/{id_tiss}/finalizar', 'GuideController@finaliza_tiss');

	Route::get('/historico/paciente/{id_paciente}/tiss/pdf/{id_guia}', 'GuideController@imprimir_guia');



	//rotas para config da empresa
	Route::get('/configuracao/empresa/', 'ConfigurationController@index');
	Route::get('/configuracao/empresa/unidades', 'ConfigurationController@unidades');
	Route::post('/configuracao/empresa/unidades/salvar', 'ConfigurationController@salvarUnidade');
	Route::get('/configuracao/empresa/unidades/listar', 'ConfigurationController@listarUnidade');
	Route::get('/configuracao/empresa/unidades/{id_unidade}/editar', 'ConfigurationController@editarUnidade');
	Route::get('/configuracao/empresa/unidades/{id_unidade}/editar', 'ConfigurationController@editarUnidade');
	Route::patch('/configuracao/empresa/unidades/{id_unidade}/editar', 'ConfigurationController@atualizar');
	Route::get('/configuracao/empresa/unidades/{id_unidade}/deletar', 'ConfigurationController@delete');
	
	Route::patch('/configuracao/empresa/{id}/editar/', 'ConfigurationController@editar');

	Route::get('/chart/', 'RelatorioController@chart');



});
