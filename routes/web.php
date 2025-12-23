<?php

use Illuminate\Support\Facades\Route;

//Publieke controllers

//Admin controllers
use App\Http\Controllers\Admin\UserController as AdminUserController;

//Models
use App\Models\User;

//Publieke routes

// Homepagina 
Route::get('/', function () {
    return view('home');
})->name('home');

// User dashboard (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Admin routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        
        // Admin dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'usersCount' => \App\Models\User::count(),
            ]);
        })->name('dashboard');

        //Userbeheer
        Route::resource('users', AdminUserController::class)->except(['show']);
    });

require __DIR__.'/auth.php';
