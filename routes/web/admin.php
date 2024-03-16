<?php

use App\Http\Controllers\Admin\DashboardController;
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
