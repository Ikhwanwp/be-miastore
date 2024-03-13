<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Agar tidak bisa melakukan registrasi lagi
Auth::routes(['register' => false]);

Route::get('products/{id}/gallery', [ProductController::class, 'gallery'])->name('products.gallery');

Route::resource('products', ProductController::class);
Route::resource('product-galleries', ProductGalleryController::class);
Route::resource('transactions', TransactionController::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
