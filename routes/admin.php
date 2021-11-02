<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::group(['middleware' => ["UserAdmin"], 'as' => 'adm.'], function() {
    // Admin Dashboard
    Route::get('/admin',[DashboardController::class,'index'])->name('dashboardadmin');
    Route::get('/users',[UserController::class,'index'])->name('datauser');
    Route::get('/user/add',[UserController::class,'add'])->name('adduser');
    Route::post('user/store',[UserController::class,'store'])->name('storeuser');
    Route::get('/user/role/{id}',[UserController::class,'changerole'])->name('changerole');

});
