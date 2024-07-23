<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
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

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.create');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.delete');

Route::get('/jobs/profile', [ProfileController::class, 'profile']);

Route::get('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');
Route::post('/jobs/store-application', [JobController::class, 'storeApplication'])->name('jobs.storeApplication');

require __DIR__.'/auth.php';
