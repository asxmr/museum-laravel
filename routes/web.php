<?php

use Illuminate\Support\Facades\Route;

//Publieke controllers
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoFavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhotoCommentController;
use App\Http\Controllers\NewsController;

//Admin controllers
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PhotoCategoryController as AdminPhotoCategoryController;
use App\Http\Controllers\Admin\PhotoController as AdminPhotoController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FaqCategoryController as AdminFaqCategoryController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\PhotoCommentController as AdminPhotoCommentController;

//Models
use App\Models\User;
use App\Models\Photo;
use App\Models\PhotoPhotoCategory;
use App\Models\News;
use App\Models\FaqCategory;
use App\Models\Faq;
use App\Models\FavoritePhoto;
use App\Models\PhotoComment;
//Publieke routes

// Homepagina 
Route::get('/', function () {
        $carouselPhotos = Photo::latest()->take(5)->get();
        $latestNews = News::latest('published_at')->take(3)->get();
        
    return view('home', compact('carouselPhotos', 'latestNews'));
})->name('home');

// User dashboard (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Publieke fotogalerij
Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');

// Favoriet toggelen (alleen ingelogde users)
Route::post('/photos/{photo}/favorite', [PhotoFavoriteController::class, 'toggle'])
    ->name('photos.favorite')
    ->middleware('auth');

// Mijn favorieten (alleen ingelogde users)
Route::get('/favorites', [PhotoController::class, 'favorites'])
    ->name('photos.favorites')
    ->middleware('auth');

//Authenticated user routes (profiel)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Comments (alleen ingelogde users)
Route::post('/photos/{photo}/comments', [PhotoCommentController::class, 'store'])
    ->name('photos.comments.store')
    ->middleware('auth');

// Publiek profiel van een user
Route::get('/users/{user}', function (User $user) {
    return view('users.show', compact('user'));
})->name('users.show');

// Publieke nieuws-routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

    
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
    
        // Comments verwijderen
        Route::delete('photo-comments/{photoComment}', [\App\Http\Controllers\Admin\PhotoCommentController::class, 'destroy'])
        ->name('photo-comments.destroy');

    });

require __DIR__.'/auth.php';
