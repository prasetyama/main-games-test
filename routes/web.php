<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/create', [App\Http\Controllers\MenuController::class, 'create'])->name('menu.create');
Route::post('/menu/create', [App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
Route::delete('/menu/{id}', [App\Http\Controllers\MenuController::class, 'delete'])->name('menu.delete');
Route::get('/{menu}/edit', [App\Http\Controllers\MenuController::class, 'edit'])->name('menu.edit');
Route::patch('/{menu}/update', [App\Http\Controllers\MenuController::class, 'update'])->name('menu.update');

Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
Route::post('/cart', [App\Http\Controllers\OrderController::class, 'cart'])->name('order.cart');

Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('report.index');

Route::get('/dice', [App\Http\Controllers\DiceController::class, 'index'])->name('dice.index');
