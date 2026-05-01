<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/request-driver', [\App\Http\Controllers\HomeController::class, 'store'])
    ->name('driver.request.store');


Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('drivers/request', [\App\Http\Controllers\DriverController::class, 'request'])
        ->name('driver.request.index')
        ->middleware(['auth', 'role:admin,manager']);

    Route::resource('brands', \App\Http\Controllers\BrandController::class);
    Route::resource('drivers', \App\Http\Controllers\DriverController::class);
    Route::resource('buses', \App\Http\Controllers\BusController::class);

    Route::post('/buses/{bus}/attach-driver', [\App\Http\Controllers\BusController::class, 'attachDriver'])
        ->name('buses.attachDriver');

    Route::delete('/buses/{bus}/detach-driver', [\App\Http\Controllers\BusController::class, 'detachDriver'])
        ->name('buses.detachDriver');

    Route::get('/drivers-olds', [\App\Http\Controllers\DriverController::class, 'olds'])
        ->name('drivers.olds');

    Route::middleware('can:admin')->group(function () {
        Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
        Route::post('/settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
    });

});

Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::get('drivers/request', [\App\Http\Controllers\DriverController::class, 'request'])
        ->name('driver.request.index')
        ->middleware(['auth', 'role:admin,manager']);
    Route::resource('drivers', \App\Http\Controllers\DriverController::class);
    Route::resource('buses', \App\Http\Controllers\BusController::class);
});

Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'profile'])
        ->name('profile');
});

require __DIR__.'/auth.php';
