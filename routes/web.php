<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('landing.landing');
})->name('landing.landing');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// Halaman login / register
Route::get('/auth', [AuthController::class, 'showAuth'])
    ->name('auth');

// Proses login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

// Proses register
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| PUBLIC GALLERY
|--------------------------------------------------------------------------
*/

// Galeri yang bisa dilihat tanpa login
Route::get('/gallery', [GalleryController::class, 'index'])
    ->name('gallery.index');


/*
|--------------------------------------------------------------------------
| JELAJAH
|--------------------------------------------------------------------------
*/

Route::get('/jelajah', function () {

    // ==============================
    // EXPLORE
    // ==============================

    $explorePath = public_path('explore');
    $exploreImages = [];

    if (File::exists($explorePath)) {

        foreach (File::files($explorePath) as $file) {

            $exploreImages[] = asset(
                'explore/' . $file->getFilename()
            );
        }
    }


    // ==============================
    // TRENDING
    // ==============================

    $trendingPath = public_path('trending');
    $trendingImages = [];

    if (File::exists($trendingPath)) {

        foreach (File::files($trendingPath) as $file) {

            $trendingImages[] = asset(
                'trending/' . $file->getFilename()
            );
        }
    }


    // ==============================
    // CATEGORIES
    // ==============================

    $categories = [
        'photography',
        'anime',
        'architecture',
        'art',
        'food',
        'memes'
    ];


    return view(
        'jelajah.jelajah',
        compact(
            'exploreImages',
            'trendingImages',
            'categories'
        )
    );

})->name('jelajah');


/*
|--------------------------------------------------------------------------
| JELAJAH - ANIME
|--------------------------------------------------------------------------
*/

Route::get('/jelajah/anime', function () {

    $folder = 'anime';
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
        'jelajah.anime',
        compact('images')
    );

})->name('jelajah.anime');


/*
|--------------------------------------------------------------------------
| JELAJAH - PHOTOGRAPHY
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| JELAJAH - ART
|--------------------------------------------------------------------------
*/

Route::get('/jelajah/art', function () {

    $folder = 'art';
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
        'jelajah.art',
        compact('images')
    );

})->name('jelajah.art');


/*
|--------------------------------------------------------------------------
| JELAJAH - MEME
|--------------------------------------------------------------------------
*/

Route::get('/jelajah/meme', function () {

    $folder = 'memes';
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
        'jelajah.meme',
        compact('images')
    );

})->name('jelajah.meme');


/*
|--------------------------------------------------------------------------
| USER LOGIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $path = public_path('images');
        $images = [];

        if (File::exists($path)) {

            foreach (File::files($path) as $file) {

                $images[] = asset(
                    'images/' . $file->getFilename()
                );
            }
        }

        return view(
            'dashboard.dashboard',
            compact('images')
        );

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | UPLOAD GALERI
    |--------------------------------------------------------------------------
    */

    Route::get('/upload', [GalleryController::class, 'create'])
        ->name('gallery.create');

    Route::post('/upload', [GalleryController::class, 'store'])
        ->name('gallery.store');


    /*
    |--------------------------------------------------------------------------
    | DELETE GALERI
    |--------------------------------------------------------------------------
    */

    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])
        ->name('gallery.destroy');


    /*
    |--------------------------------------------------------------------------
    | PROFILE / AKUN
    |--------------------------------------------------------------------------
    */

    Route::get('/akun', [ProfileController::class, 'index'])
        ->name('akun');

    Route::get('/akun/edit', [ProfileController::class, 'edit'])
        ->name('akun.edit');

    Route::post('/akun/update', [ProfileController::class, 'update'])
        ->name('akun.update');

});
