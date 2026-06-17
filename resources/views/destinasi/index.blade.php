@extends('layouts.app')

@section('title', 'Destinasi - Geosite Danau Toba')

@section('content')

<style>
    /*  HERO SECTION  */
    /* Import Font */
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap');

body {
    font-family: 'Open Sans', sans-serif;
}

/* Hero Section */
.destinasi-hero {
    height: 55vh;
    min-height: 400px;

    background:
        linear-gradient(rgba(0, 51, 102, 0.45), rgba(0, 51, 102, 0.45)),
        url('{{ asset("image/tuktuk/slide1.jpg") }}');

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

.destinasi-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(1px);
}

.destinasi-hero div {
    position: relative;
    z-index: 2;
}

.destinasi-hero h1 {
    font-family: 'Open Sans', sans-serif;
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    animation: fadeInUp 0.8s ease;
    text-shadow: 0 4px 15px rgba(0,0,0,0.4);
}

.destinasi-hero p {
    font-family: 'Open Sans', sans-serif;
    font-size: 1rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    opacity: 0.95;
    animation: fadeInUp 0.8s ease 0.1s both;
    text-shadow: 0 2px 10px rgba(0,0,0,0.4);
}

/* Deskripsi seperti gambar pertama */
.destinasi-desc {
    font-family: 'Open Sans', sans-serif;
    font-size: 18px;
    font-weight: 400;
    line-height: 2;
    color: #333333;
    text-align: justify;
    letter-spacing: 0.2px;
    margin-bottom: 25px;
}

/* Judul Section */
.section-title {
    font-family: 'Open Sans', sans-serif;
    font-size: 2rem;
    font-weight: 700;
    color: #003366;
    margin-bottom: 20px;
}

/* Animasi */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .destinasi-hero {
        height: 45vh;
        min-height: 300px;
    }

    .destinasi-hero h1 {
        font-size: 2.5rem;
    }

    .destinasi-hero p {
        font-size: 0.85rem;
        letter-spacing: 0.15em;
    }

    .destinasi-desc {
        font-size: 16px;
        line-height: 1.9;
    }
}

    /*  CATEGORY SECTION  */
    .category-section {
        padding: 80px 0;
        background: #f0f4f0;
    }

    .section-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-header .subtitle {
        display: inline-block;
        font-size: 0.7rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #c6a43b;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .section-header h2 {
        font-size: 2.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #003366;
        font-family: 'Cormorant Garamond', serif;
    }

    .section-header .divider {
        width: 60px;
        height: 2px;
        background: #c6a43b;
        margin: 0 auto 20px;
    }

    .section-header p {
        color: #666;
        max-width: 600px;
        margin: 0 auto;
        font-size: 0.9rem;
    }

    /* Category Cards */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .category-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .card-image {
        position: relative;
        height: 240px;
        overflow: hidden;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-card:hover .card-image img {
        transform: scale(1.05);
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,51,102,0.3) 100%);
    }

    .card-content {
        padding: 25px;
        text-align: center;
    }

    .card-icon {
        width: 60px;
        height: 60px;
        background: rgba(0,51,102,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -40px auto 15px;
        position: relative;
        z-index: 2;
    }

    .card-icon i {
        font-size: 24px;
        color: #003366;
    }

    .card-content h3 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #003366;
    }

    .card-content p {
        font-size: 0.85rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /*  STATS SECTION  */
    .stats-section {
        background: linear-gradient(135deg, #003366, #1a4a7a);
        padding: 60px 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .stat-item {
        text-align: center;
        padding: 20px;
        background: rgba(255,255,255,0.08);
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        background: rgba(255,255,255,0.15);
        transform: translateY(-5px);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #c6a43b;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 0.7rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: rgba(255,255,255,0.8);
    }

    /*  RESPONSIVE  */
    @media (max-width: 992px) {
        .category-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .destinasi-hero {
            min-height: 320px;
        }

        .destinasi-hero h1 {
            font-size: 2.2rem;
        }

        .destinasi-hero p {
            font-size: 0.8rem;
            letter-spacing: 0.15em;
        }

        .category-section {
            padding: 50px 0;
        }

        .section-header h2 {
            font-size: 1.6rem;
        }

        .category-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
    }
</style>

<!-- HERO SECTION -->
<section class="destinasi-hero">
    <div data-aos="fade-up">
        <h1>Destinasi Geosite</h1>
        <p>Jelajahi Pesona Caldera Danau Toba</p>
    </div>
</section>

<!-- CATEGORY SECTION -->
<section class="category-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="subtitle">PILIH KATEGORI</span>
            <h2>Temukan Destinasi Favoritmu</h2>
            <div class="divider"></div>
            <p>Nikmati pengalaman wisata yang berbeda di setiap kategorinya</p>
        </div>

        <div class="category-grid">

            <!-- Destinasi Alam -->
            <a href="{{ url('/destinasi/alam') }}" class="category-card" data-aos="fade-up">
                <div class="card-image">
                    <img src="{{ asset('image/tuktuk/destinasi-alam.jpg') }}" alt="Destinasi Alam">
                    <div class="card-overlay"></div>
                </div>

                <div class="card-content">
                    <div class="card-icon">
                        <i class="fas fa-mountain"></i>
                    </div>

                    <h3>Destinasi Alam</h3>

                    <p>
                        Goa alami, formasi batuan unik, air terjun,
                        dan keindahan alam Danau Toba
                    </p>
                </div>
            </a>

            <!-- Destinasi Buatan --> 
            <a href="{{ url('/destinasi/buatan') }}" class="category-card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-image">
                    <img src="{{ asset('/image/Tomok/tomok1.jpg') }}" alt="Destinasi Buatan">
                    <div class="card-overlay"></div>
                </div>

                <div class="card-content">
                    <div class="card-icon">
                        <i class="fas fa-building"></i>
                    </div>

                    <h3>Destinasi Buatan</h3>

                    <p>
                        Patung ikonik, taman kota,
                        jembatan dengan pemandangan spektakuler
                    </p>
                </div>
            </a>

            <!-- Destinasi Budaya -->
            <a href="{{ url('/destinasi/budaya') }}" class="category-card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-image">
                    <img src="{{ asset('image/tuktuk/destinasi-budaya.jpg') }}" alt="Destinasi Budaya">
                    <div class="card-overlay"></div>
                </div>

                <div class="card-content">
                    <div class="card-icon">
                        <i class="fas fa-landmark"></i>
                    </div>

                    <h3>Destinasi Budaya</h3>

                    <p>
                        Desa adat, museum sejarah, kerajinan ulos,
                        dan kearifan lokal Batak
                    </p>
                </div>
            </a>

        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">

            <div class="stat-item" data-aos="fade-up">
                <div class="stat-number">74.000+</div>
                <div class="stat-label">TAHUN SEJARAH</div>
            </div>

            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number">3</div>
                <div class="stat-label">GEOSITE UNGGULAN</div>
            </div>

            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number">15+</div>
                <div class="stat-label">WARISAN BUDAYA</div>
            </div>

            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number">100+</div>
                <div class="stat-label">UMKM LOKAL</div>
            </div>

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