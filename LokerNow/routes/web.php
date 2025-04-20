<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobTrackingController;
use Illuminate\Support\Facades\Route;
use App\Models\CompanyProfile;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $companyProfile = CompanyProfile::where('user_id', $user->id)->first();

    return view('dashboard', compact('companyProfile'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


use App\Http\Controllers\CompanyProfileController;

Route::middleware(['auth'])->group(function () {
   
    Route::get('/company-profile/{companyProfile}', [CompanyProfileController::class, 'show'])->name('company_profile.show');

    Route::get('/company-profile/{companyProfile}/edit', [CompanyProfileController::class, 'edit'])->name('company_profile.edit');
    Route::put('/company-profile/{companyProfile}', [CompanyProfileController::class, 'update'])->name('company_profile.update');
    Route::get('/company-profile/create', [CompanyProfileController::class, 'create'])->name('company_profile.create');
});


Route::middleware(['auth', 'verified', 'employer'])->group(function () {
    Route::resource('company-profiles', CompanyProfileController::class);
});



Route::middleware(['auth'])->group(function () {
    Route::get('/trackings', [JobTrackingController::class, 'index'])->name('tracking.index');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/trackings', [JobTrackingController::class, 'index'])->name('tracking.index');
});



require __DIR__.'/auth.php';
