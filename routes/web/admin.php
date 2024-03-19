<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\PageDataController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin', 'verified'])
    ->namespace('App\Http\Controllers\Admin')
    ->controller(DashboardController::class)
    ->prefix('a')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/dashboard/orders', 'getOrders')->name('dashboard.orders');
    });

Route::middleware(['auth', 'role:admin'])
    ->controller(PageDataController::class)
    ->name('landing.')
    ->group(function () {
        Route::get('/landing', 'index')->name('index');
    });

Route::middleware(['auth', 'role:admin'])
    ->namespace('App\Http\Controllers\Admin')
    ->prefix('a')
    ->controller(ServiceController::class)
    ->name('admin.')
    ->group(function () {
        Route::get('/services', 'index')->name('services.index');
        Route::post('/services', 'store')->name('services.store');
        Route::put('/services/{service}', 'update')->name('services.update');
        Route::patch('/services/{service}', 'changeAvailable')->name('services.changeAvailable');
        Route::delete('/services/{service}', 'destroy')->name('services.delete');
    });
