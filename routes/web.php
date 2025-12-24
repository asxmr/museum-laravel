<?php

use Illuminate\Support\Facades\Route;

//Publieke controllers

//Admin controllers
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PhotoCategoryController as AdminPhotoCategoryController;
use App\Http\Controllers\Admin\PhotoController as AdminPhotoController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

//Models
use App\Models\User;
use App\Models\Photo;
use App\Models\PhotoPhotoCategory;
use App\Models\News;

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
                'photosCount' => \App\Models\Photo::count(),
                'newsCount'  => \App\Models\News::count(),
            ]);
        })->name('dashboard');

        //Userbeheer
        Route::resource('users', AdminUserController::class)->except(['show']);

        // Fotocategorieën beheer
        Route::resource('photo-categories', AdminPhotoCategoryController::class)->except('show');
        
        // Foto's beheer
        Route::resource('photos', AdminPhotoController::class)->except('show');

        //Nieuwsbeheer
        Route::resource('news', AdminNewsController::class);
    });

require __DIR__.'/auth.php';
