<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\CripController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('layouts.home');
// });

Auth::routes();

route::middleware(['auth'])->group(function () {
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('/calculating', [CalculateController::class, 'index'])->name('calculate.index');
	Route::get('/calculating/{id}/edit', [CalculateController::class, 'edit'])->name('calculate.edit');
	Route::put('/calculating/{id}', [CalculateController::class, 'update'])->name('calculate.update');
	Route::get('/calculating/result', [CalculateController::class, 'proses'])->name('calculate.proses');	
});



Route::middleware(['auth', 'admin'])->group(function () {
	Route::resource('criteria', CriteriaController::class);
	Route::resource('alternative', AlternativeController::class);
	Route::resource('user', UserController::class);

	Route::get('/crips', [CripController::class, 'index'])->name('crips.index');
	Route::get('/crips/{id}', [CripController::class, 'create'])->name('crips.create');
	Route::post('/crips/{id}', [CripController::class, 'store'])->name('crips.store');
	Route::delete('/crips/{id}', [CripController::class, 'destroy'])->name('crips.destroy');
	Route::put('/crips/{id}', [CripController::class, 'update'])->name('crips.update');
	Route::get('/crips/{id}/edit', [CripController::class, 'edit'])->name('crips.edit');
});
