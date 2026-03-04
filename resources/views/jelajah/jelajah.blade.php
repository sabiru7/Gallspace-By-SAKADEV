<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Gallspace</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins}

body{
background:linear-gradient(to bottom,#0b0f14,#111820);
color:#fff;
padding:30px 60px;
opacity:0;
transition:opacity .8s ease;
}

/* HEADER */
.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:50px;
flex-wrap:wrap;
gap:20px;
}

.header-left{
display:flex;
align-items:center;
gap:15px;
}

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
background:#4f6d7a;
transform:translateY(-2px);
}

.logo{
display:flex;
align-items:center;
gap:15px;
}
.logo img{width:50px}
.logo h1{
font-size:20px;
letter-spacing:2px;
font-weight:600;
}

/* SEARCH */
.search-box{
background:#111820;
padding:12px 18px;
border-radius:30px;
display:flex;
align-items:center;
width:300px;
transition:.3s;
}
.search-box:focus-within{
box-shadow:0 0 15px #4f6d7a;
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
margin:50px 0 20px;
font-size:15px;
color:#aaa;
letter-spacing:1px;
opacity:0;
transform:translateY(20px);
transition:.6s;
}
.section-title.show{
opacity:1;
transform:translateY(0);
}

/* CATEGORIES */
.categories{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;
}

.card{
padding:30px;
border-radius:20px;
transition:.4s;
cursor:pointer;
text-decoration:none;
color:white;
position:relative;
overflow:hidden;
opacity:0;
transform:translateY(20px);
}
.card.show{
opacity:1;
transform:translateY(0);
}
.card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,.4);
}

.card h3{font-size:18px;margin-bottom:8px}
.card span{font-size:13px;color:#eee}

.photography{background:linear-gradient(135deg,#4f6d7a,#2c3e50)}
.anime{background:linear-gradient(135deg,#7a4f6b,#3e1f2c)}
.architecture{background:linear-gradient(135deg,#3e5c3a,#1e2f1d)}
.art{background:linear-gradient(135deg,#4b4453,#2d2833)}
.food{background:linear-gradient(135deg,#5c2f0f,#2d1606)}
.memes{background:linear-gradient(135deg,#6e7300,#333600)}

/* TRENDING */
.trending{
display:flex;
gap:15px;
overflow-x:auto;
padding-bottom:10px;
}

.trending img{
height:130px;
border-radius:15px;
cursor:pointer;
transition:.4s;
opacity:0;
transform:scale(.9);
}
.trending img.show{
opacity:1;
transform:scale(1);
}
.trending img:hover{
transform:scale(1.05);
}

/* ===============================
   NEW EXPLORE SECTION
=================================*/

.explore-grid{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
gap:25px;
margin-top:30px;
}

.post-card{
background:#111820;
border-radius:20px;
overflow:hidden;
transition:.4s;
box-shadow:0 10px 25px rgba(0,0,0,.4);
opacity:0;
transform:translateY(40px);
}

.post-card.show{
opacity:1;
transform:translateY(0);
}

.post-card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,.6);
}

.post-card img{
width:100%;
height:300px;
object-fit:cover;
transition:.5s;
}

.post-card:hover img{
transform:scale(1.05);
}

.post-content{
padding:15px;
display:flex;
justify-content:space-between;
align-items:center;
}

.post-actions{
display:flex;
gap:10px;
}

.action-btn{
background:#1a2430;
padding:8px 14px;
border-radius:25px;
cursor:pointer;
font-size:13px;
transition:.3s;
display:flex;
align-items:center;
gap:6px;
user-select:none;
}

.action-btn:hover{
background:#4f6d7a;
}

.like-btn.liked{
background:#e74c3c;
color:white;
}

.download-btn{
background:#4f6d7a;
color:white;
padding:8px 14px;
border-radius:25px;
text-decoration:none;
font-size:13px;
font-weight:500;
transition:.3s;
}

.download-btn:hover{
background:white;
color:black;
}

/* MODAL */
.modal{
position:fixed;
inset:0;
background:rgba(0,0,0,.95);
display:flex;
align-items:center;
justify-content:center;
z-index:1000;
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
@media(max-width:900px){
.explore-grid{grid-template-columns:repeat(auto-fill,minmax(200px,1fr));}
}
@media(max-width:600px){
body{padding:20px}
.search-box{width:100%}
.explore-grid{grid-template-columns:1fr;}
}
</style>
</head>
<body>

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

<div class="section-title">Browse Categories</div>
<div class="categories">
@foreach($categories as $category)
<a href="/jelajah/{{ $category }}" class="card {{ $category }}">
<h3>{{ ucfirst($category) }}</h3>
<span>View Photos</span>
</a>
@endforeach
</div>

<div class="section-title">Trending Now</div>
<div class="trending">
@forelse($trendingImages as $image)
<img src="{{ $image }}" onclick="openModal(this.src)">
@empty
<p>Tidak ada gambar trending.</p>
@endforelse
</div>

<div class="section-title">Explore</div>
<div class="explore-grid" id="exploreGrid">
@forelse($exploreImages as $image)
<div class="post-card">
<img src="{{ $image }}" onclick="openModal(this.src)">

<div class="post-content">
<div class="post-actions">
<div class="action-btn like-btn" onclick="toggleLike(this)">
❤️ <span>0</span>
</div>
</div>

<a href="{{ $image }}" download class="download-btn">
⬇ Download
</a>
</div>
</div>
@empty
<p>Tidak ada gambar di folder explore.</p>
@endforelse
</div>

<div class="modal" id="modal" onclick="closeModal()">
<img id="modal-img">
</div>

<script>
window.addEventListener("load",()=>{document.body.style.opacity="1";});

const observer=new IntersectionObserver(entries=>{
entries.forEach(entry=>{
if(entry.isIntersecting){entry.target.classList.add("show");}
});
},{threshold:0.2});

document.querySelectorAll(".card,.section-title,.trending img,.post-card")
.forEach(el=>observer.observe(el));

function openModal(src){
document.getElementById('modal').classList.add('active');
document.getElementById('modal-img').src=src;
}
function closeModal(){
document.getElementById('modal').classList.remove('active');
}
function goBack(){window.history.back();}

function searchImages(keyword){
keyword=keyword.toLowerCase();
const cards=document.querySelectorAll('.post-card');
cards.forEach(card=>{
const img=card.querySelector('img');
if(img.src.toLowerCase().includes(keyword)){
card.style.display="block";
}else{
card.style.display="none";
}
});
}

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
</script>

</body>
</html>