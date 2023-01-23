<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\TipoController;
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

//Index
Route::get('/', [TicketsController::class,'index']);

//Dashboard e Relatorios WhatsApp
Route::get('/whatsapp',[TicketsController::class,'whatsapp'])->name('whatsapp');
Route::get('/relatorio/whatsapp/fila/{id}',[TicketsController::class,'relfilas'])->name('whatsapp.rel.filas');
Route::get('/relatorio/whatsapp/user/{id}',[TicketsController::class,'relUsers'])->name('whatsapp.rel.users');

//Dashboar e Relatorios E-Mail
Route::get('/email',[EmailController::class,'index'])->name('email');
Route::post('/email/adc/tipo',[TipoController::class,'store'])->name('email.adc.tipo');
Route::post('/email/adc/dados',[RegistroController::class,'store'])->name('email.adc.dado');
Route::get('/email/edit/tipo/{id}',[TipoController::class,'edit'])->name('email.edit.tipo');
Route::post('email/editar/tipo/{id}',[TipoController::class,'update'])->name('email.editar.tipo');
Route::post('/email/del/tipo/{id}',[TipoController::class,'delete'])->name('email.del.tipo');
