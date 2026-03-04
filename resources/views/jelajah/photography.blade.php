<!DOCTYPE html>
<html>
<head>
    <title>Photography Gallery</title>
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

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        .card {
            background: #111;
            padding: 12px;
            border-radius: 18px;
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-6px);
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .actions button,
        .actions a {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
        }

        .actions button:hover {
            opacity: 0.7;
        }

        .download:hover {
            color: #00ff99;
        }

        .like-active {
            color: #ff4d6d;
        }

        .comment-box {
            display: none;
            margin-top: 10px;
        }

        .comment-box input {
            width: 100%;
            padding: 8px;
            border-radius: 10px;
            border: none;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .comment-box button {
            padding: 6px 10px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }

        .comment-list {
            font-size: 13px;
            opacity: 0.8;
            margin-bottom: 6px;
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
        <h2>Photography Gallery</h2>
    </div>

    <!-- Search -->
    <div class="search-box">
        <form method="GET" action="{{ route('jelajah.photography') }}">
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
        <div class="card" data-name="{{ strtolower(basename($image)) }}">

            <!-- Image -->
            <img src="{{ $image }}" alt="photo">

            <!-- Title -->
            <div class="title">
                {{ ucfirst(pathinfo($image, PATHINFO_FILENAME)) }}
            </div>

            <!-- Actions -->
            <div class="actions">

                <!-- Like -->
                <button onclick="toggleLike(this)">
                    ❤️ <span class="like-count">0</span>
                </button>

                <!-- Comment -->
                <button onclick="toggleComment(this)">
                    💬 Comment
                </button>

                <!-- Download -->
                <a href="{{ $image }}" download class="download">
                    ⬇ Download
                </a>

            </div>

            <!-- Comment Section -->
            <div class="comment-box">
                <div class="comment-list"></div>
                <input type="text" placeholder="Tulis komentar..." class="comment-input">
                <button onclick="addComment(this)">Post</button>
            </div>

        </div>
        @endforeach
    </div>

</div>

<script>

    function toggleLike(button) {
        const count = button.querySelector('.like-count');
        let number = parseInt(count.innerText);

        if (button.classList.contains('like-active')) {
            button.classList.remove('like-active');
            count.innerText = number - 1;
        } else {
            button.classList.add('like-active');
            count.innerText = number + 1;
        }
    }

    function toggleComment(button) {
        const card = button.closest('.card');
        const box = card.querySelector('.comment-box');

        box.style.display =
            box.style.display === 'block'
                ? 'none'
                : 'block';
    }

    function addComment(button) {
        const card = button.closest('.card');
        const input = card.querySelector('.comment-input');
        const list = card.querySelector('.comment-list');

        if (input.value.trim() !== '') {
            const newComment = document.createElement('div');
            newComment.textContent = "• " + input.value;
            list.appendChild(newComment);
            input.value = '';
        }
    }

</script>

</body>
</html>