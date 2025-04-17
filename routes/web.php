<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailSaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;



Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'loginview'])->name('login');
    Route::post('/loginpost', [UserController::class, 'login'])->name('loginpost');
  
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DetailSaleController::class, 'index'])->name('dashboard');
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/sale', [SaleController::class, 'index'])->name('sale');
    Route::get('/downloadPDF/{id}', [DetailSaleController::class, 'downloadPDF'])->name('downloadPDF');
    Route::get('saleXLXS', [DetailSaleController::class, 'exportexcel'])->name('exportpenjualan');
    Route::get('product-export-xlxs', [ProductController::class, 'exportProduct'])->name('product.export');

});

        
Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::prefix('/product')->name('product.')->group(function () {
        Route::get('/product/create', [ProductController::class, 'create'])->name('create');
        Route::post('/product/create/post', [ProductController::class, 'store'])->name('store.post');
        Route::get('/product/update/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/product/update/post/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
        Route::put('/product/update/stock/{id}', [ProductController::class, 'updatestock'])->name('update.stock');
    });

    Route::prefix('/user')->name('user.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('list');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/create/post', [UserController::class, 'store'])->name('post');
        Route::get('/update/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/post/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/post/{id}', [UserController::class, 'destroy'])->name('delete');
        Route::get('-export-xlxs', [UserController::class, 'exportProduct'])->name('export');
    });

});

        
Route::middleware(['auth', 'is_employee'])->group(function () {

    Route::prefix('/sale')->name('sale.')->group(function () {
    
        Route::get('/sale/create', [SaleController::class, 'create'])->name('create');
        Route::post('/sale/create/post', [SaleController::class, 'store'])->name('store');
        Route::get('/sale/create/post', [SaleController::class, 'post'])->name('post');
        Route::post('/sale/view/sale', [SaleController::class, 'viewsale'])->name('view.member');
    });
    Route::get('/sale-view-member/{id}', [SaleController::class, 'createmember'])->name('viewmembersale');
    Route::get('/sale-print-show/{id}', [DetailSaleController::class, 'show'])->name('sales.print.show');





});

