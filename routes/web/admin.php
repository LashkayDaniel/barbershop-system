<?php

use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\PageDataController;
use App\Http\Controllers\Admin\ServiceController;
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
        Route::patch('/landing', 'update')->name('update');
        Route::post('/upload-image', 'uploadImage')->name('imageUpload');
        Route::delete('/delete-image', 'deleteImage')->name('imageDelete');
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

Route::middleware(['auth', 'role:admin'])
    ->namespace('App\Http\Controllers\Admin')
    ->controller(DiscountController::class)
    ->name('discount.')
    ->group(function () {
        Route::get('/discounts', 'index')->name('index');
        Route::post('/discounts', 'store')->name('store');
        Route::delete('/discounts/{discount}', 'destroy')->name('delete');
    });

Route::middleware(['auth', 'role:admin'])
    ->namespace('App\Http\Controllers\Admin')
    ->controller(BillingController::class)
    ->name('billing.')
    ->group(function () {
        Route::get('/billing', 'index')->name('index');
    });
