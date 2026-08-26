<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Akun Saya - GallSpace</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>

        /* =========================================================
           ROOT
        ========================================================= */

        :root {
            --primary: #0d6efd;
            --primary-dark: #0b5ed7;

            --background: #101010;
            --card-bg: #1c1c1c;
            --card-bg-2: #202020;

            --text: #eeeeee;
            --muted-text: #aaaaaa;

            --border: rgba(255,255,255,0.06);

            --hover: #272727;

            --shadow:
                0 10px 30px rgba(0,0,0,0.55);
        }


        /* =========================================================
           BODY
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;

            background:
                radial-gradient(
                    circle at top,
                    #1b1b1b 0%,
                    #101010 45%
                );

            color: var(--text);

            margin-top: 80px;

            min-height: 100vh;
        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar {
            background: rgba(28,28,28,0.96) !important;

            backdrop-filter: blur(12px);

            box-shadow:
                0 3px 20px rgba(0,0,0,0.7);

            border-bottom:
                1px solid rgba(255,255,255,0.04);
        }

        .navbar-brand {
            color: white !important;
        }

        .navbar-brand span {
            letter-spacing: -0.3px;
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
        }

        .navbar a.nav-link {
            color: #eeeeee !important;

            transition:
                color .25s ease,
                transform .25s ease;
        }

        .navbar a.nav-link:hover {
            color: var(--primary) !important;
        }

        .navbar .dropdown-toggle {
            padding: 7px 10px;

            border-radius: 12px;

            transition:
                background .25s ease;
        }

        .navbar .dropdown-toggle:hover {
            background: rgba(255,255,255,0.05);
        }


        /* Navbar avatar */

        .navbar-avatar {
            width: 36px;
            height: 36px;

            border-radius: 50%;

            object-fit: cover;

            border: 2px solid #333;
        }

        .navbar-avatar-placeholder {
            width: 36px;
            height: 36px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #6610f2
                );

            color: white;

            font-size: 18px;

            border: 2px solid #333;

            flex-shrink: 0;
        }


        /* Dropdown */

        .dropdown-menu {
            background: #202020;

            border: 1px solid rgba(255,255,255,0.06);

            border-radius: 14px;

            padding: 8px;

            box-shadow:
                0 12px 30px rgba(0,0,0,0.65);
        }

        .dropdown-item {
            border-radius: 9px;

            padding: 9px 12px;

            transition:
                background .2s ease,
                color .2s ease;
        }

        .dropdown-item:hover {
            background: var(--primary);

            color: white !important;
        }

        .dropdown-divider {
            border-color: #444;
        }


        /* =========================================================
           COVER
        ========================================================= */

        .profile-header {
            height: 300px;

            max-width: 1250px;

            margin: 0 auto;

            border-radius: 20px;

            overflow: hidden;

            position: relative;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.65);

            border:
                1px solid rgba(255,255,255,0.05);
        }

        .profile-header::after {
            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    to bottom,
                    rgba(0,0,0,0.05),
                    rgba(0,0,0,0.4)
                );

            pointer-events: none;
        }

        .cover-photo {
            width: 100%;
            height: 100%;

            object-fit: cover;

            filter:
                brightness(0.45)
                saturate(1.1);

            transition:
                transform .7s ease;
        }

        .profile-header:hover .cover-photo {
            transform: scale(1.04);
        }


        /* =========================================================
           PROFILE CARD
        ========================================================= */

        .profile-card {
            max-width: 1100px;

            margin:
                -80px auto 2rem;

            position: relative;

            background:
                linear-gradient(
                    145deg,
                    #202020,
                    #181818
                );

            border-radius: 22px;

            padding:
                2rem
                2rem
                2.5rem;

            text-align: center;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.65);

            border:
                1px solid rgba(255,255,255,0.05);
        }


        /* =========================================================
           AVATAR
        ========================================================= */

        .avatar-wrap {
            position: absolute;

            left: 50%;

            top: -70px;

            transform: translateX(-50%);

            z-index: 5;
        }

        .avatar {
            width: 140px;
            height: 140px;

            border-radius: 50%;

            object-fit: cover;

            border: 5px solid #1e1e1e;

            box-shadow:
                0 8px 25px rgba(0,0,0,0.7),
                0 0 0 2px rgba(13,110,253,0.25);

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }

        .avatar:hover {
            transform: scale(1.05);

            box-shadow:
                0 12px 30px rgba(0,0,0,0.8),
                0 0 0 3px rgba(13,110,253,0.35);
        }


        /* Avatar kosong */

        .avatar-placeholder {
            display: flex;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd 0%,
                    #6610f2 50%,
                    #6f42c1 100%
                );

            color:
                rgba(255,255,255,0.95);

            font-size: 65px;

            user-select: none;
        }

        .avatar-placeholder i {
            transform: translateY(3px);
        }


        /* Camera */

        .avatar-camera {
            position: absolute;

            bottom: 3px;
            right: -2px;

            width: 43px;
            height: 43px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            background: var(--primary);

            color: white;

            border: 3px solid #1e1e1e;

            text-decoration: none;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.65);

            transition:
                all .3s ease;
        }

        .avatar-camera:hover {
            background: var(--primary-dark);

            color: white;

            transform: scale(1.1);
        }


        /* =========================================================
           PROFILE META
        ========================================================= */

        .profile-meta {
            margin-top: 80px;
        }

        .profile-meta h3 {
            color: white;

            font-size: 1.5rem;

            font-weight: 700;

            margin-top: 10px;

            margin-bottom: 5px;

            letter-spacing: -0.4px;
        }

        .small-muted {
            color: var(--muted-text);

            font-size: 0.9rem;

            line-height: 1.6;
        }


        /* =========================================================
           TABS
        ========================================================= */

        .profile-tabs {
            display: flex;

            justify-content: center;

            gap: 10px;

            border-bottom:
                1px solid #333;

            padding-bottom: 10px;

            margin-top: 20px;
        }

        .tab-link {
            padding:
                8px 18px;

            font-weight: 600;

            font-size: 14px;

            border-radius: 12px;

            cursor: pointer;

            color: #aaa;

            transition:
                all .25s ease;
        }

        .tab-link:hover {
            background: var(--hover);

            color: white;
        }

        .tab-link.active {
            background: var(--primary);

            color: white;

            box-shadow:
                0 5px 15px rgba(13,110,253,0.25);
        }


        /* =========================================================
           MAIN LAYOUT
        ========================================================= */

        .container-main {
            max-width: 1250px;

            margin:
                2rem auto 3rem;

            display: grid;

            grid-template-columns:
                280px
                minmax(0, 640px)
                300px;

            gap: 1.5rem;
        }


        /* =========================================================
           CARDS
        ========================================================= */

        .card-slim {
            background:
                linear-gradient(
                    145deg,
                    #1e1e1e,
                    #191919
                );

            border-radius: 18px;

            padding: 1.4rem;

            box-shadow:
                0 8px 25px rgba(0,0,0,0.45);

            border:
                1px solid rgba(255,255,255,0.04);

            color: var(--text);

            transition:
                transform .3s ease,
                background .3s ease,
                box-shadow .3s ease;
        }

        .card-slim:hover {
            transform: translateY(-3px);

            background: #222;

            box-shadow:
                0 12px 30px rgba(0,0,0,0.55);
        }

        .card-slim h6 {
            color: white;

            font-weight: 700;

            margin-bottom: 15px;
        }


        /* =========================================================
           INFO
        ========================================================= */

        .info-item {
            display: flex;

            align-items: flex-start;

            gap: 10px;

            margin-bottom: 14px;
        }

        .info-icon {
            width: 32px;
            height: 32px;

            flex-shrink: 0;

            border-radius: 9px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                rgba(13,110,253,0.12);

            color: var(--primary);
        }

        .info-text {
            font-size: 13px;

            color: #aaa;

            line-height: 1.5;
        }

        .info-text strong {
            color: #ddd;

            display: block;
        }


        /* =========================================================
           PHOTO / POST GRID
        ========================================================= */

        .photos-wrapper {
            padding: 1.3rem;
        }

        .photos-title {
            margin-bottom: 5px;
        }

        .photos-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 10px;

            margin-top: 15px;

            padding-top: 15px;

            border-top:
                1px solid #2a2a2a;
        }

        .photo-item {
            width: 100%;

            aspect-ratio: 1 / 1;

            overflow: hidden;

            border-radius: 13px;

            position: relative;

            background: #292929;
        }

        .photos-grid img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;

            transition:
                transform .4s ease,
                filter .4s ease;
        }

        .photo-item:hover img {
            transform: scale(1.07);

            filter:
                brightness(0.75);
        }


        /* =========================================================
           DELETE BUTTON
        ========================================================= */

        .delete-button {
            position: absolute;

            top: 8px;
            right: 8px;

            width: 34px;
            height: 34px;

            border: none;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                rgba(220,53,69,0.95);

            color: white;

            opacity: 0;

            transform:
                translateY(-5px);

            transition:
                all .25s ease;

            box-shadow:
                0 4px 12px rgba(0,0,0,0.5);
        }

        .photo-item:hover .delete-button {
            opacity: 1;

            transform:
                translateY(0);
        }

        .delete-button:hover {
            background:
                #dc3545;

            transform:
                scale(1.1) !important;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            grid-column:
                1 / -1;

            min-height: 180px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            text-align: center;

            color: #888;
        }

        .empty-state-icon {
            width: 65px;
            height: 65px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            margin-bottom: 12px;

            background:
                rgba(255,255,255,0.05);

            color: #777;

            font-size: 27px;
        }

        .empty-state p {
            margin: 0;

            font-size: 13px;
        }


        /* =========================================================
           FRIENDS
        ========================================================= */

        .friend-item {
            display: flex;

            align-items: center;

            gap: 10px;

            padding: 8px;

            margin-bottom: 5px;

            border-radius: 12px;

            transition:
                background .25s ease;
        }

        .friend-item:hover {
            background:
                rgba(255,255,255,0.04);
        }

        .friend-item img {
            width: 45px;
            height: 45px;

            border-radius: 50%;

            object-fit: cover;

            border:
                2px solid #333;
        }

        .friend-item strong {
            color: #ddd;

            font-size: 13px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .container-main {
                grid-template-columns:
                    230px
                    minmax(0, 1fr)
                    230px;

                padding:
                    0 15px;
            }

            .profile-header {
                margin-left: 15px;
                margin-right: 15px;
            }

            .profile-card {
                margin-left: 15px;
                margin-right: 15px;
            }
        }


        @media (max-width: 900px) {

            .container-main {
                grid-template-columns:
                    1fr;

                max-width: 700px;
            }

            .container-main > div:first-child {
                order: 2;
            }

            .container-main > div:nth-child(2) {
                order: 1;
            }

            .container-main > div:last-child {
                order: 3;
            }
        }


        @media (max-width: 600px) {

            body {
                margin-top: 70px;
            }

            .navbar-brand img {
                height: 42px;
            }

            .profile-header {
                height: 220px;

                margin-left: 10px;
                margin-right: 10px;

                border-radius: 15px;
            }

            .profile-card {
                margin:
                    -60px 10px 1.5rem;

                padding:
                    1.5rem 1rem 1.8rem;

                border-radius: 18px;
            }

            .avatar {
                width: 120px;
                height: 120px;
            }

            .avatar-placeholder {
                font-size: 55px;
            }

            .avatar-camera {
                width: 38px;
                height: 38px;
            }

            .profile-meta {
                margin-top: 70px;
            }

            .profile-meta h3 {
                font-size: 1.3rem;
            }

            .profile-tabs {
                gap: 5px;
            }

            .tab-link {
                padding:
                    7px 14px;

                font-size: 13px;
            }

            .container-main {
                padding:
                    0 10px;

                margin-top: 1rem;
            }

            .photos-grid {
                gap: 6px;
            }

            .photo-item {
                border-radius: 9px;
            }

            .delete-button {
                opacity: 1;

                width: 30px;
                height: 30px;

                top: 5px;
                right: 5px;
            }
        }

    </style>
</head>


<body>

@php
    $profile = optional(Auth::user()->profile);

    /*
    |--------------------------------------------------------------------------
    | Avatar
    |--------------------------------------------------------------------------
    | Kalau user belum punya foto:
    | $avatar = null
    |
    | Maka akan menggunakan avatar placeholder.
    */

    $avatar = $profile->avatar ?? null;

    $hasAvatar = !empty($avatar);
@endphp


<!-- =========================================================
     NAVBAR
========================================================= -->

<nav
    class="navbar navbar-expand-lg fixed-top navbar-dark"
>

    <div class="container">

        <!-- Logo -->

        <a
            class="navbar-brand d-flex align-items-center"
            href="{{ route('dashboard') }}"
        >

            <img
                src="{{ asset('logo/logo.png') }}"
                alt="Logo GallSpace"
            >

            <span class="ms-2 fw-bold">
                GallSpace
            </span>

        </a>


        <!-- Mobile Toggle -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navMenu"
        >

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- Menu -->

        <div
            class="collapse navbar-collapse"
            id="navMenu"
        >

            <ul
                class="navbar-nav ms-auto align-items-center"
            >

                <!-- Home -->

                <li class="nav-item me-3">

                    <a
                        class="nav-link fw-semibold"
                        href="{{ route('dashboard') }}"
                    >
                        Home
                    </a>

                </li>


                <!-- User -->

                <li class="nav-item dropdown">

                    <a
                        class="nav-link dropdown-toggle d-flex align-items-center"
                        href="#"
                        data-bs-toggle="dropdown"
                    >

                        @if($hasAvatar)

                            <img
                                src="{{ asset('profile/'.$avatar) }}"
                                class="navbar-avatar me-2"
                                alt="Profile"
                            >

                        @else

                            <div class="navbar-avatar-placeholder me-2">

                                <i class="bi bi-person-fill"></i>

                            </div>

                        @endif


                        <span class="fw-medium">
                            {{ Auth::user()->name }}
                        </span>

                    </a>


                    <ul
                        class="dropdown-menu dropdown-menu-end"
                    >

                        <li>

                            <a
                                class="dropdown-item text-light"
                                href="{{ route('akun') }}"
                            >
                                <i class="bi bi-person me-2"></i>
                                Akun Saya
                            </a>

                        </li>


                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>

                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-danger w-100"
                                >

                                    <i class="bi bi-box-arrow-right me-1"></i>

                                    Logout

                                </button>

                            </form>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>



<!-- =========================================================
     COVER
========================================================= -->

<div class="profile-header">

    <img
        src="{{ asset('anime/anime.jpg') }}"
        class="cover-photo"
        alt="Cover Profile"
    >

</div>



<!-- =========================================================
     PROFILE CARD
========================================================= -->

<div class="profile-card">


    <!-- Avatar -->

    <div class="avatar-wrap">

        @if($hasAvatar)

            <!-- Jika ada foto -->

            <img
                class="avatar"
                src="{{ asset('profile/'.$avatar) }}"
                alt="Foto Profil {{ Auth::user()->name }}"
            >

        @else

            <!-- Jika belum ada foto -->

            <div
                class="avatar avatar-placeholder"
                title="Belum ada foto profil"
            >

                <i class="bi bi-person-fill"></i>

            </div>

        @endif


        <!-- Tombol edit foto -->

        <a
            href="{{ route('akun.edit') }}"
            class="avatar-camera"
            title="Ubah foto profil"
        >

            <i class="bi bi-camera-fill"></i>

        </a>

    </div>



    <!-- Profile Information -->

    <div class="profile-meta">

        <h3>
            {{ Auth::user()->name }}
        </h3>


        <p class="small-muted mb-0">

            {{ Auth::user()->bio ?? 'Belum ada status' }}

        </p>



        <!-- Tabs -->

        <div class="profile-tabs">

            <div
                class="tab-link active"
                data-tab="posts"
            >

                <i class="bi bi-grid-3x3-gap-fill me-1"></i>

                Postingan

            </div>


            <div
                class="tab-link"
                data-tab="photos"
            >

                <i class="bi bi-download me-1"></i>

                Download

            </div>

        </div>

    </div>

</div>



<!-- =========================================================
     MAIN CONTENT
========================================================= -->

<div class="container-main">


    <!-- =====================================================
         LEFT SIDEBAR
    ====================================================== -->

    <div>

        <div class="card-slim">

            <h6>
                <i class="bi bi-person-lines-fill me-2 text-primary"></i>
                Tentang
            </h6>


            <!-- Location -->

            <div class="info-item">

                <div class="info-icon">

                    <i class="bi bi-geo-alt-fill"></i>

                </div>

                <div class="info-text">

                    <strong>Lokasi</strong>

                    {{ $profile->location ?? 'Depok, Jawa Barat' }}

                </div>

            </div>


            <!-- Joined -->

            <div class="info-item">

                <div class="info-icon">

                    <i class="bi bi-calendar3"></i>

                </div>

                <div class="info-text">

                    <strong>Bergabung</strong>

                    {{ Auth::user()->created_at->format('d M Y') }}

                </div>

            </div>


            <!-- Email -->

            <div class="info-item mb-0">

                <div class="info-icon">

                    <i class="bi bi-envelope-fill"></i>

                </div>

                <div class="info-text">

                    <strong>Email</strong>

                    {{ Auth::user()->email }}

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div id="tabContent">


        <!-- =================================================
             POSTINGAN
        ================================================== -->

        <div
            id="tab-posts"
            class="tab-section"
        >

            <div class="card-slim photos-wrapper">

                <h6 class="photos-title">

                    <i class="bi bi-images me-2 text-primary"></i>

                    Postingan

                </h6>


                <div class="photos-grid">

                    @forelse($posts->take(9) as $post)

                        <div class="photo-item">


                            <!-- IMAGE -->

                            <img
                                src="{{ asset('images/'.$post->image) }}"
                                alt="Post Image"
                            >


                            <!-- DELETE -->

                            <form
                                action="{{ route('gallery.destroy', $post->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus postingan ini?')"
                            >

                                @csrf

                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="delete-button"
                                    title="Hapus postingan"
                                >

                                    <i class="bi bi-trash-fill"></i>

                                </button>

                            </form>

                        </div>

                    @empty


                        <!-- EMPTY -->

                        <div class="empty-state">

                            <div class="empty-state-icon">

                                <i class="bi bi-image"></i>

                            </div>

                            <p>
                                Belum ada postingan.
                            </p>

                            <small class="text-secondary">
                                Posting foto pertama kamu di GallSpace.
                            </small>

                        </div>


                    @endforelse

                </div>

            </div>

        </div>



        <!-- =================================================
             DOWNLOAD
        ================================================== -->

        <div
            id="tab-photos"
            class="tab-section d-none"
        >

            <div class="card-slim photos-wrapper">

                <h6 class="photos-title">

                    <i class="bi bi-download me-2 text-primary"></i>

                    Download

                </h6>


                <div class="photos-grid">

                    @forelse($images as $image)

                        <div class="photo-item">

                            <img
                                src="{{ $image }}"
                                alt="Foto Download"
                            >

                        </div>

                    @empty


                        <!-- EMPTY -->

                        <div class="empty-state">

                            <div class="empty-state-icon">

                                <i class="bi bi-cloud-download"></i>

                            </div>

                            <p>
                                Belum ada foto.
                            </p>

                            <small class="text-secondary">
                                Foto yang kamu download akan muncul di sini.
                            </small>

                        </div>


                    @endforelse

                </div>

            </div>

        </div>



        <!-- =================================================
             ABOUT
        ================================================== -->

        <div
            id="tab-about"
            class="tab-section d-none"
        >

            <div class="card-slim">

                <h6>

                    <i class="bi bi-info-circle me-2 text-primary"></i>

                    Informasi

                </h6>

                <p class="small-muted mb-0">

                    Informasi akun di sini.

                </p>

            </div>

        </div>


    </div>



    <!-- =====================================================
         RIGHT SIDEBAR
    ====================================================== -->

    <div>

        <div class="card-slim">

            <h6>

                <i class="bi bi-people-fill me-2 text-primary"></i>

                Teman

            </h6>


            <!-- Friend 1 -->

            <div class="friend-item">

                <img
                    src="{{ asset('images/tewa.jpg') }}"
                    alt="Pemalas YT"
                >

                <div>

                    <strong>
                        Pemalas YT
                    </strong>

                </div>

            </div>


            <!-- Friend 2 -->

            <div class="friend-item">

                <img
                    src="{{ asset('images/anime.jpg') }}"
                    alt="Wibu kalcer"
                >

                <div>

                    <strong>
                        Wibu kalcer
                    </strong>

                </div>

            </div>


            <!-- Friend 3 -->

            <div class="friend-item">

                <img
                    src="{{ asset('images/hama.jpg') }}"
                    alt="Pacarnya Iwan"
                >

                <div>

                    <strong>
                        Pacarnya Iwan
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- =========================================================
     BOOTSTRAP JS
========================================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</script>



<!-- =========================================================
     TAB SCRIPT
========================================================= -->

<script>

    const tabLinks =
        document.querySelectorAll('.tab-link');

    const tabSections =
        document.querySelectorAll('.tab-section');


    tabLinks.forEach(link => {

        link.addEventListener('click', () => {

            /*
            |--------------------------------------------------------------------------
            | Remove active dari semua tab
            |--------------------------------------------------------------------------
            */

            tabLinks.forEach(item => {

                item.classList.remove('active');

            });


            /*
            |--------------------------------------------------------------------------
            | Aktifkan tab yang diklik
            |--------------------------------------------------------------------------
            */

            link.classList.add('active');


            /*
            |--------------------------------------------------------------------------
            | Ambil target
            |--------------------------------------------------------------------------
            */

            const target =
                link.getAttribute('data-tab');


            /*
            |--------------------------------------------------------------------------
            | Tampilkan section yang sesuai
            |--------------------------------------------------------------------------
            */

            tabSections.forEach(section => {

                if (
                    section.id ===
                    'tab-' + target
                ) {

                    section.classList.remove('d-none');

                } else {

                    section.classList.add('d-none');

                }

            });

        });

    });

</script>


</body>
</html>
