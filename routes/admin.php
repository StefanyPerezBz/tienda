<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;

// Admin 
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/** Profile Routes */
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

// Slider 
Route::resource('slider', SliderController::class);

//Category 
Route::resource('category', CategoryController::class)->parameters([
    'category' => 'slug',
]);

Route::resource('subcategory', SubCategoryController::class)->parameters([
    'subcategory' => 'slug',
]);

Route::resource('childcategory', ChildCategoryController::class)->parameters([
    'childcategory' => 'slug',
]);

Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');


// Marcas 
Route::resource('brand', BrandController::class)->parameters([
    'brand' => 'slug',
]);

// Vendor 
Route::resource('vendor-profile', AdminVendorProfileController::class);

//Product
 Route::resource('products', ProductController::class)->parameters([
     'product' => 'slug',
 ]);
