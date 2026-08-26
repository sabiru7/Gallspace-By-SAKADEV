<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


// =====================================================
// AUTH ROUTES (PUBLIC)
// =====================================================

// Halaman utama auth / login / register
Route::get('/', function () {
    return view('auth.auth');
})->name('auth');

// Halaman auth
Route::get('/auth', [AuthController::class, 'showAuth'])
    ->name('auth');

// Login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

// Register
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// =====================================================
// ROUTES KHUSUS USER LOGIN
// =====================================================

Route::middleware('auth')->group(function () {

    // =================================================
    // DASHBOARD
    // =================================================

    Route::get('/dashboard', function () {

        $path = public_path('images');
        $images = [];

        if (File::exists($path)) {

            $files = File::files($path);

            foreach ($files as $file) {
                $images[] = asset(
                    'images/' . $file->getFilename()
                );
            }
        }

        // View:
        // resources/views/dashboard/dashboard.blade.php
        return view('dashboard.dashboard', compact('images'));

    })->name('dashboard');


    // =================================================
    // UPLOAD GALERI
    // =================================================

    // Menampilkan halaman upload
    Route::get('/upload', [GalleryController::class, 'create'])
        ->name('gallery.create');

    // Proses upload
    Route::post('/upload', [GalleryController::class, 'store'])
        ->name('gallery.store');


    // =================================================
    // HAPUS GAMBAR GALERI
    // =================================================

    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])
        ->name('gallery.destroy');


    // =================================================
    // PROFILE / AKUN
    // =================================================

    // Halaman akun
    Route::get('/akun', [ProfileController::class, 'index'])
        ->name('akun');

    // Halaman edit akun
    Route::get('/akun/edit', [ProfileController::class, 'edit'])
        ->name('akun.edit');

    // Proses update akun
    Route::post('/akun/update', [ProfileController::class, 'update'])
        ->name('akun.update');
});


// =====================================================
// GALERI PUBLIK
// =====================================================

// Tidak perlu login
Route::get('/gallery', [GalleryController::class, 'index'])
    ->name('gallery.index');


// =====================================================
// JELAJAH
// =====================================================

Route::get('/jelajah', function () {

    // =================================================
    // EXPLORE
    // =================================================

    $explorePath = public_path('explore');
    $exploreImages = [];

    if (File::exists($explorePath)) {

        foreach (File::files($explorePath) as $file) {

            $exploreImages[] = asset(
                'explore/' . $file->getFilename()
            );
        }
    }


    // =================================================
    // TRENDING
    // =================================================

    $trendingPath = public_path('trending');
    $trendingImages = [];

    if (File::exists($trendingPath)) {

        foreach (File::files($trendingPath) as $file) {

            $trendingImages[] = asset(
                'trending/' . $file->getFilename()
            );
        }
    }


    // =================================================
    // CATEGORIES
    // =================================================

    $categories = [
        'photography',
        'anime',
        'architecture',
        'art',
        'food',
        'memes'
    ];


    // =================================================
    // VIEW
    // =================================================

    return view(
        'jelajah.jelajah',
        compact(
            'exploreImages',
            'trendingImages',
            'categories'
        )
    );

})->name('jelajah');


// =====================================================
// JELAJAH - ANIME
// =====================================================

Route::get('/jelajah/anime', function () {

    $animePath = public_path('anime');
    $images = [];

    if (File::exists($animePath)) {

        foreach (File::files($animePath) as $file) {

            $images[] = asset(
                'anime/' . $file->getFilename()
            );
        }
    }

    return view(
        'jelajah.anime',
        compact('images')
    );

})->name('jelajah.anime');


// =====================================================
// JELAJAH - PHOTOGRAPHY
// =====================================================

Route::get('/jelajah/photography', function () {

    $folder = 'photography';
    $path = public_path($folder);
    $images = [];

    if (File::exists($path)) {

        foreach (File::files($path) as $file) {

            $images[] = asset(
                $folder . '/' . $file->getFilename()
            );
        }
    }

    return view(
        'jelajah.photography',
        compact('images')
    );

})->name('jelajah.photography');


// =====================================================
// JELAJAH - ART
// =====================================================

Route::get('/jelajah/art', function () {

    $path = public_path('art');
    $images = [];

    if (File::exists($path)) {

        foreach (File::files($path) as $file) {

            $images[] = asset(
                'art/' . $file->getFilename()
            );
        }
    }

    return view(
        'jelajah.art',
        compact('images')
    );

})->name('jelajah.art');


// =====================================================
// JELAJAH - MEME
// =====================================================

Route::get('/jelajah/meme', function () {

    $path = public_path('memes');
    $images = [];

    if (File::exists($path)) {

        foreach (File::files($path) as $file) {

            $images[] = asset(
                'memes/' . $file->getFilename()
            );
        }
    }

    return view(
        'jelajah.meme',
        compact('images')
    );

})->name('jelajah.meme');
