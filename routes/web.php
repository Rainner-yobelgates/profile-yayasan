<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\RunningTextController;

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
// Route yang diakses pertama kali oleh user tambahkan middleware middleware('hitvisitors') 
// fungsinya untuk mengitung jumlah pengunjung website
Route::middleware(['hitvisitors'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');     
    Route::get('/hubungi-kami', [HomeController::class, 'contact'])->name('contact');     
    Route::get('/berita', [HomeController::class, 'news'])->name('news');     
    Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');     
});
Route::post('/hubungi-kami/proses', [HomeController::class, 'contactProcess'])->name('contact.process');     
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
            // institution
            Route::get('/lembaga', [InstitutionController::class, 'index'])->name('admin.institution');
            Route::get('/lembaga/data', [InstitutionController::class, 'data'])->name('admin.institution.data');
            Route::get('/lembaga/tambah', [InstitutionController::class, 'create'])->name('admin.institution.create');
            Route::post('/lembaga/simpan', [InstitutionController::class, 'store'])->name('admin.institution.store');
            Route::get('/lembaga/{institution:id}/edit', [InstitutionController::class, 'edit'])->name('admin.institution.edit');
            Route::patch('/lembaga/{institution:id}/perbarui', [InstitutionController::class, 'update'])->name('admin.institution.update');
            Route::delete('/lembaga/{institution:id}/hapus', [InstitutionController::class, 'delete'])->name('admin.institution.delete');
            // Banner
            Route::get('/spanduk', [BannerController::class, 'index'])->name('admin.banner');
            Route::get('/spanduk/data', [BannerController::class, 'data'])->name('admin.banner.data');
            Route::get('/spanduk/tambah', [BannerController::class, 'create'])->name('admin.banner.create');
            Route::post('/spanduk/simpan', [BannerController::class, 'store'])->name('admin.banner.store');
            Route::get('/spanduk/{banner:id}/edit', [BannerController::class, 'edit'])->name('admin.banner.edit');
            Route::patch('/spanduk/{banner:id}/perbarui', [BannerController::class, 'update'])->name('admin.banner.update');
            Route::delete('/spanduk/{banner:id}/hapus', [BannerController::class, 'delete'])->name('admin.banner.delete');
            // Running Text
            Route::get('/tulisan-berjalan', [RunningTextController::class, 'index'])->name('admin.running-text');
            Route::get('/tulisan-berjalan/data', [RunningTextController::class, 'data'])->name('admin.running-text.data');
            Route::get('/tulisan-berjalan/tambah', [RunningTextController::class, 'create'])->name('admin.running-text.create');
            Route::post('/tulisan-berjalan/simpan', [RunningTextController::class, 'store'])->name('admin.running-text.store');
            Route::get('/tulisan-berjalan/{runningText:id}/edit', [RunningTextController::class, 'edit'])->name('admin.running-text.edit');
            Route::patch('/tulisan-berjalan/{runningText:id}/perbarui', [RunningTextController::class, 'update'])->name('admin.running-text.update');
            Route::delete('/tulisan-berjalan/{runningText:id}/hapus', [RunningTextController::class, 'delete'])->name('admin.running-text.delete');
            // Message
            Route::get('/pesan', [MessageController::class, 'index'])->name('admin.message');
            Route::get('/pesan/data', [MessageController::class, 'data'])->name('admin.message.data');
            Route::get('/pesan/{message:id}/show', [MessageController::class, 'show'])->name('admin.message.show');
            Route::delete('/pesan/{message:id}/hapus', [MessageController::class, 'delete'])->name('admin.message.delete');
                //Settings
            Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting');
            Route::patch('/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
    });
});