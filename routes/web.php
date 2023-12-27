<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
   Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin/dashboard', 'index');
   });

   Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category', 'index')->name('allcategory');
        Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
   });

   Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/all-subcategory', 'index')->name('allsubcategory');
        Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
   });

   Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-products', 'index')->name('allproducts');
        Route::get('/admin/add-products', 'AddSubCategory')->name('addproducts');
   });

   Route::controller(CategoryController::class)->group(function(){
        Route::get('admin/pending-order', 'index')->name('pendingorder');
   });

});

require __DIR__.'/auth.php';
