<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function () {
   return view('about');
})->middleware(['auth', 'verified'])->name('about');

Route::get('hello', function () {
    return 'Halo, ini halaman percobaan route';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('jobs', [JobController::class, 'index'])->middleware(['auth', 'verified'])->name('jobs.index');

// Route untuk user melamar
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
    ->name('apply.store')
    ->middleware('auth');

// Route untuk admin melihat pelamar berdasarkan lowongan
Route::get('/jobs/{job}/applicants', [ApplicationController::class, 'index'])
    ->name('job.applicants')
    ->middleware('isAdmin');

// Perbaiki Route resource 'jobs' yang sudah ada sebelumnya:
// Admin: akses penuh kecuali index dan show (bisa create/edit/delete)
Route::resource('jobs', JobController::class)
    ->middleware(['auth', 'isAdmin'])
    ->except(['index', 'show']);

// User biasa: hanya bisa index dan show
Route::resource('jobs', JobController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

// Admin can manage applications (create, edit, update, delete but not index/show which are different)
Route::resource('applications', ApplicationController::class)
    ->middleware(['auth', 'isAdmin'])
    ->except(['index', 'show']);

// Only admin can view all applications
Route::get('/applications', [ApplicationController::class, 'index'])
    ->middleware(['auth', 'isAdmin'])
    ->name('applications.index');
// Admin can view any application, regular users can view their own
Route::get('/applications/{application}', [ApplicationController::class, 'show'])
    ->middleware(['auth'])
    ->name('applications.show');

// Route untuk export aplikasi
Route::get('/applications/export', [ApplicationController::class, 'export'])
     ->name('applications.export')
     ->middleware('isAdmin');

// Route untuk import lowongan
Route::post('/jobs/import', [JobController::class, 'import'])
     ->name('jobs.import')
     ->middleware('isAdmin');

Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    
    Route::get('admin/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('admin/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('admin/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('admin/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('admin/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

require __DIR__.'/auth.php';
