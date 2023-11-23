<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TesteController;

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

/*Route Group: GuestController*/
Route::middleware('web')->group(function () {
    Route::get('/', [GuestController::class, 'welcome'])->name('welcome');
    Route::get('/pre-cadastrar', [GuestController::class, 'pre_cadastrar'])->name('pre-cadastrar');
    Route::post('/pre-cadastrar', [GuestController::class, 'valida_cadastrar'])->name('valida-cadastrar');
    Route::get('/falar-administrador', [GuestController::class, 'falar_administrador'])->name('falar-administrador');
    Route::post('/falar-administrador', [GuestController::class, 'email_administrador'])->name('falar-administrador');
    Route::get('/mensagem-enviada', [GuestController::class, 'mensagem_enviada'])->name('mensagem-enviada');
    Route::get('/cadastro-realizado', [GuestController::class, 'cadastro_realizado'])->name('cadastro-realizado');

});
