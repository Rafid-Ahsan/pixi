<?php

use App\Http\Controllers\AdminContestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminImageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SingleImageController;
use App\Http\Controllers\CatalogImageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\ContestUploadController;
use App\Http\Controllers\OpenImageController;
use App\Http\Controllers\publisherProfileController;
use App\Http\Controllers\TeamController;

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
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/open_blog_image/{id}', [OpenImageController::class, 'open_blog_image'])->name('open.blog');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/order', function() {
    return view('order');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');


    // show all routes
    Route::get('rand/blog/all', [WelcomeController::class, 'show_all_blogs'])->name('random.blog.all');
    Route::get('rand/single/all', [WelcomeController::class, 'show_all_singles'])->name('random.single.all');
    Route::get('rand/catalog/all', [WelcomeController::class, 'show_all_catalogs'])->name('random.catalog.all');

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
    Route::put('/update_catalog/{id}', [CatalogImageController::class, 'update'])->name('catalog.update');
    Route::get('/delete_catalog/{id}', [CatalogImageController::class, 'delete'])->name('catalog.delete');

    //contest routes
    Route::post('create/contest/{id}', [ContestController::class, 'store'])->name('contest.store.id');
    Route::get('show/personal/contest/{contest}', [ContestController::class, 'personal'])->name('contest.personal');
    Route::resource('contest', ContestController::class);

    //contest upload routes
    Route::post('/contest/upload/{contest_id}/{publisher_id}/{participator_id}', [ContestUploadController::class, 'store'])->name('contest.upload');
    Route::get('/contest/uploads/submissions/{id}', [ContestUploadController::class, 'submissions'])->name('contest.uploads.submissions');
    Route::get('/uploads/contest/picture/{id}', [ContestUploadController::class, 'show_image'])->name('contest.image.show');
    Route::put('/uploads/contest/status/update/{id}', [ContestUploadController::class, 'update_status'])->name('contest.uploads.status_update');

    // Admin routes
    Route::group(['middleware' => ['can:see admin panel']], function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

        //Admin contest routes
        Route::get('/admin/contest', [AdminContestController::class, 'index'])->name('admin.contest.index');
        Route::put('/admin/contest/status-update/{contest}', [AdminContestController::class, 'update_status'])->name('admin.contest.status_update');
        Route::get('/admin/contest/delete/{contest}', [AdminContestController::class, 'delete'])->name('admin.contest.delete');

        //Team routes
        Route::get('/team', [TeamController::class, 'index'])->name('admin.team.index');
        Route::put('/team/update/role/{user}', [TeamController::class, 'update'])->name('admin.team.update');
        Route::get('/team/delete/{user}', [TeamController::class, 'delete'])->name('admin.team.delete');

        //Admin Images routes
        Route::get('/admin/images', [AdminImageController::class, 'index'])->name('admin.images.index');
    });
});
// asd


