@extends('layouts.app')

@section('title', 'Galeri Foto - GeoToba')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap');

    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #f0f2f5; }

    /* = HERO = */
    .gallery-hero {
        background: linear-gradient(135deg, #003366 0%, #1a4a7a 50%, #0a3a6a 100%);
        padding: 90px 0 60px;
        margin-top: 70px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
   
    @keyframes heroRotate { from{transform:rotate(0deg);} to{transform:rotate(360deg);} }
    .gallery-hero-content { position: relative; z-index: 2; padding: 0 20px; }
    .gallery-hero-eyebrow {
        font-size: 0.65rem; letter-spacing: 0.4em; text-transform: uppercase;
        color: #c6a43b; font-weight: 600; margin-bottom: 14px;
        animation: fadeUp 0.7s ease both;
    }
    .gallery-hero h1 {
        font-size: clamp(2rem,5vw,3.2rem); font-weight: 800;
        font-family: 'Playfair Display', serif;
        color: white; margin-bottom: 14px; letter-spacing: 2px;
        animation: fadeUp 0.8s ease 0.1s both;
    }
    .gallery-hero p {
        font-size: 0.9rem; letter-spacing: 2px;
        text-transform: uppercase; color: rgba(255,255,255,0.78);
        font-weight: 500; animation: fadeUp 0.8s ease 0.2s both;
    }
    @keyframes fadeUp { from{opacity:0;transform:translateY(22px);} to{opacity:1;transform:translateY(0);} }

    /* = SECTION = */
    .gallery-section {
        padding: 60px 0 100px;
        background: linear-gradient(160deg, #f0f7ff 0%, #e8f0fa 55%, #dde5f0 100%);
        min-height: 100vh;
    }
    .gcontainer { max-width: 1400px; margin: 0 auto; padding: 0 24px; }

    /* = SECTION LABEL = */
    .section-label { display: flex; align-items: center; gap: 14px; margin-bottom: 24px; }
    .section-label h2 { font-size: 1.4rem; font-weight: 800; color: #003366; font-family: 'Playfair Display', serif; white-space: nowrap; }
    .label-line { flex: 1; height: 2px; background: linear-gradient(90deg, #c6a43b, transparent); border-radius: 2px; }
    .label-badge { background: linear-gradient(135deg, #003366, #1a4a7a); color: #c6a43b; font-size: 0.62rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; padding: 4px 14px; border-radius: 20px; white-space: nowrap; }
    .section-desc { font-size: 0.85rem; color: #64748b; margin-bottom: 32px; line-height: 1.7; max-width: 600px; }

    /* 
       FOTO UNGGULAN — CAROUSEL FULLWIDTH HORIZONTAL
       Setiap slide = 1 foto penuh lebar container
       Bisa swipe kiri/kanan, ada tombol panah dan dots
     */
    .featured-section { margin-bottom: 72px; }

    /* Wrapper: clip overflow agar slide tidak meluber ke luar */
    .carousel-wrap {
        position: relative;
        width: 100%;
        border-radius: 24px;
        overflow: hidden;                        /* ← KUNCI: sembunyikan slide lain */
        box-shadow: 0 24px 80px rgba(0,51,102,0.2);
        background: #0a1628;
    }

    /* Viewport yang terlihat user — tinggi tetap */
    .carousel-viewport {
        width: 100%;
        height: 480px;                           /* tinggi slide */
        overflow: hidden;
        position: relative;
    }

    /* Track horizontal: semua slide berjejer kiri-kanan */
    .carousel-track {
        display: flex;
        height: 100%;
        /* Transisi smooth saat slide berpindah */
        transition: transform 0.65s cubic-bezier(0.77, 0, 0.175, 1);
        will-change: transform;
    }

    /* Setiap slide: lebar = 100% container, tidak boleh menyusut */
    .carousel-slide {
        flex: 0 0 100%;          /* lebar 100%, tidak mengecil */
        width: 100%;
        height: 100%;
        position: relative;
        cursor: pointer;
        overflow: hidden;
    }

    /* Gambar mengisi seluruh slide */
    .carousel-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;       /* fill tanpa distorsi */
        display: block;
        filter: brightness(0.72);
        transition: transform 0.7s ease, filter 0.5s ease;
    }
    .carousel-slide:hover img {
        transform: scale(1.04);
        filter: brightness(0.85);
    }

    /* Overlay gradien dari bawah — untuk teks agar terbaca */
    .slide-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(
            to top,
            rgba(0,10,40,0.92) 0%,
            rgba(0,10,40,0.4) 40%,
            transparent 70%
        );
        pointer-events: none;
    }

    /* Badge kategori pojok kiri atas */
    .slide-badge {
        position: absolute; top: 22px; left: 22px; z-index: 4;
        background: linear-gradient(135deg, #c6a43b, #d4a947);
        color: #003366; font-size: 0.6rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 1.5px;
        padding: 5px 14px; border-radius: 20px;
    }

    /* Nomor foto pojok kanan atas */
    .slide-num {
        position: absolute; top: 22px; right: 22px; z-index: 4;
        background: rgba(0,0,0,0.55); backdrop-filter: blur(6px);
        color: rgba(198,164,59,0.9);
        font-size: 0.65rem; font-weight: 700;
        font-family: 'Courier New', monospace;
        padding: 4px 12px; border-radius: 10px;
        border: 1px solid rgba(198,164,59,0.25);
        letter-spacing: 1px;
    }

    /* Ikon zoom muncul di tengah saat hover */
    .slide-zoom {
        position: absolute; top: 50%; left: 50%; z-index: 4;
        transform: translate(-50%,-50%) scale(0);
        width: 64px; height: 64px;
        background: rgba(198,164,59,0.9);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #003366; font-size: 1.5rem;
        transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
        pointer-events: none;
    }
    .carousel-slide:hover .slide-zoom { transform: translate(-50%,-50%) scale(1); }

    /* Info teks di bawah slide */
    .slide-info {
        position: absolute; bottom: 0; left: 0; right: 0; z-index: 4;
        padding: 28px 32px 26px;
    }
    .slide-title {
        font-size: clamp(1.3rem, 2.5vw, 1.8rem);
        font-weight: 800; font-family: 'Playfair Display', serif;
        color: white; line-height: 1.3; margin-bottom: 8px;
        text-shadow: 0 2px 12px rgba(0,0,0,0.5);
    }
    .slide-loc {
        display: flex; align-items: center; gap: 6px;
        color: rgba(198,164,59,0.9); font-size: 0.82rem; font-weight: 600;
    }

    /* ── Tombol panah kiri / kanan ── */
    .carousel-arrow {
        position: absolute; top: 50%; transform: translateY(-50%); z-index: 10;
        width: 52px; height: 52px; border-radius: 50%;
        background: rgba(255,255,255,0.15); backdrop-filter: blur(12px);
        border: 1.5px solid rgba(255,255,255,0.3);
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 1.15rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
    }
    .carousel-arrow:hover {
        background: linear-gradient(135deg, #c6a43b, #d4a947);
        color: #003366; border-color: transparent;
        transform: translateY(-50%) scale(1.12);
    }
    .carousel-arrow-prev { left: 18px; }
    .carousel-arrow-next { right: 18px; }

    /* Counter "2 / 8" */
    .slide-counter {
        position: absolute; bottom: 26px; right: 32px; z-index: 5;
        background: rgba(0,0,0,0.55); backdrop-filter: blur(8px);
        color: white; font-size: 0.72rem; font-weight: 700;
        padding: 5px 14px; border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.12); letter-spacing: 1px;
    }
    .slide-counter span { color: #c6a43b; }

    /* ── Dots / indikator di bawah carousel ── */
    .carousel-dots {
        display: flex; align-items: center; justify-content: center;
        gap: 8px; margin-top: 16px;
    }
    .cdot {
        width: 8px; height: 8px; border-radius: 4px;
        background: rgba(0,51,102,0.2); cursor: pointer;
        transition: all 0.35s ease;
    }
    .cdot.active { width: 28px; background: #c6a43b; }

    /* Empty state carousel */
    .carousel-empty {
        display: flex; align-items: center; justify-content: center;
        height: 320px; background: #fff;
        border-radius: 24px; border: 2px dashed rgba(198,164,59,0.2);
        text-align: center; padding: 40px;
    }
    .carousel-empty i { font-size: 3.5rem; color: rgba(198,164,59,0.2); display: block; margin-bottom: 16px; }
    .carousel-empty p { color: #64748b; font-weight: 600; }
    .carousel-empty small { color: #94a3b8; }

    /* 
       GRID 4 KOLOM — SEMUA FOTO
       aspect-ratio 4:3 (landscape) supaya tidak terlalu panjang
     */
    .grid-section { margin-top: 12px; }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);  /* ← 4 kolom */
        gap: 16px;
    }

    /* Setiap kartu foto */
    .photo-card {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: #111827;
        cursor: pointer;
        aspect-ratio: 4 / 3;                   /* ← landscape, bukan portrait */
        transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
        box-shadow: 0 6px 20px rgba(0,51,102,0.1);
        border: 1px solid rgba(198,164,59,0.08);
    }
    .photo-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 48px rgba(0,51,102,0.2), 0 0 0 1.5px rgba(198,164,59,0.35);
        z-index: 5;
    }
    .photo-card img {
        width: 100%; height: 100%;
        object-fit: cover;                      /* fill kotak tanpa distorsi */
        display: block;
        transition: transform 0.65s ease;
        filter: brightness(0.85);
    }
    .photo-card:hover img { transform: scale(1.1); filter: brightness(1.05); }

    /* Badge kategori */
    .p-cat {
        position: absolute; top: 10px; left: 10px;
        background: linear-gradient(135deg,#c6a43b,#d4a947);
        color: #003366; font-size: 0.5rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 1px;
        padding: 3px 10px; border-radius: 10px;
    }
    /* Nomor foto */
    .p-num {
        position: absolute; top: 10px; right: 10px;
        background: rgba(0,0,0,0.55); backdrop-filter: blur(6px);
        color: rgba(198,164,59,0.85);
        font-size: 0.55rem; font-weight: 700;
        font-family: 'Courier New', monospace;
        padding: 3px 8px; border-radius: 8px; letter-spacing: 1px;
    }
    /* Ikon zoom muncul saat hover */
    .p-zoom {
        position: absolute; top: 50%; left: 50%;
        transform: translate(-50%,-50%) scale(0);
        width: 44px; height: 44px;
        background: rgba(198,164,59,0.92); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #003366; font-size: 1rem;
        transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
        pointer-events: none;
    }
    .photo-card:hover .p-zoom { transform: translate(-50%,-50%) scale(1); }
    /* Info teks bawah */
    .p-info {
        position: absolute; bottom: 0; left: 0; right: 0;
        padding: 12px 12px 10px;
        background: linear-gradient(to top, rgba(0,15,45,0.95) 0%, rgba(0,15,45,0.6) 60%, transparent 100%);
    }
    .p-title {
        color: white; font-size: 0.75rem; font-weight: 700;
        line-height: 1.3; white-space: nowrap;
        overflow: hidden; text-overflow: ellipsis;
    }
    .p-loc {
        color: rgba(198,164,59,0.85); font-size: 0.6rem; font-weight: 500;
        margin-top: 3px; display: flex; align-items: center; gap: 3px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    /* Empty state grid */
    .empty-gallery {
        grid-column: 1/-1; text-align: center;
        padding: 80px 40px; background: #fff;
        border-radius: 20px; border: 2px dashed rgba(198,164,59,0.2);
    }
    .empty-gallery i { font-size: 4rem; color: rgba(198,164,59,0.2); margin-bottom: 20px; display: block; }
    .empty-gallery p { color: #64748b; font-weight: 600; font-size: 1rem; margin-bottom: 8px; }
    .empty-gallery small { color: #94a3b8; }

    /* 
       MODAL DETAIL FOTO
       Background gelap, gambar besar kiri, info kanan
     */
    .modal-overlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.96);
        z-index: 9999;
        display: none; align-items: center; justify-content: center;
        backdrop-filter: blur(18px);
        padding: 20px;
    }
    .modal-box {
        background: linear-gradient(135deg,#1a1a1a 0%,#0f0f0f 100%);
        width: 100%; max-width: 1000px; max-height: 92vh;
        display: grid; grid-template-columns: 1.1fr 1fr;
        border-radius: 24px; overflow: hidden;
        animation: modalIn 0.45s cubic-bezier(0.34,1.56,0.64,1);
        box-shadow: 0 50px 100px rgba(0,0,0,0.5), 0 0 60px rgba(198,164,59,0.2);
        border: 1px solid rgba(198,164,59,0.3);
    }
    @keyframes modalIn { from{opacity:0;transform:scale(0.93);} to{opacity:1;transform:scale(1);} }

    .modal-img-part {
        background: #050505;
        display: flex; align-items: center; justify-content: center;
        padding: 24px; position: relative; min-height: 300px;
    }
    .modal-img-part img {
        max-width: 100%; max-height: 72vh;
        width: auto; height: auto;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        transition: transform 0.3s ease;
    }
    .modal-img-part img:hover { transform: scale(1.02); }

    .modal-text-part {
        padding: 40px 36px; color: white;
        display: flex; flex-direction: column; justify-content: center;
        position: relative; overflow-y: auto;
    }
    .modal-text-part::before { content:''; position:absolute; left:0; top:0; bottom:0; width:3px; background:linear-gradient(180deg,#c6a43b,transparent); }
    .close-btn {
        position: absolute; top: 20px; right: 20px;
        color: white; font-size: 1.3rem; cursor: pointer;
        z-index: 10000; width: 46px; height: 46px;
        background: rgba(0,0,0,0.6); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        backdrop-filter: blur(8px); border: 1px solid rgba(198,164,59,0.3);
        transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
    }
    .close-btn:hover { background:linear-gradient(135deg,#c6a43b,#d4a947); color:#003366; transform:rotate(90deg) scale(1.15); }
    .modal-tag { display:inline-block; background:linear-gradient(135deg,#c6a43b,#d4a947); color:#003366; font-size:0.6rem; font-weight:800; text-transform:uppercase; letter-spacing:2px; padding:4px 14px; border-radius:20px; margin-bottom:18px; }
    .modal-text-part h2 { font-size:1.55rem; margin:0 0 14px; font-family:'Playfair Display',serif; font-weight:700; color:white; line-height:1.35; }
    .modal-desc { color:#c0c9d8; line-height:1.85; font-size:0.88rem; margin-bottom:22px; }
    .modal-meta { display:flex; flex-direction:column; gap:10px; padding-top:18px; border-top:1px solid rgba(198,164,59,0.15); }
    .modal-meta-row { display:flex; align-items:center; gap:8px; font-size:0.8rem; }
    .modal-meta-row i { color:#c6a43b; font-size:0.9rem; min-width:16px; }
    .modal-meta-label { color:#94a3b8; font-weight:500; }
    .modal-meta-value { color:#e2e8f0; font-weight:600; }

    /* = MUSIK LATAR = */
   

    /* = RESPONSIVE = */
    @media (max-width: 1200px) {
        .photo-grid { grid-template-columns: repeat(4,1fr); gap: 12px; }
    }
    @media (max-width: 900px) {
        .photo-grid { grid-template-columns: repeat(2,1fr); }
        .carousel-viewport { height: 360px; }
        .modal-box { grid-template-columns:1fr; max-height:90vh; overflow-y:auto; }
        .modal-img-part img { max-height:50vh; }
    }
    @media (max-width: 560px) {
        .photo-grid { grid-template-columns: repeat(2,1fr); gap: 10px; }
        .carousel-viewport { height: 260px; }
        .slide-title { font-size: 1.1rem; }
        .slide-info { padding: 16px 16px 14px; }
        .carousel-arrow { width:40px; height:40px; font-size:0.9rem; }
        .gallery-hero h1 { font-size: 2rem; }
    }
    /* = HERO = */

.hero-image {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    object-fit: contain; /* seluruh gambar terlihat */
    object-position: center;

    z-index: 1;
}

.hero-overlay {
    position: absolute;
    inset: 0;

    background: linear-gradient(
        rgba(0,20,50,0.45),
        rgba(0,20,50,0.65)
    );

    z-index: 2;
}

.gallery-hero-content {
    position: relative;
    z-index: 3;

    text-align: center;
    padding: 20px;
}

.gallery-hero h1 {
    color: white;
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-family: 'Playfair Display', serif;
    font-weight: 800;
}

.gallery-hero p {
    color: rgba(255,255,255,0.9);
}

.gallery-hero-eyebrow {
    color: #c6a43b;
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 12px;
}
.gallery-hero{
    position:relative;
    height:600px;
    margin-top:70px;
    overflow:hidden;
    display:flex;
    align-items:center;
    justify-content:center;
}

.hero-image{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover; /* penuh layar */
    object-position:center;
}

.hero-overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.45);
}

.gallery-hero-content{
    position:relative;
    z-index:10;
    text-align:center;
}
</style>

<!-- HERO -->
<div class="gallery-hero">
    <img src="{{ asset('image/tuktuk/Tuktuk1.jpg') }}"
         alt="Danau Toba"
         class="hero-image">
    <div class="hero-overlay"></div>

    <div class="gallery-hero-content">
        <div class="gallery-hero-eyebrow">
            Geopark Kaldera Toba &bull; Samosir
        </div>

        <h1>Galeri Foto</h1>

        <p>Pesona Alam &amp; Budaya Danau Toba</p>
    </div>
</div>

<section class="gallery-section">
    <div class="gcontainer">

        
        <div class="featured-section">
            <div class="section-label">
                <h2>Foto Unggulan</h2>
                <div class="label-line"></div>
                <span class="label-badge">&#8592; Geser / Klik &#8594;</span>
            </div>
            <p class="section-desc">
                Jelajahi keindahan destinasi wisata Geosite Danau Toba.
                Klik foto untuk melihat detail, atau geser untuk foto berikutnya.
            </p>

            @if(count($allPhotos) > 0)

            {{-- Wrapper: overflow:hidden memastikan hanya 1 slide terlihat --}}
            <div class="carousel-wrap" id="carouselWrap">

                {{-- Viewport (area yang terlihat) --}}
                <div class="carousel-viewport">

                    {{-- Track: semua slide berjajar horizontal.
                         Digeser dengan transform: translateX(-(index * 100%)) --}}
                    <div class="carousel-track" id="carouselTrack">

                        @foreach($allPhotos as $i => $photo)
                        {{-- Satu slide = satu foto penuh --}}
                        <div class="carousel-slide"
                             onclick="openPhoto('{{ $photo['src'] }}', '{{ addslashes($photo['judul']) }}', '{{ addslashes($photo['deskripsi']) }}', '{{ $photo['kategori'] }}', '{{ addslashes($photo['lokasi']) }}')">

                            {{-- Gambar mengisi seluruh slide --}}
                            <img src="{{ $photo['src'] }}"
                                 alt="{{ $photo['judul'] }}"
                                 loading="{{ $i < 2 ? 'eager' : 'lazy' }}"
                                 onerror="this.src='https://placehold.co/1200x480/003366/c6a43b?text=GeoToba+Foto'">

                            {{-- Gradien gelap bawah untuk teks --}}
                            <div class="slide-overlay"></div>

                            {{-- Badge dan nomor --}}
                            <span class="slide-badge">{{ $photo['kategori'] }}</span>
                            <span class="slide-num">#{{ str_pad($i+1,3,'0',STR_PAD_LEFT) }}</span>

                            {{-- Ikon zoom saat hover --}}
                            <div class="slide-zoom"><i class="bi bi-zoom-in"></i></div>

                            {{-- Judul + lokasi di bawah --}}
                            <div class="slide-info">
                                <div class="slide-title">{{ $photo['judul'] }}</div>
                                <div class="slide-loc">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    {{ Str::limit($photo['lokasi'], 55) }}
                                </div>
                            </div>

                        </div>
                        @endforeach

                    </div>{{-- end track --}}

                    {{-- Tombol panah kiri --}}
                    <div class="carousel-arrow carousel-arrow-prev" id="carouselPrev">
                        <i class="bi bi-chevron-left"></i>
                    </div>

                    {{-- Tombol panah kanan --}}
                    <div class="carousel-arrow carousel-arrow-next" id="carouselNext">
                        <i class="bi bi-chevron-right"></i>
                    </div>

                    {{-- Counter --}}
                    <div class="slide-counter">
                        <span id="slideNum">1</span> / {{ count($allPhotos) }}
                    </div>

                </div>{{-- end viewport --}}
            </div>{{-- end wrap --}}

            {{-- Dots indikator --}}
            <div class="carousel-dots" id="carouselDots">
                @foreach($allPhotos as $i => $photo)
                <div class="cdot {{ $i === 0 ? 'active' : '' }}" onclick="goSlide({{ $i }})"></div>
                @endforeach
            </div>

            @else
            <div class="carousel-empty">
                <div>
                    <i class="bi bi-images"></i>
                    <p>Belum ada foto galeri.</p>
                    <small>Unggah foto melalui panel admin untuk menampilkan koleksi ini.</small>
                </div>
            </div>
            @endif
        </div>

        {{-- ===
             GRID 4 KOLOM — SEMUA FOTO
             aspect-ratio 4:3 (landscape)
        === --}}
        <div class="grid-section">
            <div class="section-label">
                <h2>Semua Foto</h2>
                <div class="label-line"></div>
                <span class="label-badge">{{ count($allPhotos) }} Foto</span>
            </div>
            <p class="section-desc">
                Koleksi lengkap foto wisata Geosite Danau Toba.
                Klik foto untuk melihat detail dan informasi lokasi.
            </p>

            <div class="photo-grid">
                @forelse($allPhotos as $i => $photo)
                <div class="photo-card"
                     onclick="openPhoto('{{ $photo['src'] }}', '{{ addslashes($photo['judul']) }}', '{{ addslashes($photo['deskripsi']) }}', '{{ $photo['kategori'] }}', '{{ addslashes($photo['lokasi']) }}')">

                    <img src="{{ $photo['src'] }}"
                         alt="{{ $photo['judul'] }}"
                         loading="lazy"
                         onerror="this.src='https://placehold.co/400x300/003366/c6a43b?text=GeoToba'">

                    <span class="p-cat">{{ $photo['kategori'] }}</span>
                    <span class="p-num">#{{ str_pad($i+1,3,'0',STR_PAD_LEFT) }}</span>
                    <div class="p-zoom"><i class="bi bi-zoom-in"></i></div>
                    <div class="p-info">
                        <div class="p-title">{{ Str::limit($photo['judul'], 32) }}</div>
                        <div class="p-loc">
                            <i class="bi bi-geo-alt-fill"></i>
                            {{ Str::limit($photo['lokasi'], 26) }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-gallery">
                    <i class="bi bi-camera"></i>
                    <p>Belum ada foto yang tersedia</p>
                    <small>Unggah foto melalui panel admin.</small>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

{{-- = MODAL DETAIL FOTO =
     Gambar proporsional di kiri, info di kanan --}}
<div id="pModal" class="modal-overlay" onclick="closePhoto()">
    <div class="close-btn" onclick="closePhoto()"><i class="bi bi-x-lg"></i></div>
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-img-part">
            <img src="" id="mImg" alt="Foto Wisata Danau Toba">
        </div>
        <div class="modal-text-part">
            <span class="modal-tag" id="mTag"></span>
            <h2 id="mTitle"></h2>
            <p class="modal-desc" id="mDesc"></p>
            <div class="modal-meta">
                <div class="modal-meta-row">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span class="modal-meta-label">Lokasi:</span>
                    <span class="modal-meta-value" id="mLoc"></span>
                </div>
                <div class="modal-meta-row">
                    <i class="bi bi-camera2"></i>
                    <span class="modal-meta-label">Kawasan:</span>
                    <span class="modal-meta-value">Geopark Kaldera Toba, Sumatra Utara</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/* 
   MODAL FOTO
   Klik gambar (carousel atau grid) → modal muncul
 */
function openPhoto(src, title, desc, tag, loc) {
    const img = document.getElementById('mImg');
    img.src = '';
    img.src = src;
    document.getElementById('mTitle').textContent = title;
    document.getElementById('mTag').textContent   = tag;
    document.getElementById('mDesc').textContent  = desc || 'Salah satu pemandangan indah di kawasan Geopark Kaldera Toba.';
    document.getElementById('mLoc').textContent   = loc  || 'Danau Toba, Sumatra Utara';
    document.getElementById('pModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closePhoto() {
    document.getElementById('pModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closePhoto(); });

/* 
   CAROUSEL FOTO UNGGULAN
   - Slide = 100% lebar container
   - Digeser dengan translateX(-(idx * 100%))
   - Support swipe touch di mobile
 */
const totalSlides = {{ count($allPhotos) }};
let curSlide = 0;

// Pindah ke slide index tertentu
function goSlide(idx) {
    // Wrapping: kembali ke 0 jika melebihi, atau ke akhir jika kurang dari 0
    curSlide = ((idx % totalSlides) + totalSlides) % totalSlides;

    // Geser track
    const track = document.getElementById('carouselTrack');
    if (track) track.style.transform = `translateX(-${curSlide * 100}%)`;

    // Update dots
    document.querySelectorAll('.cdot').forEach((d, i) =>
        d.classList.toggle('active', i === curSlide)
    );

    // Update counter
    const numEl = document.getElementById('slideNum');
    if (numEl) numEl.textContent = curSlide + 1;
}

// Tombol panah
document.getElementById('carouselPrev')?.addEventListener('click', e => {
    e.stopPropagation(); // jangan trigger openPhoto
    goSlide(curSlide - 1);
});
document.getElementById('carouselNext')?.addEventListener('click', e => {
    e.stopPropagation();
    goSlide(curSlide + 1);
});

// Auto-play setiap 5 detik
let autoTimer = setInterval(() => goSlide(curSlide + 1), 5000);

// Pause saat mouse di atas carousel
const wrap = document.getElementById('carouselWrap');
if (wrap) {
    wrap.addEventListener('mouseenter', () => clearInterval(autoTimer));
    wrap.addEventListener('mouseleave', () => {
        autoTimer = setInterval(() => goSlide(curSlide + 1), 5000);
    });
}

// ── SWIPE TOUCH (mobile) ──
let touchStartX = 0;
const viewport = document.querySelector('.carousel-viewport');
if (viewport) {
    viewport.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    viewport.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].screenX;
        if (Math.abs(diff) > 40) {        // minimal 40px untuk trigger swipe
            goSlide(diff > 0 ? curSlide + 1 : curSlide - 1);
        }
    }, { passive: true });
}

// Inisialisasi
if (totalSlides > 0) goSlide(0);

/* 
   MUSIK LATAR
 */

</script>

@endsection