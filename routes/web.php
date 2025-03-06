<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;


Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

Route::get("/", [HomeController::class, "index"])->name('index');
Route::get("/products/{id}", [ProductController::class, "show"])->name("products.show");

Route::post('/products/{product}/reviews', [ProductController::class, 'storeReview'])->name('reviews.store');

Route::get('/reviews/{review}/edit', [ProductController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [ProductController::class, 'update'])->name('reviews.update');

Route::get('/product/{product}/status', [ProductController::class, 'showStatusForm'])->name('products.status.form');

Route::get('/product/{product}/status/show', [ProductController::class, 'showStatus'])->name('products.status.show');

Route::post('/product/{product}/status', [ProductController::class, 'updateStatus'])->name('products.status.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
