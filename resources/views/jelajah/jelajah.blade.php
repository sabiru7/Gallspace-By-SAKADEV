<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Explore — GallSpace</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --bg: #080808;
            --bg-2: #0e0e0f;
            --bg-3: #141415;
            --card: #171718;

            --text: #f5f5f5;
            --text-soft: #c7c7c7;
            --muted: #77777c;

            --border: rgba(255,255,255,.075);

            --accent: #ffffff;
            --accent-dark: #d4d4d4;

            --danger: #ef4444;

            --shadow:
                0 20px 60px rgba(0,0,0,.35);
        }

        html.light {
            --bg: #f6f6f4;
            --bg-2: #ffffff;
            --bg-3: #f0f0ee;
            --card: #ffffff;

            --text: #18181b;
            --text-soft: #3f3f46;
            --muted: #71717a;

            --border: rgba(0,0,0,.08);

            --accent: #18181b;
            --accent-dark: #3f3f46;

            --shadow:
                0 20px 50px rgba(0,0,0,.08);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;

            font-family: 'Poppins', sans-serif;

            background:
                radial-gradient(
                    circle at 80% 0%,
                    rgba(255,255,255,.025),
                    transparent 30%
                ),
                var(--bg);

            color: var(--text);

            transition:
                background .35s ease,
                color .35s ease;
        }

        body::before {
            content: "";

            position: fixed;
            inset: 0;

            pointer-events: none;

            background-image:
                radial-gradient(
                    rgba(255,255,255,.025) 1px,
                    transparent 1px
                );

            background-size: 28px 28px;

            mask-image:
                linear-gradient(
                    to bottom,
                    black,
                    transparent 70%
                );
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font-family: inherit;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            position: fixed;

            inset: 0 auto 0 0;

            width: 245px;

            padding: 27px 17px;

            display: flex;
            flex-direction: column;

            background:
                rgba(14,14,15,.88);

            border-right:
                1px solid var(--border);

            backdrop-filter: blur(24px);

            z-index: 1000;
        }

        html.light .sidebar {
            background:
                rgba(255,255,255,.88);
        }

        .logo {
            display: flex;
            align-items: center;

            gap: 11px;

            padding: 4px 10px;

            margin-bottom: 42px;
        }

        .logo img {
            width: 42px;
            height: 42px;

            object-fit: contain;
        }

        .logo-text {
            font-size: 19px;
            font-weight: 700;

            letter-spacing: -.7px;
        }

        .logo-text span {
            color: var(--text);
        }

        .nav-title {
            padding: 0 12px;

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

            gap: 5px;
        }

        .nav-item {
            position: relative;

            display: flex;
            align-items: center;

            gap: 13px;

            padding: 13px 14px;

            border-radius: 13px;

            color: var(--muted);

            font-size: 12px;
            font-weight: 500;

            transition: .25s ease;
        }

        .nav-item i {
            width: 19px;

            text-align: center;

            font-size: 17px;
        }

        .nav-item:hover {
            color: var(--text);

            background:
                rgba(255,255,255,.045);

            transform:
                translateX(3px);
        }

        html.light .nav-item:hover {
            background:
                rgba(0,0,0,.035);
        }

        .nav-item.active {
            color: var(--text);

            background:
                linear-gradient(
                    135deg,
                    rgba(255,255,255,.09),
                    rgba(255,255,255,.025)
                );
        }

        .nav-item.active::before {
            content: "";

            position: absolute;

            left: 0;
            top: 50%;

            width: 3px;
            height: 22px;

            border-radius: 20px;

            background:
                var(--text);

            transform:
                translateY(-50%);
        }


        /* =====================================================
           SIDEBAR BOTTOM
        ===================================================== */

        .sidebar-bottom {
            margin-top: auto;

            display: flex;
            flex-direction: column;

            gap: 8px;
        }

        .theme-toggle {
            width: 100%;

            border:
                1px solid var(--border);

            background:
                rgba(255,255,255,.025);

            color: var(--muted);

            padding: 11px 13px;

            border-radius: 13px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            cursor: pointer;

            transition: .3s ease;
        }

        .theme-toggle:hover {
            color: var(--text);

            background:
                rgba(255,255,255,.055);
        }

        html.light .theme-toggle:hover {
            background:
                rgba(0,0,0,.035);
        }

        .theme-left {
            display: flex;
            align-items: center;

            gap: 10px;

            font-size: 11px;
        }

        .theme-left i {
            font-size: 15px;
        }

        .profile-link {
            display: flex;
            align-items: center;

            gap: 10px;

            padding: 9px;

            border-radius: 14px;

            transition: .25s ease;
        }

        .profile-link:hover {
            background:
                rgba(255,255,255,.045);
        }

        .profile-avatar,
        .profile-placeholder {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            border-radius: 50%;
        }

        .profile-avatar {
            object-fit: cover;

            border:
                1px solid var(--border);
        }

        .profile-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #eeeeee,
                    #777777
                );

            color: #111;

            font-size: 16px;
        }

        .profile-info {
            min-width: 0;
        }

        .profile-name {
            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        .profile-label {
            color: var(--muted);

            font-size: 9px;
        }


        /* =====================================================
           MOBILE HEADER
        ===================================================== */

        .mobile-header {
            display: none;

            position: fixed;

            left: 0;
            right: 0;
            top: 0;

            height: 64px;

            padding: 0 16px;

            align-items: center;
            justify-content: space-between;

            background:
                rgba(14,14,15,.88);

            border-bottom:
                1px solid var(--border);

            backdrop-filter:
                blur(20px);

            z-index: 1500;
        }

        html.light .mobile-header {
            background:
                rgba(255,255,255,.88);
        }

        .mobile-logo {
            display: flex;
            align-items: center;

            gap: 8px;

            font-size: 15px;
            font-weight: 700;
        }

        .mobile-logo img {
            width: 32px;
            height: 32px;
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

            border:
                1px solid var(--border);

            border-radius: 11px;

            background:
                rgba(255,255,255,.035);

            color: var(--text);

            cursor: pointer;
        }


        /* =====================================================
           MOBILE DRAWER
        ===================================================== */

        .mobile-drawer {
            position: fixed;

            inset: 0;

            background:
                rgba(0,0,0,.65);

            backdrop-filter:
                blur(5px);

            z-index: 3000;

            opacity: 0;
            visibility: hidden;

            transition: .3s ease;
        }

        .mobile-drawer.show {
            opacity: 1;
            visibility: visible;
        }

        .mobile-drawer-content {
            position: absolute;

            left: 0;
            top: 0;
            bottom: 0;

            width: 275px;

            padding: 25px 18px;

            background:
                var(--bg-2);

            transform:
                translateX(-100%);

            transition:
                transform .35s ease;
        }

        .mobile-drawer.show
        .mobile-drawer-content {
            transform:
                translateX(0);
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            margin-left: 245px;

            min-height: 100vh;
        }

        .container {
            width:
                min(
                    1240px,
                    calc(100% - 70px)
                );

            margin: auto;
        }


        /* =====================================================
           EXPLORE HEADER
        ===================================================== */

        .explore-header {
            padding-top: 75px;
            padding-bottom: 30px;

            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 30px;
        }

        .eyebrow {
            display: flex;
            align-items: center;

            gap: 7px;

            margin-bottom: 9px;

            color: var(--text);

            font-size: 9px;
            font-weight: 700;

            letter-spacing: 1.8px;

            text-transform: uppercase;
        }

        .eyebrow i {
            font-size: 11px;
        }

        .explore-title {
            margin: 0;

            font-size:
                clamp(36px, 5vw, 58px);

            line-height: 1;

            letter-spacing: -3px;

            font-weight: 800;
        }

        .explore-title span {
            color: var(--text-soft);
        }

        .explore-description {
            max-width: 430px;

            margin: 14px 0 0;

            color: var(--muted);

            font-size: 11px;

            line-height: 1.8;
        }


        /* =====================================================
           SEARCH
        ===================================================== */

        .search-wrapper {
            width: 330px;

            flex-shrink: 0;
        }

        .search-box {
            position: relative;

            display: flex;
            align-items: center;
        }

        .search-box > i {
            position: absolute;

            left: 16px;

            color: var(--muted);

            font-size: 15px;

            pointer-events: none;
        }

        .search-box input {
            width: 100%;

            padding:
                14px 45px 14px 43px;

            border:
                1px solid var(--border);

            border-radius: 15px;

            outline: none;

            background:
                var(--card);

            color:
                var(--text);

            font-size: 11px;

            transition: .3s ease;
        }

        .search-box input::placeholder {
            color: var(--muted);
        }

        .search-box input:focus {
            border-color:
                rgba(255,255,255,.25);

            box-shadow:
                0 0 0 4px
                rgba(255,255,255,.035);
        }

        .search-clear {
            position: absolute;

            right: 13px;

            width: 25px;
            height: 25px;

            display: none;
            align-items: center;
            justify-content: center;

            border: 0;

            border-radius: 50%;

            background:
                rgba(255,255,255,.07);

            color: var(--muted);

            cursor: pointer;
        }


        /* =====================================================
           CATEGORY FOLDER
        ===================================================== */

        .category-section {
            padding:
                20px 0 35px;
        }

        .section-mini-title {
            margin-bottom: 15px;

            color: var(--muted);

            font-size: 9px;
            font-weight: 700;

            letter-spacing: 1.5px;

            text-transform: uppercase;
        }

        .categories {
            display: grid;

            grid-template-columns:
                repeat(
                    auto-fill,
                    minmax(155px, 1fr)
                );

            gap: 12px;

            overflow: visible;
        }

        .category {
            position: relative;

            min-height: 105px;

            display: flex;
            flex-direction: column;

            justify-content: space-between;

            padding: 14px;

            border:
                1px solid var(--border);

            border-radius: 15px;

            background:
                linear-gradient(
                    145deg,
                    var(--card),
                    var(--bg-3)
                );

            color: var(--text-soft);

            font-size: 10px;
            font-weight: 600;

            overflow: hidden;

            transition:
                transform .3s ease,
                border-color .3s ease,
                background .3s ease,
                box-shadow .3s ease;
        }

        /* Folder tab */

        .category::before {
            content: "";

            position: absolute;

            top: 0;
            left: 14px;

            width: 34px;
            height: 6px;

            border-radius:
                0 0 6px 6px;

            background:
                rgba(255,255,255,.16);
        }

        /* Folder icon */

        .category i {
            width: 39px;
            height: 31px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background:
                rgba(255,255,255,.055);

            color:
                var(--text);

            font-size: 17px;

            transition:
                transform .3s ease,
                background .3s ease;
        }

        .category:hover {
            color: var(--text);

            border-color:
                rgba(255,255,255,.18);

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.08),
                    var(--card)
                );

            transform:
                translateY(-4px);

            box-shadow:
                0 14px 35px
                rgba(0,0,0,.25);
        }

        .category:hover i {
            background:
                rgba(255,255,255,.1);

            transform:
                translateY(-2px)
                scale(1.05);
        }

        .category.active {
            color: var(--text);

            border-color:
                rgba(255,255,255,.32);

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.12),
                    rgba(255,255,255,.035)
                );

            box-shadow:
                inset 0 1px 0
                rgba(255,255,255,.08),

                0 12px 30px
                rgba(0,0,0,.2);
        }

        .category.active::before {
            background:
                white;
        }

        .category.active i {
            background:
                rgba(255,255,255,.12);

            color: white;
        }

        html.light .category {
            background:
                linear-gradient(
                    145deg,
                    #ffffff,
                    #f1f1ef
                );
        }

        html.light .category:hover {
            border-color:
                rgba(0,0,0,.18);

            background:
                linear-gradient(
                    145deg,
                    #ffffff,
                    #eeeeec
                );

            box-shadow:
                0 14px 35px
                rgba(0,0,0,.08);
        }

        html.light .category.active {
            border-color:
                rgba(0,0,0,.25);

            background:
                linear-gradient(
                    145deg,
                    #eeeeec,
                    #ffffff
                );
        }

        html.light .category::before {
            background:
                rgba(0,0,0,.15);
        }

        html.light .category i {
            background:
                rgba(0,0,0,.045);
        }

        html.light .category.active i {
            background:
                rgba(0,0,0,.08);

            color:
                var(--text);
        }


        /* =====================================================
           TRENDING
        ===================================================== */

        .trending-section {
            padding:
                45px 0 20px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            margin-bottom: 22px;
        }

        .section-eyebrow {
            margin-bottom: 6px;

            color: var(--muted);

            font-size: 8px;
            font-weight: 700;

            letter-spacing: 1.7px;

            text-transform: uppercase;
        }

        .section-title {
            margin: 0;

            font-size: 25px;

            letter-spacing: -1px;

            font-weight: 700;
        }

        .section-description {
            max-width: 330px;

            color: var(--muted);

            font-size: 9px;

            line-height: 1.7;

            text-align: right;
        }

        .trending {
            display: flex;

            gap: 13px;

            overflow-x: auto;

            padding-bottom: 10px;

            scrollbar-width: thin;

            scrollbar-color:
                rgba(255,255,255,.2)
                transparent;
        }

        .trend-card {
            position: relative;

            min-width: 210px;
            height: 150px;

            overflow: hidden;

            border:
                1px solid var(--border);

            border-radius: 17px;

            background:
                var(--card);

            cursor: pointer;
        }

        .trend-card img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            transition:
                transform .6s ease,
                filter .4s ease;
        }

        .trend-card:hover img {
            transform:
                scale(1.08);

            filter:
                brightness(.6);
        }

        .trend-overlay {
            position: absolute;

            inset: 0;

            display: flex;
            align-items: flex-end;

            padding: 14px;

            background:
                linear-gradient(
                    to top,
                    rgba(0,0,0,.7),
                    transparent 65%
                );
        }

        .trend-number {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 27px;
            height: 27px;

            margin-right: 8px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.9);

            color: #111;

            font-size: 10px;
            font-weight: 800;
        }

        .trend-label {
            color: white;

            font-size: 9px;
            font-weight: 600;
        }


        /* =====================================================
           EXPLORE GALLERY
        ===================================================== */

        .explore-section {
            padding:
                75px 0;
        }

        .gallery-toolbar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            margin-bottom: 25px;
        }

        .result-count {
            color: var(--muted);

            font-size: 9px;
        }

        .sort-button {
            display: flex;
            align-items: center;

            gap: 7px;

            padding: 9px 12px;

            border:
                1px solid var(--border);

            border-radius: 10px;

            background:
                var(--card);

            color: var(--muted);

            font-size: 9px;

            cursor: pointer;
        }


        /* =====================================================
           MASONRY
        ===================================================== */

        .masonry {
            columns:
                4 220px;

            column-gap: 15px;
        }

        .post-card {
            position: relative;

            display: inline-block;

            width: 100%;

            margin:
                0 0 15px;

            break-inside: avoid;

            overflow: hidden;

            border:
                1px solid var(--border);

            border-radius: 17px;

            background:
                var(--card);

            cursor: pointer;

            box-shadow:
                0 10px 35px
                rgba(0,0,0,.18);

            animation:
                cardIn .55s ease both;
        }

        @keyframes cardIn {

            from {
                opacity: 0;

                transform:
                    translateY(20px);
            }

            to {
                opacity: 1;

                transform:
                    translateY(0);
            }
        }

        .post-image {
            position: relative;

            overflow: hidden;
        }

        .post-image img {
            width: 100%;
            height: auto;

            display: block;

            transition:
                transform .6s ease,
                filter .45s ease;
        }

        .post-card:hover
        .post-image img {
            transform:
                scale(1.045);

            filter:
                brightness(.57);
        }

        .post-overlay {
            position: absolute;

            inset: 0;

            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            padding: 13px;

            background:
                linear-gradient(
                    to top,
                    rgba(0,0,0,.8),
                    transparent 55%
                );

            opacity: 0;

            transition:
                opacity .3s ease;
        }

        .post-card:hover
        .post-overlay {
            opacity: 1;
        }

        .post-info {
            min-width: 0;

            max-width: 70%;
        }

        .post-name {
            display: block;

            color: white;

            font-size: 10px;
            font-weight: 600;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        .post-meta {
            margin-top: 3px;

            color:
                rgba(255,255,255,.58);

            font-size: 7px;
        }

        .open-button {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border: 0;

            border-radius: 50%;

            background:
                rgba(255,255,255,.12);

            color: white;

            backdrop-filter:
                blur(8px);

            transition: .25s ease;
        }

        .post-card:hover
        .open-button {
            background:
                white;

            color: #111;

            transform:
                rotate(5deg);
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-state {
            padding: 90px 20px;

            text-align: center;

            border:
                1px dashed var(--border);

            border-radius: 20px;

            color: var(--muted);
        }

        .empty-state i {
            display: block;

            margin-bottom: 14px;

            color:
                var(--text);

            font-size: 40px;
        }

        .empty-state h3 {
            margin:
                0 0 7px;

            color:
                var(--text);

            font-size: 16px;
        }

        .empty-state p {
            margin: 0;

            font-size: 10px;
        }


        /* =====================================================
           MODAL
        ===================================================== */

        .modal {
            position: fixed;

            inset: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px;

            background:
                rgba(0,0,0,.94);

            backdrop-filter:
                blur(12px);

            z-index: 5000;

            opacity: 0;
            visibility: hidden;

            transition: .3s ease;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            position: relative;

            max-width: 1100px;
            max-height: 92vh;

            display: flex;
            flex-direction: column;
            align-items: center;

            transform:
                scale(.9);

            transition:
                .35s ease;
        }

        .modal.active
        .modal-content {
            transform:
                scale(1);
        }

        .modal img {
            max-width: 100%;
            max-height: 78vh;

            object-fit: contain;

            border-radius: 17px;

            box-shadow:
                0 30px 100px
                rgba(0,0,0,.6);
        }

        .modal-close {
            position: fixed;

            top: 22px;
            right: 22px;

            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border:
                1px solid
                rgba(255,255,255,.12);

            border-radius: 50%;

            background:
                rgba(255,255,255,.08);

            color: white;

            cursor: pointer;

            font-size: 17px;
        }

        .modal-actions {
            display: flex;

            gap: 8px;

            margin-top: 14px;
        }

        .modal-action {
            display: flex;
            align-items: center;

            gap: 7px;

            padding: 10px 15px;

            border:
                1px solid
                rgba(255,255,255,.1);

            border-radius: 100px;

            background:
                rgba(255,255,255,.06);

            color: white;

            font-size: 9px;

            cursor: pointer;

            transition: .25s ease;
        }

        .modal-action:hover {
            background: white;

            color: #111;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        footer {
            padding:
                25px 0 35px;

            border-top:
                1px solid var(--border);

            color: var(--muted);

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

        @media(max-width: 1100px) {

            .sidebar {
                width: 215px;
            }

            .main {
                margin-left: 215px;
            }

            .container {
                width: 94%;
            }

            .explore-header {
                align-items: flex-start;

                flex-direction: column;
            }

            .search-wrapper {
                width: 100%;

                max-width: 500px;
            }

            .masonry {
                columns:
                    3 180px;
            }

        }


        @media(max-width: 767px) {

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
                width:
                    calc(100% - 30px);
            }

            .explore-header {
                padding-top: 45px;

                padding-bottom: 20px;
            }

            .explore-title {
                font-size: 42px;

                letter-spacing:
                    -2.5px;
            }

            .explore-description {
                font-size: 10px;
            }

            .search-wrapper {
                width: 100%;
            }


            /* Mobile folders */

            .categories {
                display: flex;

                gap: 9px;

                overflow-x: auto;

                padding:
                    4px 2px 10px;

                scrollbar-width: none;
            }

            .categories::-webkit-scrollbar {
                display: none;
            }

            .category {
                min-width: 125px;

                min-height: 90px;

                padding: 12px;

                border-radius: 13px;

                flex-shrink: 0;
            }

            .category i {
                width: 34px;
                height: 28px;

                font-size: 15px;
            }


            .trending-section {
                padding-top: 35px;
            }

            .section-header {
                display: block;
            }

            .section-description {
                margin-top: 7px;

                text-align: left;
            }

            .trend-card {
                min-width: 175px;

                height: 125px;
            }

            .explore-section {
                padding: 50px 0;
            }

            .gallery-toolbar {
                align-items: center;
            }

            .masonry {
                columns:
                    2 140px;

                column-gap: 9px;
            }

            .post-card {
                margin-bottom: 9px;

                border-radius: 12px;
            }

            .post-overlay {
                opacity: 1;

                padding: 8px;
            }

            .post-name {
                font-size: 8px;
            }

            .post-meta {
                display: none;
            }

            .open-button {
                width: 27px;
                height: 27px;

                font-size: 9px;
            }

            .modal {
                padding: 15px;
            }

            .modal img {
                max-height: 72vh;
            }

            footer {
                padding-bottom: 80px;
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

@php
    $profile = optional(auth()->user()->profile);
    $avatar = $profile->avatar ?? null;
    $hasAvatar = !empty($avatar);
@endphp


<!-- =========================================================
     DESKTOP SIDEBAR
========================================================= -->

<aside class="sidebar">

    <a href="{{ route('dashboard') }}"
       class="logo">

        <img
            src="{{ asset('logo/logo.png') }}"
            alt="GallSpace"
        >

        <div class="logo-text">
            Gall<span>Space</span>
        </div>

    </a>


    <div class="nav-title">
        Navigation
    </div>


    <nav class="sidebar-nav">

        <a
            href="{{ route('dashboard') }}"
            class="nav-item"
        >
            <i class="bi bi-house"></i>

            <span>
                Home
            </span>
        </a>


        <a
            href="/jelajah"
            class="nav-item active"
        >
            <i class="bi bi-compass-fill"></i>

            <span>
                Explore
            </span>
        </a>


        @auth

            <a
                href="/upload"
                class="nav-item"
            >
                <i class="bi bi-plus-square"></i>

                <span>
                    Upload Artwork
                </span>
            </a>

        @else

            <a
                href="{{ route('login') }}"
                class="nav-item"
            >
                <i class="bi bi-plus-square"></i>

                <span>
                    Upload Artwork
                </span>
            </a>

        @endauth

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

        @else

            <a
                href="{{ route('login') }}"
                class="profile-link"
            >

                <div class="profile-placeholder">
                    <i class="bi bi-person"></i>
                </div>

                <div class="profile-info">

                    <div class="profile-name">
                        Login
                    </div>

                    <div class="profile-label">
                        Sign in to GallSpace
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
            Gall<span style="color:var(--text)">
                Space
            </span>
        </span>

    </a>


    <div class="mobile-actions">

        <button
            class="mobile-btn"
            id="mobileTheme"
            type="button"
        >
            <i class="bi bi-moon-stars"></i>
        </button>


        <button
            class="mobile-btn"
            id="mobileMenu"
            type="button"
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

            <div class="logo-text">
                Gall<span>Space</span>
            </div>

        </a>


        <nav class="sidebar-nav">

            <a
                href="{{ route('dashboard') }}"
                class="nav-item"
            >
                <i class="bi bi-house"></i>
                Home
            </a>


            <a
                href="/jelajah"
                class="nav-item active"
            >
                <i class="bi bi-compass-fill"></i>
                Explore
            </a>


            @auth

                <a
                    href="/upload"
                    class="nav-item"
                >
                    <i class="bi bi-plus-square"></i>
                    Upload Artwork
                </a>


                <a
                    href="{{ route('akun') }}"
                    class="nav-item"
                >
                    <i class="bi bi-person"></i>
                    Profile
                </a>

            @else

                <a
                    href="{{ route('login') }}"
                    class="nav-item"
                >
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </a>


                <a
                    href="{{ route('register') }}"
                    class="nav-item"
                >
                    <i class="bi bi-person-plus"></i>
                    Register
                </a>

            @endauth

        </nav>


        <button
            type="button"
            class="theme-toggle"
            id="mobileThemeDrawer"
            style="margin-top:25px;"
        >

            <div class="theme-left">

                <i class="bi bi-moon-stars"></i>

                <span>
                    Change Theme
                </span>

            </div>

            <i class="bi bi-chevron-right"></i>

        </button>

    </div>

</div>


<!-- =========================================================
     MAIN
========================================================= -->

<main class="main">

    <div class="container">


        <!-- =================================================
             EXPLORE HEADER
        ================================================== -->

        <section class="explore-header">

            <div>

                <div class="eyebrow">

                    <i class="bi bi-compass"></i>

                    Explore GallSpace

                </div>


                <h1 class="explore-title">

                    Find something
                    <span>
                        inspiring.
                    </span>

                </h1>


                <p class="explore-description">

                    Jelajahi berbagai karya kreatif dari
                    komunitas GallSpace. Temukan inspirasi,
                    nikmati karya, dan temukan sesuatu yang
                    sesuai dengan style kamu.

                </p>

            </div>


            <div class="search-wrapper">

                <div class="search-box">

                    <i class="bi bi-search"></i>


                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search artwork..."
                        autocomplete="off"
                    >


                    <button
                        type="button"
                        class="search-clear"
                        id="searchClear"
                    >
                        <i class="bi bi-x"></i>
                    </button>

                </div>

            </div>

        </section>


        <!-- =================================================
             CATEGORIES / FOLDERS
        ================================================== -->

        <section class="category-section">

            <div class="section-mini-title">
                Browse Categories
            </div>


            <div class="categories">


                <!-- ALL -->

                <a
                    href="/jelajah"
                    class="category active"
                >

                    <i class="bi bi-grid"></i>

                    <span>
                        All Artwork
                    </span>

                </a>


                @foreach($categories as $category)

                    <a
                        href="/jelajah/{{ $category }}"
                        class="category"
                    >

                        @if($category === 'photography')

                            <i class="bi bi-camera"></i>

                        @elseif($category === 'anime')

                            <i class="bi bi-stars"></i>

                        @elseif($category === 'architecture')

                            <i class="bi bi-building"></i>

                        @elseif($category === 'art')

                            <i class="bi bi-palette"></i>

                        @elseif($category === 'food')

                            <i class="bi bi-cup-hot"></i>

                        @elseif($category === 'memes')

                            <i class="bi bi-emoji-laughing"></i>

                        @else

                            <i class="bi bi-images"></i>

                        @endif


                        <span>
                            {{ ucfirst($category) }}
                        </span>

                    </a>

                @endforeach

            </div>

        </section>


        <!-- =================================================
             TRENDING
        ================================================== -->

        @if(count($trendingImages ?? []) > 0)

            <section class="trending-section">

                <div class="section-header">

                    <div>

                        <div class="section-eyebrow">
                            Popular right now
                        </div>

                        <h2 class="section-title">
                            Trending artwork.
                        </h2>

                    </div>


                    <p class="section-description">

                        Karya yang sedang menarik perhatian
                        komunitas GallSpace.

                    </p>

                </div>


                <div class="trending">

                    @foreach($trendingImages as $index => $image)

                        @php
                            $trendName = pathinfo(
                                basename($image),
                                PATHINFO_FILENAME
                            );
                        @endphp


                        <div
                            class="trend-card"
                            onclick="openModal('{{ $image }}')"
                        >

                            <img
                                src="{{ $image }}"
                                alt="{{ $trendName }}"
                                loading="lazy"
                            >


                            <div class="trend-overlay">

                                <div class="trend-number">
                                    {{ $index + 1 }}
                                </div>


                                <span class="trend-label">
                                    {{ ucfirst($trendName) }}
                                </span>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>

        @endif


        <!-- =================================================
             EXPLORE GALLERY
        ================================================== -->

        <section class="explore-section">

            <div class="gallery-toolbar">

                <div>

                    <div class="section-eyebrow">
                        Community gallery
                    </div>

                    <h2 class="section-title">
                        Explore everything.
                    </h2>

                </div>


                <div
                    class="result-count"
                    id="resultCount"
                >
                    {{ count($exploreImages ?? []) }}
                    artworks
                </div>

            </div>


            @if(count($exploreImages ?? []) > 0)

                <div
                    class="masonry"
                    id="exploreGrid"
                >

                    @foreach($exploreImages as $index => $image)

                        @php

                            $filename =
                                basename($image);

                            $cleanName =
                                pathinfo(
                                    $filename,
                                    PATHINFO_FILENAME
                                );

                        @endphp


                        <div
                            class="post-card"
                            data-name="{{ strtolower($cleanName) }}"
                            data-src="{{ strtolower($image) }}"
                            style="
                                animation-delay:
                                {{ min($index * 0.035, .5) }}s
                            "
                        >

                            <div class="post-image">

                                <img
                                    src="{{ $image }}"
                                    alt="{{ ucfirst($cleanName) }}"
                                    loading="lazy"
                                >


                                <div class="post-overlay">

                                    <div class="post-info">

                                        <span class="post-name">
                                            {{ ucfirst($cleanName) }}
                                        </span>


                                        <div class="post-meta">
                                            GallSpace Artwork
                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="open-button"
                                        onclick="
                                            event.stopPropagation();
                                            openModal('{{ $image }}')
                                        "
                                    >

                                        <i class="bi bi-arrow-up-right"></i>

                                    </button>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


                <div
                    id="noResults"
                    class="empty-state"
                    style="display:none;"
                >

                    <i class="bi bi-search"></i>


                    <h3>
                        Artwork tidak ditemukan
                    </h3>


                    <p>
                        Coba gunakan kata kunci pencarian
                        yang berbeda.
                    </p>

                </div>

            @else

                <div class="empty-state">

                    <i class="bi bi-images"></i>


                    <h3>
                        Belum ada artwork
                    </h3>


                    <p>
                        Belum ada karya yang tersedia
                        di GallSpace.
                    </p>

                </div>

            @endif

        </section>

    </div>


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


<!-- =========================================================
     MODAL
========================================================= -->

<div
    class="modal"
    id="modal"
    onclick="handleModalClick(event)"
>

    <button
        type="button"
        class="modal-close"
        onclick="closeModal()"
    >

        <i class="bi bi-x-lg"></i>

    </button>


    <div class="modal-content">

        <img
            id="modal-img"
            src=""
            alt="Artwork preview"
        >


        <div class="modal-actions">

            <button
                type="button"
                class="modal-action"
                id="modalLike"
            >

                <i class="bi bi-heart"></i>

                Like

            </button>


            <a
                href="#"
                id="modalDownload"
                class="modal-action"
                download
            >

                <i class="bi bi-download"></i>

                Download

            </a>

        </div>

    </div>

</div>


<script>

    /* =========================================================
       THEME
    ========================================================= */

    const html =
        document.documentElement;

    const themeToggle =
        document.getElementById(
            'themeToggle'
        );

    const mobileTheme =
        document.getElementById(
            'mobileTheme'
        );

    const mobileThemeDrawer =
        document.getElementById(
            'mobileThemeDrawer'
        );

    const themeIcon =
        document.getElementById(
            'themeIcon'
        );

    const themeText =
        document.getElementById(
            'themeText'
        );


    function updateThemeUI() {

        const isLight =
            html.classList.contains(
                'light'
            );


        if (themeIcon) {

            themeIcon.className =
                isLight
                    ? 'bi bi-sun'
                    : 'bi bi-moon-stars';

        }


        if (themeText) {

            themeText.innerText =
                isLight
                    ? 'Light Mode'
                    : 'Dark Mode';

        }


        if (mobileTheme) {

            mobileTheme.innerHTML =
                isLight

                    ? '<i class="bi bi-sun"></i>'

                    : '<i class="bi bi-moon-stars"></i>';

        }


        if (mobileThemeDrawer) {

            const icon =
                mobileThemeDrawer
                    .querySelector('i');

            if (icon) {

                icon.className =
                    isLight
                        ? 'bi bi-sun'
                        : 'bi bi-moon-stars';

            }

        }

    }


    function setTheme(theme) {

        if (theme === 'light') {

            html.classList.add(
                'light'
            );

        } else {

            html.classList.remove(
                'light'
            );

        }


        localStorage.setItem(
            'gallspace-theme',
            theme
        );


        updateThemeUI();

    }


    function toggleTheme() {

        const isLight =
            html.classList.contains(
                'light'
            );


        setTheme(
            isLight
                ? 'dark'
                : 'light'
        );

    }


    const savedTheme =
        localStorage.getItem(
            'gallspace-theme'
        );


    if (savedTheme === 'light') {

        html.classList.add(
            'light'
        );

    } else {

        html.classList.remove(
            'light'
        );

    }


    updateThemeUI();


    if (themeToggle) {

        themeToggle.addEventListener(
            'click',
            toggleTheme
        );

    }


    if (mobileTheme) {

        mobileTheme.addEventListener(
            'click',
            toggleTheme
        );

    }


    if (mobileThemeDrawer) {

        mobileThemeDrawer.addEventListener(
            'click',
            toggleTheme
        );

    }


    /* =========================================================
       MOBILE DRAWER
    ========================================================= */

    const mobileMenu =
        document.getElementById(
            'mobileMenu'
        );

    const mobileDrawer =
        document.getElementById(
            'mobileDrawer'
        );


    if (
        mobileMenu &&
        mobileDrawer
    ) {

        mobileMenu.addEventListener(
            'click',
            () => {

                mobileDrawer.classList.add(
                    'show'
                );

            }
        );


        mobileDrawer.addEventListener(
            'click',
            event => {

                if (
                    event.target ===
                    mobileDrawer
                ) {

                    mobileDrawer.classList.remove(
                        'show'
                    );

                }

            }
        );


        mobileDrawer
            .querySelectorAll('a')
            .forEach(link => {

                link.addEventListener(
                    'click',
                    () => {

                        mobileDrawer.classList.remove(
                            'show'
                        );

                    }
                );

            });

    }


    /* =========================================================
       SEARCH
    ========================================================= */

    const searchInput =
        document.getElementById(
            'searchInput'
        );

    const searchClear =
        document.getElementById(
            'searchClear'
        );

    const resultCount =
        document.getElementById(
            'resultCount'
        );

    const noResults =
        document.getElementById(
            'noResults'
        );


    function searchImages(keyword) {

        keyword =
            keyword
                .toLowerCase()
                .trim();


        const cards =
            document.querySelectorAll(
                '.post-card'
            );


        let visible = 0;


        cards.forEach(card => {

            const name =
                card.dataset.name ||
                '';

            const src =
                card.dataset.src ||
                '';


            const matched =
                !keyword ||
                name.includes(keyword) ||
                src.includes(keyword);


            if (matched) {

                card.style.display =
                    'inline-block';

                visible++;

            } else {

                card.style.display =
                    'none';

            }

        });


        if (resultCount) {

            resultCount.innerText =
                visible +
                ' artwork' +
                (
                    visible !== 1
                        ? 's'
                        : ''
                );

        }


        if (noResults) {

            noResults.style.display =
                visible === 0 &&
                cards.length > 0
                    ? 'block'
                    : 'none';

        }


        if (searchClear) {

            searchClear.style.display =
                keyword
                    ? 'flex'
                    : 'none';

        }

    }


    if (searchInput) {

        searchInput.addEventListener(
            'input',
            function() {

                searchImages(
                    this.value
                );

            }
        );

    }


    if (searchClear) {

        searchClear.addEventListener(
            'click',
            () => {

                searchInput.value = '';

                searchImages('');

                searchInput.focus();

            }
        );

    }


    /* =========================================================
       MODAL
    ========================================================= */

    const modal =
        document.getElementById(
            'modal'
        );

    const modalImg =
        document.getElementById(
            'modal-img'
        );

    const modalDownload =
        document.getElementById(
            'modalDownload'
        );


    function openModal(src) {

        if (
            !modal ||
            !modalImg
        ) {
            return;
        }


        modalImg.src =
            src;


        if (modalDownload) {

            modalDownload.href =
                src;

        }


        modal.classList.add(
            'active'
        );


        document.body.style.overflow =
            'hidden';

    }


    function closeModal() {

        if (!modal) {
            return;
        }


        modal.classList.remove(
            'active'
        );


        document.body.style.overflow =
            '';

    }


    function handleModalClick(event) {

        if (
            event.target ===
            modal
        ) {

            closeModal();

        }

    }


    document.addEventListener(
        'keydown',
        event => {

            if (
                event.key ===
                'Escape'
            ) {

                closeModal();


                if (mobileDrawer) {

                    mobileDrawer.classList.remove(
                        'show'
                    );

                }

            }

        }
    );


    /* =========================================================
       IMAGE FALLBACK
    ========================================================= */

    document
        .querySelectorAll('img')
        .forEach(img => {

            img.addEventListener(
                'error',
                function() {

                    this.style.opacity =
                        '0';

                }
            );

        });


    /* =========================================================
       CARD CLICK
    ========================================================= */

    document
        .querySelectorAll('.post-card')
        .forEach(card => {

            card.addEventListener(
                'click',
                () => {

                    const img =
                        card.querySelector(
                            'img'
                        );


                    if (img) {

                        openModal(
                            img.src
                        );

                    }

                }
            );

        });

</script>

</body>
</html>
