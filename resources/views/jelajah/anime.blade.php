<!DOCTYPE html>
<html>
<head>
    <title>Anime Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: black;
            color: white;
            padding: 40px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .logo img {
            height: 50px;
            border-radius: 15px;
        }

        /* Search */
        .search-box {
            margin-bottom: 30px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 15px;
            border: none;
            outline: none;
            font-size: 16px;
        }

        /* Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: #111;
            padding: 10px;
            border-radius: 15px;
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
        }

        .empty {
            margin-top: 20px;
            opacity: 0.7;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="{{ asset('logo/logo.png') }}" alt="Logo">
        </div>
        <h2>Art Gallery</h2>
    </div>

    <!-- Search Bar -->
    <div class="search-box">
        <form method="GET" action="{{ route('jelajah.anime') }}">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari nama gambar..."
                value="{{ request('search') }}"
            >
        </form>
    </div>

    @if(empty($images))
        <p class="empty">Tidak ada gambar ditemukan.</p>
    @endif

    <!-- Grid -->
    <div class="grid">
        @foreach($images as $image)
            <div class="card">
                <img src="{{ $image }}" alt="anime">
            </div>
        @endforeach
    </div>

</div>
</body>
</html>