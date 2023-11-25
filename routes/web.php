<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', [GuestController::class, 'welcome'])
        ->middleware('guest')->name('welcome');
    Route::get('/pre-cadastrar', [GuestController::class, 'pre_cadastrar'])
        ->middleware('guest')->name('pre-cadastrar');
    Route::post('/pre-cadastrar', [GuestController::class, 'valida_cadastrar'])
        ->middleware('guest')->name('valida-cadastrar');
    Route::get('/falar-administrador', [GuestController::class, 'falar_administrador'])
        ->middleware('guest')->name('falar-administrador');
    Route::post('/falar-administrador', [GuestController::class, 'email_administrador'])
        ->middleware('guest')->name('falar-administrador');
    Route::get('/mensagem-enviada', [GuestController::class, 'mensagem_enviada'])
        ->middleware('guest')->name('mensagem-enviada');
    Route::get('/cadastro-realizado', [GuestController::class, 'cadastro_realizado'])
        ->middleware('guest')->name('cadastro-realizado');

});

//recuperação de senha
Route::post('/esqueci-senha', [GuestController::class, 'esqueci_senha'])
    ->middleware('guest')->name('esqueci-senha');

Route::get('/esqueci-senha', [GuestController::class, 'solicitar_senha'])
    ->middleware('guest')->name('solicitar-senha');

Route::get('/password-reset/{token}/{email?}', [GuestController::class, 'password_reset'])
    ->middleware('guest')->name('password.reset');

Route::post('/senha-recuperada', [GuestController::class, 'save_reseted_password'])
    ->middleware('guest')->name('senha-recuperada');

//Fallback
Route::fallback(function () {
    return view('front.welcome');
});


