<?php

use App\Http\Controllers\ProfileController;
use App\Models\PageData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', function () {
    $pageData = PageData::query()->first();
    $services = DB::table('service_user as su')
        ->join('services as s', 's.id', '=', 'su.service_id')
        ->select(
            's.name',
            's.description',
            DB::raw('ROUND(AVG(su.duration)) as avg_duration'),
            DB::raw('MIN(su.price) as min_price')
        )
        ->where('s.is_available', true)
        ->groupBy('su.service_id')
        ->get();

    return Inertia::render('Home', [
        'pageData' => $pageData,
        'services' => $services,
    ]);
});

Route::get('/test', function () {
    echo Hash::make('123123123');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/web/admin.php';
require __DIR__ . '/web/employee.php';
require __DIR__ . '/auth.php';
