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
    // Form edit profile
    Route::get('/akun/edit', [ProfileController::class, 'edit'])->name('akun.edit');
    // Update profile
    Route::post('/akun/update', [ProfileController::class, 'update'])->name('akun.update');
});
//edit
route::middleware('auth')->group(function () {
    // Halaman edit profile → URL /edit, nama route 'edit'
    Route::get('/akun.edit', [ProfileController::class, 'edit'])->name('edit');
});
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
        'categories'
    ));
});