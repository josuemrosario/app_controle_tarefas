<?php

use Illuminate\Support\Facades\Route;

//aula 215
use App\Mail\MensagemTesteMail;

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
    return view('welcome');
});


// aula 220 - parametro para verificar email
Auth::routes(['verify' => true]);


//aula 220 acrescentado middleware para impedir login enquanto email não estiver verificado

/* retirado na aula 228
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');
*/    

Route::resource('tarefa', 'App\Http\Controllers\TarefaController')
    ->middleware('verified');

//Aula 211
//Middleware auth poderia ter sido ativado neste ponto (está sendo ativado no construtor da classe TarefaController)
//Route::resource('tarefa', 'App\Http\Controllers\TarefaController')->Middleware('auth');

//aula 215
Route::get('/mensagem-teste',function(){
    return new MensagemTesteMail();
    //Mail::to('atendimento@teste.com.br')->send(new MensagemTesteMail());
    //return 'E-mail enviado com sucesso';
});