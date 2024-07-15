<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FerramentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\SimCardController;
use App\Http\Controllers\RastreadorController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\OperadoraController;
use App\Http\Controllers\ModeloRastreadorController;
use App\Http\Controllers\TipoRastreadorController;
use App\Http\Controllers\BaixaController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\TransferenciaEstoqueController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('index');
Route::post('/autenticarLogin', [LoginController::class, 'autenticar'])->name('autenticar');
Route::get('/recuperarSenha', [LoginController::class, 'recuperarSenha'])->name('recuperarSenha');
Route::post('/gerarNovaSenha', [LoginController::class, 'gerarNovaSenha'])->name('gerarNovaSenha');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/alterarSenha', [DashboardController::class, 'alterarSenha'])->name('alterarSenha');
    Route::post('/setNovaSenha', [DashboardController::class, 'setNovaSenha'])->name('setNovaSenha');
    Route::get('/alterarImagem', [DashboardController::class, 'alterarImagem'])->name('alterarImagem');
    Route::post('/setNovaImagem', [DashboardController::class, 'setNovaImagem'])->name('setNovaImagem');

    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/adicionar', [UsuarioController::class, 'adicionar'])->name('usuarios.add');
    Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->name('usuarios.editar');
    Route::get('/usuarios/excluir/{id}', [UsuarioController::class, 'excluir'])->name('usuarios.excluir');
    Route::post('/usuarios/insert', [UsuarioController::class, 'insert'])->name('usuarios.insert');
    Route::post('/usuarios/update', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::post('/usuarios/delete', [UsuarioController::class, 'delete'])->name('usuarios.delete');

    Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas');
    Route::get('/marcas/adicionar', [MarcaController::class, 'adicionar'])->name('marcas.add');
    Route::get('/marcas/editar/{id}', [MarcaController::class, 'editar'])->name('marcas.editar');
    Route::get('/marcas/excluir/{id}', [MarcaController::class, 'excluir'])->name('marcas.excluir');
    Route::post('/marcas/insert', [MarcaController::class, 'insert'])->name('marcas.insert');
    Route::post('/marcas/update', [MarcaController::class, 'update'])->name('marcas.update');
    Route::post('/marcas/delete', [MarcaController::class, 'delete'])->name('marcas.delete');

    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');
    Route::get('/produtos/adicionar', [ProdutoController::class, 'adicionar'])->name('produtos.add');
    Route::get('/produtos/editar/{id}', [ProdutoController::class, 'editar'])->name('produtos.editar');
    Route::get('/produtos/excluir/{id}', [ProdutoController::class, 'excluir'])->name('produtos.excluir');
    Route::post('/produtos/insert', [ProdutoController::class, 'insert'])->name('produtos.insert');
    Route::post('/produtos/update', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::post('/produtos/delete', [ProdutoController::class, 'delete'])->name('produtos.delete');

    Route::get('/ferramentas', [FerramentaController::class, 'index'])->name('ferramentas');
    Route::get('/ferramentas/adicionar', [FerramentaController::class, 'adicionar'])->name('ferramentas.add');
    Route::get('/ferramentas/editar/{id}', [FerramentaController::class, 'editar'])->name('ferramentas.editar');
    Route::get('/ferramentas/excluir/{id}', [FerramentaController::class, 'excluir'])->name('ferramentas.excluir');
    Route::post('/ferramentas/insert', [FerramentaController::class, 'insert'])->name('ferramentas.insert');
    Route::post('/ferramentas/update', [FerramentaController::class, 'update'])->name('ferramentas.update');
    Route::post('/ferramentas/delete', [FerramentaController::class, 'delete'])->name('ferramentas.delete');
    Route::get('/ferramentas/alterar_estoque/{id}', [FerramentaController::class, 'alterar_estoque'])->name('ferramentas.alterarEstoque');
    Route::post('/ferramentas/alterar_estoque/update', [FerramentaController::class, 'alterar_estoque_update'])->name('ferramentas.alterar_estoque.update');
    Route::get('/ferramentas/enviar_manutencao/{id}', [FerramentaController::class, 'enviar_manutencao'])->name('ferramentas.enviar_manutencao');
    Route::post('/ferramentas/enviar_manutencao/set', [FerramentaController::class, 'enviar_manutencao_set'])->name('ferramentas.enviar_manutencao.set');
    Route::get('/ferramentas/retorno_manutencao/{id}', [FerramentaController::class, 'retorno_manutencao'])->name('ferramentas.retorno_manutencao');
    Route::post('/ferramentas/retorno_manutencao/set', [FerramentaController::class, 'retorno_manutencao_set'])->name('ferramentas.retorno_manutencao.set');
    Route::get('/ferramentas/baixar/{id}', [FerramentaController::class, 'baixar'])->name('ferramentas.baixar');
    Route::post('/ferramentas/baixar/set', [FerramentaController::class, 'baixar_set'])->name('ferramentas.baixar.set');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/clientes/adicionar', [ClienteController::class, 'adicionar'])->name('clientes.add');
    Route::get('/clientes/editar/{id}', [ClienteController::class, 'editar'])->name('clientes.editar');
    Route::get('/clientes/excluir/{id}', [ClienteController::class, 'excluir'])->name('clientes.excluir');
    Route::get('/clientes/visualizar/{id}', [ClienteController::class, 'visualizar'])->name('clientes.visualizar');
    Route::post('/clientes/insert', [ClienteController::class, 'insert'])->name('clientes.insert');
    Route::post('/clientes/update', [ClienteController::class, 'update'])->name('clientes.update');
    Route::post('/clientes/delete', [ClienteController::class, 'delete'])->name('clientes.delete');

    Route::get('/estoques', [EstoqueController::class, 'index'])->name('estoques');
    Route::get('/estoques/adicionar', [EstoqueController::class, 'adicionar'])->name('estoques.add');
    Route::get('/estoques/editar/{id}', [EstoqueController::class, 'editar'])->name('estoques.editar');
    Route::get('/estoques/excluir/{id}', [EstoqueController::class, 'excluir'])->name('estoques.excluir');
    Route::post('/estoques/insert', [EstoqueController::class, 'insert'])->name('estoques.insert');
    Route::post('/estoques/update', [EstoqueController::class, 'update'])->name('estoques.update');
    Route::post('/estoques/delete', [EstoqueController::class, 'delete'])->name('estoques.delete');
    Route::get('/estoques/adm', [EstoqueController::class, 'estoque_adm'])->name('estoques.adm');
    Route::post('/estoques/adm', [EstoqueController::class, 'estoque_adm_set'])->name('estoques.adm.set');
    Route::get('/estoques/confere_quant_disponivel', [EstoqueController::class, 'confere_quant_disponivel']);

    Route::get('/veiculos', [VeiculoController::class, 'index'])->name('veiculos');
    Route::get('/veiculos/adicionar', [VeiculoController::class, 'adicionar'])->name('veiculos.add');
    Route::get('/veiculos/editar/{id}', [VeiculoController::class, 'editar'])->name('veiculos.editar');
    Route::get('/veiculos/excluir/{id}', [VeiculoController::class, 'excluir'])->name('veiculos.excluir');
    Route::post('/veiculos/insert', [VeiculoController::class, 'insert'])->name('veiculos.insert');
    Route::post('/veiculos/update', [VeiculoController::class, 'update'])->name('veiculos.update');
    Route::post('/veiculos/delete', [VeiculoController::class, 'delete'])->name('veiculos.delete');
    Route::get('/veiculos/busca_veiculos_cliente', [VeiculoController::class, 'busca_veiculos_cliente']);
    Route::get('/veiculos/instalacaoes/{id}', [VeiculoController::class, 'instalacoes'])->name('veiculos.instalacoes');

    Route::get('/simcards', [SimCardController::class, 'index'])->name('simcards');
    Route::get('/simcards/adicionar', [SimCardController::class, 'adicionar'])->name('simcards.add');
    Route::get('/simcards/editar/{id}', [SimCardController::class, 'editar'])->name('simcards.editar');
    Route::get('/simcards/excluir/{id}', [SimCardController::class, 'excluir'])->name('simcards.excluir');
    Route::post('/simcards/insert', [SimCardController::class, 'insert'])->name('simcards.insert');
    Route::post('/simcards/update', [SimCardController::class, 'update'])->name('simcards.update');
    Route::post('/simcards/delete', [SimCardController::class, 'delete'])->name('simcards.delete');

    Route::get('/rastreadores', [RastreadorController::class, 'index'])->name('rastreadores');
    Route::get('/rastreadores/adicionar', [RastreadorController::class, 'adicionar'])->name('rastreadores.add');
    Route::get('/rastreadores/editar/{id}', [RastreadorController::class, 'editar'])->name('rastreadores.editar');
    Route::get('/rastreadores/excluir/{id}', [RastreadorController::class, 'excluir'])->name('rastreadores.excluir');
    Route::post('/rastreadores/insert', [RastreadorController::class, 'insert'])->name('rastreadores.insert');
    Route::post('/rastreadores/update', [RastreadorController::class, 'update'])->name('rastreadores.update');
    Route::post('/rastreadores/delete', [RastreadorController::class, 'delete'])->name('rastreadores.delete');
    Route::get('/rastreadores/busca/tipo', [RastreadorController::class, 'busca_tipo']);
    Route::get('/rastreadores/busca/modelo', [RastreadorController::class, 'busca_modelo']);

    Route::get('/operadoras', [OperadoraController::class, 'index'])->name('operadoras');
    Route::get('/operadoras/adicionar', [OperadoraController::class, 'adicionar'])->name('operadoras.add');
    Route::get('/operadoras/editar/{id}', [OperadoraController::class, 'editar'])->name('operadoras.editar');
    Route::get('/operadoras/excluir/{id}', [OperadoraController::class, 'excluir'])->name('operadoras.excluir');
    Route::post('/operadoras/insert', [OperadoraController::class, 'insert'])->name('operadoras.insert');
    Route::post('/operadoras/update', [OperadoraController::class, 'update'])->name('operadoras.update');
    Route::post('/operadoras/delete', [OperadoraController::class, 'delete'])->name('operadoras.delete');

    Route::get('/modelos_rastreadores', [ModeloRastreadorController::class,'index'])->name('modelos_rastreadores');
    Route::get('/modelos_rastreadores/adicionar', [ModeloRastreadorController::class,'adicionar'])->name('modelos_rastreadores.add');
    Route::get('/modelos_rastreadores/editar/{id}', [ModeloRastreadorController::class,'editar'])->name('modelos_rastreadores.editar');
    Route::get('/modelos_rastreadores/excluir/{id}', [ModeloRastreadorController::class,'excluir'])->name('modelos_rastreadores.excluir');
    Route::post('/modelos_rastreadores/insert', [ModeloRastreadorController::class,'insert'])->name('modelos_rastreadores.insert');
    Route::post('/modelos_rastreadores/update', [ModeloRastreadorController::class,'update'])->name('modelos_rastreadores.update');
    Route::post('/modelos_rastreadores/delete', [ModeloRastreadorController::class,'delete'])->name('modelos_rastreadores.delete');

    Route::get('/tipos_rastreadores', [TipoRastreadorController::class,'index'])->name('tipos_rastreadores');
    Route::get('/tipos_rastreadores/adicionar', [TipoRastreadorController::class,'adicionar'])->name('tipos_rastreadores.add');
    Route::get('/tipos_rastreadores/editar/{id}', [TipoRastreadorController::class,'editar'])->name('tipos_rastreadores.editar');
    Route::get('/tipos_rastreadores/excluir/{id}', [TipoRastreadorController::class,'excluir'])->name('tipos_rastreadores.excluir');
    Route::post('/tipos_rastreadores/insert', [TipoRastreadorController::class,'insert'])->name('tipos_rastreadores.insert');
    Route::post('/tipos_rastreadores/update', [TipoRastreadorController::class,'update'])->name('tipos_rastreadores.update');
    Route::post('/tipos_rastreadores/delete', [TipoRastreadorController::class,'delete'])->name('tipos_rastreadores.delete');

    Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas');
    Route::get('/entradas/adicionar', [EntradaController::class, 'adicionar'])->name('entradas.add');
    Route::get('/entradas/editar/{id}', [EntradaController::class, 'editar'])->name('entradas.editar');
    Route::get('/entradas/excluir/{id}', [EntradaController::class, 'excluir'])->name('entradas.excluir');
    Route::get('/entradas/visualizar/{id}', [EntradaController::class, 'visualizar'])->name('entradas.view');
    Route::post('/entradas/insert', [EntradaController::class, 'insert'])->name('entradas.insert');
    Route::post('/entradas/update', [EntradaController::class, 'update'])->name('entradas.update');
    Route::post('/entradas/delete', [EntradaController::class, 'delete'])->name('entradas.delete');
    Route::get('/entradas/delete_prod', [EntradaController::class, 'delete_prod']);

    Route::get('/oficina/simcards', [OficinaController::class, 'simcards'])->name('oficina.simcards');
    Route::get('/oficina/simcards/desbloquear/{id}', [OficinaController::class, 'simcards_desbloquear'])->name('oficina.simcards.desbloquear');
    Route::get('/oficina/simcards/baixar/{id}', [OficinaController::class, 'simcards_baixar'])->name('oficina.simcards.baixar');
    Route::post('/oficina/simcards/desbloquear/set', [OficinaController::class, 'simcards_desbloquear_set'])->name('oficina.simcards.desbloquear.set');
    Route::post('/oficina/simcards/baixar/set', [OficinaController::class, 'simcards_baixar_set'])->name('oficina.simcards.baixar.set');

    Route::get('/oficina/rastreadores', [OficinaController::class, 'rastreadores'])->name('oficina.rastreadores');
    Route::get('/oficina/rastreadores/configurar/{id}', [OficinaController::class, 'rastreadores_configurar'])->name('oficina.rastreadores.configurar');
    Route::get('/oficina/rastreadores/habilitar/{id}', [OficinaController::class, 'rastreadores_habilitar'])->name('oficina.rastreadores.habilitar');
    Route::get('/oficina/rastreadores/desabilitar/{id}', [OficinaController::class, 'rastreadores_desabilitar'])->name('oficina.rastreadores.desabilitar');
    Route::get('/oficina/rastreadores/estoque/{id}', [OficinaController::class, 'rastreadores_estoque'])->name('oficina.rastreadores.estoque');
    Route::get('/oficina/rastreadores/baixar/{id}', [OficinaController::class, 'rastreadores_baixar'])->name('oficina.rastreadores.baixar');
    Route::post('/oficina/rastreadores/configurar/set', [OficinaController::class, 'rastreadores_configurar_set'])->name('oficina.rastreadores.configurar.set');
    Route::post('/oficina/rastreadores/habilitar/set', [OficinaController::class, 'rastreadores_habilitar_set'])->name('oficina.rastreadores.habilitar.set');
    Route::post('/oficina/rastreadores/desabilitar/set', [OficinaController::class, 'rastreadores_desabilitar_set'])->name('oficina.rastreadores.desabilitar.set');
    Route::post('/oficina/rastreadores/estoque/set', [OficinaController::class, 'rastreadores_estoque_set'])->name('oficina.rastreadores.estoque.set');
    Route::post('/oficina/rastreadores/baixar/set', [OficinaController::class, 'rastreadores_baixar_set'])->name('oficina.rastreadores.baixar.set');

    Route::get('/oficina/instalacoes', [OficinaController::class, 'instalacoes'])->name('oficina.instalacoes');
    Route::get('/oficina/instalacoes/add', [OficinaController::class, 'instalacoes_adicionar'])->name('oficina.instalacoes.add');
    Route::post('/oficina/instalacoes/insert', [OficinaController::class, 'instalacoes_insert'])->name('oficina.instalacoes.insert');
    Route::get('/oficina/instalacoes/visualizar/{id}', [OficinaController::class, 'instalacoes_visualizar'])->name('oficina.instalacoes.visualizar');
    Route::get('/oficina/instalacoes/desinstalar/{id}', [OficinaController::class, 'instalacoes_desinstalar'])->name('oficina.instalacoes.desinstalar');
    Route::post('/oficina/instalacoes/desinstalar/set', [OficinaController::class, 'instalacoes_desinstalar_set'])->name('oficina.instalacoes.desinstalar.set');

    Route::get('/baixas', [BaixaController::class, 'index'])->name('baixas');
    Route::get('/baixas/adicionar', [BaixaController::class, 'adicionar'])->name('baixas.add');
    Route::get('/baixas/editar/{id}', [BaixaController::class, 'editar'])->name('baixas.editar');
    Route::get('/baixas/excluir/{id}', [BaixaController::class, 'excluir'])->name('baixas.excluir');
    Route::get('/baixas/visualizar/{id}', [BaixaController::class, 'visualizar'])->name('baixas.view');
    Route::post('/baixas/insert', [BaixaController::class, 'insert'])->name('baixas.insert');
    Route::post('/baixas/update', [BaixaController::class, 'update'])->name('baixas.update');
    Route::post('/baixas/delete', [BaixaController::class, 'delete'])->name('baixas.delete');
    Route::get('/baixas/delete_prod', [BaixaController::class, 'delete_prod']);

    Route::get('/transferencias_estoque', [TransferenciaEstoqueController::class, 'index'])->name('transferencias');
    Route::get('/transferencias_estoque/adicionar', [TransferenciaEstoqueController::class, 'adicionar'])->name('transferencias.add');
    Route::post('/transferencias_estoque/insert', [TransferenciaEstoqueController::class, 'insert'])->name('transferencias.insert');
    Route::get('/transferencias_estoque/excluir/{id}', [TransferenciaEstoqueController::class, 'excluir'])->name('transferencias.excluir');
    Route::post('/transferencias_estoque/delete', [TransferenciaEstoqueController::class, 'delete'])->name('transferencias.delete');

    Route::get('/movimentacoes/ferramentas', [MovimentacaoController::class, 'ferramentas'])->name('movimentacoes.ferramentas');
    Route::post('/movimentacoes/ferramentas/pesquisa', [MovimentacaoController::class, 'ferramentas_gerar'])->name('movimentacoes.ferramentas.pesquisa');
    Route::get('/movimentacoes/simcards', [MovimentacaoController::class, 'simcards'])->name('movimentacoes.simcards');
    Route::post('/movimentacoes/simcards/pesquisa', [MovimentacaoController::class, 'simcards_gerar'])->name('movimentacoes.simcards.pesquisa');
    Route::get('/movimentacoes/rastreadores', [MovimentacaoController::class, 'rastreadores'])->name('movimentacoes.rastreadores');
    Route::post('/movimentacoes/rastreadores/pesquisa', [MovimentacaoController::class, 'rastreadores_gerar'])->name('movimentacoes.rastreadores.pesquisa');

    Route::get('/relatorios/estoques', [RelatoriosController::class, 'estoques'])->name('relatorios.estoques');
    Route::post('/relatorios/estoques/gerar', [RelatoriosController::class, 'estoques_gerar'])->name('relatorios.estoques.gerar');
    Route::get('/relatorios/produtos', [RelatoriosController::class, 'produtos'])->name('relatorios.produtos');
    Route::post('/relatorios/produtos/gerar', [RelatoriosController::class, 'produtos_gerar'])->name('relatorios.produtos.gerar');
    Route::get('/relatorios/clientes', [RelatoriosController::class, 'clientes'])->name('relatorios.clientes');
    Route::post('/relatorios/clientes/gerar', [RelatoriosController::class, 'clientes_gerar'])->name('relatorios.clientes.gerar');
    Route::get('/relatorios/veiculos', [RelatoriosController::class, 'veiculos'])->name('relatorios.veiculos');
    Route::post('/relatorios/veiculos/gerar', [RelatoriosController::class, 'veiculos_gerar'])->name('relatorios.veiculos.gerar');
    Route::get('/relatorios/simcards', [RelatoriosController::class, 'simcards'])->name('relatorios.simcards');
    Route::post('/relatorios/simcards/gerar', [RelatoriosController::class, 'simcards_gerar'])->name('relatorios.simcards.gerar');
    Route::get('/relatorios/rastreadores', [RelatoriosController::class, 'rastreadores'])->name('relatorios.rastreadores');
    Route::post('/relatorios/rastreadores/gerar', [RelatoriosController::class, 'rastreadores_gerar'])->name('relatorios.rastreadores.gerar');
    Route::get('/relatorios/entradas', [RelatoriosController::class, 'entradas'])->name('relatorios.entradas');
    Route::post('/relatorios/entradas/gerar', [RelatoriosController::class, 'entradas_gerar'])->name('relatorios.entradas.gerar');
    Route::get('/relatorios/baixas', [RelatoriosController::class, 'baixas'])->name('relatorios.baixas');
    Route::post('/relatorios/baixas/gerar', [RelatoriosController::class, 'baixas_gerar'])->name('relatorios.baixas.gerar');
    Route::get('/relatorios/transferencias', [RelatoriosController::class, 'transferencias'])->name('relatorios.transferencias');
    Route::post('/relatorios/transferencias/gerar', [RelatoriosController::class, 'transferencias_gerar'])->name('relatorios.transferencias.gerar');
    Route::get('/relatorios/instalacoes', [RelatoriosController::class, 'instalacoes'])->name('relatorios.instalacoes');
    Route::post('/relatorios/instalacoes/gerar', [RelatoriosController::class, 'instalacoes_gerar'])->name('relatorios.instalacoes.gerar');


    Route::post('/export/imprimir', [ExportController::class, 'imprimir'])->name('export.imprimir');

});
