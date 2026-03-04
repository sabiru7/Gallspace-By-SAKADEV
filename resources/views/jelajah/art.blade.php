<!DOCTYPE html>
<html>
<head>
    <title>Art Gallery</title>
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
            opacity: 0;
            transition: opacity .6s ease;
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
            transition: .4s ease;
            opacity: 0;
            transform: translateY(20px);
        }

        .card.show {
            opacity: 1;
            transform: translateY(0);
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
            cursor: pointer;
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
            text-decoration: none;
            transition: .2s;
        }

        .actions button:hover,
        .actions a:hover {
            opacity: .7;
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
            opacity: .8;
            margin-bottom: 6px;
        }

        .empty {
            margin-top: 20px;
            opacity: .7;
        }

        /* MODAL */
        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: .4s;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 15px;
            transform: scale(.8);
            transition: .4s;
        }

        .modal.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal.active img {
            transform: scale(1);
        }

        @media(max-width:768px){
            body{padding:20px}
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <div class="logo">
            <img src="{{ asset('logo/logo.png') }}" alt="Logo">
        </div>
        <h2>Art Gallery</h2>
    </div>

    <div class="search-box">
        <form method="GET" action="{{ route('jelajah.art') }}">
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

    <div class="grid">
        @foreach($images as $image)
        <div class="card">

            <img src="{{ $image }}" onclick="openModal(this.src)">

            <div class="title">
                {{ ucfirst(pathinfo($image, PATHINFO_FILENAME)) }}
            </div>

            <div class="actions">
                <button onclick="toggleLike(this)">
                    ❤️ <span class="like-count">0</span>
                </button>

                <button onclick="toggleComment(this)">
                    💬 Comment
                </button>

                <a href="{{ $image }}" download>
                    ⬇ Download
                </a>
            </div>

            <div class="comment-box">
                <div class="comment-list"></div>
                <input type="text" placeholder="Tulis komentar..." class="comment-input">
                <button onclick="addComment(this)">Post</button>
            </div>

        </div>
        @endforeach
    </div>

</div>

<div class="modal" id="modal" onclick="closeModal()">
    <img id="modal-img">
</div>

<script>

// Fade in page
window.addEventListener("load",()=>{
    document.body.style.opacity="1";
});

// Scroll animation
const observer = new IntersectionObserver(entries=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting){
            entry.target.classList.add("show");
        }
    });
},{threshold:0.2});

document.querySelectorAll(".card").forEach(card=>{
    observer.observe(card);
});

// Like
function toggleLike(button){
    const count = button.querySelector('.like-count');
    let num = parseInt(count.innerText);

    if(button.classList.contains("like-active")){
        button.classList.remove("like-active");
        count.innerText = num - 1;
    }else{
        button.classList.add("like-active");
        count.innerText = num + 1;
    }
}

// Comment toggle
function toggleComment(button){
    const card = button.closest('.card');
    const box = card.querySelector('.comment-box');

    box.style.display = 
        box.style.display === "block" ? "none" : "block";
}

// Add comment
function addComment(button){
    const card = button.closest('.card');
    const input = card.querySelector('.comment-input');
    const list = card.querySelector('.comment-list');

    if(input.value.trim() !== ""){
        const div = document.createElement("div");
        div.textContent = "• " + input.value;
        list.appendChild(div);
        input.value="";
    }
}

// Modal
function openModal(src){
    document.getElementById("modal").classList.add("active");
    document.getElementById("modal-img").src = src;
}

function closeModal(){
    document.getElementById("modal").classList.remove("active");
}

</script>

</body>
</html>