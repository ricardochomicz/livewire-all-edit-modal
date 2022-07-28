<?php

use App\Http\Livewire\CategoryController;
use App\Http\Livewire\ProductController;
use App\Http\Livewire\ProductCreate;
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

// Route::get('/products', function () {
//     return view('layouts.app');
// })->name('products');

Route::get('products', [ProductController::class, 'create'])->name('products');
Route::get('categories', [CategoryController::class, 'create'])->name('categories');
//Route::get('product/new', [ProductController::class, 'create'])->name('product-new');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
