<!DOCTYPE html>
<html>
<head>
    <title>Anime Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Poppins, sans-serif;
        }

        body{
            background:linear-gradient(to bottom,#0b0f14,#111820);
            color:white;
            padding:40px;
        }

        .container{
            max-width:1200px;
            margin:auto;
        }

        /* HEADER */
        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:40px;
            flex-wrap:wrap;
            gap:20px;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .logo img{
            height:50px;
            border-radius:15px;
        }

        .header h2{
            letter-spacing:2px;
            font-weight:600;
        }

        /* SEARCH */
        .search-box{
            margin-bottom:40px;
        }

        .search-box input{
            width:100%;
            padding:14px 18px;
            border-radius:30px;
            border:none;
            outline:none;
            font-size:14px;
            background:#1a2430;
            color:white;
            transition:.3s;
        }

        .search-box input:focus{
            box-shadow:0 0 15px #4f6d7a;
        }

        /* GRID */
        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
            gap:25px;
        }

        .card{
            background:#111820;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 10px 25px rgba(0,0,0,.4);
            transition:.4s;
        }

        .card:hover{
            transform:translateY(-8px);
            box-shadow:0 20px 40px rgba(0,0,0,.6);
        }

        .card img{
            width:100%;
            height:300px;
            object-fit:cover;
            transition:.4s;
            cursor:pointer;
        }

        .card:hover img{
            transform:scale(1.05);
        }

        .card-footer{
            padding:15px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .like-btn{
            background:#1a2430;
            padding:8px 14px;
            border-radius:25px;
            cursor:pointer;
            font-size:13px;
            transition:.3s;
            user-select:none;
        }

        .like-btn:hover{
            background:#4f6d7a;
        }

        .like-btn.liked{
            background:#e74c3c;
        }

        .download-btn{
            background:#4f6d7a;
            padding:8px 14px;
            border-radius:25px;
            text-decoration:none;
            color:white;
            font-size:13px;
            transition:.3s;
        }

        .download-btn:hover{
            background:white;
            color:black;
        }

        .empty{
            opacity:.6;
            margin-bottom:20px;
        }

        /* MODAL */
        .modal{
            position:fixed;
            inset:0;
            background:rgba(0,0,0,.95);
            display:flex;
            align-items:center;
            justify-content:center;
            opacity:0;
            pointer-events:none;
            transition:.4s;
        }

        .modal img{
            max-width:90%;
            max-height:90%;
            border-radius:15px;
            transform:scale(.8);
            transition:.4s;
        }

        .modal.active{
            opacity:1;
            pointer-events:auto;
        }

        .modal.active img{
            transform:scale(1);
        }

        /* RESPONSIVE */
        @media(max-width:600px){
            body{padding:20px;}
        }

    </style>
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <img src="{{ asset('logo/logo.png') }}" alt="Logo">
            <h2>ANIME GALLERY</h2>
        </div>
    </div>

    <!-- SEARCH -->
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

    <!-- GRID -->
    <div class="grid">
        @foreach($images as $image)
        <div class="card">
            <img src="{{ $image }}" onclick="openModal(this.src)">

            <div class="card-footer">
                <div class="like-btn" onclick="toggleLike(this)">
                    ❤️ <span>0</span>
                </div>

                <a href="{{ $image }}" download class="download-btn">
                    ⬇ Download
                </a>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- MODAL -->
<div class="modal" id="modal" onclick="closeModal()">
    <img id="modal-img">
</div>

<script>
function toggleLike(btn){
    const span = btn.querySelector("span");
    let count = parseInt(span.innerText);

    if(btn.classList.contains("liked")){
        btn.classList.remove("liked");
        span.innerText = count - 1;
    }else{
        btn.classList.add("liked");
        span.innerText = count + 1;
    }
}

function openModal(src){
    document.getElementById('modal').classList.add('active');
    document.getElementById('modal-img').src = src;
}

function closeModal(){
    document.getElementById('modal').classList.remove('active');
}
</script>

</body>
</html>