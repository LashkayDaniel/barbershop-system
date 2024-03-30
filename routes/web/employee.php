<?php

use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\WorktimeController;
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

Route::middleware(['auth', 'role:employee'])
    ->controller(PortfolioController::class)
    ->name('portfolio.')
    ->group(function () {
        Route::get('/portfolio', 'index')->name('index');
        Route::post('/portfolio', 'store')->name('create');
        Route::post('/portfolio/avatar', 'avatarUpload')->name('avatar');
        Route::delete('/portfolio/{portfolio}', 'destroy')->name('delete');
    });

Route::middleware(['auth', 'role:employee'])
    ->controller(WorktimeController::class)
    ->group(function () {
        Route::get('/worktime', 'index')->name('worktime.index');
    });

Route::middleware(['auth', 'role:employee'])
    ->controller(WorktimeController::class)
    ->group(function () {
        Route::get('/worktimes', 'index')->name('worktime.index');
        Route::post('/worktime/create', 'store')->name('worktime.create');
        Route::patch('/worktime/{worktime}', 'update')->name('worktime.update');
        Route::delete('/worktime/{worktime}', 'destroy')->name('worktime.delete');
    });
