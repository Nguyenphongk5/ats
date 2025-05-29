<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ApplyController;


use Illuminate\Container\Attributes\Auth;

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact');
Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');
// Route::get('/dashboard', function () {
//     return view('dashboard'); // file resources/views/dashboard.blade.php
// })->name('views.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Job routes
    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'index'])->name('jobs.index');
        Route::post('/{job}/upload-cv', [JobController::class, 'uploadCv'])->name('jobs.uploadCv');
    });

    // CV routes
    Route::prefix('cv')->group(function () {
        Route::get('/', [CvController::class, 'index'])->name('cv.index');
        Route::get('/{id}', [CvController::class, 'show'])->name('cv.show');
        Route::post('/', [CvController::class, 'store'])->name('cv.store');
    });

    // Apply routes
    Route::prefix('apply')->group(function () {
        Route::get('/', [ApplyController::class, 'index'])->name('apply.index');
    });
});


require __DIR__ . '/auth.php';



Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs/store-job', [JobController::class, 'storeJob'])->name('jobs.storeJob');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store'); // upload CV
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/company/{company}', [JobController::class, 'jobsByCompany']);




// Route::get('/companies/{company}/jobs/closed', [JobController::class, 'showClosedJobs'])->name('jobs.closed');
Route::get('/companies/{company}/jobs/open', [JobController::class, 'showOpen'])->name('jobs.open');
Route::get('/companies/{company}/jobs/closed', [JobController::class, 'showClosed'])->name('jobs.closed');

Route::get('/jobs/{job}/apply', [CvController::class, 'apply'])->name('jobs.apply');

Route::get('/jobs/{job}/apply', [CvController::class, 'applyForm'])->name('jobs.applyForm');

Route::post('/jobs/{job}/apply', [CvController::class, 'submitApplication'])->name('jobs.apply');
Route::post('/jobs/{jobs}/apply', [CvController::class, 'submitApplication'])->name('jobs.submitApplication');
// web.php
Route::get('/cv/{id}/view', [CvController::class, 'view'])->name('cv.view');
Route::post('/cv/{id}/note', [CvController::class, 'saveNote'])->name('cv.saveNote');
Route::post('/cv/{id}/note', [CvController::class, 'saveNote'])->name('cv.saveNote');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/pool', [\App\Http\Controllers\PoolController::class, 'index']);

use App\Http\Controllers\PoolController;

Route::get('/pool/cxo/{id}', [PoolController::class, 'showCxo'])->name('pool.cxo.show');


Route::get('/pool/function', [PoolController::class, 'functionList'])->name('pool.function');
// routes/web.php
Route::post('/cvs/{cv}/qualify', [CvController::class, 'qualify'])->name('cvs.qualify');
Route::post('/cv/{cv}/qualify', [CVController::class, 'qualify'])->name('cv.qualify');

Route::post('/cvs/{cv}/interview1', [JobController::class, 'markInterview1'])->name('cvs.interview1');

Route::post('/cv/{cv}/interview1', [JobController::class, 'markInterview1'])->name('cv.interview1');
Route::post('/cv/{cv}/interview2', [JobController::class, 'markInterview2'])->name('cv.interview2');
Route::post('/cv/{cv}/offer', [JobController::class, 'markOffer'])->name('cv.offer');
Route::post('/cv/{cv}/hand', [JobController::class, 'markHand'])->name('cv.hand');

Route::post('/cv/{cv}/interview1', [CvController::class, 'markInterview1'])->name('cv.interview1');
Route::post('/cv/{cv}/interview2', [CvController::class, 'markInterview2'])->name('cv.interview2');
Route::post('/cv/{cv}/offer', [CvController::class, 'markOffer'])->name('cv.offer');
Route::post('/cv/{cv}/hand', [CvController::class, 'markHand'])->name('cv.hand');

Route::get('/cvs/job/{job}', [CVController::class, 'indexByJob'])->name('cv.index.job');



use App\Http\Controllers\CandidateController;

Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
Route::get('/candidates/print', [CandidateController::class, 'exportPdf'])->name('candidates.pdf');
