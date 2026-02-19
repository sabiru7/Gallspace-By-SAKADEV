<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GallSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to bottom, #000, #121212);
        }

        .glass {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
        }

        .logo {
            filter: drop-shadow(0 0 8px rgba(255,255,255,0.4));
        }

        .gallery-card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .gallery-card:hover {
            transform: scale(1.06);
            box-shadow: 0 20px 40px rgba(255,255,255,0.1);
        }

        .category-card {
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform 0.4s ease;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);
            transition: background 0.4s ease;
        }

        .category-card:hover .overlay {
            background: rgba(0,0,0,0.6);
        }

        .category-text {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 600;
            text-transform: lowercase;
            letter-spacing: 1px;
        }
    </style>
</head>

<body class="text-white min-h-screen">

<!-- NAVBAR -->
<nav class="glass sticky top-0 z-50 flex justify-between items-center px-10 py-4">

    <!-- LOGO -->
    <a href="/" class="flex items-center space-x-3">
        <img src="{{ asset('logo/logo.png') }}" class="logo w-12 h-12 object-contain">
    </a>

    <!-- MENU -->
    <div class="hidden md:flex items-center space-x-8 text-gray-250 font-medium">
<div class="hidden md:flex justify-center items-center flex-1">

    <nav class="flex items-center gap-10 text-gray-250 text-sm font-medium">

        <!-- Home -->
        <a href="/dashboard"
           class="group flex items-center gap-2 hover:text-white transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 transition group-hover:scale-110"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 10.5L12 3l9 7.5M4.5 9.75V20h5.25v-6h4.5v6H19.5V9.75"/>
            </svg>
            <span>Home</span>
        </a>

        <!-- Explore -->
        <a href="/jelajah"
           class="group flex items-center gap-2 text-yellow-400 border-b-2 border-yellow-400 pb-1">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 2l3 7 7 3-7 3-3 7-3-7-7-3 7-3 3-7z"/>
            </svg>
            <span>Explore</span>
        </a>

        <!-- Upload -->
        <a href="/upload"
           class="group flex items-center gap-2 hover:text-white transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 transition group-hover:scale-110"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12V4m0 0l-3 3m3-3l3 3"/>
            </svg>
            <span>Upload</span>
        </a>

    </nav>

</div>
    <!-- AUTH SECTION -->
@auth
    <!-- Sudah Login -->
   <a href="{{ route('akun') }}"
   title="{{ auth()->user()->name }}"
   class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center
          hover:brightness-90 transition-all border border-white/30">
    <img src="{{ asset('images/' . (auth()->user()->profile->avatar ?? 'gojokiko.jpg')) }}" 
         alt="{{ auth()->user()->name }}" 
         class="w-full h-full object-cover">
</a>

@else
    <!-- Belum Login -->
    <a href="{{ route('login') }}"
       class="px-4 py-2 rounded bg-white/20 hover:bg-white/30 transition-colors font-semibold text-white">
        Login
    </a>
@endauth
</nav>
<!-- HERO -->
<div class="text-center mt-16 px-4">
    <h1 class="text-3xl md:text-4xl font-semibold mb-6">
        Introduce our products from artists,
        photographers, and digital art
    </h1>

    <div class="flex justify-center mb-10">
        <input type="text"
               id="searchInput"
               placeholder="Search images..."
               class="px-5 py-3 rounded-xl text-black w-80 focus:outline-none shadow-lg">
    </div>
</div>

<!-- RELATED INTERESTING -->
<div class="max-w-6xl mx-auto px-6 pb-24">
    <h2 class="text-center text-3xl mb-12 font-semibold tracking-wide">
        related interesting
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="category-card">
            <img src="{{ asset('explore/fantasi.jpg') }}" class="w-full h-40 object-cover">
            <div class="overlay"></div>
            <div class="category-text">fantasy</div>
        </div>

        <div class="category-card">
            <img src="{{ asset('explore/tewa.jpg') }}" class="w-full h-40 object-cover">
            <div class="overlay"></div>
            <div class="category-text">memes</div>
        </div>

        <div class="category-card">
            <img src="{{ asset('explore/gojokiko.jpg') }}" class="w-full h-40 object-cover">
            <div class="overlay"></div>
            <div class="category-text">anime</div>
        </div>

        <div class="category-card">
            <img src="{{ asset('explore/media.jpg') }}" class="w-full h-40 object-cover">
            <div class="overlay"></div>
            <div class="category-text">media social</div>
        </div>
    </div>
</div>

<!-- GALLERY -->
<div class="max-w-6xl mx-auto px-6 pb-20">
    <h2 class="text-center text-3xl mb-12 font-semibold tracking-wide">
        For You Page
    </h2>

    <div id="gallery" class="grid grid-cols-2 md:grid-cols-4 gap-8">
        @forelse($images as $img)
            <div class="gallery-card shadow-2xl"
                 data-name="{{ strtolower(basename($img)) }}">
                <img src="{{ $img }}" class="w-full h-64 object-cover">
            </div>
        @empty
            <p class="col-span-4 text-center text-gray-500">
                Tidak ada gambar ditemukan.
            </p>
        @endforelse
    </div>
</div>

<!-- SEARCH SCRIPT -->
<script>
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function () {
        const value = this.value.toLowerCase();

        document.querySelectorAll('.gallery-card').forEach(card => {
            card.style.display = card.dataset.name.includes(value)
                ? 'block'
                : 'none';
        });
    });
</script>

</body>
</html>
