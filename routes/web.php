<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ProntuarioController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [HomeController::class, 'index'])->name('home');

//AUTH
/**
 * @return Rotas_de_Login
 * */
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//UNIDADES
/**
 * @return Rotas_de_Unidade
 * */
Route::prefix('unidades')->group(function () {
    Route::get('/', [UnidadeController::class, 'index'])->name('unidades');
    Route::get('/detalhar-unidade/{id}', [UnidadeController::class, 'show'])->name('detalharUnidade');
    Route::get('/cadastrar-unidade', [UnidadeController::class, 'create'])->name('cadastrarUnidade');
    Route::post('/salvar-unidade', [UnidadeController::class, 'store'])->name('salvarUnidade');
    Route::get('/alterar-unidade/{id}', [UnidadeController::class, 'edit'])->name('alterarUnidade');
    Route::post('/salvar-alteracao-unidade', [UnidadeController::class, 'update'])->name('salvarAlteracaoUnidade');
    Route::get('/excluir-unidade/{id}', [UnidadeController::class, 'destroy'])->name('excluirUnidade');
    Route::get('/excluir-servico-unidade/{idServico}/{idUnidade}', [UnidadeController::class, 'destroyServicoUnidade'])->name('excluirServicoUnidade');
});

//MEDICOS
/**
 * @return Rotas_de_Medicos
 * */
Route::prefix('medicos')->group(function () {
    Route::get('/', [MedicoController::class, 'index'])->name('medicos');
    Route::get('/detalhar-medico/{id}', [MedicoController::class, 'show'])->name('detalharMedico');
    Route::get('/cadastrar-medico', [MedicoController::class, 'create'])->name('cadastrarMedico');
    Route::post('/salvar-medico', [MedicoController::class, 'store'])->name('salvarMedico');
    Route::post('/salvar-alteracao-medico', [MedicoController::class, 'update'])->name('salvarAlteracaoMedico');
    Route::get('/alterar-medico/{id}', [MedicoController::class, 'edit'])->name('alterarMedico');
    Route::post('/servicos-ajax', [MedicoController::class, 'servicosAjax'])->name('servicosAjax');
    Route::get('/excluir-medico/{id}', [MedicoController::class, 'destroy'])->name('excluirMedico');
});

//SERVIÇOS
/**
 * @return Rotas_de_Servicos
 * */
Route::prefix('servicos')->group(function () {
    Route::get('/', [ServicoController::class, 'index'])->name('servicos');
    Route::get('/detalhar-servico/{id}', [ServicoController::class, 'show'])->name('detalharServico');
    Route::get('/cadastrar-servico', [ServicoController::class, 'create'])->name('cadastrarServico');
    Route::get('/alterar-servico/{id}', [ServicoController::class, 'edit'])->name('alterarServico');
    Route::post('/salvar-alteracao-servico', [ServicoController::class, 'update'])->name('salvarAlteracaoServico');
    Route::post('/salvar-servico', [ServicoController::class, 'store'])->name('salvarServico');
});

//AGENDAMENTOS
/**
 * @return Rotas_de_Agendamentos
 * */
Route::prefix('agendamentos')->group(function () {
    Route::get('/atender-pendente/{id}', [AgendamentoController::class, 'edit'])->name('atenderPendente');
    Route::post('/salvar-atendimento', [AgendamentoController::class, 'update'])->name('salvarAtendimento');
    Route::get('/{situacao}', [AgendamentoController::class, 'index'])->name('agendamentos');
    Route::get('/{situacao}/{id}', [AgendamentoController::class, 'show'])->name('detalharAgendamento');
});

//PACIENTES
/**
 * @return Rotas_de_Pacientes
 * */
Route::prefix('pacientes')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('pacientes');
    Route::get('/detalhar-paciente/{id}', [UsuarioController::class, 'show'])->name('detalharPaciente');
});

//FUNCIONÁRIOS
/**
 * @return Rotas_de_Funcionarios
 * */
Route::prefix('funcionarios')->group(function () {
    Route::get('/', [FuncionarioController::class, 'index'])->name('funcionarios');
    Route::get('/detalhar-funcionario/{id}', [FuncionarioController::class, 'show'])->name('detalharFuncionario');
    Route::get('/cadastrar-funcionario', [FuncionarioController::class, 'create'])->name('cadastrarFuncionario');
    Route::post('/salvar-funcionario', [FuncionarioController::class, 'store'])->name('salvarFuncionario');
    Route::get('/alterar-funcionario/{id}', [FuncionarioController::class, 'edit'])->name('alterarFuncionario');
});

Route::get('/download/{id_user}/{nome_arquivo}/{token}', [ProntuarioController::class, 'baixarPDF']);
