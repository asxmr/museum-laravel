<?php

use Illuminate\Support\Facades\Route;

//Publieke controllers
use App\Http\Controllers\PhotoController;

//Admin controllers
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PhotoCategoryController as AdminPhotoCategoryController;
use App\Http\Controllers\Admin\PhotoController as AdminPhotoController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FaqCategoryController as AdminFaqCategoryController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;

//Models
use App\Models\User;
use App\Models\Photo;
use App\Models\PhotoPhotoCategory;
use App\Models\News;
use App\Models\FaqCategory;
use App\Models\Faq;
//Publieke routes

// Homepagina 
Route::get('/', function () {
        $carouselPhotos = Photo::latest()->take(5)->get();

    return view('home', compact('carouselPhotos'));
})->name('home');

// User dashboard (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Publieke fotogalerij
Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');

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

        // FAQ-categorieën beheer
        Route::resource('faq-categories', AdminFaqCategoryController::class)->except('show');

        // FAQ-vragen beheer
        Route::resource('faqs', AdminFaqController::class)->except('show');        
    });

require __DIR__.'/auth.php';
