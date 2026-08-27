<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        GallSpace — Your Space for Creativity
    </title>


    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    >


    <!-- Poppins -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <style>

        * {
            box-sizing: border-box;
        }


        :root {

            --bg: #000000;

            --surface: #080808;

            --surface-2: #101010;

            --border: rgba(255,255,255,.08);

            --border-hover: rgba(255,255,255,.18);

            --text: #f5f5f5;

            --muted: #777777;

            --muted-light: #aaaaaa;

            --white: #ffffff;

        }


        html {
            scroll-behavior: smooth;
        }


        body {

            margin: 0;

            background: var(--bg);

            color: var(--text);

            font-family: 'Poppins', sans-serif;

            overflow-x: hidden;

        }


        a {

            color: inherit;

            text-decoration: none;

        }


        button {

            font-family: inherit;

        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar {

            position: fixed;

            top: 0;
            left: 0;
            right: 0;

            height: 76px;

            z-index: 1000;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 6%;

            background:
                rgba(0,0,0,.72);

            border-bottom:
                1px solid rgba(255,255,255,.06);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);

        }


        .brand {

            display: flex;

            align-items: center;

            gap: 10px;

            font-size: 18px;

            font-weight: 700;

            letter-spacing: -.7px;

        }


        .brand img {

            width: 38px;

            height: 38px;

            object-fit: contain;

        }


        .brand span {

            color: #ffffff;

        }


        .nav-right {

            display: flex;

            align-items: center;

            gap: 10px;

        }


        .nav-login {

            padding: 10px 17px;

            border:
                1px solid var(--border);

            border-radius: 10px;

            color: #cccccc;

            font-size: 11px;

            font-weight: 600;

            transition: .25s ease;

        }


        .nav-login:hover {

            color: #ffffff;

            background:
                rgba(255,255,255,.04);

            border-color:
                var(--border-hover);

        }


        .nav-register {

            padding: 10px 17px;

            border:
                1px solid #ffffff;

            border-radius: 10px;

            background: #ffffff;

            color: #000000;

            font-size: 11px;

            font-weight: 700;

            transition: .25s ease;

        }


        .nav-register:hover {

            background: #dddddd;

            border-color: #dddddd;

            transform:
                translateY(-2px);

        }


        /* =========================================================
           HERO
        ========================================================= */

        .hero {

            position: relative;

            min-height: 100vh;

            max-width: 1250px;

            margin: auto;

            padding:
                125px 35px 80px;

            display: grid;

            grid-template-columns:
                .9fr 1.1fr;

            align-items: center;

            gap: 70px;

            overflow: hidden;

        }


        .hero::before {

            content: "";

            position: absolute;

            width: 600px;

            height: 600px;

            right: -250px;

            top: 50px;

            background:
                radial-gradient(
                    circle,
                    rgba(255,255,255,.06),
                    transparent 68%
                );

            pointer-events: none;

        }


        .hero-content {

            position: relative;

            z-index: 5;

        }


        .eyebrow {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            margin-bottom: 23px;

            color: #ffffff;

            font-size: 9px;

            font-weight: 700;

            letter-spacing: 1.6px;

            text-transform: uppercase;

        }


        .eyebrow::before {

            content: "";

            width: 24px;

            height: 1px;

            background: #ffffff;

        }


        .hero h1 {

            max-width: 650px;

            margin: 0;

            font-size:
                clamp(45px, 6vw, 78px);

            line-height: .98;

            letter-spacing: -4px;

            font-weight: 800;

        }


        .hero h1 span {

            display: block;

            color: #666666;

        }


        .hero-description {

            max-width: 520px;

            margin: 25px 0 0;

            color: var(--muted);

            font-size: 13px;

            line-height: 1.9;

        }


        .hero-actions {

            display: flex;

            align-items: center;

            gap: 11px;

            margin-top: 32px;

        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .btn-main {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            padding: 14px 21px;

            border:
                1px solid #ffffff;

            border-radius: 11px;

            background: #ffffff;

            color: #000000;

            font-size: 11px;

            font-weight: 700;

            transition: .25s ease;

        }


        .btn-main:hover {

            background: #dddddd;

            border-color: #dddddd;

            transform:
                translateY(-3px);

            box-shadow:
                0 15px 35px
                rgba(255,255,255,.08);

        }


        .btn-outline {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            padding: 13px 19px;

            border:
                1px solid var(--border);

            border-radius: 11px;

            color: #dddddd;

            font-size: 11px;

            font-weight: 600;

            transition: .25s ease;

        }


        .btn-outline:hover {

            background:
                rgba(255,255,255,.05);

            border-color:
                var(--border-hover);

            color: #ffffff;

        }


        /* =========================================================
           VISUAL
        ========================================================= */

        .visual {

            position: relative;

            height: 570px;

        }


        .visual-card {

            position: absolute;

            overflow: hidden;

            border:
                1px solid var(--border);

            border-radius: 18px;

            background: var(--surface);

            box-shadow:
                0 30px 80px
                rgba(0,0,0,.65);

        }


        .visual-card img {

            width: 100%;

            height: 100%;

            display: block;

            object-fit: cover;

            filter:
                grayscale(100%);

            transition:
                transform .6s ease,
                filter .6s ease;

        }


        .visual-card:hover img {

            transform:
                scale(1.06);

            filter:
                grayscale(0%);

        }


        .visual-card::after {

            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    to top,
                    rgba(0,0,0,.55),
                    transparent 60%
                );

            pointer-events: none;

        }


        .card-one {

            width: 205px;

            height: 280px;

            left: 4%;

            top: 120px;

            transform:
                rotate(-5deg);

        }


        .card-two {

            width: 270px;

            height: 360px;

            left: 28%;

            top: 55px;

            z-index: 3;

        }


        .card-three {

            width: 190px;

            height: 250px;

            right: 1%;

            bottom: 55px;

            transform:
                rotate(5deg);

        }


        .card-four {

            width: 150px;

            height: 150px;

            left: 10%;

            bottom: 25px;

            z-index: 4;

            transform:
                rotate(4deg);

        }


        .visual-label {

            position: absolute;

            right: 12%;

            top: 15px;

            z-index: 10;

            padding: 9px 12px;

            border:
                1px solid rgba(255,255,255,.12);

            border-radius: 30px;

            background:
                rgba(255,255,255,.04);

            color: #999999;

            font-size: 8px;

            font-weight: 700;

            letter-spacing: .8px;

        }


        /* =========================================================
           STATS
        ========================================================= */

        .stats {

            max-width: 1250px;

            margin: -25px auto 0;

            padding:
                0 35px 80px;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 14px;

        }


        .stat {

            padding: 22px 24px;

            border-top:
                1px solid var(--border);

        }


        .stat-number {

            font-size: 22px;

            font-weight: 700;

            color: #ffffff;

        }


        .stat-text {

            margin-top: 3px;

            color: var(--muted);

            font-size: 10px;

            line-height: 1.7;

        }


        /* =========================================================
           ABOUT
        ========================================================= */

        .about {

            padding:
                100px 35px;

            border-top:
                1px solid rgba(255,255,255,.05);

        }


        .about-inner {

            max-width: 950px;

            margin: auto;

            text-align: center;

        }


        .about h2 {

            margin: 0;

            font-size:
                clamp(30px, 4vw, 48px);

            line-height: 1.1;

            letter-spacing: -2px;

        }


        .about h2 span {

            color: #666666;

        }


        .about p {

            max-width: 620px;

            margin: 20px auto 0;

            color: var(--muted);

            font-size: 12px;

            line-height: 1.9;

        }


        /* =========================================================
           FEATURES
        ========================================================= */

        .features {

            max-width: 1100px;

            margin: auto;

            padding:
                20px 35px 120px;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 14px;

        }


        .feature {

            padding: 27px;

            border:
                1px solid var(--border);

            border-radius: 16px;

            background: #080808;

            transition: .3s ease;

        }


        .feature:hover {

            transform:
                translateY(-5px);

            border-color:
                var(--border-hover);

            background: #0d0d0d;

        }


        .feature-icon {

            width: 40px;

            height: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 20px;

            border-radius: 10px;

            background:
                rgba(255,255,255,.06);

            color: #ffffff;

            font-size: 17px;

        }


        .feature h3 {

            margin:
                0 0 8px;

            font-size: 14px;

        }


        .feature p {

            margin: 0;

            color: var(--muted);

            font-size: 10px;

            line-height: 1.8;

        }


        /* =========================================================
           CTA
        ========================================================= */

        .cta-wrap {

            padding:
                0 35px 90px;

        }


        .cta {

            position: relative;

            overflow: hidden;

            max-width: 1180px;

            margin: auto;

            padding:
                75px 30px;

            border:
                1px solid rgba(255,255,255,.1);

            border-radius: 22px;

            text-align: center;

            background:
                radial-gradient(
                    circle at center,
                    rgba(255,255,255,.055),
                    transparent 65%
                ),
                #0a0a0a;

        }


        .cta h2 {

            position: relative;

            margin: 0;

            font-size:
                clamp(30px, 4vw, 45px);

            letter-spacing: -2px;

        }


        .cta p {

            position: relative;

            max-width: 480px;

            margin:
                14px auto 25px;

            color: var(--muted);

            font-size: 11px;

            line-height: 1.8;

        }


        /* =========================================================
           FOOTER
        ========================================================= */

        footer {

            padding:
                25px 6% 30px;

            border-top:
                1px solid rgba(255,255,255,.05);

            color: #4f4f4f;

            font-size: 9px;

        }


        .footer-inner {

            display: flex;

            align-items: center;

            justify-content: space-between;

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media(max-width: 900px) {

            .hero {

                grid-template-columns: 1fr;

                gap: 25px;

                text-align: center;

            }


            .hero-content {

                display: flex;

                flex-direction: column;

                align-items: center;

            }


            .hero-description {

                margin-left: auto;

                margin-right: auto;

            }


            .visual {

                width: 100%;

                max-width: 650px;

                margin: auto;

                height: 500px;

            }

        }


        @media(max-width: 650px) {

            .navbar {

                height: 64px;

                padding: 0 18px;

            }


            .brand {

                font-size: 15px;

            }


            .brand img {

                width: 32px;

                height: 32px;

            }


            .nav-register {

                display: none;

            }


            .hero {

                min-height: auto;

                padding:
                    110px 20px 50px;

            }


            .hero h1 {

                font-size: 46px;

                letter-spacing: -2.8px;

            }


            .hero-description {

                font-size: 11px;

            }


            .hero-actions {

                width: 100%;

                justify-content: center;

            }


            .btn-main,
            .btn-outline {

                padding:
                    13px 15px;

            }


            .visual {

                height: 390px;

            }


            .card-one {

                width: 125px;

                height: 175px;

                left: 0;

                top: 100px;

            }


            .card-two {

                width: 175px;

                height: 245px;

                left: 50%;

                top: 35px;

                transform:
                    translateX(-50%);

            }


            .card-three {

                width: 120px;

                height: 165px;

                right: 0;

                bottom: 45px;

            }


            .card-four {

                width: 100px;

                height: 100px;

                left: 13px;

                bottom: 15px;

            }


            .visual-label {

                right: 5%;

                top: 0;

            }


            .stats {

                grid-template-columns: 1fr;

                padding:
                    0 20px 60px;

            }


            .stat {

                padding:
                    16px 0;

            }


            .about {

                padding:
                    70px 20px;

            }


            .about h2 {

                font-size: 31px;

            }


            .features {

                grid-template-columns: 1fr;

                padding:
                    10px 20px 75px;

            }


            .cta-wrap {

                padding:
                    0 20px 60px;

            }


            .cta {

                padding:
                    55px 20px;

            }


            .footer-inner {

                flex-direction: column;

                gap: 7px;

                text-align: center;

            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         NAVBAR
    ========================================================= -->

    <header class="navbar">


        <!--
            LOGO KEMBALI KE LANDING
            GET /
        -->

        <a
            href="{{ route('landing.landing') }}"
            class="brand"
        >

            <img
                src="{{ asset('logo/logo.png') }}"
                alt="GallSpace"
            >

            <div>
                Gall<span>Space</span>
            </div>

        </a>


        <div class="nav-right">


            <!--
                PENTING:
                Jangan pakai route('login') di sini.

                route('login') = POST /login
                sehingga tidak bisa dibuka melalui href.

                Halaman auth kamu adalah:
                GET /auth
            -->

            <a
                href="{{ route('auth') }}"
                class="nav-login"
            >
                Login
            </a>


            <!--
                Register juga masuk ke halaman auth.

                Form register nantinya melakukan:
                POST /register
            -->

            <a
                href="{{ route('auth') }}"
                class="nav-register"
            >
                Create Account
            </a>

        </div>

    </header>



    <!-- =========================================================
         MAIN
    ========================================================= -->

    <main>


        <!-- =====================================================
             HERO
        ===================================================== -->

        <section class="hero">


            <div class="hero-content">


                <div class="eyebrow">
                    GallSpace Community
                </div>


                <h1>

                    A place for

                    <span>
                        creative minds.
                    </span>

                </h1>


                <p class="hero-description">

                    GallSpace adalah ruang untuk menemukan,
                    membagikan, dan menikmati berbagai karya
                    kreatif dari orang-orang yang punya cerita
                    melalui karya mereka.

                </p>


                <div class="hero-actions">


                    <!--
                        MASUK KE HALAMAN AUTH

                        GET /auth
                    -->

                    <a
                        href="{{ route('auth') }}"
                        class="btn-main"
                    >

                        Masuk ke GallSpace

                        <i class="bi bi-arrow-right"></i>

                    </a>


                    <!--
                        DAFTAR JUGA KE /auth

                        Bukan POST /register,
                        karena <a href=""> selalu GET.
                    -->

                    <a
                        href="{{ route('auth') }}"
                        class="btn-outline"
                    >

                        Daftar

                    </a>

                </div>

            </div>



            <!-- =================================================
                 VISUAL COLLAGE
            ================================================= -->

            <div class="visual">


                <div class="visual-label">
                    CREATIVE COMMUNITY
                </div>


                @php

                    $heroImages =
                        collect($images ?? [])
                        ->take(4);

                @endphp


                @if(isset($heroImages[0]))

                    <div
                        class="visual-card card-one"
                    >

                        <img
                            src="{{ $heroImages[0] }}"
                            alt="Artwork"
                        >

                    </div>

                @endif


                @if(isset($heroImages[1]))

                    <div
                        class="visual-card card-two"
                    >

                        <img
                            src="{{ $heroImages[1] }}"
                            alt="Artwork"
                        >

                    </div>

                @endif


                @if(isset($heroImages[2]))

                    <div
                        class="visual-card card-three"
                    >

                        <img
                            src="{{ $heroImages[2] }}"
                            alt="Artwork"
                        >

                    </div>

                @endif


                @if(isset($heroImages[3]))

                    <div
                        class="visual-card card-four"
                    >

                        <img
                            src="{{ $heroImages[3] }}"
                            alt="Artwork"
                        >

                    </div>

                @endif


                @if($heroImages->count() === 0)

                    <div
                        class="visual-card card-two"

                        style="
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            color:#666;
                            text-align:center;
                            padding:30px;
                        "
                    >

                        <div>

                            <i
                                class="bi bi-images"

                                style="
                                    display:block;
                                    font-size:40px;
                                    margin-bottom:10px;
                                "
                            ></i>

                            Artwork komunitas

                        </div>

                    </div>

                @endif

            </div>

        </section>



        <!-- =====================================================
             STATS
        ===================================================== -->

        <section class="stats">


            <div class="stat">

                <div class="stat-number">
                    Discover
                </div>

                <div class="stat-text">

                    Temukan karya yang mungkin
                    belum pernah kamu lihat.

                </div>

            </div>


            <div class="stat">

                <div class="stat-number">
                    Share
                </div>

                <div class="stat-text">

                    Bagikan karya dan ide
                    yang kamu banggakan.

                </div>

            </div>


            <div class="stat">

                <div class="stat-number">
                    Connect
                </div>

                <div class="stat-text">

                    Bertemu dengan orang-orang
                    yang sama-sama kreatif.

                </div>

            </div>

        </section>



        <!-- =====================================================
             ABOUT
        ===================================================== -->

        <section class="about">


            <div class="about-inner">


                <div class="eyebrow">
                    About GallSpace
                </div>


                <h2>

                    Your work deserves

                    <span>
                        a space.
                    </span>

                </h2>


                <p>

                    Tidak semua karya harus sempurna untuk
                    dibagikan. GallSpace dibuat sebagai tempat
                    sederhana bagi siapa saja yang ingin
                    menunjukkan kreativitas, mencari inspirasi,
                    dan menikmati karya orang lain.

                </p>

            </div>

        </section>



        <!-- =====================================================
             FEATURES
        ===================================================== -->

        <section class="features">


            <div class="feature">

                <div class="feature-icon">

                    <i class="bi bi-compass"></i>

                </div>

                <h3>
                    Explore
                </h3>

                <p>

                    Jelajahi ilustrasi, fotografi, desain,
                    dan berbagai karya kreatif dari komunitas.

                </p>

            </div>



            <div class="feature">

                <div class="feature-icon">

                    <i class="bi bi-cloud-arrow-up"></i>

                </div>

                <h3>
                    Upload
                </h3>

                <p>

                    Punya karya yang ingin dibagikan?
                    Upload dan biarkan orang lain menemukannya.

                </p>

            </div>



            <div class="feature">

                <div class="feature-icon">

                    <i class="bi bi-heart"></i>

                </div>

                <h3>
                    Appreciate
                </h3>

                <p>

                    Berikan apresiasi kepada karya yang kamu suka
                    dan ikut membangun komunitas yang positif.

                </p>

            </div>

        </section>



        <!-- =====================================================
             CTA
        ===================================================== -->

        <section class="cta-wrap">


            <div class="cta">


                <div class="eyebrow">
                    Welcome to GallSpace
                </div>


                <h2>
                    Let's make something.
                </h2>


                <p>

                    Masuk ke GallSpace dan mulai menemukan
                    ruang baru untuk kreativitasmu.

                </p>


                <!--
                    CTA → GET /auth
                -->

                <a
                    href="{{ route('auth') }}"
                    class="btn-main"
                >

                    Masuk ke GallSpace

                    <i class="bi bi-arrow-up-right"></i>

                </a>

            </div>

        </section>

    </main>



    <!-- =========================================================
         FOOTER
    ========================================================= -->

    <footer>


        <div class="footer-inner">


            <span>

                © {{ date('Y') }} GallSpace

            </span>


            <span>

                Your space for creativity.

            </span>


        </div>

    </footer>



    <!-- =========================================================
         JAVASCRIPT
    ========================================================= -->

    <script>


        /*
        |--------------------------------------------------------------------------
        | IMAGE FALLBACK
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('img')
            .forEach(img => {

                img.addEventListener(
                    'error',
                    function () {

                        this.style.display = 'none';

                    }
                );

            });



        /*
        |--------------------------------------------------------------------------
        | SIMPLE PARALLAX
        |--------------------------------------------------------------------------
        */

        const cards =
            document.querySelectorAll(
                '.visual-card'
            );


        window.addEventListener(
            'scroll',
            () => {

                const scroll =
                    window.scrollY;


                if (scroll < 700) {

                    cards.forEach(
                        (card, index) => {

                            const speed =
                                (index + 1) * 0.025;


                            card.style.translate =
                                `0 ${scroll * speed}px`;

                        }
                    );

                }

            },
            {
                passive: true
            }
        );

    </script>


</body>

</html>
