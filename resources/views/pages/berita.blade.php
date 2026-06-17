@extends('layouts.app')

@section('title', 'Berita Terkini - Geosite Danau Toba')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


<style>

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap');

:root{
    --primary:#003366;
    --gold:#c6a43b;
    --gold2:#d4a947;
    --bg:#f5f8fc;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
}

/* HERO */
.news-hero{
    position:relative;
    height:60vh;
    min-height:380px;
    background:url('{{ asset("image/tuktuk/Tuktuk1.jpg") }}') center/cover no-repeat;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    overflow:hidden;
    margin-top:70px;
}

.news-hero::before{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(
        135deg,
        rgba(0,51,102,.8),
        rgba(0,0,0,.45)
    );
}

.news-hero-content{
    position:relative;
    z-index:2;
    color:white;
    padding:0 20px;
}

.news-hero h1{
    font-size:3.5rem;
    font-family:'Playfair Display',serif;
    font-weight:800;
    margin-bottom:14px;
}

.news-hero p{
    font-size:.85rem;
    letter-spacing:4px;
    text-transform:uppercase;
}

/* 
SECTION
 */
.news-section{
    background:linear-gradient(
        135deg,
        #eef5ff,
        #f7fbff
    );
    padding:80px 0;
    min-height:100vh;
}

.ncontainer{
    max-width:1400px;
    margin:auto;
    padding:0 24px;
}

.section-header{
    margin-bottom:40px;
}

.section-top{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:18px;
}

.section-top h2{
    font-size:1.5rem;
    font-weight:800;
    color:var(--primary);
    font-family:'Playfair Display',serif;
}

.line{
    flex:1;
    height:2px;
    background:linear-gradient(90deg,var(--gold),transparent);
}

.badge-news{
    background:linear-gradient(135deg,var(--primary),#1c4d7f);
    color:var(--gold);
    padding:5px 14px;
    border-radius:20px;
    font-size:.65rem;
    letter-spacing:1.5px;
    text-transform:uppercase;
    font-weight:700;
}

.section-desc{
    max-width:650px;
    color:#64748b;
    font-size:.9rem;
    line-height:1.8;
}

/* 
GRID
 */
.news-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:26px;
}

.news-card{
    background:white;
    border-radius:22px;
    overflow:visible;
    position:relative;
    transition:.4s ease;
    box-shadow:0 8px 30px rgba(0,51,102,.08);
    border:1px solid rgba(198,164,59,.08);
    display:flex;
    flex-direction:column;
}

.news-card:hover{
    transform:translateY(-8px);
    box-shadow:
        0 18px 50px rgba(0,51,102,.18),
        0 0 0 1px rgba(198,164,59,.25);
}

/* 
IMAGE
 */
.news-image{
    position:relative;
    height:220px;
    overflow:hidden;
    background:#001c36;
    cursor:pointer;
    border-radius:22px 22px 0 0;
}

.news-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:transform .7s ease;
}

.news-card:hover .news-image img{
    transform:scale(1.08);
}

.news-image::after{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(
        to top,
        rgba(0,0,0,.6),
        transparent
    );
    pointer-events: none;
}

/* 
SOURCE LINK
 */
.img-source{
    position:absolute;
    bottom:8px;
    left:8px;

    background:rgba(0,0,0,.65);
    backdrop-filter:blur(5px);

    color:#fff;

    font-size:10px;
    font-weight:600;

    padding:4px 9px;

    border-radius:20px;

    text-decoration:none;

    z-index:30;

    transition:.3s ease;
}

.img-source:hover{
    background:#c6a43b;
    color:#003366;
}

/* 
BADGE
 */
.news-badge{
    position:absolute;
    top:14px;
    left:14px;
    z-index:20;

    background:linear-gradient(
        135deg,
        var(--gold),
        var(--gold2)
    );

    color:var(--primary);

    font-size:.55rem;
    font-weight:800;

    padding:5px 12px;

    border-radius:30px;

    letter-spacing:1px;
    text-transform:uppercase;
}

/* 
NUMBER
 */
.news-number{
    position:absolute;
    top:14px;
    right:14px;

    z-index:20;

    background:rgba(0,0,0,.55);
    backdrop-filter:blur(6px);

    color:#fff;

    font-size:.65rem;

    padding:4px 10px;

    border-radius:12px;
}

/* 
BODY
 */
.news-body{
    padding:22px;
    flex:1;
    display:flex;
    flex-direction:column;
}

.news-date{
    display:flex;
    align-items:center;
    gap:7px;
    color:#94a3b8;
    font-size:.72rem;
    margin-bottom:12px;
}

.news-date i{
    color:var(--gold);
}

.news-title{
    font-size:1rem;
    line-height:1.5;
    font-weight:700;
    color:var(--primary);
    margin-bottom:12px;
    font-family:'Playfair Display',serif;

    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

.news-card:hover .news-title{
    color:var(--gold);
}

.news-excerpt{
    font-size:.82rem;
    line-height:1.8;
    color:#64748b;
    margin-bottom:20px;
    flex:1;
    font-family:'Quicksand', sans-serif;
    text-align: justify;
}

/* 
BUTTON
 */
.news-btn{
    width:100%;
    border:none;
    border-radius:50px;
    padding:12px 20px;
    position:relative;
    z-index:10;
    font-size:.76rem;
    font-weight:700;
    cursor:pointer;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;

    background:linear-gradient(
        135deg,
        var(--primary),
        #1a4a7a
    );

    color:white;
    transition:.35s ease;
}

.news-btn:hover{
    background:linear-gradient(
        135deg,
        var(--gold),
        var(--gold2)
    );

    color:var(--primary);
}

/* 
MODAL
 */
.image-modal{
    position:fixed;
    inset:0;

    background:rgba(0,0,0,.88);

    z-index:999999;

    display:none;

    align-items:center;
    justify-content:center;

    padding:30px;

    backdrop-filter:blur(10px);
}

.image-modal.active{
    display:flex;
}

.image-modal-box{
    width:100%;
    max-width:1100px;

    background:#111;

    border-radius:28px;

    overflow:hidden;

    display:grid;

    grid-template-columns:1.1fr .9fr;

    animation:zoomIn .35s ease;
}

@keyframes zoomIn{
    from{
        opacity:0;
        transform:scale(.92);
    }
    to{
        opacity:1;
        transform:scale(1);
    }
}

.image-modal-img{
    background:#000;
}

.image-modal-img img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

.image-modal-content{
    padding:55px 45px;
    color:white;

    display:flex;
    flex-direction:column;
    justify-content:center;
}

.image-modal-tag{
    color:#00ffff;
    letter-spacing:4px;
    font-size:.78rem;
    margin-bottom:20px;
    text-transform:uppercase;
}

.image-modal-title{
    font-size:3rem;
    font-weight:800;
    margin-bottom:20px;
    line-height:1.2;
    font-family:'Playfair Display',serif;
}

.image-modal-desc{
    color:#d1d5db;
    line-height:1.9;
    font-size:1rem;
}

.image-modal-close{
    position:absolute;
    top:30px;
    right:35px;

    width:58px;
    height:58px;

    border:none;

    border-radius:50%;

    background:rgba(255,255,255,.08);

    color:white;

    font-size:1.7rem;

    cursor:pointer;

    backdrop-filter:blur(8px);

    transition:.3s ease;
}

.image-modal-close:hover{
    background:#c6a43b;
    color:#003366;
    transform:rotate(90deg);
}

/* 
RESPONSIVE
 */
@media(max-width:1024px){
    .news-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:900px){

    .image-modal-box{
        grid-template-columns:1fr;
    }

    .image-modal-title{
        font-size:2rem;
    }

    .image-modal-content{
        padding:35px 25px;
    }
}

@media(max-width:640px){
    .news-grid{
        grid-template-columns:1fr;
    }
}
/* = MUSIK LATAR = */


</style>

<!-- HERO -->
<div class="news-hero">
    <div class="news-hero-content">
        <h1>Berita Terkini</h1>
        <p>Discover Geosite Toba</p>
    </div>
</div>

<!-- SECTION -->
<section class="news-section">

    <div class="ncontainer">

        <div class="section-header">

            <div class="section-top">

                <h2>Berita Pilihan</h2>

                <div class="line"></div>

                <span class="badge-news">
                    {{ $berita->count() }} Berita
                </span>

            </div>

            <p class="section-desc">
                Ikuti perkembangan terbaru seputar Geosite Danau Toba,
                budaya Batak, wisata alam, hingga kegiatan geopark terbaru.
            </p>

        </div>

        <!-- GRID -->
        <div class="news-grid">

            @forelse($berita as $i => $item)

            <div class="news-card">

                <!-- IMAGE -->
                <div class="news-image"

                        onclick="openImageModal(
                        '{{ $item->gambar && !str_starts_with($item->gambar, 'data:') ? asset('storage/' . $item->gambar) : $item->gambar }}',
                        {{ json_encode($item->judul) }},
                        {{ json_encode(Str::limit(strip_tags($item->konten),250)) }}
                    )"
                >

                    @if($item->gambar)

                        <img
                            src="{{ $item->gambar && !str_starts_with($item->gambar, 'data:') ? asset('storage/' . $item->gambar) : $item->gambar }}"
                            alt="{{ $item->judul }}"
                            loading="{{ $i < 3 ? 'eager' : 'lazy' }}"
                        >

                    @else

                        <img
                            src="{{ asset('image/default.jpg') }}"
                            alt="News"
                        >

                    @endif

                    {{-- SOURCE --}}
                    @if($item->link_referensi)

                    <a
                        href="{{ $item->link_referensi }}"
                        target="_blank"
                        class="img-source"
                        onclick="event.stopPropagation();"
                    >
                        🔗 source
                    </a>

                    @endif

                    <span class="news-badge">
                        Berita
                    </span>

                    <span class="news-number">
                        #{{ str_pad($i+1,3,'0',STR_PAD_LEFT) }}
                    </span>

                </div>

                <!-- BODY -->
                <div class="news-body">

                    <div class="news-date">
                        <i class="bi bi-calendar3"></i>

                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                    </div>

                    <div class="news-title">
                        {{ $item->judul }}
                    </div>

                    <div class="news-excerpt">
                        {{ Str::limit(strip_tags($item->konten), 130) }}
                    </div>

                    <button
                            class="news-btn"
                            onclick="openImageModal(
                                '{{ $item->gambar && !str_starts_with($item->gambar, 'data:') ? asset('storage/' . $item->gambar) : $item->gambar }}',
                                {{ json_encode($item->judul) }},
                                {{ json_encode(Str::limit(strip_tags($item->konten),250)) }}
                            )"
>

                        <i class="bi bi-book"></i>
                        Lihat Detail
                    </button>

                </div>

            </div>

            @empty

            <div class="empty-news">

                <i class="bi bi-newspaper"></i>

                <h3>Belum Ada Berita</h3>

                <p>
                    Silakan tambah berita melalui panel admin.
                </p>

            </div>

            @endforelse

        </div>

    </div>

</section>

<!-- MODAL -->
<div class="image-modal" id="imageModal">

    <button
        class="image-modal-close"
        onclick="closeImageModal()"
    >
        ✕
    </button>

    <div class="image-modal-box">

        <div class="image-modal-img">

            <img
                src=""
                id="modalImg"
            >

        </div>

        <div class="image-modal-content">

            <div class="image-modal-tag">
                GEOSITE TOBA
            </div>

            <div
                class="image-modal-title"
                id="modalTitle"
            ></div>

            <div
                class="image-modal-desc"
                id="modalDesc"
            ></div>

        </div>

    </div>

</div>

<script>





function openImageModal(img,title,desc){

    document.getElementById('modalImg').src =
        img;

    document.getElementById('modalTitle').innerText =
        title;

    document.getElementById('modalDesc').innerText =
        desc;

    document
        .getElementById('imageModal')
        .classList
        .add('active');

    document.body.style.overflow='hidden';
}

function closeImageModal(){

    document
        .getElementById('imageModal')
        .classList
        .remove('active');

    document.body.style.overflow='auto';
}

document.addEventListener('keydown',function(e){

    if(e.key === 'Escape'){

        closeImageModal();
    }
});

</script>

@endsection