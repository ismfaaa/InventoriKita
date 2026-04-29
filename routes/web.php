<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Admin
Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'admin'])->name('admin');

// Route Stakeholder
Route::get('/stakeholder', function () {
    return view('stakeholder.index');
})->middleware(['auth', 'stakeholder'])->name('stakeholder');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
