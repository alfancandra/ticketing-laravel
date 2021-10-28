<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::group(['middleware' => ["UserAdmin"], 'as' => 'adm.'], function() {
    // Admin Dashboard
    Route::get('/admin',[DashboardController::class,'index'])->name('dashboardadmin');
});
