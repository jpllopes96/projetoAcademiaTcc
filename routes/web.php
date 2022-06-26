<?php

use App\Http\Controllers\AcademiaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EstatisticaController;
use App\Http\Controllers\ModificarDadosAcessoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TreinoController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {

    $users = User::permission('admin')->get();
    if($users->count() > 0){
        return redirect()->route('login');
    }
    return redirect()->route('register');
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Login Socialite 
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');

//academia
Route::resource('academia', AcademiaController::class);

//professores
Route::resource('professor', ProfessorController::class);

//alunos
Route::get('/alunos/pesquisar', [AlunoController::class, 'pesquisar'])->name('aluno.pesquisar');
Route::resource('aluno', AlunoController::class);

//treinos
Route::resource('treino', TreinoController::class);
Route::get('/treinos/create/aluno/{aluno}', [TreinoController::class, 'create'])->name('treino.create');
Route::post('/treinos/aluno/{aluno}', [TreinoController::class, 'store'])->name('treino.store');
Route::put('/treinos/update', [TreinoController::class, 'update'])->name('treino.update');

//estatistica
Route::get('/estatisticas/{academia}', [EstatisticaController::class, 'index'])->name('estatisticas');

//dados de acessos
Route::get('/modificar-dados-acesso/{id}', [ModificarDadosAcessoController::class, 'index'])->name('modificar-dados');
Route::put('/modificar-dados-acesso/{id}', [ModificarDadosAcessoController::class, 'update'])->name('modificar-dados');

//Exportar Excel
Route::get('alunos/exportar', [AcademiaController::class, 'exportar'])->name('alunos.exportar');

//Exportar PDF
Route::get('treinos/exportar', [TreinoController::class, 'exportar'])->name('treinos.exportar');

// Rota Erro
Route::fallback(function(){
    return redirect()->route('home')->with('msg_erro', 'Essa rota não existe');
});