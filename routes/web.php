<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SingleImageController;
use App\Http\Controllers\CatalogImageController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Staring User Routes
Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    // Cover image store route
    Route::post('/store_cover_image', [CoverController::class, 'store']);

    // Single Images Route
    Route::get('/single-image', [SingleImageController::class, 'create'])->name('single_image.create');
    Route::post('/store_single_image', [SingleImageController::class, 'store'])->name('single_image.store');
    Route::get('/all_single_images', [SingleImageController::class, 'show'])->name('single_image.show');

    // Catalog Images Route
    Route::get('/catalog_image', [CatalogImageController::class, 'create'])->name('catalog.create');
    Route::post('/store_catalog/{id}', [CatalogImageController::class, 'store'])->name('catalog.store');

    //Blog Route
    Route::get('/blog', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/store_blog/{id}', [BlogController::class, 'store'])->name('blog.store');
});


