@extends('layouts.app')

@section('title', 'Sejarah Caldera Toba - Geosite Danau Toba')

@section('content')

<style>
    .sejarah-image{
    position:relative;
    flex:1;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,51,102,.15);
}

.img-source{

    position:absolute;

    bottom:12px;
    left:12px;

    background:rgba(0,0,0,.65);

    backdrop-filter:blur(6px);

    color:#fff;

    font-size:10px;

    font-weight:600;

    padding:4px 10px;

    border-radius:20px;

    text-decoration:none;

    z-index:99;

    transition:.3s ease;
}

.img-source:hover{

    background:#c6a43b;

    color:#003366;
}
    .sejarah-hero {
        height: 55vh;
        min-height: 360px;
        background: linear-gradient(rgba(0, 51, 102, 0.6), rgba(0, 102, 153, 0.4)), url('/image/Tomok/Tomok1.jpg') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        margin-top: 76px;
    }
    .sejarah-hero h1 { 
        font-size: 3.5rem; 
        font-family: 'Cormorant Garamond', serif; 
        margin-bottom: 12px;
        text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    }
    .sejarah-hero p { 
        font-size: 0.9rem; 
        letter-spacing: 0.2em; 
        text-transform: uppercase; 
        opacity: 0.85;
    }

    .section { padding: 60px 0; }
    .bg-light { background: linear-gradient(135deg, #e0ecf7 0%, #d4e4f2 100%); }
    .container { max-width: 1100px; margin: 0 auto; padding: 0 24px; }
    .section-title { text-align: center; margin-bottom: 45px; }
    .section-title h2 { 
        font-size: 2rem; 
        font-family: 'Cormorant Garamond', serif; 
        color: #003366; 
    }
    .divider { width: 50px; height: 2px; background: #c6a43b; margin: 10px auto 0; }

    .sejarah-grid { display: flex; flex-direction: column; gap: 45px; }
.sejarah-item {
    display: flex;
    align-items: center;
    gap: 50px;
}
    .sejarah-item.reverse { flex-direction: row-reverse; }
 .sejarah-text {
    flex: 0 0 60%;
    max-width: 60%;

    font-family: 'Quicksand', sans-serif;
    font-size: 17px;
    font-weight: 500;
    line-height: 2;
    letter-spacing: 0.3px;

    color: #000306;
    text-align: justify;
}
   .sejarah-image {
    flex: 0 0 48%;
    max-width: 48%;
}

.sejarah-image img {
    width: 100%;
    height: 380px;
    object-fit: cover;
}
    .sejarah-image:hover img { transform: scale(1.02); }

    .timeline {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 30px;
    }
    .timeline-item {
        flex: 1;
        background: white;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(0, 51, 102, 0.05);
    }
    .timeline-item:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 15px 30px rgba(0, 51, 102, 0.15);
        border-color: #c6a43b;
    }
    .timeline-year { font-size: 1.3rem; font-weight: 700; color: #c6a43b; }
    .timeline-title { font-weight: 600; color: #003366; }

    .fakta-grid { 
        display: grid; 
        grid-template-columns: repeat(3, 1fr); 
        gap: 25px; 
        margin-top: 30px; 
    }
    .fakta-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        transition: 0.3s;
    }
    .fakta-card:hover { transform: translateY(-5px); }
    .fakta-number { font-size: 2rem; font-weight: 700; color: #c6a43b; }
    .fakta-title { font-weight: 600; color: #003366; }

    .cta-section {
        background: linear-gradient(135deg, #003366 0%, #0a4a7a 100%);
        padding: 60px 0;
        text-align: center;
    }
    .cta-btn {
        display: inline-block;
        background: #c6a43b;
        color: #003366;
        padding: 12px 35px;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 600;
    }
    .cta-btn:hover { background: white; }

    @media (max-width: 768px) {
        .sejarah-hero h1 { font-size: 2.2rem; }
        .sejarah-item, .sejarah-item.reverse { flex-direction: column; text-align: center; }
        .timeline { flex-direction: column; }
        .fakta-grid { grid-template-columns: 1fr; }
    }
 /* = GORGA BATAK VERTIKAL = */
.section-batak {
    position: relative;
    overflow: hidden;
}

.section-batak::before,
.section-batak::after {
    content: "";
    position: absolute;
    top: 0;
    width: 120px;
    height: 100%;

    background-image: url('/image/gorga2.jpg');
    background-repeat: repeat-y;
    background-position: center top;
    background-size: 100% auto;

    opacity: 0.18;
    z-index: 1;
}

/* kiri */
.section-batak::before {
    left: 40px;
}

/* kanan */
.section-batak::after {
    right: 40px;
    transform: scaleX(-1);
}

.section-batak .container {
    position: relative;
    z-index: 2;
}
    /* = MUSIK LATAR = */

</style>

<!-- HERO -->
<section class="sejarah-hero">
    <div data-aos="fade-up">
        <h1>Sejarah Caldera Toba</h1>
        <p>Warisan Geologi Kelas Dunia</p>
    </div>
</section>

<!-- SEJARAH BERSILANG dari DATABASE -->
<!-- SEJARAH BERSILANG dari DATABASE -->
<section class="section section-batak">

    <div class="container">

        <div class="section-title" data-aos="fade-up">

            <h2>Ciri Khas</h2>

            <div class="divider"></div>

        </div>


        <div class="sejarah-grid">

            @forelse($sejarahList as $index => $item)

            <div
                class="sejarah-item {{ $index % 2 == 1 ? 'reverse' : '' }}"
                data-aos="fade-{{ $index % 2 == 0 ? 'right' : 'left' }}"
            >

                <!-- IMAGE -->
                <div class="sejarah-image">

                    @if($item->gambar)

                        <img
                            src="{{ $item->gambar && !str_starts_with($item->gambar, 'data:') ? asset('storage/' . $item->gambar) : $item->gambar }}"
                            alt="{{ $item->judul }}"
                        >

                    @else

                        <img
                            src="/image/sejarah{{ $index+1 }}.jpg"
                            alt="{{ $item->judul }}"
                        >

                    @endif


                    {{-- SOURCE --}}
                    @if($item->link_referensi)

                    <a
                        href="{{ $item->link_referensi }}"
                        target="_blank"
                        class="img-source"
                        title="Sumber Gambar"
                    >
                        🔗 source
                    </a>

                    @endif

                </div>


                <!-- TEXT -->
                <div class="sejarah-text">

                    {!! $item->konten !!}

                </div>

            </div>

            @empty

            <div class="text-center py-5">

                <p>Belum ada data sejarah.</p>

            </div>

            @endforelse

        </div>

    </div>

</section>

<!-- TIMELINE 4 LETUSAN (STATIS) -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>4 Periode Letusan</h2>
            <div class="divider"></div>
            <p>Proses pembentukan Kaldera Toba melalui 4 letusan besar</p>
        </div>
        <div class="timeline">
            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-year">1,2 Juta Tahun</div>
                <div class="timeline-title">Letusan Pertama</div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="50">
                <div class="timeline-year">840.000 Tahun</div>
                <div class="timeline-title">Letusan Kedua</div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                <div class="timeline-year">450.000 Tahun</div>
                <div class="timeline-title">Letusan Ketiga</div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="150">
                <div class="timeline-year">74.000 Tahun</div>
                <div class="timeline-title">Letusan Keempat</div>
            </div>
        </div>
    </div>
</section>

<!-- FAKTA UNIK (STATIS) -->
<section class="section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Fakta Unik Danau Toba</h2>
            <div class="divider"></div>
        </div>
        <div class="fakta-grid">
            <div class="fakta-card" data-aos="fade-up">
                <div class="fakta-number">#1</div>
                <div class="fakta-title">Danau Vulkanik Terbesar</div>
            </div>
            <div class="fakta-card" data-aos="fade-up" data-aos-delay="50">
                <div class="fakta-number">#2</div>
                <div class="fakta-title">Pulau di Tengah Danau</div>
            </div>
            <div class="fakta-card" data-aos="fade-up" data-aos-delay="100">
                <div class="fakta-number">#3</div>
                <div class="fakta-title">UNESCO Global Geopark</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
        <h3 style="color: white;">Jelajahi Geosite Lainnya</h3>
            <div class="divider"></div>
            <p style="color: white;">Temukan keajaiban geologi lainnya di Geopark Danau Toba</p>
            <a href="{{ url('/') }}" class="cta-btn">Kembali ke Beranda</a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 700, once: true, offset: 50 });</script>
<script>

</script>
@endsection