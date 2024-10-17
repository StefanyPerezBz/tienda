<?php
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;
use Illuminate\Support\Facades\Route;

//Vendor Ruta
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

/** Vendor Perfil */
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update'); // vendor.profile.update
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password'); // vendor.profile.update.password

