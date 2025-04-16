<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailSaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DetailSaleController::class, 'index'])->name('dashboard');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/create/post', [ProductController::class, 'store'])->name('product.store.post');
Route::get('/product/update/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/update/post/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');


Route::get('/user', [UserController::class, 'index'])->name('user.list');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/create/post', [UserController::class, 'store'])->name('user.post');