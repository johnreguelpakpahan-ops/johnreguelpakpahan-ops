@extends('layouts.app')

@section('title', 'Destinasi ' . $kategori . ' - Geosite Danau Toba')

@section('content')

<style>
    /*  HERO SECTION  */
    .kategori-hero {
        height: 45vh;
        min-height: 350px;

        background:
            linear-gradient(rgba(0,51,102,0.45), rgba(0,51,102,0.45)),
            url('{{ asset("image/tuktuk/destinasi-" . strtolower($kategori) . ".jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        margin-top: 76px;

        position: relative;
        overflow: hidden;
    }

    .kategori-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.15);
        backdrop-filter: blur(1px);
    }

    .kategori-hero div {
        position: relative;
        z-index: 2;
    }

    .kategori-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.4);
    }

    .kategori-hero p {
        font-size: 0.9rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        opacity: 0.95;
        text-shadow: 0 2px 10px rgba(0,0,0,0.4);
    }

    /*  DESTINASI GRID  */
    .destinasi-section {
        padding: 60px 0;
        background: #f8f9fa;
    }

    .destinasi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .dest-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
    }

    .dest-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px rgba(0,0,0,0.12);
    }

    .card-image {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .dest-card:hover .card-image img {
        transform: scale(1.05);
    }

    .card-image::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(0,0,0,0.2),
            transparent
        );
    }

    .card-content {
        padding: 20px;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #003366;
    }

    .card-location {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.7rem;
        color: #c6a43b;
        margin-bottom: 12px;
    }

    .card-location i {
        font-size: 0.6rem;
    }

    .card-desc {
    font-size: 0.85rem;
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
    font-family: 'Quicksand', sans-serif;
    text-align: justify;
    }

    .card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .card-tags span {
        background: #f0f4f0;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        color: #003366;
    }

    .card-link {
        display: inline-block;
        margin-top: 14px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #003366;
        text-decoration: none;
        border-bottom: 2px solid #c6a43b;
        transition: color 0.2s ease, border-color 0.2s ease;
    }

    .card-link:hover {
        color: #c6a43b;
        border-color: #003366;
    }

    /* Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 16px;
    }

    .empty-state i {
        font-size: 3rem;
        color: #ccc;
        margin-bottom: 15px;
    }

    .empty-state h3 {
        font-size: 1.3rem;
        color: #666;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #999;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .destinasi-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
    }

    @media (max-width: 768px) {
        .kategori-hero {
            min-height: 280px;
        }

        .kategori-hero h1 {
            font-size: 2rem;
        }

        .destinasi-section {
            padding: 40px 0;
        }

        .destinasi-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .card-image {
            height: 200px;
        }
    }
</style>

<!-- HERO SECTION -->
<section class="kategori-hero">
    <div data-aos="fade-up">
        <h1>Destinasi {{ $kategori }}</h1>
        <p>{{ $deskripsi }}</p>
    </div>
</section>

<!-- DESTINASI GRID -->
<section class="destinasi-section">
    <div class="container">
        <div class="destinasi-grid">

            @forelse($destinasi as $item)

            <div class="dest-card"
                 data-aos="fade-up"
                 data-aos-delay="{{ $loop->index * 100 }}">

                <div class="card-image">
                    <img src="{{ $item->gambar_utama && !str_starts_with($item->gambar_utama, 'data:') 
                            ? asset('storage/' . $item->gambar_utama) 
                            : $item->gambar }}" 
                        class="card-img" 
                        alt="{{ $item->nama }}">
                </div>

                <div class="card-content">

                    <h3 class="card-title">
                        {{ $item->nama }}
                    </h3>

                    <div class="card-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $item->lokasi }}
                    </div>

                    <p class="card-desc">
                        {{ $item->deskripsi }}
                    </p>

                    <div class="card-tags">
                        @if(is_array($item->tags))
                            @foreach($item->tags as $tag)
                                <span>#{{ $tag }}</span>
                            @endforeach
                        @endif
                    </div>

                    <a href="{{ route('destinasi.detail', $item->slug) }}" class="card-link">
                        Jelajahi →
                    </a>

                </div>
            </div>

            @empty

            <div class="empty-state">
                <i class="fas fa-mountain"></i>
                <h3>Belum Ada Destinasi</h3>
                <p>Destinasi pada kategori ini akan segera ditambahkan.</p>
            </div>

            @endforelse

        </div>
    </div>
</section>

<!-- FONT AWESOME -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- AOS -->
<link rel="stylesheet"
href="https://unpkg.com/aos@next/dist/aos.css" />

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });
</script>

@endsection