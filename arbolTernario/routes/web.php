<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
});

Route::group(['prefix' => 'Clients', 'controller' => \App\Http\Controllers\User\UserController::class], function(){
	Route::get('/', 'getDatatable');
});

Route::get('/Referred', [\App\Http\Controllers\Referred\ReferredController::class, 'index'])->name('referred');
Route::get('/Sponsor', [\App\Http\Controllers\Sponsors\SponsorController::class, 'index'])->name('sponsor');
Route::get('/Esquema', [\App\Http\Controllers\Esquema\EsquemaController::class, 'index'])->name('esquema');

