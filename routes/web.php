<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdController::class,'index'])->name('home');

// Ads public
Route::get('/ads', [AdController::class,'index'])->name('ads.index');
Route::get('/ads/{ad:slug}', [AdController::class, 'show'])->name('ads.show');

// Categories public
Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');


// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ads routes
    Route::get('/ads/my', [AdController::class,'myAds'])->name('ads.my');
    Route::get('/ads/create', [AdController::class,'create'])->name('ads.create');
    Route::post('/ads', [AdController::class,'store'])->name('ads.store');
    Route::get('/ads/{ad:slug}/edit', [AdController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/{ad:slug}', [AdController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{ad:slug}', [AdController::class,'destroy'])->name('ads.destroy');

    // Favorite toggle
    Route::post('/ads/{ad:slug}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


require __DIR__.'/auth.php';
