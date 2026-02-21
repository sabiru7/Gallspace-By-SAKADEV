<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
// =====================
// AUTH ROUTES (PUBLIC)
// =====================
// Halaman utama auth/login/register
Route::get('/', function () {
    return view('auth.auth');
})->name('auth');
Route::get('/auth', [AuthController::class, 'showAuth'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// =====================
// ROUTES KHUSUS USER LOGIN (MIDDLEWARE auth)
// =====================
Route::middleware('auth')->group(function () {
    // Dashboard user (contoh ambil gambar dari folder public/images)
    Route::get('/dashboard', function () {
        $path = public_path('images');
        $images = [];

        if (File::exists($path)) {
            $files = File::files($path);
            foreach ($files as $file) {
                $images[] = asset('images/' . $file->getFilename());
            }
        }
        return view('dashboard', compact('images'));
    })->name('dashboard');
    // Halaman profile user
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    // Upload galeri (tampilkan form)
    Route::get('/upload', [GalleryController::class, 'create'])
        ->name('gallery.create');

    // Proses upload galeri
    Route::post('/upload', [GalleryController::class, 'store'])
        ->name('gallery.store');
});
// =====================
// GALERI PUBLIK (TIDAK PERLU LOGIN)
// =====================
Route::get('/gallery', [GalleryController::class, 'index'])
    ->name('gallery.index');
// PROFILE
// HALAMAN AKUN (tanpa filter user)
Route::get('/akun', function () {
    $path = public_path('images');
    $images = [];

    if (File::exists($path)) {
        $files = File::files($path);
        foreach ($files as $file) {
            $images[] = asset('images/' . $file->getFilename());
        }
    }

    // Sekarang $images pasti tersedia
    return view('akun.akun', compact('images'));
})->middleware('auth')->name('akun');
// Edit profile (hanya untuk user yang login)
Route::middleware('auth')->group(function () {
    // Halaman profile → URL /akun, nama route 'akun'
Route::get('/akun', [ProfileController::class, 'index'])->name('akun');
Route::get('/akun/edit', [ProfileController::class, 'edit'])->name('akun.edit');
Route::post('/akun/update', [ProfileController::class, 'update'])->name('akun.update');
});
//edit
route::middleware('auth')->group(function () {
    // Halaman edit profile → URL /edit, nama route 'edit'
    Route::get('/akun.edit', [ProfileController::class, 'edit'])->name('edit');
});
Route::get('/akun', [ProfileController::class, 'index'])->name('akun');
Route::post('/akun/update', [ProfileController::class, 'update'])->name('akun.update');
//jelajah
Route::get('/jelajah', function () {

    // 🔹 EXPLORE
    $explorePath = public_path('explore');
    $exploreImages = [];

    if (File::exists($explorePath)) {
        foreach (File::files($explorePath) as $file) {
            $exploreImages[] = asset('explore/' . $file->getFilename());
        }
    }

    // 🔹 TRENDING
    $trendingPath = public_path('trending');
    $trendingImages = [];

    if (File::exists($trendingPath)) {
        foreach (File::files($trendingPath) as $file) {
            $trendingImages[] = asset('trending/' . $file->getFilename());
        }
    }

    $categories = [
        'photography',
        'anime',
        'architecture',
        'art',
        'food',
        'memes'
    ];

    return view('jelajah.jelajah', compact(
        'exploreImages',
        'trendingImages',
        'categories',
        
    ));
});
//anime
Route::get('/jelajah/anime', function () {

    $animePath = public_path('anime');
    $images = [];

    if (File::exists($animePath)) {
        foreach (File::files($animePath) as $file) {
            $images[] = asset('anime/' . $file->getFilename());
        }
    }

    return view('jelajah.anime', compact('images'));

})->name('jelajah.anime');
//photography
Route::get('/jelajah/photography', function () {

    $folder = 'photography';
    $path = public_path($folder);
    $images = [];

    if (File::exists($path)) {
        foreach (File::files($path) as $file) {
            $images[] = asset($folder . '/' . $file->getFilename());
        }
    }

    return view('jelajah.photography', compact('images'));

})->name('jelajah.photography');
// art
Route::get('/jelajah/art', function () {

    $path = public_path('art');
    $images = [];

    if (File::exists($path)) {
        foreach (File::files($path) as $file) {
            $images[] = asset('art/' . $file->getFilename());
        }
    }

    return view('jelajah.art', compact('images'));
})->name('jelajah.art');

//meme
Route::get('/jelajah/meme', function () {

    $path = public_path('memes');
    $images = [];

    if (File::exists($path)) {
        foreach (File::files($path) as $file) {
            $images[] = asset('memes/' . $file->getFilename());
        }
    }

    return view('jelajah.meme', compact('images'));
})->name('jelajah.meme');