<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\DashboardController;


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
Route::get('/', [UserController::class, 'index']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Cover image store route
    Route::post('/store_cover_image', [CoverController::class, 'store']);

    // Add Images route
    Route::get('/single-image', [DashboardController::class, 'create_single_image'])->name('image.single');
    Route::post('/store_single_image/{id}', [DashboardController::class, 'store_single_image']);

    Route::get('/catalog_image', [DashboardController::class, 'create_catalog_image'])->name('image.catalog');
    Route::post('/store_catalog/{id}', [DashboardController::class, 'store_catalog']);

    Route::get('/blog', [DashboardController::class, 'create_blog'])->name('image.blog');
    Route::post('/store_blog/{id}', [DashboardController::class, 'store_blog']);
});


