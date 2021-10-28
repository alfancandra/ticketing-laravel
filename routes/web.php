<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Ticket\TicketController;

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

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('loginuser',[LoginController::class,'login'])->name('loginuser');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => ["UserLogin"], 'as' => 'usr.'], function() {
    // Admin Dashboard
    Route::get('/ticket',[TicketController::class,'index'])->name('ticket');
    Route::get('/ticket/all',[TicketController::class,'allticket'])->name('allticket');
    Route::get('/ticket/add',[TicketController::class,'add'])->name('addticket');
    Route::post('ticket/store',[TicketController::class,'store'])->name('storeticket');
    Route::get('/ticket/show/{id}',[TicketController::class,'show'])->name('showticket');
    Route::get('/ticket/nonaktif',[TicketController::class,'nonaktif'])->name('ticketnonaktif');
});

