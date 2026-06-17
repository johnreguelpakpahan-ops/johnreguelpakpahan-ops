@extends('layouts.app')

@section('title', $destinasi->nama . ' - Geosite Danau Toba')

@section('content')

<style>
    /*  HERO SECTION  */
    .detail-hero {
        height: 70vh;
        min-height: 450px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        display: flex;
        align-items: flex-end;
        justify-content: flex-start;
        color: white;
        overflow: hidden;
        margin-top: 76px;
    }

    .detail-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            rgba(0,0,0,0.1) 0%,
            rgba(0,51,102,0.75) 100%
        );
        z-index: 1;
    }

    .detail-hero-content {
        position: relative;
        z-index: 2;
        padding: 50px 60px;
        animation: fadeInUp 0.9s ease;
    }

    .detail-hero-content .badge-kategori {
        display: inline-block;
        background: #c6a43b;
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 5px 16px;
        border-radius: 30px;
        margin-bottom: 14px;
    }

    .detail-hero-content h1 {
        font-size: 3.2rem;
        font-weight: 700;
        text-shadow: 0 4px 20px rgba(0,0,0,0.5);
        margin-bottom: 10px;
        line-height: 1.1;
    }

    .detail-hero-content .lokasi-text {
        font-size: 0.9rem;
        opacity: 0.9;
        letter-spacing: 0.1em;
    }

    .detail-hero-content .lokasi-text i {
        color: #c6a43b;
        margin-right: 6px;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /*  MAIN CONTENT  */
    .detail-wrapper {
        background: #f8f9fa;
        padding: 60px 0;
    }

    .detail-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Card base */
    .detail-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        transition: box-shadow 0.3s ease;
    }

    .detail-card:hover {
        box-shadow: 0 12px 40px rgba(0,0,0,0.11);
    }

    .detail-card h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #003366;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-card h2 i {
        color: #c6a43b;
        font-size: 1.2rem;
    }

    .detail-card p {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.9;
        margin-bottom: 0;
    }

    /* Tags */
    .tags-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .tag-pill {
        background: #eef2f8;
        color: #003366;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 30px;
        letter-spacing: 0.5px;
    }

    /* Back button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #003366;
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 40px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid #003366;
    }

    .btn-back:hover {
        background: transparent;
        color: #003366;
    }

    .btn-back-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: #003366;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 40px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid #003366;
        margin-left: 12px;
    }

    .btn-back-outline:hover {
        background: #003366;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-hero {
            min-height: 350px;
            align-items: flex-end;
        }

        .detail-hero-content {
            padding: 30px 24px;
        }

        .detail-hero-content h1 {
            font-size: 2rem;
        }

        .detail-card {
            padding: 25px 20px;
        }
    }
</style>

<!-- HERO -->
<section class="detail-hero"
    style="background-image: url('{{ $destinasi->gambar_utama && !str_starts_with($destinasi->gambar_utama, 'data:')
    ? asset('storage/' . $destinasi->gambar_utama)
    : $destinasi->gambar_utama }}');">

    <div class="detail-hero-content container">
        <span class="badge-kategori">{{ $destinasi->kategori }}</span>
        <h1>{{ $destinasi->nama }}</h1>
        <div class="lokasi-text">
            <i class="fas fa-map-marker-alt"></i>
            {{ $destinasi->lokasi }}
        </div>
    </div>
</section>

<!-- KONTEN UTAMA -->
<div class="detail-wrapper">
    <div class="detail-container">

        <!-- DESKRIPSI -->
        <div class="detail-card" data-aos="fade-up">
            <h2><i class="fas fa-info-circle"></i> Tentang Destinasi</h2>
            <p>{{ $destinasi->deskripsi }}</p>
        </div>

        <!-- TAGS -->
        @if($destinasi->tags && count($destinasi->tags) > 0)
        <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
            <h2><i class="fas fa-tags"></i> Tags</h2>
            <div class="tags-wrapper">
                @foreach($destinasi->tags as $tag)
                    <span class="tag-pill">#{{ $tag }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- INFORMASI TAMBAHAN -->
        <div class="detail-card" data-aos="fade-up" data-aos-delay="150">
            <h2><i class="fas fa-map-marker-alt"></i> Lokasi</h2>
            <p>{{ $destinasi->lokasi }}</p>

            <!-- Embed Google Maps berdasarkan nama lokasi -->
            <div class="mt-4" style="border-radius:12px; overflow:hidden;">
                <iframe
                    src="https://maps.google.com/maps?q={{ urlencode($destinasi->nama . ' ' . $destinasi->lokasi . ' Danau Toba') }}&output=embed"
                    width="100%"
                    height="350"
                    style="border:none; display:block;"
                    loading="lazy"
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <!-- NAVIGASI -->
        <div class="d-flex align-items-center flex-wrap gap-3" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ url()->previous() }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('destinasi') }}" class="btn-back-outline">
                <i class="fas fa-th-large"></i> Semua Destinasi
            </a>
        </div>

    </div>
</div>

@endsection