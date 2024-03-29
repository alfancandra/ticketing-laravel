<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlfanController;

Route::group(['middleware' => ["UserAdmin"], 'as' => 'adm.'], function() {
    // Admin Dashboard
    Route::get('/admin',[DashboardController::class,'index'])->name('dashboardadmin');
    Route::get('/users',[UserController::class,'index'])->name('datauser');
    Route::get('/user/add',[UserController::class,'add'])->name('adduser');
    Route::post('user/store',[UserController::class,'store'])->name('storeuser');
    Route::get('/user/role/{id}/{role}',[UserController::class,'changerole'])->name('changerole');
    Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('edituser');
    Route::post('user/edit',[UserController::class,'update'])->name('updateuser');

    // Alfan
    Route::get('/alfan',[AlfanController::class,'index'])->name('dataalfan');
    Route::get('/alfan/add',[AlfanController::class,'add'])->name('addalfan');
    Route::post('alfan/store',[AlfanController::class,'store'])->name('storealfan');
});
