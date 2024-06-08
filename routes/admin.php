<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();
Route::prefix('admin')->group(function () {
    Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'admin.lang']);
    Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('admin.root');
    Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('admin.updatePassword');
    Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
});
