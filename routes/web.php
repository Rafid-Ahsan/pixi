<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SingleImageController;
use App\Http\Controllers\CatalogImageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OpenImageController;

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

// End User Routes
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/open_blog_image/{id}', [OpenImageController::class, 'open_blog_image'])->name('open.blog');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    // Cover image store route
    Route::post('/store_cover_image', [CoverController::class, 'store']);

    //Blog Route
    Route::get('/blog', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/store_blog/{id}', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/all_blogs', [BlogController::class, 'show_all'])->name('blog.all');
    Route::get('/single_blog/{blog}', [BlogController::class, 'show_single'])->name('blog.single');
    Route::get('/download_blog/{blog}', [BlogController::class, 'download'])->name('blog.download');
    Route::get('/update_blog/{blog}', [BlogController::class, 'show_update_form'])->name('blog.showUpdateForm');
    Route::put('/update_blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/delete_blog/{id}', [BlogController::class, 'delete'])->name('blog.delete');

    // Single Images Route
    Route::get('/single-image', [SingleImageController::class, 'create'])->name('single_image.create');
    Route::post('/store_single_image', [SingleImageController::class, 'store'])->name('single_image.store');
    Route::get('/all_single_images', [SingleImageController::class, 'show_all'])->name('single.all');
    Route::get('/single_single_image/{single}', [SingleImageController::class, 'show_single'])->name('single_image.single');
    Route::get('/update_single_image/{single}', [SingleImageController::class, 'show_update_form'])->name('single.show_update_form');
    Route::put('/update_single/{single}', [SingleImageController::class, 'update'])->name('single.update');
    Route::get('/delete_single/{id}', [SingleImageController::class, 'delete'])->name('single.delete');

    // Catalog Images Route
    Route::get('/catalog_image', [CatalogImageController::class, 'create'])->name('catalog.create');
    Route::post('/store_catalog/{id}', [CatalogImageController::class, 'store'])->name('catalog.store');
    Route::get('/all_catalog_images', [CatalogImageController::class, 'show_all'])->name('catalog.all');
    Route::get('/single_catalog_image/{catalog}', [CatalogImageController::class, 'show_single'])->name('catalog_image.single');
    Route::get('/update_catalog_image/{catalog}', [CatalogImageController::class, 'show_update_form'])->name('catalog.show_update_form');
    Route::put('/update_catalog/{single}', [CatalogImageController::class, 'update'])->name('catalog.update');
    Route::get('/delete_catalog/{id}', [CatalogImageController::class, 'delete'])->name('catalog.delete');
});


