<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PackageCategoryController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicPackageController;
use App\Http\Controllers\PublicGalleryController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Untuk Pengunjung Website)
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tentang Kami
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');

// Paket Tour
Route::get('/paket-tour', [PublicPackageController::class, 'index'])->name('packages.index');
Route::get('/paket-tour/{package:slug}', [PublicPackageController::class, 'show'])->name('packages.show');

// Galeri
Route::get('/galeri', [PublicGalleryController::class, 'index'])->name('gallery.index');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// Kontak
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [HomeController::class, 'contactSubmit'])->name('contact.submit');


/*
|--------------------------------------------------------------------------
| Rute CMS / Admin (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Redirect dashboard to admin dashboard
    Route::get('/dashboard', function() {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    // Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Rute untuk Manajemen Kategori Paket
        Route::resource('categories', PackageCategoryController::class);

        // Rute untuk Manajemen Paket Wisata
        Route::resource('packages', AdminPackageController::class);

        // Rute untuk Manajemen Galeri
        Route::resource('galleries', AdminGalleryController::class);

        // Rute untuk Manajemen Artikel Blog
        Route::resource('posts', PostController::class);
    });
});


// Rute Autentikasi (login, register, dll) dari Breeze
require __DIR__.'/auth.php';

