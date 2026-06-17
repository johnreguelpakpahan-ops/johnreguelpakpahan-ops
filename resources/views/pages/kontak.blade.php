@extends('layouts.app')

@section('title', 'Kontak - Geosite Danau Toba')

@section('content')

<style>
    /* Kosong - CSS logo/flag dihapus */

    /*  HERO  */
    .kontak-hero {
        height: 45vh;
        min-height: 320px;
        background: linear-gradient(135deg, rgba(0,0,0,0.65), rgba(0,0,0,0.4)),
                    url('/image/tuktuk/slide2.jpg') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        margin-top: 76px;
        position: relative;
    }
    
    .kontak-hero::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80px;
        background: linear-gradient(to top, #fafaf8, transparent);
    }
    
    .kontak-hero h1 {
        font-size: 3.5rem;
        font-weight: 400;
        font-family: 'Cormorant Garamond', serif;
        letter-spacing: 0.02em;
        margin-bottom: 15px;
    }
    
    .kontak-hero p {
        font-size: 1rem;
        opacity: 0.85;
        letter-spacing: 0.2em;
        text-transform: uppercase;
    }
    
    /*  KONTAK SECTION  */
    .kontak-section {
        padding: 60px 0;
    }
    
    .kontak-card {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        height: 100%;
    }
    
    .kontak-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .kontak-icon {
        width: 65px;
        height: 65px;
        background: rgba(198, 164, 59, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }
    
    .kontak-icon i {
        font-size: 28px;
        color: #c6a43b;
    }
    
    .kontak-card h4 {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: #1a1a1a;
    }
    
    .kontak-card p {
        color: #666;
        margin-bottom: 5px;
        font-size: 0.85rem;
        line-height: 1.5;
    }
    
    /*  FORM  */
    .form-card {
        background: white;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        height: 100%;
    }
    
    .form-card h3 {
        font-size: 1.5rem;
        font-family: 'Cormorant Garamond', serif;
        font-weight: 500;
        margin-bottom: 20px;
        color: #1a1a1a;
    }
    
    .form-control, .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #c6a43b;
        box-shadow: 0 0 0 3px rgba(198, 164, 59, 0.08);
        outline: none;
    }
    
    .btn-send {
        background: #1a1a1a;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 0.75rem;
        text-transform: uppercase;
    }
    
    .btn-send:hover {
        background: #c6a43b;
        color: #1a1a1a;
        transform: translateY(-2px);
    }
    
    /*  MAPS  */
    .map-card {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        background: white;
        height: 100%;
    }
    
    .map-card iframe {
        width: 100%;
        height: 280px;
        border: 0;
    }
    
    .map-info {
        padding: 20px;
        text-align: center;
    }
    
    .map-info h4 {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #1a1a1a;
    }
    
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 20px;
    }
    
    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #f5f4f0;
        border-radius: 50%;
        color: #1a1a1a;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .social-icons a:hover {
        background: #c6a43b;
        color: white;
        transform: translateY(-3px);
    }
    
    .jam-operasional p {
        margin-bottom: 5px;
        font-size: 0.85rem;
        color: #666;
    }
    
    .jam-operasional h5 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: #1a1a1a;
    }
    
    /*  RESPONSIVE  */
    @media (max-width: 768px) {
        .kontak-hero h1 {
            font-size: 2.2rem;
        }
        .kontak-hero p {
            font-size: 0.8rem;
        }
        .kontak-section {
            padding: 40px 0;
        }
        .form-card {
            margin-bottom: 25px;
        }
    }
    
    @media (max-width: 576px) {
        .kontak-hero h1 {
            font-size: 1.8rem;
        }
        .kontak-card {
            padding: 20px 15px;
        }
        .form-card {
            padding: 25px;
        }
    }
    /* = MUSIK LATAR = */

</style>

<!--  LOGO SECTION  -->
   

<!-- HERO -->
<section class="kontak-hero">
    <div class="container">
        <h1 data-aos="fade-up">Hubungi Kami</h1>
        <p data-aos="fade-up" data-aos-delay="100">Senang mendengar dari Anda</p>
    </div>
</section>

<!-- KONTAK SECTION -->
<section class="kontak-section">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- ALAMAT -->
            <div class="col-md-4" data-aos="fade-up">
                <div class="kontak-card">
                    <div class="kontak-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Alamat</h4>
                    <p>Geosite Danau Toba</p>
                    <p>Pulau Sibandang, Danau Toba</p>
                    <p>Sumatera Utara, Indonesia</p>
                </div>
            </div>
            
            <!-- TELEPON -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="kontak-card">
                    <div class="kontak-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4>Telepon</h4>
                    <p>+62 812 3456 7890</p>
                    <p>+62 813 9876 5432</p>
                    <p>(0622) 12345</p>
                </div>
            </div>
            
            <!-- EMAIL -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="kontak-card">
                    <div class="kontak-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4>Email</h4>
                    <p>info@geotoba.com</p>
                    <p>reservasi@geotoba.com</p>
                    <p>support@geotoba.com</p>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- FORM KONTAK -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="form-card">
                    <h3>Kirim Pesan</h3>

                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center gap-2 py-2 px-3 mb-3" role="alert" style="font-size:0.85rem; border-radius:12px;">
                            <span>✅</span> {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 mb-3" role="alert" style="font-size:0.85rem; border-radius:12px;">
                            <span>❌</span> {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('kontak.kirim') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap"
                                   value="{{ old('nama') }}" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                   value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="telepon" class="form-control" placeholder="Nomor Telepon"
                                   value="{{ old('telepon') }}">
                        </div>
                        <div class="mb-3">
                            <select name="subjek" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Subjek --</option>
                                <option value="Informasi Wisata"   {{ old('subjek')=='Informasi Wisata'   ? 'selected':'' }}>Informasi Wisata</option>
                                <option value="Reservasi Tiket"    {{ old('subjek')=='Reservasi Tiket'    ? 'selected':'' }}>Reservasi Tiket</option>
                                <option value="Kerjasama"          {{ old('subjek')=='Kerjasama'          ? 'selected':'' }}>Kerjasama</option>
                                <option value="Saran & Masukan"    {{ old('subjek')=='Saran & Masukan'    ? 'selected':'' }}>Saran & Masukan</option>
                                <option value="Lainnya"            {{ old('subjek')=='Lainnya'            ? 'selected':'' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <textarea name="pesan" class="form-control" rows="5" placeholder="Pesan Anda..." required>{{ old('pesan') }}</textarea>
                        </div>
                        <button type="submit" class="btn-send">
                            Kirim Pesan <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- MAPS & SOSIAL -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="map-card">
                   <iframe
    src="https://maps.google.com/maps?q=Pulau+Samosir,+Sumatera+Utara&t=&z=12&ie=UTF8&iwloc=&output=embed"
    width="100%"
    height="450"
    style="border:0;"
    allowfullscreen=""
    loading="lazy">
</iframe>
                    <div class="map-info">
                        <h4>Ikuti Kami</h4>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                        <div class="jam-operasional">
                            <h5>Jam Operasional</h5>
                            <p>Senin - Jumat: 08:00 - 17:00</p>
                            <p>Sabtu - Minggu: 08:00 - 18:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection