<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
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

Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    
    Route::get('admin/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('admin/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('admin/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('admin/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('admin/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

require __DIR__.'/auth.php';
