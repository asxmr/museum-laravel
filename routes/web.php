<?php

use Illuminate\Support\Facades\Route;

// Homepagina 
Route::get('/', function () {
    return view('home');
})->name('home');

// User dashboard (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

require __DIR__.'/auth.php';
