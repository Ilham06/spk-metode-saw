<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CripController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('criteria', CriteriaController::class);
Route::resource('alternative', AlternativeController::class);
// Route::resource('crips', CripController::class);

Route::get('/crips', [CripController::class, 'index'])->name('crips.index');
Route::get('/crips/{id}', [CripController::class, 'create'])->name('crips.create');
Route::post('/crips/{id}', [CripController::class, 'store'])->name('crips.store');
Route::delete('/crips/{id}', [CripController::class, 'destroy'])->name('crips.destroy');
Route::put('/crips/{id}', [CripController::class, 'update'])->name('crips.update');
Route::get('/crips/{id}/edit', [CripController::class, 'edit'])->name('crips.edit');
