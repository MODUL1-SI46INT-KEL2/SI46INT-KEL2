<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobTrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\CompanyProfileController;

Route::middleware(['auth', 'role:employer'])->group(function () {
    // Route to edit company profile
    Route::get('/company-profile', [CompanyProfileController::class, 'edit'])->name('company-profiles.edit');

    // Route to update company profile
    Route::put('/company-profile', [CompanyProfileController::class, 'update'])->name('company-profiles.update');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/trackings', [JobTrackingController::class, 'index'])->name('tracking.index');
});



require __DIR__.'/auth.php';
