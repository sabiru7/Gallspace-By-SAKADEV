<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Akun Saya - GallSpace</title>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
:root {
  --primary:#0d6efd;
  --background:#121212;
  --card-bg:#1e1e1e;
  --text:#e4e4e4;
  --muted-text:#aaaaaa;
  --shadow:0 8px 20px rgba(0,0,0,0.6);
  --hover:#272727;
}

body {
  font-family: 'Poppins', sans-serif;
  background: var(--background);
  color: var(--text);
  margin-top: 80px;
}

/* Navbar */
.navbar {
  background: var(--card-bg);
  box-shadow: 0 2px 10px rgba(0,0,0,0.9);
}
.navbar a.nav-link {
  color: var(--text);
  transition: color 0.3s;
}
.navbar a.nav-link:hover {
  color: var(--primary);
}
.navbar-brand img {
  height: 50px;
}

/* Cover */
.profile-header {
  height: 300px;
  max-width: 1250px;
  margin: 0 auto;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: var(--shadow);
}
.cover-photo {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.5);
  transition: transform 0.5s;
}
.cover-photo:hover {
  transform: scale(1.05);
}

/*navbar profile */
.navbar-nav .nav-link:hover {
  color: #0d6efd !important;
}
.dropdown-menu {
  border-radius: 12px;
  border: none;
}
.dropdown-item:hover {
  background: #0d6efd;
  color: #fff !important;
}


/* Profile Card */
.profile-card {
  max-width: 1100px;
  margin: -80px auto 2rem;
  background: var(--card-bg);
  border-radius: 20px;
  box-shadow: var(--shadow);
  padding: 2rem 2rem 3rem;
  position: relative;
  text-align: center;
}

.avatar-wrap {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  top: -70px;
}
.avatar {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  object-fit: cover;
  border: 4px solid var(--background);
  box-shadow: 0 8px 18px rgba(0,0,0,0.7);
  transition: transform 0.3s;
}
.avatar:hover {
  transform: scale(1.05);
}
.avatar-camera {
  position: absolute;
  bottom: 0;
  right: -5px;
  background: var(--primary);
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.7);
  transition: background 0.3s;
}
.avatar-camera:hover {
  background: #0056b3;
}

.profile-meta h3 {
  font-weight: 700;
  margin-top: 10px;
}
.small-muted {
  color: var(--muted-text);
  font-size: 0.9rem;
}

/* Tabs */
.profile-tabs {
  display: flex;
  justify-content: center;
  gap: 1rem;
  border-bottom: 1px solid #333;
  padding-bottom: 0.5rem;
  margin-top: 1rem;
}
.tab-link {
  padding: 0.5rem 1.2rem;
  font-weight: 600;
  border-radius: 15px;
  cursor: pointer;
  transition: 0.3s;
  color: var(--text);
}
.tab-link:hover {
  background: var(--hover);
}
.tab-link.active {
  background: var(--primary);
  color: #fff;
}

/* Layout */
.container-main {
  max-width: 1250px;
  margin: 2rem auto 3rem;
  display: grid;
  grid-template-columns: 280px minmax(0, 640px) 300px;
  gap: 1.5rem;
}

/* Cards */
.card-slim, .card-post {
  background: var(--card-bg);
  border-radius: 20px;
  padding: 1.5rem;
  box-shadow: var(--shadow);
  transition: transform 0.3s, background 0.3s;
  color: var(--text);
}
.card-slim:hover, .card-post:hover {
  transform: translateY(-5px);
  background: var(--hover);
}

/* ===== CARD POST ===== */
.card-post {
  background: #fff;
  padding: 20px;
  border-radius: 18px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  margin-bottom: 20px;
}

/* Gambar utama di dalam post */
.card-post .post-image {
  width: 100%;
  border-radius: 18px;
  margin-top: 15px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.card-post .post-image:hover {
  transform: scale(1.03);
}


/* ===== PHOTOS GRID ===== */
.photos-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* FIX 3 kolom */
  gap: 10px;
  margin-top: 15px;
  padding-top: 10px;
  border-top: 1px solid #2a2a2a; 
}

/* Wrapper tiap foto */
.photos-grid .photo-item {
  width: 100%;
  aspect-ratio: 1 / 1; /* paksa kotak */
  overflow: hidden;
  border-radius: 12px;
}

/* Foto */
.photos-grid img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.photos-grid img:hover {
  transform: scale(1.05);
}

/* Friend Items */
.friend-item img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}
.friend-item strong {
  color: var(--text);
}

</style>
</head>
<body>

@php
$profile = optional(Auth::user()->profile);
$avatar = $profile->avatar ?? 'gojokiko.jpg';
@endphp

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background:#1e1e1e; box-shadow:0 2px 10px rgba(0,0,0,0.7);">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
      <img src="{{ asset('logo/logo.png') }}" alt="Logo" style="height:50px;">
      <span class="ms-2 fw-bold text-light">GallSpace</span>
    </a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- Home Link -->
        <li class="nav-item me-3">
          <a class="nav-link text-light fw-semibold" href="{{ route('dashboard') }}">Home</a>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('profile/'.$avatar) }}" class="rounded-circle border border-2 border-dark me-2" width="36" height="36" style="object-fit:cover;">
            <span class="fw-medium">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end bg-dark text-light">
            <li><a class="dropdown-item text-light" href="{{ route('akun') }}">Akun Saya</a></li>
            <li><hr class="dropdown-divider bg-secondary"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100">Logout</button>
              </form>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>


<!-- Cover -->
<div class="profile-header">
  <img src="{{ asset('anime/anime.jpg') }}" class="cover-photo">
</div>
<!-- Profile Card -->
<div class="profile-card">
  <!-- Avatar -->
  <div class="avatar-wrap">
    <img class="avatar" src="{{ asset('profile/'.$avatar) }}">
    <a href="{{ route('akun.edit') }}" class="avatar-camera">
      <i class="bi bi-camera"></i>
    </a>
  </div>

  <!-- Meta (nama, status, tabs) -->
  <div class="profile-meta" style="margin-top:80px;"> <!-- <-- margin-top menyesuaikan avatar -->
    <h3 style="margin-bottom:5px;">{{ Auth::user()->name }}</h3>
    <p class="small-muted">{{ $profile->status ?? 'Belum ada status' }}</p>

    <div class="profile-tabs">
      <div class="tab-link active" data-tab="posts">Postingan</div>
      <div class="tab-link" data-tab="photos">Download</div>
    </div>
  </div>
</div>
<!-- Main Content -->
<div class="container-main">

  <!-- Left Sidebar -->
  <div>
    <div class="card-slim">
      <h6>Tentang</h6>
      <p class="small-muted"><strong>Lokasi:</strong> {{ $profile->location ?? 'Depok, Jawa Barat' }}</p>
      <p class="small-muted"><strong>Bergabung:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
      <p class="small-muted"><strong>Email:</strong> {{ Auth::user()->email }}</p>
    </div>
  </div>
<!-- ================== CONTENT UTAMA (POSTS, PHOTOS, ABOUT) ================== -->
 <div id="tabContent">
 {{-- ================= POSTINGAN ================= --}}
<div id="tab-posts" class="tab-section">
    <div class="card-slim max-w-2xl mx-auto">
        <h6 class="text-lg font-semibold mb-3">Postingan</h6>

        <div class="grid grid-cols-3 gap-3">
            @php $count = 0; @endphp

            @forelse($posts as $post)
                @if($post->image && $count < 9)
                    @php $count++; @endphp

                    <div class="relative aspect-square rounded-lg overflow-hidden group">

                        <!-- IMAGE -->
                        <img 
                            src="{{ asset('images/'.$post->image) }}"
                            class="w-full h-full object-cover"
                        >

                        <!-- DELETE BUTTON (muncul saat klik / focus) -->
                        <form 
                            action="{{ route('gallery.destroy', $post->id) }}" 
                            method="POST"
                            class="absolute top-2 right-2 opacity-0 group-focus-within:opacity-100 group-hover:opacity-100 transition"
                        >
                            @csrf
                            @method('DELETE')

                            <button 
                                type="submit"
                                onclick="return confirm('Hapus gambar ini?')"
                                class="bg-red-600 text-white text-xs px-2 py-1 rounded"
                            >
                                Hapus
                            </button>
                        </form>

                    </div>

                @endif
            @empty
                <div class="col-span-3 text-center text-gray-400 py-6">
                    Belum ada postingan.
                </div>
            @endforelse
        </div>
    </div>
</div>
{{-- ============= Download ================= --}}
<div id="tab-photos" class="tab-section d-none">
    <div class="card-slim photos-wrapper">
        <h6 class="photos-title">Download</h6>
        <div class="photos-grid">
            @forelse($images as $image)
                <div class="photo-item">
                    <img src="{{ $image }}" alt="Foto">
                </div>
            @empty
                <div class="empty-text">
                    Belum ada foto.
                </div>
            @endforelse
        </div>

    </div>
</div>
    {{-- ================= ABOUT ================= --}}
    <div id="tab-about" class="tab-section d-none">
        <div class="card-slim">
            <h6>Informasi</h6>
            <p class="text-gray-300 text-sm">
                Informasi akun di sini.
            </p>
        </div>
    </div>

</div>

  <!-- Right Sidebar -->
<div>
  <div class="card-slim">
    <h6>Teman</h6>

    <div class="friend-item d-flex align-items-center gap-2 mb-2">
        <img src="{{ asset('images/tewa.jpg') }}" 
             width="40" height="40"
             style="border-radius:50%; object-fit:cover;">
        <div><strong>Pemalas YT</strong></div>
    </div>

    <div class="friend-item d-flex align-items-center gap-2 mb-2">
        <img src="{{ asset('images/anime.jpg') }}" 
             width="40" height="40"
             style="border-radius:50%; object-fit:cover;">
        <div><strong>Wibu kalcer</strong></div>
    </div>

    <div class="friend-item d-flex align-items-center gap-2 mb-2">
        <img src="{{ asset('images/hama.jpg') }}" 
             width="40" height="40"
             style="border-radius:50%; object-fit:cover;">
        <div><strong>Pacarnya Iwan</strong></div>
    </div>

  </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const tabLinks = document.querySelectorAll('.tab-link');
const tabSections = document.querySelectorAll('.tab-section');

tabLinks.forEach(link => {
  link.addEventListener('click', () => {
    tabLinks.forEach(l => l.classList.remove('active'));
    link.classList.add('active');
    const target = link.getAttribute('data-tab');
    tabSections.forEach(sec => {
      sec.classList.toggle('d-none', sec.id !== 'tab-' + target);
    });
  });
});
</script>
</body>
</html>