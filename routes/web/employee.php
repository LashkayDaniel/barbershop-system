<?php

use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\OrderController;
use App\Http\Controllers\WorktimeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:employee', 'verified'])
    ->namespace('App\Http\Controllers\Employee')
    ->controller(DashboardController::class)
    ->prefix('e')
    ->name('employee.')
    ->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
