<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ApplyController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');
Route::get('/dashboard', function () {
    return view('dashboard'); // file resources/views/dashboard.blade.php
})->name('views.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::post('/jobs/{job}/upload-cv', [JobController::class, 'uploadCv'])->name('jobs.uploadCv');
    Route::get('/cv', [CvController::class, 'index'])->name('cv.index');
    Route::get('/cv/{id}', [CvController::class, 'show'])->name('cv.show');
    Route::post('/cv', [CvController::class, 'store'])->name('cv.store');
    Route::get('/apply', [ApplyController::class, 'index'])->name('apply.index');
});

require __DIR__.'/auth.php';



Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs/store-job', [JobController::class, 'storeJob'])->name('jobs.storeJob');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store'); // upload CV
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');


// Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
//     Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');
//     Route::get('jobs/create', [JobController::class, 'create'])->name('admin.jobs.create');
//     Route::post('jobs', [JobController::class, 'store'])->name('admin.jobs.store');
//     Route::get('jobs/{job}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');
//     Route::put('jobs/{job}', [JobController::class, 'update'])->name('admin.jobs.update');
//     Route::delete('jobs/{job}', [JobController::class, 'destroy'])->name('admin.jobs.destroy');
// });
