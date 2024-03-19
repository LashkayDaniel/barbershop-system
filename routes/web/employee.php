<?php

use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:employee', 'verified'])
    ->namespace('App\Http\Controllers\Employee')
    ->controller(DashboardController::class)
    ->prefix('e')
    ->name('employee.')
    ->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

Route::middleware(['auth', 'role:employee'])
    ->controller(ServiceController::class)
    ->group(function () {
        Route::get('/services', 'index')->name('services.index');
        Route::post('/services', 'store')->name('services.store');
        Route::put('/services/{service}', 'update')->name('services.update');
        Route::delete('/services/{service}', 'destroy')->name('services.delete');
    });
