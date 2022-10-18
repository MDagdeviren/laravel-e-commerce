<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\SubCategoryController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    //Blade
    Route::get('/categorymanagement',[CategoryController::class,'index'])->name('category.index');
    Route::get('/productmanagement',[ProductController::class,'index'])->name('product.index');
    Route::get('/products',[ProductListController::class,'index'])->name('products.index');
    Route::get('/cart',[CartController::class,'index'])->name('cart.index');
    //Cart All Data
    Route::get('/carts/{id}',[CartController::class,'allData'])->name('cart.allData');

    //Category 
    Route::post('/category',[CategoryController::class,'store'])->name('category.store');
    Route::put('/category/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('/category/{id}',[CategoryController::class,'destroy'])->name('category.delete');
    
    //Sub Category
    Route::post('/subcategory',[SubCategoryController::class,'store'])->name('subcategory.store');
    Route::put('/subcategory/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');
    Route::delete('/subcategory/{id}',[SubCategoryController::class,'destroy'])->name('subcategory.delete');
    
    //Product
    Route::post('/product',[ProductController::class,'store'])->name('product.store');
    Route::put('/product/{id}',[ProductController::class,'update'])->name('product.update');
    Route::delete('/product/{id}',[ProductController::class,'destroy'])->name('product.destroy');
    
    



    //Api
    Route::get('/api/getsubcategories/{id}',[ProductController::class,'create'])->name('product.create');
    
    
   
    



});