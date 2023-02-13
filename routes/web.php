<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\SkuController;
use App\Http\Controllers\PageController;
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
Route::resource('/property', PropertyController::class);
Route::get('/property/page/{page}', [PropertyController::class, 'index'])->name('propertyPage');
Route::resource('/option', OptionController::class);
Route::get('/option/page/{page}', [OptionController::class, 'index'])->name('optionPage');
Route::resource('/product', ProductController::class);
Route::get('/product/page/{page}', [ProductController::class, 'index'])->name('productPage');
Route::resource('/sku', SkuController::class);
Route::get('/sku/page/{page}', [SkuController::class, 'index'])->name('skuPage');

Route::get('/viewProducts', [PageController::class, 'viewProducts'])->name('viewProducts');