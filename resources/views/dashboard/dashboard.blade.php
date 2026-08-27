<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GallSpace — Your Space for Creativity</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --bg: #070707;
            --bg-soft: #0d0d0d;
            --surface: #111111;
            --surface-2: #161616;

            --text: #f5f5f5;
            --text-soft: #b4b4b4;
            --muted: #707070;

            --line: rgba(255,255,255,.09);
            --line-hover: rgba(255,255,255,.18);

            --accent: #ffffff;
            --accent-inverse: #050505;

            --shadow: rgba(0,0,0,.45);
        }

        html.light {
            --bg: #f5f5f3;
            --bg-soft: #eeeeec;
            --surface: #ffffff;
            --surface-2: #f8f8f7;

            --text: #111111;
            --text-soft: #555555;
            --muted: #888888;

            --line: rgba(0,0,0,.09);
            --line-hover: rgba(0,0,0,.18);

            --accent: #080808;
            --accent-inverse: #ffffff;

            --shadow: rgba(0,0,0,.12);
        }

        html {
            scroll-behavior: smooth;
            background: var(--bg);
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: "Inter", sans-serif;
            transition:
                background .35s ease,
                color .35s ease;
        }

        body::selection {
            background: var(--text);
            color: var(--bg);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 250px;

            padding: 28px 17px;

            display: flex;
            flex-direction: column;

            background: rgba(8,8,8,.82);
            border-right: 1px solid var(--line);

            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);

            z-index: 1000;
        }

        html.light .sidebar {
            background: rgba(255,255,255,.82);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 11px;

            padding: 6px 10px;
            margin-bottom: 52px;
        }

        .logo img {
            width: 39px;
            height: 39px;
            object-fit: contain;
            filter: grayscale(1);
        }

        .logo span {
            font-family: "Space Grotesk", sans-serif;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: -.7px;
        }

        .logo-dot {
            color: var(--text);
        }

        .nav-title {
            padding: 0 13px;
            margin-bottom: 10px;

            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.7px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            position: relative;

            display: flex;
            align-items: center;
            gap: 13px;

            padding: 12px 14px;

            color: var(--muted);
            border-radius: 12px;

            font-size: 12px;
            font-weight: 500;

            transition:
                color .25s ease,
                background .25s ease,
                transform .25s ease;
        }

        .nav-item i {
            width: 18px;
            font-size: 16px;
            text-align: center;
        }

        .nav-item:hover {
            color: var(--text);
            background: rgba(255,255,255,.045);
            transform: translateX(3px);
        }

        html.light .nav-item:hover {
            background: rgba(0,0,0,.045);
        }

        .nav-item.active {
            color: var(--text);
            background: rgba(255,255,255,.075);
        }

        html.light .nav-item.active {
            background: rgba(0,0,0,.07);
        }

        .nav-item.active::before {
            content: "";

            position: absolute;
            left: 0;
            top: 50%;

            width: 2px;
            height: 19px;

            border-radius: 10px;
            background: var(--text);

            transform: translateY(-50%);
        }

        .sidebar-bottom {
            margin-top: auto;

            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* =====================================================
           PROFILE
        ===================================================== */

        .profile-link {
            display: flex;
            align-items: center;
            gap: 10px;

            padding: 9px;

            border-radius: 13px;

            transition: background .25s ease;
        }

        .profile-link:hover {
            background: rgba(255,255,255,.045);
        }

        html.light .profile-link:hover {
            background: rgba(0,0,0,.045);
        }

        .profile-avatar,
        .profile-placeholder {
            width: 36px;
            height: 36px;
            flex-shrink: 0;

            border-radius: 50%;
        }

        .profile-avatar {
            object-fit: cover;
            filter: grayscale(1);
            border: 1px solid var(--line);
        }

        .profile-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--text);
            color: var(--bg);

            font-size: 15px;
        }

        .profile-info {
            min-width: 0;
        }

        .profile-name {
            overflow: hidden;

            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .profile-label {
            margin-top: 2px;

            color: var(--muted);
            font-size: 9px;
        }

        /* =====================================================
           THEME
        ===================================================== */

        .theme-toggle {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 11px 13px;

            color: var(--muted);
            background: rgba(255,255,255,.025);

            border: 1px solid var(--line);
            border-radius: 12px;

            cursor: pointer;

            transition:
                color .25s ease,
                background .25s ease,
                border .25s ease;
        }

        html.light .theme-toggle {
            background: rgba(0,0,0,.025);
        }

        .theme-toggle:hover {
            color: var(--text);
            background: rgba(255,255,255,.055);
            border-color: var(--line-hover);
        }

        html.light .theme-toggle:hover {
            background: rgba(0,0,0,.055);
        }

        .theme-left {
            display: flex;
            align-items: center;
            gap: 10px;

            font-size: 11px;
            font-weight: 500;
        }

        .theme-left i {
            font-size: 15px;
        }

        /* =====================================================
           MOBILE HEADER
        ===================================================== */

        .mobile-header {
            display: none;

            position: fixed;
            inset: 0 0 auto 0;

            height: 64px;
            padding: 0 16px;

            align-items: center;
            justify-content: space-between;

            background: rgba(7,7,7,.84);
            border-bottom: 1px solid var(--line);

            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);

            z-index: 999;
        }

        html.light .mobile-header {
            background: rgba(255,255,255,.84);
        }

        .mobile-logo {
            display: flex;
            align-items: center;
            gap: 8px;

            font-family: "Space Grotesk", sans-serif;
            font-weight: 700;
        }

        .mobile-logo img {
            width: 31px;
            height: 31px;
            filter: grayscale(1);
        }

        .mobile-actions {
            display: flex;
            gap: 7px;
        }

        .mobile-btn {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--text);
            background: rgba(255,255,255,.045);

            border: 1px solid var(--line);
            border-radius: 11px;

            cursor: pointer;

            transition: .25s ease;
        }

        html.light .mobile-btn {
            background: rgba(0,0,0,.045);
        }

        .mobile-btn:hover {
            border-color: var(--line-hover);
            transform: translateY(-1px);
        }

        /* =====================================================
           MOBILE DRAWER
        ===================================================== */

        .mobile-drawer {
            position: fixed;
            inset: 0;

            background: rgba(0,0,0,.68);
            backdrop-filter: blur(5px);

            z-index: 2000;

            opacity: 0;
            visibility: hidden;

            transition:
                opacity .3s ease,
                visibility .3s ease;
        }

        .mobile-drawer.show {
            opacity: 1;
            visibility: visible;
        }

        .mobile-drawer-content {
            position: absolute;
            inset: 0 auto 0 0;

            width: 275px;
            padding: 25px 18px;

            background: var(--surface);

            transform: translateX(-100%);

            transition: transform .35s cubic-bezier(.22,1,.36,1);
        }

        .mobile-drawer.show .mobile-drawer-content {
            transform: translateX(0);
        }

        .mobile-drawer .logo {
            margin-bottom: 35px;
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            min-height: 100vh;
            margin-left: 250px;
            overflow: hidden;
        }

        .container {
            width: min(1180px, calc(100% - 70px));
            margin-inline: auto;
        }

        /* =====================================================
           HERO
        ===================================================== */

        .hero {
            min-height: 750px;

            padding: 100px 0 70px;

            display: grid;
            grid-template-columns: .88fr 1.12fr;

            align-items: center;
            gap: 70px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 22px;
            padding: 7px 11px;

            color: var(--text-soft);

            border: 1px solid var(--line);
            background: rgba(255,255,255,.025);
            border-radius: 100px;

            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1.2px;
        }

        html.light .hero-badge {
            background: rgba(0,0,0,.025);
        }

        .hero-badge i {
            color: var(--text);
            font-size: 11px;
        }

        .hero h1 {
            max-width: 650px;

            margin: 0;

            font-family: "Space Grotesk", sans-serif;

            font-size: clamp(46px, 5.4vw, 75px);
            line-height: .98;

            letter-spacing: -4px;
            font-weight: 700;
        }

        .hero h1 span {
            color: var(--text);
            position: relative;
        }

        .hero h1 span::after {
            content: "";

            position: absolute;
            left: 2px;
            right: 0;
            bottom: -4px;

            height: 1px;

            background: var(--text);
            opacity: .35;
        }

        .hero-description {
            max-width: 500px;

            margin: 27px 0 0;

            color: var(--muted);

            font-size: 13px;
            line-height: 1.9;
        }

        .hero-buttons {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;

            margin-top: 31px;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            padding: 12px 18px;

            border-radius: 11px;

            font-size: 11px;
            font-weight: 600;

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                background .25s ease,
                color .25s ease,
                border .25s ease;
        }

        .btn-primary {
            background: var(--accent);
            color: var(--accent-inverse);
            border: 1px solid var(--accent);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px var(--shadow);
        }

        .btn-secondary {
            color: var(--text);
            background: rgba(255,255,255,.035);
            border: 1px solid var(--line);
        }

        html.light .btn-secondary {
            background: rgba(0,0,0,.035);
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,.075);
            border-color: var(--line-hover);
            transform: translateY(-3px);
        }

        html.light .btn-secondary:hover {
            background: rgba(0,0,0,.075);
        }

        /* =====================================================
           HERO GALLERY
        ===================================================== */

        .hero-gallery {
            position: relative;

            height: 560px;

            display: grid;
            grid-template-columns: 1fr 1.18fr 1fr;

            gap: 11px;

            align-items: center;
        }

        .hero-column {
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .hero-column:nth-child(1) {
            transform: translateY(27px);
        }

        .hero-column:nth-child(2) {
            transform: translateY(-23px);
        }

        .hero-column:nth-child(3) {
            transform: translateY(39px);
        }

        .hero-image {
            position: relative;
            overflow: hidden;

            background: var(--surface);

            border: 1px solid var(--line);
            border-radius: 17px;

            box-shadow:
                0 25px 70px rgba(0,0,0,.25);
        }

        .hero-image::after {
            content: "";

            position: absolute;
            inset: 0;

            background:
                linear-gradient(
                    to bottom,
                    transparent 50%,
                    rgba(0,0,0,.3)
                );

            pointer-events: none;
        }

        .hero-image img {
            display: block;

            width: 100%;
            height: auto;

            object-fit: cover;

            filter: grayscale(100%);

            transition:
                transform .8s cubic-bezier(.22,1,.36,1),
                filter .5s ease;
        }

        .hero-image:hover img {
            transform: scale(1.06);
            filter: grayscale(75%);
        }

        .hero-image.tall img {
            aspect-ratio: 4 / 5;
        }

        .hero-image.square img {
            aspect-ratio: 1 / 1;
        }

        /* =====================================================
           SUBTLE BACKGROUND DETAIL
        ===================================================== */

        .hero-glow {
            position: absolute;

            width: 420px;
            height: 420px;

            right: 5%;
            top: 10%;

            background:
                radial-gradient(
                    circle,
                    rgba(255,255,255,.055),
                    transparent 68%
                );

            filter: blur(35px);

            pointer-events: none;
        }

        html.light .hero-glow {
            background:
                radial-gradient(
                    circle,
                    rgba(0,0,0,.055),
                    transparent 68%
                );
        }

        /* =====================================================
           SECTIONS
        ===================================================== */

        .section {
            padding: 90px 0;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 30px;
            margin-bottom: 30px;
        }

        .section-eyebrow {
            margin-bottom: 7px;

            color: var(--muted);

            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .section-title {
            margin: 0;

            font-family: "Space Grotesk", sans-serif;

            font-size: 29px;
            line-height: 1.1;
            letter-spacing: -1.5px;
            font-weight: 600;
        }

        .section-description {
            max-width: 380px;

            margin: 0 0 10px;

            color: var(--muted);

            font-size: 10px;
            line-height: 1.8;
            text-align: right;
        }

        .view-all {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;

            color: var(--text-soft);

            font-size: 10px;
            font-weight: 500;

            transition: color .25s ease;
        }

        .view-all:hover {
            color: var(--text);
        }

        /* =====================================================
           MASONRY
        ===================================================== */

        .masonry {
            columns: 4 220px;
            column-gap: 14px;
        }

        .art-card {
            position: relative;

            display: block;

            margin-bottom: 14px;

            overflow: hidden;

            background: var(--surface);

            border: 1px solid var(--line);
            border-radius: 15px;

            break-inside: avoid;

            cursor: pointer;
        }

        .art-card img {
            display: block;

            width: 100%;
            height: auto;

            filter: grayscale(100%);

            transition:
                transform .65s cubic-bezier(.22,1,.36,1),
                filter .5s ease;
        }

        .art-card:hover img {
            transform: scale(1.045);
            filter: grayscale(40%) brightness(.65);
        }

        .art-overlay {
            position: absolute;
            inset: 0;

            padding: 13px;

            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            background:
                linear-gradient(
                    to top,
                    rgba(0,0,0,.78),
                    transparent 55%
                );

            opacity: 0;

            transition: opacity .3s ease;
        }

        .art-card:hover .art-overlay {
            opacity: 1;
        }

        .art-name {
            max-width: 70%;

            overflow: hidden;

            color: white;

            font-size: 10px;
            font-weight: 600;

            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .art-open {
            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.18);

            border-radius: 50%;

            backdrop-filter: blur(8px);
        }

        /* =====================================================
           WHY
        ===================================================== */

        .why-section {
            padding: 90px 0;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;

            margin-top: 34px;
        }

        .feature-card {
            position: relative;

            min-height: 235px;
            padding: 27px;

            overflow: hidden;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.035),
                    rgba(255,255,255,.008)
                );

            border: 1px solid var(--line);
            border-radius: 18px;

            transition:
                transform .35s cubic-bezier(.22,1,.36,1),
                border-color .3s ease,
                background .3s ease;
        }

        html.light .feature-card {
            background:
                linear-gradient(
                    145deg,
                    rgba(0,0,0,.018),
                    rgba(0,0,0,.005)
                );
        }

        .feature-card::before {
            content: "";

            position: absolute;
            width: 150px;
            height: 150px;

            right: -70px;
            bottom: -70px;

            background:
                radial-gradient(
                    circle,
                    rgba(255,255,255,.07),
                    transparent 70%
                );

            pointer-events: none;
        }

        html.light .feature-card::before {
            background:
                radial-gradient(
                    circle,
                    rgba(0,0,0,.05),
                    transparent 70%
                );
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: var(--line-hover);
        }

        .feature-icon {
            width: 43px;
            height: 43px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 27px;

            color: var(--text);

            background: rgba(255,255,255,.055);
            border: 1px solid var(--line);

            border-radius: 12px;

            font-size: 18px;
        }

        html.light .feature-icon {
            background: rgba(0,0,0,.055);
        }

        .feature-card h3 {
            margin: 0 0 8px;

            font-family: "Space Grotesk", sans-serif;

            font-size: 16px;
            font-weight: 600;
        }

        .feature-card p {
            max-width: 280px;

            margin: 0;

            color: var(--muted);

            font-size: 10px;
            line-height: 1.85;
        }

        /* =====================================================
           CTA
        ===================================================== */

        .cta {
            position: relative;

            margin: 25px 0 80px;
            padding: 75px 40px;

            overflow: hidden;

            text-align: center;

            background:
                linear-gradient(
                    145deg,
                    var(--surface-2),
                    var(--surface)
                );

            border: 1px solid var(--line);
            border-radius: 24px;
        }

        .cta::before {
            content: "";

            position: absolute;
            width: 500px;
            height: 500px;

            left: 50%;
            top: 50%;

            transform: translate(-50%, -50%);

            background:
                radial-gradient(
                    circle,
                    rgba(255,255,255,.045),
                    transparent 67%
                );

            pointer-events: none;
        }

        html.light .cta::before {
            background:
                radial-gradient(
                    circle,
                    rgba(0,0,0,.045),
                    transparent 67%
                );
        }

        .cta > * {
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            max-width: 650px;

            margin: 0 auto;

            font-family: "Space Grotesk", sans-serif;

            font-size: clamp(29px, 4vw, 44px);
            line-height: 1.03;

            letter-spacing: -2px;
            font-weight: 600;
        }

        .cta p {
            max-width: 490px;

            margin: 16px auto 25px;

            color: var(--muted);

            font-size: 11px;
            line-height: 1.8;
        }

        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            padding: 25px 0 34px;

            color: var(--muted);

            border-top: 1px solid var(--line);

            font-size: 9px;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .sidebar {
                width: 215px;
            }

            .main {
                margin-left: 215px;
            }

            .container {
                width: min(92%, 900px);
            }

            .hero {
                grid-template-columns: 1fr;

                padding-top: 90px;
                gap: 50px;
            }

            .hero-content {
                text-align: center;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-gallery {
                width: 100%;
                max-width: 650px;
                margin: auto;
            }

            .masonry {
                columns: 3 180px;
            }
        }

        @media (max-width: 767px) {

            .sidebar {
                display: none;
            }

            .mobile-header {
                display: flex;
            }

            .main {
                margin-left: 0;
                padding-top: 64px;
            }

            .container {
                width: calc(100% - 30px);
            }

            .hero {
                min-height: auto;

                padding:
                    65px 0
                    45px;

                gap: 42px;
            }

            .hero-badge {
                font-size: 8px;
            }

            .hero h1 {
                font-size: 45px;
                letter-spacing: -2.7px;
            }

            .hero-description {
                font-size: 11px;
                line-height: 1.85;
            }

            .hero-gallery {
                height: 400px;
                gap: 7px;
            }

            .hero-column {
                gap: 7px;
            }

            .hero-image {
                border-radius: 11px;
            }

            .section {
                padding: 60px 0;
            }

            .section-header {
                display: block;
            }

            .section-title {
                font-size: 26px;
            }

            .section-description {
                margin-top: 9px;
                text-align: left;
            }

            .view-all {
                justify-content: flex-start;
                margin-top: 14px;
            }

            .masonry {
                columns: 2 135px;
                column-gap: 9px;
            }

            .art-card {
                margin-bottom: 9px;
                border-radius: 11px;
            }

            .art-overlay {
                opacity: 1;
                padding: 9px;
            }

            .art-name {
                font-size: 9px;
            }

            .art-open {
                width: 27px;
                height: 27px;
                font-size: 10px;
            }

            .why-section {
                padding: 60px 0;
            }

            .why-grid {
                grid-template-columns: 1fr;
                gap: 9px;
            }

            .feature-card {
                min-height: auto;
                padding: 24px;
            }

            .feature-icon {
                margin-bottom: 20px;
            }

            .cta {
                margin:
                    15px 0
                    45px;

                padding: 52px 20px;

                border-radius: 19px;
            }

            .cta h2 {
                font-size: 31px;
                letter-spacing: -1.5px;
            }

            .footer-inner {
                flex-direction: column;
                gap: 7px;

                text-align: center;
            }
        }

        /* =====================================================
           REDUCED MOTION
        ===================================================== */

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition: none !important;
                animation: none !important;
            }
        }
    </style>
</head>

<body>

@php
    $profile = optional(auth()->user()->profile);
    $avatar = $profile->avatar ?? null;
    $hasAvatar = !empty($avatar);

    $galleryImages = collect($images ?? [])->take(12);
@endphp


<!-- =========================================================
     DESKTOP SIDEBAR
========================================================= -->

<aside class="sidebar">

    <a href="{{ route('dashboard') }}" class="logo">

        <img
            src="{{ asset('logo/logo.png') }}"
            alt="GallSpace"
        >

        <span>
            Gall<span class="logo-dot">Space</span>
        </span>

    </a>


    <div class="nav-title">
        Navigation
    </div>


    <nav class="sidebar-nav">

        <a
            href="{{ route('dashboard') }}"
            class="nav-item active"
        >
            <i class="bi bi-house-fill"></i>
            <span>Home</span>
        </a>


        <a
            href="/jelajah"
            class="nav-item"
        >
            <i class="bi bi-compass"></i>
            <span>Explore</span>
        </a>


        <a
            href="/upload"
            class="nav-item"
        >
            <i class="bi bi-plus-square"></i>
            <span>Upload Artwork</span>
        </a>

    </nav>


    <div class="sidebar-bottom">

        @auth

            <a
                href="{{ route('akun') }}"
                class="profile-link"
            >

                @if($hasAvatar)

                    <img
                        src="{{ asset('profile/'.$avatar) }}"
                        class="profile-avatar"
                        alt="Profile"
                    >

                @else

                    <div class="profile-placeholder">
                        <i class="bi bi-person-fill"></i>
                    </div>

                @endif


                <div class="profile-info">

                    <div class="profile-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="profile-label">
                        My Profile
                    </div>

                </div>

            </a>

        @endauth


        <button
            type="button"
            class="theme-toggle"
            id="themeToggle"
        >

            <div class="theme-left">

                <i
                    id="themeIcon"
                    class="bi bi-moon-stars"
                ></i>

                <span id="themeText">
                    Dark Mode
                </span>

            </div>

            <i class="bi bi-chevron-right"></i>

        </button>

    </div>

</aside>


<!-- =========================================================
     MOBILE HEADER
========================================================= -->

<header class="mobile-header">

    <a
        href="{{ route('dashboard') }}"
        class="mobile-logo"
    >

        <img
            src="{{ asset('logo/logo.png') }}"
            alt="GallSpace"
        >

        <span>
            Gall<span class="logo-dot">Space</span>
        </span>

    </a>


    <div class="mobile-actions">

        <button
            type="button"
            class="mobile-btn"
            id="mobileTheme"
            aria-label="Toggle theme"
        >
            <i class="bi bi-moon-stars"></i>
        </button>


        <button
            type="button"
            class="mobile-btn"
            id="mobileMenu"
            aria-label="Open menu"
        >
            <i class="bi bi-list"></i>
        </button>

    </div>

</header>


<!-- =========================================================
     MOBILE DRAWER
========================================================= -->

<div
    class="mobile-drawer"
    id="mobileDrawer"
>

    <div class="mobile-drawer-content">

        <a
            href="{{ route('dashboard') }}"
            class="logo"
        >

            <img
                src="{{ asset('logo/logo.png') }}"
                alt="GallSpace"
            >

            <span>
                Gall<span class="logo-dot">Space</span>
            </span>

        </a>


        <nav class="sidebar-nav">

            <a
                href="{{ route('dashboard') }}"
                class="nav-item active"
            >
                <i class="bi bi-house-fill"></i>
                Home
            </a>


            <a
                href="/jelajah"
                class="nav-item"
            >
                <i class="bi bi-compass"></i>
                Explore
            </a>


            <a
                href="/upload"
                class="nav-item"
            >
                <i class="bi bi-plus-square"></i>
                Upload Artwork
            </a>


            @auth

                <a
                    href="{{ route('akun') }}"
                    class="nav-item"
                >
                    <i class="bi bi-person"></i>
                    Profile
                </a>

            @endauth

        </nav>

    </div>

</div>


<!-- =========================================================
     MAIN
========================================================= -->

<main class="main">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero container">

        <div class="hero-content">

            <div class="hero-badge">
                <i class="bi bi-stars"></i>
                GALLSPACE COMMUNITY
            </div>


            <h1>
                Your space for
                <span>creativity.</span>
            </h1>


            <p class="hero-description">
                Temukan karya seni yang menginspirasi,
                bagikan karya terbaikmu, dan terhubung
                dengan komunitas kreatif di GallSpace.
            </p>


            <div class="hero-buttons">

                <a
                    href="/jelajah"
                    class="btn-primary"
                >
                    Explore Gallery
                    <i class="bi bi-arrow-up-right"></i>
                </a>


                <a
                    href="/upload"
                    class="btn-secondary"
                >
                    <i class="bi bi-plus-lg"></i>
                    Upload Artwork
                </a>

            </div>

        </div>


        <!-- HERO COLLAGE -->

        <div class="hero-gallery">

            <div class="hero-glow"></div>

            @php
                $heroImages = $galleryImages->take(6);
            @endphp


            @if($heroImages->count() > 0)

                <div class="hero-column">

                    @if(isset($heroImages[0]))

                        <div class="hero-image tall">

                            <img
                                src="{{ $heroImages[0] }}"
                                alt="Artwork"
                            >

                        </div>

                    @endif


                    @if(isset($heroImages[1]))

                        <div class="hero-image square">

                            <img
                                src="{{ $heroImages[1] }}"
                                alt="Artwork"
                            >

                        </div>

                    @endif

                </div>


                <div class="hero-column">

                    @if(isset($heroImages[2]))

                        <div class="hero-image square">

                            <img
                                src="{{ $heroImages[2] }}"
                                alt="Artwork"
                            >

                        </div>

                    @endif


                    @if(isset($heroImages[3]))

                        <div class="hero-image tall">

                            <img
                                src="{{ $heroImages[3] }}"
                                alt="Artwork"
                            >

                        </div>

                    @endif

                </div>


                <div class="hero-column">

                    @if(isset($heroImages[4]))

                        <div class="hero-image tall">

                            <img
                                src="{{ $heroImages[4] }}"
                                alt="Artwork"
                            >

                        </div>

                    @endif


                    @if(isset($heroImages[5]))

                        <div class="hero-image square">

                            <img
                                src="{{ $heroImages[5] }}"
                                alt="Artwork"
                            >

                        </div>

                    @endif

                </div>

            @else

                <div
                    style="
                        grid-column:1/-1;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        color:var(--muted);
                        text-align:center;
                    "
                >

                    <div>

                        <i
                            class="bi bi-images"
                            style="
                                font-size:50px;
                                display:block;
                                margin-bottom:10px;
                            "
                        ></i>

                        Belum ada artwork.

                    </div>

                </div>

            @endif

        </div>

    </section>


    <!-- =====================================================
         FEATURED ARTWORK
    ====================================================== -->

    @if($galleryImages->count() > 0)

        <section class="section">

            <div class="container">

                <div class="section-header">

                    <div>

                        <div class="section-eyebrow">
                            Discover
                        </div>

                        <h2 class="section-title">
                            Something inspiring.
                        </h2>

                    </div>


                    <div>

                        <p class="section-description">
                            Jelajahi beberapa karya terbaru
                            dari komunitas GallSpace.
                        </p>


                        <a
                            href="/jelajah"
                            class="view-all"
                        >
                            View all artwork
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                </div>


                <div class="masonry">

                    @foreach($galleryImages as $img)

                        @php
                            $filename = basename($img);

                            $cleanName = pathinfo(
                                $filename,
                                PATHINFO_FILENAME
                            );
                        @endphp


                        <a
                            href="/jelajah"
                            class="art-card"
                        >

                            <img
                                src="{{ $img }}"
                                alt="{{ ucfirst($cleanName) }}"
                                loading="lazy"
                            >


                            <div class="art-overlay">

                                <span class="art-name">
                                    {{ ucfirst($cleanName) }}
                                </span>


                                <span class="art-open">
                                    <i class="bi bi-arrow-up-right"></i>
                                </span>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    <!-- =====================================================
         WHY GALLSPACE
    ====================================================== -->

    <section class="why-section">

        <div class="container">

            <div class="section-eyebrow">
                Why GallSpace?
            </div>


            <h2 class="section-title">
                Made for people who love creating.
            </h2>


            <div class="why-grid">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-compass"></i>
                    </div>


                    <h3>
                        Discover
                    </h3>


                    <p>
                        Temukan berbagai artwork,
                        fotografi, ilustrasi, dan karya
                        kreatif dari komunitas GallSpace.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>


                    <h3>
                        Share
                    </h3>


                    <p>
                        Upload karya terbaikmu dan
                        biarkan orang lain menemukan
                        kreativitas yang kamu miliki.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-heart"></i>
                    </div>


                    <h3>
                        Connect
                    </h3>


                    <p>
                        Berikan apresiasi melalui like,
                        komentar, dan jadilah bagian
                        dari komunitas kreatif.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="container">

        <div class="cta">

            <div class="section-eyebrow">
                Start Creating
            </div>


            <h2>
                Have something beautiful
                to share?
            </h2>


            <p>
                Upload artwork pertamamu dan
                biarkan komunitas GallSpace
                melihat karya kamu.
            </p>


            <a
                href="/upload"
                class="btn-primary"
            >
                Upload Your Artwork
                <i class="bi bi-arrow-up-right"></i>
            </a>

        </div>

    </section>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer>

        <div class="container footer-inner">

            <span>
                © {{ date('Y') }} GallSpace
            </span>


            <span>
                Your space for creativity.
            </span>

        </div>

    </footer>

</main>


<script>

    /* =====================================================
       THEME
    ===================================================== */

    const html = document.documentElement;

    const themeToggle =
        document.getElementById("themeToggle");

    const themeIcon =
        document.getElementById("themeIcon");

    const themeText =
        document.getElementById("themeText");

    const mobileTheme =
        document.getElementById("mobileTheme");


    function updateThemeUI() {

        const isLight =
            html.classList.contains("light");


        if (themeIcon) {

            themeIcon.className =
                isLight
                    ? "bi bi-sun"
                    : "bi bi-moon-stars";

        }


        if (themeText) {

            themeText.innerText =
                isLight
                    ? "Light Mode"
                    : "Dark Mode";

        }


        if (mobileTheme) {

            mobileTheme.innerHTML =
                isLight
                    ? '<i class="bi bi-sun"></i>'
                    : '<i class="bi bi-moon-stars"></i>';

        }

    }


    function setTheme(theme) {

        if (theme === "light") {

            html.classList.add("light");

        } else {

            html.classList.remove("light");

        }


        localStorage.setItem(
            "gallspace-theme",
            theme
        );

        updateThemeUI();

    }


    function toggleTheme() {

        const isLight =
            html.classList.contains("light");

        setTheme(
            isLight
                ? "dark"
                : "light"
        );

    }


    const savedTheme =
        localStorage.getItem(
            "gallspace-theme"
        );


    if (savedTheme) {

        setTheme(savedTheme);

    } else if (
        window.matchMedia &&
        window.matchMedia(
            "(prefers-color-scheme: light)"
        ).matches
    ) {

        setTheme("light");

    } else {

        setTheme("dark");

    }


    if (themeToggle) {

        themeToggle.addEventListener(
            "click",
            toggleTheme
        );

    }


    if (mobileTheme) {

        mobileTheme.addEventListener(
            "click",
            toggleTheme
        );

    }


    /* =====================================================
       MOBILE MENU
    ===================================================== */

    const mobileMenu =
        document.getElementById("mobileMenu");

    const mobileDrawer =
        document.getElementById("mobileDrawer");


    function closeMobileDrawer() {

        if (mobileDrawer) {

            mobileDrawer.classList.remove(
                "show"
            );

        }

    }


    if (mobileMenu && mobileDrawer) {

        mobileMenu.addEventListener(
            "click",
            () => {

                mobileDrawer.classList.add(
                    "show"
                );

            }
        );


        mobileDrawer.addEventListener(
            "click",
            event => {

                if (
                    event.target === mobileDrawer
                ) {

                    closeMobileDrawer();

                }

            }
        );


        mobileDrawer
            .querySelectorAll("a")
            .forEach(link => {

                link.addEventListener(
                    "click",
                    closeMobileDrawer
                );

            });

    }


    /* =====================================================
       ESCAPE
    ===================================================== */

    document.addEventListener(
        "keydown",
        event => {

            if (
                event.key === "Escape"
            ) {

                closeMobileDrawer();

            }

        }
    );

</script>

</body>
</html>
