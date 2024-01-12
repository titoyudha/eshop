<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;

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

    //With Auth
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'role:user'])->name('dashboard');
    //With Auth
// Route::middleware(['auth', 'role:admin'])->group(function () {
//    Route::controller(DashboardController::class)->group(function(){
//         Route::get('/admin/dashboard', 'index');
//    });

// Without auth middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Without auth middleware and role middleware
Route::group(['prefix' => 'admin/dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
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

   Route::controller(OrderController::class)->group(function(){
        Route::get('admin/pending-order', 'index')->name('pendingorder');
   });

require __DIR__.'/auth.php';
