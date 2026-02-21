<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Gallspace</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins}
body{background:#0b0f14;color:#fff;padding:30px 60px}

/* HEADER */
.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:40px;
flex-wrap:wrap;
gap:20px;
}

.header-left{
display:flex;
align-items:center;
gap:15px;
}

/* BACK BUTTON */
.back-btn{
background:#1a2430;
color:#fff;
border:none;
padding:8px 18px;
border-radius:25px;
cursor:pointer;
font-size:13px;
transition:.3s;
}

.back-btn:hover{
background:#2d3e50;
transform:translateY(-2px);
}

/* LOGO */
.logo{
display:flex;
align-items:center;
gap:15px;
}

.logo img{width:50px}
.logo h1{font-size:20px;letter-spacing:2px}

/* SEARCH */
.search-box{
background:#111820;
padding:10px 15px;
border-radius:30px;
display:flex;
align-items:center;
width:300px;
}

.search-box input{
background:transparent;
border:none;
outline:none;
color:white;
width:100%;
font-size:14px;
}

/* SECTION TITLE */
.section-title{
margin:40px 0 15px;
font-size:16px;
color:#aaa;
}

/* CATEGORIES */
.categories{
display:grid;
grid-template-columns:1fr 1fr;
gap:20px;
}

.card{
padding:25px;
border-radius:15px;
transition:.3s;
cursor:pointer;
text-decoration:none;
color:white;
}

.card:hover{transform:translateY(-5px)}

.photography{background:#4f6d7a}
.anime{background:#7a4f6b}
.architecture{background:#3e5c3a}
.art{background:#4b4453}
.food{background:#5c2f0f}
.memes{background:#6e7300}

.card h3{font-size:18px;margin-bottom:8px}
.card span{font-size:13px;color:#ddd}

/* TRENDING */
.trending{
display:flex;
flex-wrap:wrap;
gap:15px;
}

.trending img{
width:180px;
height:120px;
object-fit:cover;
border-radius:12px;
cursor:pointer;
transition:.3s;
}

.trending img:hover{
transform:scale(1.05);
}

/* EXPLORE */
.explore-grid{
display:flex;
flex-wrap:wrap;
gap:15px;
margin-top:20px;
}

.explore-grid img{
width:220px;
border-radius:12px;
cursor:pointer;
transition:.3s;
}

.explore-grid img:hover{
transform:scale(1.05);
}

/* MODAL */
.modal{
position:fixed;
inset:0;
background:rgba(0,0,0,.9);
display:none;
align-items:center;
justify-content:center;
z-index:1000;
}

.modal img{
max-width:90%;
max-height:90%;
border-radius:12px;
}

.modal.active{
display:flex;
}

/* RESPONSIVE */
@media(max-width:768px){
body{padding:20px}
.search-box{width:100%}
.categories{grid-template-columns:1fr}
}
</style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <div class="header-left">
        <button class="back-btn" onclick="goBack()">← Back</button>

        <div class="logo">
            <img src="{{ asset('logo/logo.png') }}">
            <h1>GALLSPACE</h1>
        </div>
    </div>

    <div class="search-box">
        <input type="text" placeholder="Search images..." onkeyup="searchImages(this.value)">
    </div>
</div>

<!-- CATEGORIES -->
<div class="section-title">Browse Categories</div>
<div class="categories">
@foreach($categories as $category)
    <a href="/jelajah/{{ $category }}" class="card {{ $category }}">
        <h3>{{ ucfirst($category) }}</h3>
        <span>View Photos</span>
    </a>
@endforeach
</div>

<!-- TRENDING -->
<div class="section-title">Trending Now</div>
<div class="trending">
    @forelse($trendingImages as $image)
        <img src="{{ $image }}" onclick="openModal(this.src)">
    @empty
        <p>Tidak ada gambar trending.</p>
    @endforelse
</div>

<!-- EXPLORE -->
<div class="section-title">Explore</div>
<div class="explore-grid" id="exploreGrid">
    @forelse($exploreImages as $image)
        <img src="{{ $image }}" onclick="openModal(this.src)">
    @empty
        <p>Tidak ada gambar di folder explore.</p>
    @endforelse
</div>

<!-- MODAL -->
<div class="modal" id="modal" onclick="closeModal()">
    <img id="modal-img">
</div>

<script>
function goBack(){
    window.history.back();
}

function openModal(src){
    document.getElementById('modal').classList.add('active');
    document.getElementById('modal-img').src = src;
}

function closeModal(){
    document.getElementById('modal').classList.remove('active');
}

function searchImages(keyword){
    keyword = keyword.toLowerCase();
    const images = document.querySelectorAll('#exploreGrid img');

    images.forEach(img => {
        if(img.src.toLowerCase().includes(keyword)){
            img.style.display = "block";
        }else{
            img.style.display = "none";
        }
    });
}
</script>

</body>
</html>