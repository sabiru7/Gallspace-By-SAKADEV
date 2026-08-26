<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Explore - GallSpace</title>


    <!-- =====================================================
         TAILWIND
    ====================================================== -->

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- =====================================================
         BOOTSTRAP ICONS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    >


    <!-- =====================================================
         GOOGLE FONT
    ====================================================== -->

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- =====================================================
         STYLE
    ====================================================== -->

    <style>

        /* =====================================================
           ROOT
        ====================================================== */

        :root {

            --primary: #0d6efd;

            --background: #101010;

            --card-bg: #1c1c1c;

            --text: #eeeeee;

            --muted: #999;

            --border:
                rgba(255,255,255,0.07);

        }


        /* =====================================================
           BODY
        ====================================================== */

        * {
            box-sizing: border-box;
        }

        body {

            font-family:
                'Poppins',
                sans-serif;

            background:
                radial-gradient(
                    circle at top,
                    #1c1c1c 0%,
                    #101010 42%,
                    #080808 100%
                );

            color: var(--text);

            min-height: 100vh;

            opacity: 0;

            transition:
                opacity .8s ease;

        }


        /* =====================================================
           NAVBAR
        ====================================================== */

        .glass {

            background:
                rgba(25,25,25,0.82);

            backdrop-filter:
                blur(16px);

            -webkit-backdrop-filter:
                blur(16px);

            border-bottom:
                1px solid var(--border);

        }


        .navbar {

            box-shadow:
                0 5px 25px rgba(0,0,0,0.35);

        }


        /* Logo */

        .logo {

            filter:
                drop-shadow(
                    0 0 8px
                    rgba(255,255,255,0.35)
                );

            transition:
                transform .3s ease,
                filter .3s ease;

        }

        .logo:hover {

            transform:
                scale(1.06);

            filter:
                drop-shadow(
                    0 0 14px
                    rgba(255,255,255,0.55)
                );

        }


        /* Navbar links */

        .nav-link {

            position: relative;

            color: #aaa;

            transition:
                color .25s ease;

        }

        .nav-link:hover {

            color: white;

        }

        .nav-link.active {

            color:
                #facc15;

        }

        .nav-link.active::after {

            content: "";

            position: absolute;

            left: 0;
            right: 0;

            bottom: -8px;

            height: 2px;

            border-radius: 10px;

            background:
                #facc15;

            box-shadow:
                0 0 10px
                rgba(250,204,21,.5);

        }


        /* =====================================================
           PROFILE AVATAR
        ====================================================== */

        .profile-avatar {

            width: 42px;
            height: 42px;

            border-radius: 50%;

            object-fit: cover;

            border:
                2px solid
                rgba(255,255,255,0.25);

            box-shadow:
                0 4px 15px
                rgba(0,0,0,.5);

            transition:
                all .3s ease;

        }

        .profile-avatar:hover {

            transform:
                scale(1.07);

            border-color:
                rgba(13,110,253,.8);

        }


        /* Avatar kosong */

        .profile-avatar-placeholder {

            width: 42px;
            height: 42px;

            border-radius: 50%;

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

            color: white;

            font-size: 21px;

            border:
                2px solid
                rgba(255,255,255,0.2);

            box-shadow:
                0 4px 15px
                rgba(0,0,0,.5);

            transition:
                all .3s ease;

        }

        .profile-avatar-placeholder:hover {

            transform:
                scale(1.07);

            box-shadow:
                0 5px 20px
                rgba(13,110,253,.35);

        }


        /* =====================================================
           HERO
        ====================================================== */

        .hero {

            position: relative;

            padding:
                70px 20px 45px;

            text-align: center;

        }


        .hero-badge {

            display:
                inline-flex;

            align-items: center;

            gap: 7px;

            padding:
                7px 14px;

            border-radius:
                999px;

            background:
                rgba(13,110,253,.1);

            border:
                1px solid
                rgba(13,110,253,.25);

            color:
                #60a5fa;

            font-size:
                12px;

            margin-bottom:
                18px;

        }


        .hero h1 {

            font-size:
                clamp(
                    28px,
                    4vw,
                    43px
                );

            font-weight:
                700;

            letter-spacing:
                -1px;

            margin-bottom:
                12px;

            background:
                linear-gradient(
                    90deg,
                    #ffffff,
                    #b8c8e8
                );

            -webkit-background-clip:
                text;

            -webkit-text-fill-color:
                transparent;

        }


        .hero p {

            max-width:
                620px;

            margin:
                0 auto 28px;

            color:
                #888;

            font-size:
                14px;

            line-height:
                1.7;

        }


        /* =====================================================
           SEARCH
        ====================================================== */

        .search-wrapper {

            max-width:
                600px;

            margin:
                0 auto;

            position:
                relative;

        }


        .search-icon {

            position:
                absolute;

            left:
                18px;

            top:
                50%;

            transform:
                translateY(-50%);

            color:
                #777;

            font-size:
                17px;

            pointer-events:
                none;

        }


        #searchInput {

            width:
                100%;

            height:
                54px;

            padding:
                0 50px;

            border-radius:
                16px;

            border:
                1px solid
                rgba(255,255,255,.08);

            background:
                rgba(255,255,255,.06);

            color:
                white;

            outline:
                none;

            backdrop-filter:
                blur(10px);

            box-shadow:
                0 10px 35px
                rgba(0,0,0,.3);

            transition:
                all .3s ease;

        }


        #searchInput::placeholder {

            color:
                #777;

        }


        #searchInput:focus {

            border-color:
                rgba(13,110,253,.7);

            background:
                rgba(255,255,255,.08);

            box-shadow:
                0 0 0 4px
                rgba(13,110,253,.1),
                0 10px 35px
                rgba(0,0,0,.35);

        }


        .clear-search {

            position:
                absolute;

            right:
                15px;

            top:
                50%;

            transform:
                translateY(-50%);

            width:
                28px;

            height:
                28px;

            border:
                none;

            border-radius:
                50%;

            display:
                none;

            align-items:
                center;

            justify-content:
                center;

            background:
                rgba(255,255,255,.1);

            color:
                #aaa;

            cursor:
                pointer;

        }


        .clear-search:hover {

            background:
                rgba(255,255,255,.18);

            color:
                white;

        }


        /* =====================================================
           GALLERY CONTAINER
        ====================================================== */

        .gallery-container {

            max-width:
                1280px;

            margin:
                0 auto;

            padding:
                10px 24px 80px;

        }


        /* =====================================================
           RESULT INFO
        ====================================================== */

        .gallery-info {

            display:
                flex;

            justify-content:
                space-between;

            align-items:
                center;

            margin-bottom:
                18px;

            color:
                #777;

            font-size:
                12px;

        }


        .result-count {

            color:
                #999;

        }


        /* =====================================================
           GALLERY
        ====================================================== */

        #gallery {

            column-gap:
                20px;

        }


        /* =====================================================
           GALLERY CARD
        ====================================================== */

        .gallery-card {

            display:
                inline-block;

            width:
                100%;

            margin-bottom:
                20px;

            border-radius:
                20px;

            overflow:
                hidden;

            position:
                relative;

            background:
                linear-gradient(
                    145deg,
                    rgba(35,35,35,.9),
                    rgba(20,20,20,.9)
                );

            border:
                1px solid
                rgba(255,255,255,.05);

            box-shadow:
                0 10px 30px
                rgba(0,0,0,.3);

            transition:
                transform .4s ease,
                box-shadow .4s ease,
                border-color .4s ease;

            opacity:
                0;

            transform:
                translateY(40px);

        }


        .gallery-card.show {

            opacity:
                1;

            transform:
                translateY(0);

        }


        .gallery-card:hover {

            transform:
                translateY(-7px);

            border-color:
                rgba(255,255,255,.1);

            box-shadow:
                0 25px 55px
                rgba(0,0,0,.55);

        }


        /* =====================================================
           IMAGE
        ====================================================== */

        .image-wrapper {

            position:
                relative;

            overflow:
                hidden;

            border-radius:
                16px;

        }


        .gallery-card img {

            display:
                block;

            width:
                100%;

            height:
                auto;

            object-fit:
                cover;

            transition:
                transform .7s ease,
                filter .5s ease;

        }


        .gallery-card:hover img {

            transform:
                scale(1.06);

            filter:
                brightness(.82);

        }


        /* Image overlay */

        .image-overlay {

            position:
                absolute;

            inset:
                0;

            display:
                flex;

            align-items:
                flex-end;

            justify-content:
                space-between;

            padding:
                14px;

            opacity:
                0;

            background:
                linear-gradient(
                    to top,
                    rgba(0,0,0,.65),
                    transparent 55%
                );

            transition:
                opacity .35s ease;

        }


        .gallery-card:hover
        .image-overlay {

            opacity:
                1;

        }


        .overlay-btn {

            width:
                38px;

            height:
                38px;

            border:
                none;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                rgba(0,0,0,.55);

            color:
                white;

            backdrop-filter:
                blur(8px);

            cursor:
                pointer;

            transition:
                all .25s ease;

        }


        .overlay-btn:hover {

            background:
                rgba(255,255,255,.18);

            transform:
                scale(1.08);

        }


        /* =====================================================
           CARD CONTENT
        ====================================================== */

        .card-content {

            padding:
                14px 14px 15px;

        }


        .image-title {

            color:
                #eee;

            font-size:
                13px;

            font-weight:
                600;

            margin:
                0 0 10px;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;

        }


        .card-footer {

            display:
                flex;

            justify-content:
                space-between;

            align-items:
                center;

        }


        /* =====================================================
           LIKE
        ====================================================== */

        .like-btn {

            display:
                flex;

            align-items:
                center;

            gap:
                6px;

            border:
                none;

            background:
                transparent;

            color:
                #888;

            cursor:
                pointer;

            font-size:
                12px;

            padding:
                5px 7px;

            border-radius:
                8px;

            transition:
                all .25s ease;

        }


        .like-btn:hover {

            background:
                rgba(255,255,255,.05);

            color:
                #eee;

        }


        .like-btn.like-active {

            color:
                #ff4d6d;

        }


        .like-icon {

            font-size:
                16px;

        }


        @keyframes pop {

            0% {
                transform:
                    scale(1);
            }

            50% {
                transform:
                    scale(1.4);
            }

            100% {
                transform:
                    scale(1);
            }

        }


        .like-active .like-icon {

            animation:
                pop .3s ease;

        }


        /* =====================================================
           DOWNLOAD BUTTON
        ====================================================== */

        .download-btn {

            display:
                flex;

            align-items:
                center;

            gap:
                6px;

            padding:
                6px 9px;

            border-radius:
                8px;

            color:
                #888;

            font-size:
                12px;

            text-decoration:
                none;

            transition:
                all .25s ease;

        }


        .download-btn:hover {

            color:
                #4ade80;

            background:
                rgba(74,222,128,.08);

        }


        /* =====================================================
           EMPTY STATE
        ====================================================== */

        .empty-gallery {

            width:
                100%;

            min-height:
                350px;

            display:
                flex;

            flex-direction:
                column;

            align-items:
                center;

            justify-content:
                center;

            text-align:
                center;

            border-radius:
                20px;

            border:
                1px solid
                rgba(255,255,255,.05);

            background:
                rgba(255,255,255,.025);

        }


        .empty-icon {

            width:
                80px;

            height:
                80px;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            margin-bottom:
                18px;

            background:
                linear-gradient(
                    135deg,
                    #1d4ed8,
                    #6d28d9
                );

            color:
                white;

            font-size:
                32px;

            box-shadow:
                0 10px 30px
                rgba(37,99,235,.25);

        }


        .empty-gallery h3 {

            color:
                #ddd;

            font-size:
                16px;

            font-weight:
                600;

            margin-bottom:
                5px;

        }


        .empty-gallery p {

            color:
                #777;

            font-size:
                13px;

            margin:
                0;

        }


        /* =====================================================
           NO SEARCH RESULT
        ====================================================== */

        #noResult {

            display:
                none;

            text-align:
                center;

            padding:
                80px 20px;

            color:
                #777;

        }


        #noResult i {

            display:
                block;

            font-size:
                45px;

            margin-bottom:
                12px;

            color:
                #555;

        }


        /* =====================================================
           MOBILE MENU
        ====================================================== */

        .mobile-menu {

            display:
                none;

        }


        @media (max-width: 767px) {

            .desktop-menu {

                display:
                    none !important;

            }

            .mobile-menu {

                display:
                    flex;

            }

            .hero {

                padding:
                    50px 18px 35px;

            }

            .gallery-container {

                padding:
                    5px 14px 60px;

            }

            .gallery-info {

                margin-bottom:
                    12px;

            }

        }


        /* =====================================================
           TAILWIND COLUMN RESPONSIVE
        ====================================================== */

        @media (min-width: 640px) {

            #gallery {

                column-count:
                    2;

            }

        }


        @media (min-width: 768px) {

            #gallery {

                column-count:
                    3;

            }

        }


        @media (min-width: 1024px) {

            #gallery {

                column-count:
                    4;

            }

        }


    </style>

</head>


<body>


@php

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    $profile =
        optional(auth()->user()->profile);

    /*
    |--------------------------------------------------------------------------
    | Avatar
    |--------------------------------------------------------------------------
    |
    | Kalau avatar kosong/null:
    | gunakan placeholder gradient.
    |
    */

    $avatar =
        $profile->avatar ?? null;

    $hasAvatar =
        !empty($avatar);

@endphp



<!-- =========================================================
     NAVBAR
========================================================= -->

<nav
    class="navbar glass sticky top-0 z-50"
>

    <div
        class="max-w-7xl mx-auto px-5 md:px-8 py-3 w-full"
    >

        <div
            class="flex justify-between items-center"
        >


            <!-- LOGO -->

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3"
            >

                <img
                    src="{{ asset('logo/logo.png') }}"
                    class="logo w-11 h-11 md:w-12 md:h-12 object-contain"
                    alt="GallSpace"
                >

                <span
                    class="hidden sm:block font-bold text-lg"
                >
                    GallSpace
                </span>

            </a>



            <!-- DESKTOP MENU -->

            <div
                class="desktop-menu flex items-center gap-8 text-sm font-medium"
            >

                <a
                    href="{{ route('dashboard') }}"
                    class="nav-link"
                >
                    Home
                </a>


                <a
                    href="/jelajah"
                    class="nav-link active"
                >
                    Explore
                </a>


                <a
                    href="/upload"
                    class="nav-link"
                >
                    Upload
                </a>

            </div>



            <!-- RIGHT -->

            <div
                class="flex items-center gap-3"
            >

                @auth

                    <a
                        href="{{ route('akun') }}"
                        title="Akun Saya"
                    >

                        @if($hasAvatar)

                            <!-- FOTO PROFILE -->

                            <img
                                src="{{ asset('profile/'.$avatar) }}"
                                class="profile-avatar"
                                alt="Profile {{ auth()->user()->name }}"
                            >

                        @else

                            <!-- PROFILE KOSONG -->

                            <div
                                class="profile-avatar-placeholder"
                                title="Belum ada foto profil"
                            >

                                <i
                                    class="bi bi-person-fill"
                                ></i>

                            </div>

                        @endif

                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition font-semibold text-sm"
                    >

                        Login

                    </a>

                @endauth


                <!-- MOBILE MENU BUTTON -->

                <button
                    id="mobileMenuButton"
                    class="mobile-menu w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 items-center justify-center"
                >

                    <i
                        class="bi bi-list text-xl"
                    ></i>

                </button>

            </div>

        </div>



        <!-- MOBILE MENU -->

        <div
            id="mobileMenu"
            class="hidden pt-4 pb-2"
        >

            <div
                class="flex flex-col gap-2"
            >

                <a
                    href="{{ route('dashboard') }}"
                    class="px-4 py-3 rounded-xl hover:bg-white/5"
                >
                    Home
                </a>


                <a
                    href="/jelajah"
                    class="px-4 py-3 rounded-xl bg-yellow-400/10 text-yellow-400"
                >
                    Explore
                </a>


                <a
                    href="/upload"
                    class="px-4 py-3 rounded-xl hover:bg-white/5"
                >
                    Upload
                </a>

            </div>

        </div>

    </div>

</nav>



<!-- =========================================================
     HERO
========================================================= -->

<section
    class="hero"
>


    <div
        class="hero-badge"
    >

        <i
            class="bi bi-stars"
        ></i>

        GallSpace Explore

    </div>


    <h1>
        Discover Amazing Artwork
    </h1>


    <p>
        Jelajahi berbagai karya seni, foto, dan gambar
        menarik dari komunitas GallSpace.
    </p>


    <!-- SEARCH -->

    <div
        class="search-wrapper"
    >

        <i
            class="bi bi-search search-icon"
        ></i>


        <input
            type="text"
            id="searchInput"
            placeholder="Cari gambar atau artwork..."
            autocomplete="off"
        >


        <button
            type="button"
            id="clearSearch"
            class="clear-search"
        >

            <i
                class="bi bi-x"
            ></i>

        </button>

    </div>

</section>



<!-- =========================================================
     GALLERY
========================================================= -->

<main
    class="gallery-container"
>


    <!-- INFO -->

    <div
        class="gallery-info"
    >

        <span>
            <i
                class="bi bi-grid-3x3-gap me-1"
            ></i>

            Explore Gallery
        </span>


        <span
            id="resultCount"
            class="result-count"
        >

            {{ count($images) }} gambar

        </span>

    </div>



    <!-- =====================================================
         GALLERY
    ====================================================== -->

    @if(count($images) > 0)

        <div
            id="gallery"
        >

            @foreach($images as $img)

                @php

                    $filename =
                        basename($img);

                    $cleanName =
                        strtolower(
                            pathinfo(
                                $filename,
                                PATHINFO_FILENAME
                            )
                        );

                @endphp


                <!-- GALLERY CARD -->

                <div
                    class="gallery-card"
                    data-name="{{ $cleanName }}"
                >


                    <!-- IMAGE -->

                    <div
                        class="image-wrapper"
                    >

                        <img
                            src="{{ $img }}"
                            alt="{{ ucfirst($cleanName) }}"
                            loading="lazy"
                        >


                        <!-- IMAGE OVERLAY -->

                        <div
                            class="image-overlay"
                        >

                            <button
                                type="button"
                                class="overlay-btn"
                                onclick="toggleLike(this)"
                            >

                                <i
                                    class="bi bi-heart-fill"
                                ></i>

                            </button>


                            <a
                                href="{{ $img }}"
                                download
                                class="overlay-btn"
                                title="Download"
                            >

                                <i
                                    class="bi bi-download"
                                ></i>

                            </a>

                        </div>

                    </div>



                    <!-- CONTENT -->

                    <div
                        class="card-content"
                    >

                        <h3
                            class="image-title"
                            title="{{ ucfirst($cleanName) }}"
                        >

                            {{ ucfirst($cleanName) }}

                        </h3>


                        <div
                            class="card-footer"
                        >


                            <!-- LIKE -->

                            <button
                                type="button"
                                class="like-btn"
                                onclick="toggleLike(this)"
                            >

                                <i
                                    class="bi bi-heart-fill like-icon"
                                ></i>

                                <span
                                    class="like-count"
                                >
                                    0
                                </span>

                            </button>



                            <!-- DOWNLOAD -->

                            <a
                                href="{{ $img }}"
                                download
                                class="download-btn"
                            >

                                <i
                                    class="bi bi-download"
                                ></i>

                                Download

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>



        <!-- NO SEARCH RESULT -->

        <div
            id="noResult"
        >

            <i
                class="bi bi-search"
            ></i>

            <h3
                class="text-gray-300 font-semibold mb-1"
            >
                Gambar tidak ditemukan
            </h3>

            <p>
                Coba gunakan kata kunci yang berbeda.
            </p>

        </div>


    @else


        <!-- =================================================
             EMPTY GALLERY
        ================================================== -->

        <div
            class="empty-gallery"
        >

            <div
                class="empty-icon"
            >

                <i
                    class="bi bi-images"
                ></i>

            </div>


            <h3>
                Belum ada gambar
            </h3>


            <p>
                Belum ada artwork yang tersedia di GallSpace.
            </p>

        </div>

    @endif


</main>



<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>


    /* ========================================================
       PAGE FADE IN
    ======================================================== */

    window.addEventListener(
        "load",
        () => {

            document.body.style.opacity =
                "1";

        }
    );



    /* ========================================================
       SCROLL REVEAL
    ======================================================== */

    const observer =
        new IntersectionObserver(
            entries => {

                entries.forEach(
                    entry => {

                        if (
                            entry.isIntersecting
                        ) {

                            entry.target
                                .classList
                                .add("show");

                        }

                    }
                );

            },
            {
                threshold:
                    0.08
            }
        );


    document
        .querySelectorAll(".gallery-card")
        .forEach(
            card => {

                observer.observe(card);

            }
        );



    /* ========================================================
       SEARCH
    ======================================================== */

    const searchInput =
        document.getElementById(
            "searchInput"
        );

    const clearSearch =
        document.getElementById(
            "clearSearch"
        );

    const noResult =
        document.getElementById(
            "noResult"
        );

    const resultCount =
        document.getElementById(
            "resultCount"
        );

    const cards =
        document.querySelectorAll(
            ".gallery-card"
        );


    searchInput.addEventListener(
        "input",
        function () {

            const value =
                this.value
                    .toLowerCase()
                    .trim();


            let visible =
                0;


            /*
            |--------------------------------------------------------------------------
            | Clear button
            |--------------------------------------------------------------------------
            */

            clearSearch.style.display =
                value.length > 0
                    ? "flex"
                    : "none";


            /*
            |--------------------------------------------------------------------------
            | Filter
            |--------------------------------------------------------------------------
            */

            cards.forEach(
                card => {

                    const name =
                        card.dataset.name
                            .toLowerCase();


                    if (
                        name.includes(value)
                    ) {

                        card.style.display =
                            "inline-block";

                        visible++;

                    } else {

                        card.style.display =
                            "none";

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Result count
            |--------------------------------------------------------------------------
            */

            resultCount.innerText =
                visible +
                " gambar";


            /*
            |--------------------------------------------------------------------------
            | No result
            |--------------------------------------------------------------------------
            */

            if (
                visible === 0 &&
                cards.length > 0
            ) {

                noResult.style.display =
                    "block";

            } else {

                noResult.style.display =
                    "none";

            }

        }
    );



    /* ========================================================
       CLEAR SEARCH
    ======================================================== */

    clearSearch.addEventListener(
        "click",
        () => {

            searchInput.value =
                "";

            searchInput.dispatchEvent(
                new Event("input")
            );

            searchInput.focus();

        }
    );



    /* ========================================================
       LIKE
    ======================================================== */

    function toggleLike(button) {

        /*
        |--------------------------------------------------------------------------
        | Kalau yang diklik adalah tombol overlay
        |--------------------------------------------------------------------------
        */

        if (
            button.classList.contains(
                "overlay-btn"
            )
        ) {

            button.classList.toggle(
                "liked"
            );

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | Tombol like di footer
        |--------------------------------------------------------------------------
        */

        const countSpan =
            button.querySelector(
                ".like-count"
            );

        const icon =
            button.querySelector(
                ".like-icon"
            );


        let count =
            parseInt(
                countSpan.innerText
            ) || 0;


        const active =
            button.classList.contains(
                "like-active"
            );


        if (!active) {

            button.classList.add(
                "like-active"
            );

            count++;

            icon.className =
                "bi bi-heart-fill like-icon";

        } else {

            button.classList.remove(
                "like-active"
            );

            count--;

            icon.className =
                "bi bi-heart like-icon";

        }


        countSpan.innerText =
            count;

    }



    /* ========================================================
       MOBILE MENU
    ======================================================== */

    const mobileMenuButton =
        document.getElementById(
            "mobileMenuButton"
        );

    const mobileMenu =
        document.getElementById(
            "mobileMenu"
        );


    if (
        mobileMenuButton &&
        mobileMenu
    ) {

        mobileMenuButton.addEventListener(
            "click",
            () => {

                mobileMenu
                    .classList
                    .toggle("hidden");

            }
        );

    }


</script>


</body>

</html>
