<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Geosite Danau Toba')</title>
    <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500&display=swap" rel="stylesheet">
   
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <style>
    /* = NAVBAR BASE = */
    .navbar {
        transition: all 0.4s ease;
        padding: 0.8rem 0;
        background: white;
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(198, 164, 59, 0.25);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1040;
    }

    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.96);
        padding: 0.4rem 0;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
    }

    .navbar .container {
        max-width: 100%;
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-between;
    }

.logo-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
    padding: 0;
}

.logo-img {
    height: 65px !important;
    width: auto;
    object-fit: contain;
    display: block;
}

.logo-divider {
    width: 1px;
    height: 48px;
    background: #dcdcdc;
    flex-shrink: 0;
}

.navbar-brand {
    display: flex;
    align-items: center;
    margin-bottom: 0 !important;
    white-space: nowrap;
}
.navbar .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: nowrap;
}
.logo-img {
    height: 65px !important;
    width: auto;
    object-fit: contain;
}

/* Garis pemisah */
.logo-divider {
    height: 48px;
}

/* Tulisan GeoToba */
.navbar-brand {
    font-size: 2rem !important;
    font-weight: 800 !important;
    color: #000 !important;
    text-decoration: none !important;
    line-height: 1;
    padding-left: 4px;
}

.navbar-brand span {
    color: #c6a43b !important;
}

    /* = NAV LINKS (DESKTOP) = */
    .nav-link {
        color: black;
        font-weight: 500;
        margin: 0 0.2rem;
        transition: all 0.25s ease;
        font-size: 0.95rem;
        padding: 0.5rem 1rem;
        border-radius: 40px;
    }

    .nav-link:hover {
        color: var(--gold) !important;
        background: rgba(198, 164, 59, 0.1);
        transform: translateY(-2px);
    }

    .nav-link.active {
        color: var(--gold) !important;
        background: rgba(198, 164, 59, 0.2);
    }
/* = MUSIC PLAYER = */

.music-card{
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;

    width: 260px;
    height: 68px;

    display: flex;
    align-items: center;
    gap: 12px;

    padding: 10px 14px;

    background: #054071;
    border: 2px solid #c6a43b;
    border-radius: 40px;

    box-shadow: 0 8px 25px rgba(0,0,0,.35);

    transition: all .3s ease;
}

.music-card:hover{
    transform: translateY(-3px);
}

/* Badge */

.music-badge{
    position: absolute;
    top: -10px;
    left: 15px;

    background: #054071;
    color: #c6a43b;

    font-size: 8px;
    font-weight: 700;
    letter-spacing: .5px;

    padding: 3px 8px;

    border-radius: 20px;
    border: 1px solid rgba(198,164,59,.3);
}

/* Informasi Lagu */

.music-info{
    flex: 1;
    overflow: hidden;
}

.music-title{
    color: #ffffff;
    font-size: 14px;
    font-weight: 700;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.music-artist{
    color: #c6a43b;
    font-size: 11px;
    margin-top: 2px;
}

/* Equalizer */

.music-eq{
    display: flex;
    align-items: flex-end;
    gap: 2px;
    height: 16px;
}

.music-eq span{
    width: 3px;
    border-radius: 2px;
    background: #c6a43b;

    animation: musicBar .8s ease-in-out infinite alternate;
}

.music-eq span:nth-child(1){
    height: 6px;
}

.music-eq span:nth-child(2){
    height: 12px;
    animation-delay: .15s;
}

.music-eq span:nth-child(3){
    height: 8px;
    animation-delay: .3s;
}

.music-eq span:nth-child(4){
    height: 14px;
    animation-delay: .1s;
}

@keyframes musicBar{
    from{
        transform: scaleY(.4);
    }
    to{
        transform: scaleY(1);
    }
}

/* Tombol Play */

.music-btn{
    width: 36px;
    height: 36px;

    border: none;
    border-radius: 50%;

    background: #c6a43b;
    color: #054071;

    display: flex;
    align-items: center;
    justify-content: center;

    cursor: pointer;
    transition: all .3s ease;
}

.music-btn:hover{
    transform: scale(1.1);
}

.music-btn i{
    font-size: 15px;
}

/* Mobile */

@media (max-width: 768px){

    .music-card{
        width: 220px;
        height: 62px;

        right: 12px;
        bottom: 12px;

        padding: 8px 12px;
    }

    .music-title{
        font-size: 12px;
    }

    .music-artist{
        font-size: 10px;
    }

    .music-btn{
        width: 32px;
        height: 32px;
    }
}
    /* = DROPDOWN = */
    .dropdown-menu {
        background: white;
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        padding: 0.6rem 0;
        margin-top: 0.7rem;
        box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.3);
        color :black;
    }

    .dropdown-item {
        color: black;
        padding: 10px 24px;
        font-size: 0.85rem;
        transition: all 0.25s ease;
        border-radius: 18px;
        margin: 4px 10px;
        font-weight: bold;
    }

    .dropdown-item:hover {
        background: rgba(198, 164, 59, 0.2);
        color: var(--gold);
        transform: translateX(5px);
    }

    .dropdown-header {
        color: #c6a43b;
        padding: 8px 24px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

   /* = TOGGLER (SATU DEFINISI SAJA) = */
.navbar-toggler {
    align-items: center;
    justify-content: center;
    border: 2px solid #054071 !important;
    background: #ffffff !important;
    padding: 7px 11px !important;
    border-radius: 10px !important;
    cursor: pointer;
    z-index: 1050;
    position: relative;
}

@media (max-width: 991px) {
    .navbar-toggler {
        display: flex !important;
    }
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 3px rgba(5, 64, 113, 0.25) !important;
    outline: none;
}

.navbar-toggler-icon {
    display: inline-block;
    width: 1.5em;
    height: 1.5em;
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23054071' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.5' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
}
    /* = MOBILE COLLAPSE MENU = */
    @media (max-width: 991px) {
        /* Pastikan navbar row tidak wrap/turun ke bawah */
        .navbar > .container,
        .navbar > .container-fluid {
            flex-wrap: nowrap !important;
            align-items: center !important;
        }

        .logo-img {
            height: 32px !important;
        }
        .logo-wrapper {
            gap: 6px;
            flex-shrink: 1;
            min-width: 0;
            overflow: hidden;
        }
        .logo-divider {
            display: none;
        }
        .navbar-brand {
            font-size: 1.1rem;
            white-space: nowrap;
            flex-shrink: 0;
        }

        /* Toggler selalu di kanan, tidak turun */
        .navbar-toggler {
            flex-shrink: 0;
            margin-left: auto;
        }

        /* Collapse menu muncul di bawah navbar, full width */
        .navbar-collapse {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #ffffff;
            border-radius: 0 0 16px 16px;
            padding: 12px 16px;
            z-index: 1040;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .navbar-nav {
            width: 100%;
            text-align: center;
        }

        .nav-item {
            margin: 3px 0;
        }

        /* Override warna link jadi putih di dalam collapse biru */
        .navbar-collapse .nav-link {
            display: block !important;
            width: 100%;
            color: white !important;
            border-radius: 10px;
            padding: 8px 12px;
        }

        .navbar-collapse .nav-link:hover,
        .navbar-collapse .nav-link.active {
            color: var(--gold) !important;
            background: rgba(255, 255, 255, 0.1);
        }

        /* Dropdown di mobile */
        .navbar-collapse .dropdown-menu {
            position: static !important;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            margin: 5px 0;
            padding: 5px;
            box-shadow: none;
        }

        .navbar-collapse .dropdown-item {
            color: rgba(255, 255, 255, 0.85);
            text-align: center;
        }

        .navbar-collapse .dropdown-item:hover {
            color: var(--gold);
            transform: none;
            background: rgba(198, 164, 59, 0.15);
        }
    }

    @media (max-width: 576px) {
        .logo-img {
            height: 28px !important;
        }
        .navbar-brand {
            font-size: 0.9rem;
            padding-left: 0;
        }
    }

    /* = FOOTER = */

.footer{
    background: linear-gradient(
        135deg,
        #054071 0%,
        #0a4f89 100%
    );
    color: #ffffff;
    padding: 30px 0 10px;
    margin-top: 40px;
    position: relative;
    overflow: hidden;
}

.footer::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:4px;
    background:#c6a43b;
}

.footer h5{
    color:#ffffff;
    font-weight:700;
    margin-bottom:20px;
    font-size:1.2rem;
}

.footer p,
.footer li{
    color:rgba(255,255,255,0.85);
    line-height:1.8;
    font-size:14px;
}

.footer ul{
    padding-left:0;
}

.footer ul li{
    list-style:none;
    margin-bottom:10px;
}

.footer a{
    color:rgba(255,255,255,0.85);
    text-decoration:none;
    transition:all .3s ease;
}

.footer a:hover{
    color:#c6a43b;
    padding-left:5px;
}

.footer .social-icons{
    display:flex;
    gap:12px;
    margin-top:20px;
}

.footer .social-icons a{
    width:42px;
    height:42px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(255,255,255,0.1);
    border:1px solid rgba(255,255,255,0.15);
    color:#ffffff;
    transition:all .3s ease;
}

.footer .social-icons a:hover{
    background:#c6a43b;
    color:#054071;
    transform:translateY(-4px);
    padding-left:0;
}

.footer .copyright{
    border-top:1px solid rgba(255,255,255,0.15);
    margin-top:30px;
    padding-top:20px;
    text-align:center;
}

.footer .copyright p{
    margin:0;
    color:rgba(255,255,255,0.75);
    font-size:13px;
}

.footer i{
    color:#c6a43b;
}

@media (max-width:768px){

    .footer{
        padding: 30px 16px 12px;
        margin-top: 40px;
    }

    /* Grid footer mobile: 2 kolom side-by-side */
    .footer .row {
        display: flex;
        flex-wrap: wrap;
    }

    /* GeoToba description: full row */
    .footer .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
        text-align: center;
        margin-bottom: 12px !important;
    }

    /* Tautan + Destinasi: side-by-side 2 kolom */
    .footer .col-lg-5 {
        flex: 0 0 60%;
        max-width: 60%;
        margin-bottom: 12px !important;
    }

    /* Kontak: 1 kolom kecil di kanan */
    .footer .col-lg-3 {
        flex: 0 0 40%;
        max-width: 40%;
        margin-bottom: 12px !important;
    }

    .footer .social-icons{
        justify-content: center;
    }

    .footer h5{
        font-size: 0.95rem;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .footer p,
    .footer li {
        font-size: 12px;
        line-height: 1.6;
    }

    .footer ul li {
        margin-bottom: 5px;
    }

    .footer .social-icons a {
        width: 34px;
        height: 34px;
    }

    .footer .copyright {
        margin-top: 15px;
        padding-top: 12px;
    }

    .footer .copyright p {
        font-size: 11px;
    }
}

@media (max-width: 400px) {
    .footer .col-lg-5 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .footer .col-lg-3 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
}
</style>

    
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <!-- LOGO SECTION - LANGSUNG DARI FOLDER public/image/Logo/ -->
            <div class="logo-wrapper">
                <img src="{{ asset('image/Logo/logobankindonesia.jpg') }}" alt="Bank Indonesia" class="logo-img" loading="lazy">
                <div class="logo-divider"></div>
                <img src="{{ asset('image/Logo/del.jpg') }}" alt="Logo Del" class="logo-img" loading="lazy">
                <div class="logo-divider"></div>
                <a class="navbar-brand" href="{{ url('/') }}">Geo<span>Toba</span></a>
            </div>
            
            <button class="navbar-toggler" type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="fas fa-house me-1"></i> Home
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('informasi') ? 'active' : '' }}" href="{{ url('/informasi') }}">
            <i class="fas fa-star me-1"></i> Ciri Khas
        </a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ request()->routeIs('destinasi*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
            <i class="fas fa-map-location-dot me-1"></i> Destinasi
        </a>
        <ul class="dropdown-menu">
            <li><h6 class="dropdown-header"><i class="fas fa-tag me-1"></i> KATEGORI DESTINASI</h6></li>
            <li><b><a class="dropdown-item" href="{{ url('/destinasi/alam') }}">Destinasi Alam</a></b></li>
            <li><a class="dropdown-item" href="{{ url('/destinasi/buatan') }}">Destinasi Buatan</a></li>
            <li><a class="dropdown-item" href="{{ url('/destinasi/budaya') }}">Destinasi Budaya</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('/destinasi') }}">Semua Destinasi</a></li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ url('/galeri') }}">
            <i class="fas fa-camera me-1"></i> Galeri
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}" href="{{ url('/berita') }}">
            <i class="fas fa-newspaper me-1"></i> Berita
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ url('/kontak') }}">
            <i class="fas fa-phone me-1"></i> Kontak
        </a>
    </li>
</ul>
</div>
    </nav>

    <main style="padding-top: 80px; position: relative; z-index: 1;">@yield('content')</main>
   <footer class="footer">
    <div class="container-fluid px-5">
            <div class="row">

                <!-- GeoToba -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <h5>Geo<span style="color:#c6a43b;">Toba</span></h5>
                    <p class="mt-3" style="font-size:14px;">
                        Sistem Informasi Geosite Danau Toba -
                        Menyajikan informasi lengkap tentang
                        keindahan geologi dan budaya Batak
                        di kawasan Danau Toba.
                    </p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/share/1AfDujRj9c/" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/disbudparekrafsumut?igsh=MXM3czFidmVod3V0bw==" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://youtube.com/@disbudparekrafsumut?si=YR6nE4gZuYUD2bIm" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- TAUTAN + DESTINASI -->
                <div class="col-lg-5 col-md-12 mb-4">
                    <div class="row">
                        <div class="col-6">
                            <h5>Tautan</h5>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/informasi') }}">Ciri Khas</a></li>
                                <li><a href="{{ url('/galeri') }}">Galeri</a></li>
                                <li><a href="{{ url('/berita') }}">Berita</a></li>
                                <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h5>Destinasi</h5>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/destinasi/alam') }}">Destinasi Alam</a></li>
                                <li><a href="{{ url('/destinasi/buatan') }}">Destinasi Buatan</a></li>
                                <li><a href="{{ url('/destinasi/budaya') }}">Destinasi Budaya</a></li>
                                <li><a href="{{ url('/destinasi') }}">Semua Destinasi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="col-lg-3 col-md-12 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Danau Toba, Sumatera Utara
                        </li>
                        <li>
                            <i class="fas fa-phone me-2"></i>
                            +62 812 3456 7890
                        </li>
                        <li>
                            <i class="fas fa-envelope me-2"></i>
                            info@geotoba.com
                        </li>
                    </ul>
                </div>

            </div>
            <div class="copyright"><p>&copy; 2026 GeoToba - Geopark Danau Toba. All rights reserved.</p></div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        AOS.init({ duration: 1000, once: true });
        
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });
        
       const SONG_TITLE  = 'Horbo Paung';
const SONG_ARTIST = "D' Bambo Official";


const musicCard = document.createElement('div');
musicCard.className = 'music-card';
musicCard.innerHTML = `
    <span class="music-badge">
        ♫ BEBAS HAK CIPTA
    </span>

    <div class="music-icon">
        <i class="bi bi-music-note-beamed"></i>
    </div>

    <div class="music-info">
        <div class="music-title">${SONG_TITLE}</div>
        <div class="music-artist">${SONG_ARTIST}</div>
    </div>

    <div class="music-eq" id="musicEq">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <button class="music-btn" id="musicPlayBtn">
        <i class="bi bi-play-fill" id="musicBtnIcon"></i>
    </button>
`;
document.body.appendChild(musicCard);

/* = AUDIO = */

const audio = new Audio("{{ asset('audio/Horbo_Paung_Gondang.mp3') }}");
audio.loop = true;
audio.volume = 0.45;

/* = ELEMENT = */

const eqEl = document.getElementById('musicEq');
const iconEl = document.getElementById('musicBtnIcon');
const playBtn = document.getElementById('musicPlayBtn');

let isPlaying = false;

/* = PLAY = */

function startMusic() {

    audio.play()
        .then(() => {

            isPlaying = true;

            eqEl.classList.add('active');

            iconEl.classList.remove('bi-play-fill');
            iconEl.classList.add('bi-pause-fill');

        })
        .catch(error => {
            console.log('Audio Error:', error);
        });
}

/* = STOP = */

function stopMusic() {

    audio.pause();

    isPlaying = false;

    eqEl.classList.remove('active');

    iconEl.classList.remove('bi-pause-fill');
    iconEl.classList.add('bi-play-fill');
}

/* = BUTTON CLICK = */

playBtn.addEventListener('click', function(e) {

    e.stopPropagation();

    if (isPlaying) {
        stopMusic();
    } else {
        startMusic();
    }

});

/* = AUTO PLAY SETELAH INTERAKSI USER = */

window.addEventListener('click', function() {

    if (!isPlaying) {
        startMusic();
    }

}, {
    once: true
});

/* = JIKA LAGU SELESAI = */

audio.addEventListener('ended', function() {

    isPlaying = false;

    eqEl.classList.remove('active');

    iconEl.classList.remove('bi-pause-fill');
    iconEl.classList.add('bi-play-fill');

});
  </script>
    
    @stack('scripts')
</body>
</html>