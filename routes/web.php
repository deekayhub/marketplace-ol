<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MyListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/add-listing', [ListingController::class, 'create'])->name('listing.create');
    Route::get('/my-listings', [MyListingController::class, 'index'])->name('my-listings');
    Route::get('/my-listings/{id}', [MyListingController::class, 'edit'])->name('listings.edit');
    Route::put('/my-listings/{id}', [MyListingController::class, 'update'])->name('listings.update');
    Route::delete('/my-listings/{id}', [MyListingController::class, 'destroy'])->name('listings.destroy');
    Route::post('/add-listing', [ListingController::class, 'store'])->name('listings.store');
});

require __DIR__.'/auth.php';
