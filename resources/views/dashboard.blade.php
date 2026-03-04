<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GallSpace</title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    background: linear-gradient(to bottom, #000, #121212);
    opacity: 0;
    transition: opacity .8s ease;
}

/* Glass effect */
.glass {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(12px);
}

/* Logo glow */
.logo {
    filter: drop-shadow(0 0 8px rgba(255,255,255,0.4));
}

/* Pinterest Card */
.gallery-card {
    border-radius: 20px;
    overflow: hidden;
    transition: all .4s ease;
    opacity: 0;
    transform: translateY(40px);
    position: relative;
}

.gallery-card.show {
    opacity: 1;
    transform: translateY(0);
}

.gallery-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
}

/* Prevent column break */
.break-inside-avoid {
    break-inside: avoid;
}

/* Image hover zoom */
.gallery-card img {
    transition: transform .6s ease;
}

.gallery-card:hover img {
    transform: scale(1.05);
}

/* Like animation */
.like-active {
    color: #ff4d6d;
    animation: pop .3s ease;
}

@keyframes pop {
    0% { transform: scale(1); }
    50% { transform: scale(1.4); }
    100% { transform: scale(1); }
}
</style>
</head>

<body class="text-white min-h-screen">

<!-- NAVBAR -->
<nav class="glass sticky top-0 z-50 flex justify-between items-center px-10 py-4">

    <a href="/" class="flex items-center space-x-3">
        <img src="{{ asset('logo/logo.png') }}" class="logo w-12 h-12 object-contain">
    </a>

    <div class="hidden md:flex items-center gap-10 text-sm font-medium">
        <a href="/dashboard" class="hover:text-white transition">Home</a>

        <a href="/jelajah"
           class="text-yellow-400 border-b-2 border-yellow-400 pb-1">
            Explore
        </a>

        <a href="/upload" class="hover:text-white transition">
            Upload
        </a>
    </div>

    @auth
        <a href="{{ route('akun') }}"
           class="w-10 h-10 rounded-full overflow-hidden border border-white/30">
            <img src="{{ asset('profile/' . (auth()->user()->profile->avatar ?? 'gojokiko.jpg')) }}"
                 class="w-full h-full object-cover">
        </a>
    @else
        <a href="{{ route('login') }}"
           class="px-4 py-2 rounded bg-white/20 hover:bg-white/30 transition font-semibold">
            Login
        </a>
    @endauth
</nav>

<!-- HERO -->
<div class="text-center mt-16 px-4">
    <h1 class="text-3xl md:text-4xl font-semibold mb-6">
        Discover artwork from artists & photographers
    </h1>

    <div class="flex justify-center mb-10">
        <input type="text"
               id="searchInput"
               placeholder="Search images..."
               class="px-5 py-3 rounded-xl text-black w-80 focus:outline-none shadow-lg">
    </div>
</div>

<!-- GALLERY -->
<div class="max-w-7xl mx-auto px-6 pb-20">

    <div id="gallery"
         class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-6 space-y-6">

        @forelse($images as $img)
        @php
            $filename = basename($img);
            $cleanName = strtolower(pathinfo($filename, PATHINFO_FILENAME));
        @endphp

        <div class="gallery-card break-inside-avoid glass shadow-xl mb-6 p-3 space-y-3"
             data-name="{{ $cleanName }}">

            <img src="{{ $img }}"
                 class="w-full object-cover rounded-xl">

            <h3 class="text-sm font-semibold truncate">
                {{ ucfirst($cleanName) }}
            </h3>

            <div class="flex justify-between items-center text-xs">

                <button onclick="toggleLike(this)"
                        class="flex items-center gap-1 transition">
                    ❤️ <span class="like-count">0</span>
                </button>

                <a href="{{ $img }}"
                   download
                   class="hover:text-green-400 transition">
                    ⬇ Download
                </a>
            </div>

        </div>
        @empty
        <p class="text-center text-gray-500">
            Tidak ada gambar ditemukan.
        </p>
        @endforelse

    </div>
</div>

<script>

// Fade in
window.addEventListener("load",()=>{
    document.body.style.opacity="1";
});

// Scroll reveal
const observer = new IntersectionObserver(entries=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting){
            entry.target.classList.add("show");
        }
    });
},{threshold:0.2});

document.querySelectorAll(".gallery-card").forEach(card=>{
    observer.observe(card);
});

// SEARCH
document.getElementById('searchInput').addEventListener('keyup', function () {
    const value = this.value.toLowerCase();

    document.querySelectorAll('.gallery-card').forEach(card => {
        card.style.display = card.dataset.name.includes(value)
            ? 'block'
            : 'none';
    });
});

// LIKE
function toggleLike(button) {
    const countSpan = button.querySelector('.like-count');
    let count = parseInt(countSpan.innerText);

    button.classList.toggle('like-active');
    countSpan.innerText = button.classList.contains('like-active')
        ? count + 1
        : count - 1;
}

</script>

</body>
</html>