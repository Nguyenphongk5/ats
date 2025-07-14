<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\JobStatisticController;


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

Route::get('/jobs/{job}/apply', [CvController::class, 'applyForm'])->name('jobs.apply');

Route::post('/jobs/{job}/apply', [CvController::class, 'submitApplication'])->name('jobs.apply');
// web.php
Route::get('/cv/{id}/view', [CvController::class, 'view'])->name('cv.view');
Route::post('/cv/{id}/note', [CvController::class, 'saveNote'])->name('cv.saveNote');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/pool', [\App\Http\Controllers\PoolController::class, 'index']);

use App\Http\Controllers\PoolController;

// Route::get('/pool/cxo/{id}', [PoolController::class, 'showCxo'])->name('pool.cxo.show');


Route::get('/pool/function', [PoolController::class, 'functionList'])->name('pool.function');
// routes/web.php
Route::post('/cvs/{cv}/qualify', [CvController::class, 'qualify'])->name('cvs.qualify');
Route::post('/cv/{cv}/qualify', [CVController::class, 'qualify'])->name('cv.qualify');

Route::post('/cvs/{cv}/interview1', [JobController::class, 'markInterview1'])->name('cvs.interview1');

Route::post('/cv/{cv}/interview1', [JobController::class, 'markInterview1'])->name('cv.interview1');
Route::post('/cv/{cv}/interview2', [JobController::class, 'markInterview2'])->name('cv.interview2');
Route::post('/cv/{cv}/offer', [JobController::class, 'markOffer'])->name('cv.offer');
Route::post('/cv/{cv}/hand', [JobController::class, 'markHand'])->name('cv.hand');

Route::post('/cv/{cv}/update-apply', [CvController::class, 'updateApply'])->name('cv.updateApply');
Route::post('/cv/{cv}/interview1', [CvController::class, 'markInterview1'])->name('cv.interview1');
Route::post('/cv/{cv}/interview2', [CvController::class, 'markInterview2'])->name('cv.interview2');
Route::post('/cv/{cv}/offer', [CvController::class, 'markOffer'])->name('cv.offer');
Route::post('/cv/{cv}/hand', [CvController::class, 'markHand'])->name('cv.hand');


Route::get('/cvs/job/{job}', [CVController::class, 'indexByJob'])->name('cv.index.job');



use App\Http\Controllers\CandidateController;

Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
Route::get('/candidates/print', [CandidateController::class, 'exportPdf'])->name('candidates.pdf');
// Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
// routes/web.php

// Route::get('/jobs/{id}', [JobController::class, 'detail'])->name('jobs.detail');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
Route::get('/pool/cxo/{cxo}', [PoolController::class, 'showCxo'])->name('pool.show');



Route::prefix('pool')->group(function () {
    Route::get('/', [PoolController::class, 'index'])->name('pool.index');

    Route::get('/create', [PoolController::class, 'createCxo'])->name('pool.create');
    Route::post('/store', [PoolController::class, 'storeCxo'])->name('pool.store');
    Route::get('/{id}', [PoolController::class, 'showCxo'])->name('pool.show');

    Route::get('/function', [PoolController::class, 'functionList'])->name('pool.function');
});
//     Route::prefix('pool/function')->name('pool.function.')->group(function () {
//     Route::get('/', [FunctionController::class, 'index'])->name('index');
//     Route::get('/create', [FunctionController::class, 'create'])->name('create');
//     Route::post('/store', [FunctionController::class, 'store'])->name('store');
//     Route::get('/{id}', [FunctionController::class, 'show'])->name('show');
// });

    Route::prefix('function')->group(function () {
        Route::get('/create', [FunctionController::class, 'create'])->name('pool.function.create');
        Route::post('/', [FunctionController::class, 'store'])->name('pool.function.store');
        Route::get('/{id}', [FunctionController::class, 'show'])->name('pool.function.show');

    });
Route::get('/pool/function/{id}', [FunctionController::class, 'show'])->name('pool.function.show');



Route::get('/statistics', [JobStatisticController::class, 'index'])->name('jobs.statistics');
Route::post('/jobs/{job}/apply', [CvController::class, 'submitApplication'])->name('jobs.submitApplication');

// Pool
Route::get('/pool', [PoolController::class, 'index'])->name('pool.index');
Route::get('/pool/create', [PoolController::class, 'createCxo'])->name('pool.create');
Route::post('/pool/store', [PoolController::class, 'storeCxo'])->name('pool.store');
Route::get('/pool/{id}', [PoolController::class, 'showCxo'])->name('pool.show');

// Apply for pool
Route::get('/pool/{cxoId}/apply', [PoolController::class, 'applyForPool'])->name('pool.apply');
Route::post('/pool/{cxoId}/submit', [PoolController::class, 'submitForPool'])->name('pool.submit');

// ✅ Danh sách CV của Pool
Route::get('/pool/{cxoId}/cvs', [PoolController::class, 'listPoolCvs'])->name('pool.cvs');
Route::get('/funnel', [DashboardController::class, 'funnel'])->name('funnel');
// routes/web.php
Route::get('/dashboard/funnel-data', [DashboardController::class, 'getFunnelData'])->name('dashboard.funnel-data');
Route::get('/dashboard/funnel-data', [DashboardController::class, 'funnel'])->name('dashboard.funnel');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/funnel', [DashboardController::class, 'funnel'])->name('dashboard.funnel');

Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');


Route::prefix('pool')->group(function () {
    Route::get('/', [PoolController::class, 'index'])->name('pool.index');


    // CV theo Function
    Route::get('/function/{id}/apply', [PoolController::class, 'applyForFunction'])->name('pool.function.apply');
    Route::post('/function/{id}/submit', [PoolController::class, 'submitForFunction'])->name('pool.function.submit');

});
Route::get('/pool/function/create', [PoolController::class, 'createFunction'])->name('pool.function.create');
Route::get('/pool/function/create', [PoolController::class, 'createFunction'])->name('pool.function_create');
Route::post('/pool/function/store', [PoolController::class, 'storeFunction'])->name('pool.function_store');
Route::get('/pool/function/{functionId}/apply', [PoolController::class, 'applyForFunction'])->name('pool.function.apply');
Route::get('/pool/function/{functionId}/cvs', [PoolController::class, 'listFunctionCvs'])->name('pool.function.cvs');
Route::get('/pool/{cxo}/cvs', [CvController::class, 'listPoolCvs'])->name('pool.cxo.cvs');
