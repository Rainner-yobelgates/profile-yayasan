<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
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

Route::prefix('admin')->group(function(){
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/go-login', [AuthController::class, 'goLogin'])->name('goLogin');
    Route::get('/log-out', [AuthController::class, 'logOut'])->name('logOut');
Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        // News
        Route::get('/berita', [NewsController::class, 'index'])->name('admin.news');
        Route::get('/berita/data', [NewsController::class, 'data'])->name('admin.news.data');
        Route::get('/berita/tambah', [NewsController::class, 'create'])->name('admin.news.create');
        Route::post('/berita/simpan', [NewsController::class, 'store'])->name('admin.news.store');
        Route::get('/berita/{news:id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
        Route::patch('/berita/{news:id}/perbarui', [NewsController::class, 'update'])->name('admin.news.update');
        Route::delete('/berita/{news:id}/hapus', [NewsController::class, 'delete'])->name('admin.news.delete');
        // Gallery
        Route::get('/galeri', [GalleryController::class, 'index'])->name('admin.gallery');
        Route::get('/galeri/data', [GalleryController::class, 'data'])->name('admin.gallery.data');
        Route::get('/galeri/tambah', [GalleryController::class, 'create'])->name('admin.gallery.create');
        Route::post('/galeri/simpan', [GalleryController::class, 'store'])->name('admin.gallery.store');
        Route::get('/galeri/{gallery:id}/edit', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
        Route::patch('/galeri/{gallery:id}/perbarui', [GalleryController::class, 'update'])->name('admin.gallery.update');
        Route::delete('/galeri/{gallery:id}/hapus', [GalleryController::class, 'delete'])->name('admin.gallery.delete');
});
});