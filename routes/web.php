<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CurrencyController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/category', CategoryController::class);
Route::get('/category/page/{page}', [CategoryController::class, 'index'])->name('categoryPage');
Route::resource('/currency', CurrencyController::class);
Route::get('/currency/page/{page}', [CurrencyController::class, 'index'])->name('currencyPage');