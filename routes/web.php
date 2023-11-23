<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/exchange', [App\Http\Controllers\ExchangeRate::class, 'exchange']);
Route::post('/queue/getTicket', [App\Http\Controllers\Queue::class, 'getTicket']);
Route::post('/queue/getTicketWithOutQueue', [App\Http\Controllers\TicketController::class, 'getTicket']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
Route::get('/update', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
Route::get('/check', [App\Http\Controllers\HomeController::class, 'check'])->name('check');


