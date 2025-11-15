@extends('layouts.app')

@section('title', 'Beranda - SMKN 4 BOGOR')

@section('styles')
<style>
    /* Contact and Map Section Styling */
    .contact-item {
        padding: 0.5rem 0;
    }
    
    .contact-item i {
        font-size: 1.1rem;
    }
    
    .contact-item .fw-bold {
        font-size: 0.95rem;
        color: #333;
    }
    
    .contact-item .text-muted {
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    /* Responsive adjustments */
    @media (max-width: 991px) {
        .contact-item {
            padding: 0.75rem 0;
        }
        
        .contact-item i {
            font-size: 1.2rem;
        }
        
        .contact-item .fw-bold {
            font-size: 1rem;
        }
        
        .contact-item .text-muted {
            font-size: 0.95rem;
        }
    }
    
    @media (max-width: 576px) {
        .contact-item {
            padding: 1rem 0;
        }
        
        .contact-item i {
            font-size: 1.3rem;
        }
        
        .contact-item .fw-bold {
            font-size: 1.1rem;
        }
        
        .contact-item .text-muted {
            font-size: 1rem;
        }
    }
    
    /* Visual polish and hover effects */
    .card.shadow-sm:hover { 
        transform: translateY(-4px); 
        box-shadow: 0 10px 20px rgba(0,0,0,0.12) !important; 
        transition: transform .3s ease, box-shadow .3s ease; 
    }
    .profile-content .btn { 
        transition: transform .2s ease, box-shadow .2s ease; 
    }
    .profile-content .btn:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 8px 16px rgba(13,110,253,.25); 
    }
    
    /* Hero overlay (reverted to original, no extra animation) */
    .hero-overlay { }
    
    /* Reveal on scroll */
    .reveal { opacity: 0; transform: translateY(16px); transition: opacity .6s ease, transform .6s ease; }
    .reveal.show { opacity: 1; transform: none; }
    
    /* Image zoom on hover */
    .zoom-img { overflow: hidden; }
    .zoom-img img { transition: transform .6s ease; }
    .zoom-img:hover img { transform: scale(1.06); }
    
    /* Section labeling */
    .section-label { position: relative; }
    .section-label .label-badge {
        display: inline-flex; align-items: center; justify-content: center;
        width: 36px; height: 36px; border-radius: 8px;
        background: #0d6efd; color: #fff; font-weight: 700; letter-spacing: .5px;
        box-shadow: 0 6px 14px rgba(13,110,253,.25);
    }
    .section-label .label-line { flex: 1; height: 2px; background: rgba(13,110,253,.2); margin-left: 10px; border-radius: 2px; }
    
    /* Removed alternating wrapper styles */

    /* Section header card (inspired by provided example) */
    .section-card {
        background: #ffffff;
        border: 1px solid #e9eef5;
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 18px;
    }
    .section-card .overline {
        font-size: .8rem;
        color: #7b8a9a;
        letter-spacing: .04em;
    }
    .section-card-title {
        margin: 2px 0 0 0;
        font-weight: 800;
        color: #1e293b;
        font-size: 1.6rem;
    }
    .section-card-title .accent { color: #0d6efd; }
    .btn-primary-soft { background: rgba(13,110,253,.1); color: #0d6efd; border: 1px solid rgba(13,110,253,.2); }
    .btn-primary-soft:hover { background: rgba(13,110,253,.15); color: #0b5ed7; border-color: rgba(13,110,253,.3); }
    .icon-bubble{
        width: 44px; height: 44px; border-radius: 12px; 
        display: inline-flex; align-items: center; justify-content: center;
        background: rgba(13,110,253,.1); color: #0d6efd; font-size: 1.2rem;
    }

    /* New styles for icon bubbles */
    .icon-bubble {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        font-size: 1.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    
    /* Hero Section */
    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        margin-top: -10px;
        padding-top: 10px;
    }
    
    .hero-section--full {
        height: 100vh;
        margin-top: -10px;
        padding-top: 10px;
    }
    
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    
    .hero-slideshow {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    .hero-bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    
    .hero-bg-image.active {
        opacity: 1;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-overlay .container {
        position: relative;
        z-index: 3;
    }
    
    .hero-overlay h3 {
        color: #fff !important;
        font-size: 3.5rem;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 1.5rem;
    }
    
    .hero-overlay p {
        color: #fff !important;
        font-size: 1.4rem;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    }
    
    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1976d2;
        margin-bottom: 10px;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
        color: #666;
        margin: 0;
    }
    
    /* Responsive Hero Section */
    @media (max-width: 768px) {
        .hero-overlay h3 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .hero-overlay p {
            font-size: 1.1rem;
        }
    }
    
    @media (max-width: 576px) {
        .hero-overlay h3 {
            font-size: 2rem;
            margin-bottom: 0.75rem;
        }
        
        .hero-overlay p {
            font-size: 1rem;
        }
    }
    
    /* Main Banner */
    .main-banner-section {
        padding: 40px 0;
        background: #f5f5f5;
    }
    
    .main-banner {
        background: #e0e0e0;
        border-radius: 15px;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    
    .banner-placeholder {
        font-size: 4rem;
        color: #999;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    
    .banner-placeholder i {
        animation: float 3s ease-in-out infinite;
    }
    
    .banner-placeholder i:last-child {
        animation-delay: 1.5s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    /* Content Sections */
    .content-sections {
        padding: 40px 0;
        background: white;
    }
    
    .content-card {
        padding: 30px;
        border-radius: 15px;
        height: 100%;
        min-height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .gallery-card {
        background: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .gallery-placeholder {
        font-size: 3rem;
        color: #999;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    
    .info-card { background: #e9f2ff; }
    
    .section-title { font-size: 1.2rem; font-weight: 700; color: #0d47a1; margin-bottom: 15px; }
    
    .content-title { font-size: 2rem; font-weight: 600; color: #0b5ed7; margin-bottom: 15px; }
    
    .content-text {
        color: #424242;
        line-height: 1.6;
        margin: 0;
    }
    
    .agenda-card { background: #e7f1ff; }
    .agenda-card .section-title { color: #0b5ed7; }
    
    .agenda-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .agenda-list li {
        padding: 8px 0;
        border-bottom: 1px solid rgba(198, 40, 40, 0.1);
        color: #424242;
    }
    
    .agenda-list li:last-child {
        border-bottom: none;
    }
    
    .information-card { background: #f4f9ff; }
    
    .information-card .section-title { color: #0d47a1; }
    
    .info-subtitle {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1976d2;
        margin-bottom: 15px;
    }
    
    .info-image-placeholder {
        background: #bdbdbd;
        height: 200px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        font-size: 3rem;
        color: #757575;
    }
    
    .map-card {
        background: white;
        border: 2px solid #e0e0e0;
    }
    
    .map-card .section-title { color: #0d47a1; }
    
    .map-image-card {
        background: #f5f5f5;
        padding: 20px;
    }
    
    .school-map {
        background: white;
        border-radius: 10px;
        padding: 20px;
        position: relative;
        height: 300px;
        border: 2px solid #e0e0e0;
    }
    
    .map-legend {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.8rem;
    }
    
    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }
    
    .legend-color.classroom { background: #4caf50; }
    .legend-color.library { background: #0d6efd; }
    .legend-color.kitchen { background: #ff9800; }
    .legend-color.offices { background: #9c27b0; }
    .legend-color.chapel { background: #f44336; }
    
    .map-areas {
        position: absolute;
        top: 20px;
        left: 20px;
        right: 20px;
        bottom: 60px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(3, 1fr);
        gap: 5px;
    }
    
    /* Modal content wrapping fixes */
    #jurusanModal .card-body, 
    #jurusanModal .list-unstyled li, 
    #jurusanModal p, 
    #jurusanModal small, 
    #jurusanModal span {
        white-space: normal;
        word-break: normal;
        overflow-wrap: break-word;
    }
    #jurusanModal .list-unstyled li { line-height: 1.5; }
    /* Requested size and color */
    #jurusanModal .list-unstyled li,
    #jurusanModal p,
    #jurusanModal .card-body span,
    #jurusanModal .card-body small {
        font-size: 1.1rem;
        color:hsl(216, 98.40%, 52.20%);
    }

    /* Alternating section colors (blue/white) */
    #homeAlt > section.section-slice:nth-of-type(odd) { background: #ffffff; }
    #homeAlt > section.section-slice:nth-of-type(even) { background: rgba(13,110,253,0.06); }
</style>
@endsection

@section('content')
<div id="homeAlt">
<!-- Hero Section with Full Background -->
<section class="hero-section hero-section--full section-slice">
    <div class="hero-background">
        <div class="hero-slideshow">
            @php
                // Optimize hero images for better mobile performance
                // Hero images: max 1920px width (full HD), quality 85 for good quality
                $hero1 = \App\Helpers\ImageOptimizer::getOptimizedImageUrl('images/1.JPG', 1920, 0, 85);
                $hero2 = \App\Helpers\ImageOptimizer::getOptimizedImageUrl('images/IMG_8801.JPG', 1920, 0, 85);
                $hero3 = \App\Helpers\ImageOptimizer::getOptimizedImageUrl('images/lapangan.JPG', 1920, 0, 85);
                $hero4 = \App\Helpers\ImageOptimizer::getOptimizedImageUrl('images/smk.JPG', 1920, 0, 85);
            @endphp
            <img src="{{ $hero1 }}" class="hero-bg-image active" alt="SMKN 4 BOGOR Background 1" loading="eager" fetchpriority="high">
            <img src="{{ $hero2 }}" class="hero-bg-image" alt="SMKN 4 BOGOR Background 2" loading="lazy">
            <img src="{{ $hero3 }}" class="hero-bg-image" alt="SMKN 4 BOGOR Background 3" loading="lazy">
            <img src="{{ $hero4 }}" class="hero-bg-image" alt="SMKN 4 BOGOR Background 4" loading="lazy">
        </div>
        <div class="hero-overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="fw-bold mb-4 text-white">Selamat Datang di SMKN 4 BOGOR</h1>
                        <p class="lead mb-4">Temukan berbagai kegiatan, prestasi, dan informasi terkini tentang sekolah kami</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profil Sekolah Section -->
<section class="py-5 section-slice">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 reveal">
                <div class="profile-content">
                    <h3 class="fw-bold text-primary mb-3">
                        <i class="fas fa-school me-2"></i>
                        Profil SMKN 4 Bogor
                    </h3>
                    <div class="profile-text">
                        <p class="mb-0">
                            SMKN 4 Bogor adalah SMK negeri di Kota Bogor, berdiri sejak 2009 dan berfokus pada pembelajaran vokasi modern dengan fasilitas lengkap serta lingkungan belajar kolaboratif.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 reveal">
                <div class="video-container card shadow-lg border-0 zoom-img" style="border-radius: 16px;">
                    <div class="video-wrapper-small">
                        <h6 class="text-center mb-2 text-primary">
                            <i class="fas fa-play-circle me-1"></i>
                            Video SMKN 4 Bogor
                        </h6>
                        <div class="ratio ratio-16x9">
                            <iframe 
                                src="https://www.youtube.com/embed/N6cmqCbQllo?si=aed4uau0OQ9UbAz9" 
                                title="Video SMKN 4 Bogor" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                referrerpolicy="strict-origin-when-cross-origin" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4 themed-section" style="background: #f8fbff;">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                    <div class="card-header bg-primary text-white" style="border-radius: 12px 12px 0 0;">
                        <h5 class="mb-0"><i class="fas fa-bullseye me-2"></i>Visi</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">"Menjadi SMK Unggulan yang menghasilkan lulusan berkualitas, berakhlak mulia, dan siap kerja sesuai dengan kebutuhan dunia usaha dan dunia industri"</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                    <div class="card-header bg-primary text-white" style="border-radius: 12px 12px 0 0;">
                        <h5 class="mb-0"><i class="fas fa-list-check me-2"></i>Misi</h5>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>Menyelenggarakan pendidikan kejuruan yang berkualitas</li>
                            <li>Mengembangkan kompetensi siswa sesuai standar industri</li>
                            <li>Membentuk karakter siswa yang berakhlak mulia</li>
                            <li>Meningkatkan kerjasama dengan dunia usaha dan industri</li>
                            <li>Mengembangkan inovasi pembelajaran yang efektif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jurusan Section -->
<section id="jurusan" class="py-5 section-slice">
    <div class="container-fluid px-2">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold text-primary mb-3" style="font-size: 2rem;">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Jurusan SMKN 4 BOGOR
                </h2>
                <p class="text-muted">Pilih jurusan yang sesuai dengan minat dan bakat Anda</p>
            </div>
        </div>
        <div class="row g-2">
            <div class="col-xl-3 col-lg-3 col-md-6 reveal">
                <div class="card border-0 shadow-lg h-100 zoom-img" style="border-radius: 16px; transition: transform 0.25s ease, box-shadow 0.25s ease; overflow: hidden;">
                    <div class="position-relative" style="height: 200px; overflow: hidden;">
                        @php
                            $pplgImg = \App\Helpers\ImageOptimizer::getOptimizedImageUrl('images/jurusan/pplg.jpeg', 400, 200, 75);
                        @endphp
                        <img src="{{ $pplgImg }}" alt="PPLG" class="img-fluid w-100 h-100" style="object-fit: cover;" loading="lazy">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(13, 110, 253, 0.8); opacity: 0; transition: opacity 0.3s ease;">
                            <div class="text-white text-center">
                                <i class="fas fa-laptop-code" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold mb-3" style="color:#333333;">PPLG</h5>
                        <p class="text-muted mb-3">Pengembangan Perangkat Lunak dan Gim</p>
                        <button type="button" class="btn btn-primary btn-sm" onclick="openJurusanModal('pplg')" style="border-radius: 25px; padding: 0.5rem 1.5rem;">
                            <i class="fas fa-arrow-right me-1"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 reveal">
                <div class="card border-0 shadow-lg h-100 zoom-img" style="border-radius: 16px; transition: transform 0.25s ease, box-shadow 0.25s ease; overflow: hidden;">
                    <div class="position-relative" style="height: 200px; overflow: hidden;">
                        @php
                            $tjktImg = \App\Helpers\ImageOptimizer::getOptimizedImageUrl('images/jurusan/tjkt.jpeg', 400, 200, 75);
                        @endphp
                        <img src="{{ $tjktImg }}" alt="TJKT" class="img-fluid w-100 h-100" style="object-fit: cover;" loading="lazy">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(25, 135, 84, 0.8); opacity: 0; transition: opacity 0.3s ease;">
                            <div class="text-white text-center">
                                <i class="fas fa-network-wired" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold mb-3" style="color:#333333;">TJKT</h5>
                        <p class="text-muted mb-3">Teknik Jaringan Komputer dan Telekomunikasi</p>
                        <button type="button" class="btn btn-success btn-sm" onclick="openJurusanModal('tjkt')" style="border-radius: 25px; padding: 0.5rem 1.5rem;">
                            <i class="fas fa-arrow-right me-1"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 reveal">
                <div class="card border-0 shadow-lg h-100 zoom-img" style="border-radius: 16px; transition: transform 0.25s ease, box-shadow 0.25s ease; overflow: hidden;">
                    <div class="position-relative" style="height: 200px; overflow: hidden;">
                        @php
                            $toImg = \App\Helpers\ImageOptimizer::getOptimizedImageUrl('images/jurusan/to.jpeg', 400, 200, 75);
                        @endphp
                        <img src="{{ $toImg }}" alt="TO" class="img-fluid w-100 h-100" style="object-fit: cover;" loading="lazy">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(13, 202, 240, 0.8); opacity: 0; transition: opacity 0.3s ease;">
                            <div class="text-white text-center">
                                <i class="fas fa-cogs" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold mb-3" style="color:#333333;">TO</h5>
                        <p class="text-muted mb-3">Teknik Otomotif</p>
                        <button type="button" class="btn btn-info btn-sm" onclick="openJurusanModal('to')" style="border-radius: 25px; padding: 0.5rem 1.5rem;">
                            <i class="fas fa-arrow-right me-1"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 reveal">
                <div class="card border-0 shadow-lg h-100 zoom-img" style="border-radius: 16px; transition: transform 0.25s ease, box-shadow 0.25s ease; overflow: hidden;">
                    <div class="position-relative" style="height: 200px; overflow: hidden;">
                        @php
                            $tpflImg = \App\Helpers\ImageOptimizer::getOptimizedImageUrl('images/jurusan/tpfl.jpeg', 400, 200, 75);
                        @endphp
                        <img src="{{ $tpflImg }}" alt="TPFL" class="img-fluid w-100 h-100" style="object-fit: cover;" loading="lazy">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(255, 193, 7, 0.8); opacity: 0; transition: opacity 0.3s ease;">
                            <div class="text-white text-center">
                                <i class="fas fa-industry" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="fw-bold mb-3" style="color:#333333;">TPFL</h5>
                        <p class="text-muted mb-3">Teknik Pengelasan dan Fabrikasi Logam</p>
                        <button type="button" class="btn btn-warning btn-sm" onclick="openJurusanModal('tpfl')" style="border-radius: 25px; padding: 0.5rem 1.5rem;">
                            <i class="fas fa-arrow-right me-1"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 

<!-- Fasilitas Sekolah Section -->
<section class="py-4 section-slice">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold text-primary mb-2" style="font-size: 2rem;">
                    <i class="fas fa-building me-2"></i>
                    Fasilitas Sekolah
                </h2>
                <p class="text-muted small">Fasilitas lengkap untuk mendukung pembelajaran siswa</p>
            </div>
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 15px; background: white; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body p-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);">
                            <i class="fas fa-laptop-code" style="font-size: 1.2rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50; font-size: 1rem;">Lab Komputer Modern</h5>
                        <p class="card-text text-muted small" style="line-height: 1.4; font-size: 0.8rem;">Lab komputer nyaman untuk belajar coding dan desain.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 15px; background: white; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body p-4">
                        <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);">
                            <i class="fas fa-tools" style="font-size: 1.2rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50; font-size: 1rem;">Bengkel Praktik</h5>
                        <p class="card-text text-muted small" style="line-height: 1.4; font-size: 0.8rem;">Bengkel lengkap untuk praktik jurusan teknik.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 15px; background: white; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body p-4">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);">
                            <i class="fas fa-wifi" style="font-size: 1.2rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50; font-size: 1rem;">WiFi Gratis</h5>
                        <p class="card-text text-muted small" style="line-height: 1.4; font-size: 0.8rem;">WiFi gratis untuk kegiatan belajar.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 15px; background: white; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body p-4">
                        <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; box-shadow: 0 5px 15px rgba(13, 202, 240, 0.3);">
                            <i class="fas fa-book-open" style="font-size: 1.2rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50; font-size: 1rem;">Perpustakaan</h5>
                        <p class="card-text text-muted small" style="line-height: 1.4; font-size: 0.8rem;">Perpustakaan nyaman dengan koleksi buku yang memadai.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 15px; background: white; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body p-4">
                        <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);">
                            <i class="fas fa-shield-alt" style="font-size: 1.2rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50; font-size: 1rem;">Keamanan 24 Jam</h5>
                        <p class="card-text text-muted small" style="line-height: 1.4; font-size: 0.8rem;">Keamanan terjaga 24 jam.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 15px; background: white; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body p-4">
                        <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; box-shadow: 0 5px 15px rgba(13, 202, 240, 0.3);">
                            <i class="fas fa-trophy" style="font-size: 1.2rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50; font-size: 1rem;">Lapangan Olahraga</h5>
                        <p class="card-text text-muted small" style="line-height: 1.4; font-size: 0.8rem;">Lapangan untuk aktivitas olahraga dan ekskul.</p>
                    </div>
                </div>
                </h3>
            </div>
        </div>
    </div>
</section>


<!-- Kontak dan Peta Section -->
<section class="py-3 section-slice">
    <div class="container">
        <!-- Header -->
        <div class="row mb-3">
            <div class="col-12 text-center">
                <h3 class="text-primary mb-0" style="font-size: 2rem; font-weight: 600; text-decoration: underline;">Hubungi Kami</h3>
            </div>
        </div>
        
        <div class="row g-3">
            <!-- Denah Lokasi -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm" style="border-radius: 6px;">
                    <div class="card-header bg-primary text-white py-2" style="border-radius: 6px 6px 0 0;">
                        <h5 class="mb-0" style="font-size: 1rem;">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Denah Lokasi
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-2">
                            <a href="https://www.google.com/maps?q=SMKN+4+Kota+Bogor,+Bogor,+Jawa+Barat,+Indonesia" target="_blank" class="btn btn-light btn-sm mb-2" style="border-radius: 4px; font-size: 0.8rem;">
                                Lihat peta lebih besar
                            </a>
                        </div>
                        <div class="ratio ratio-16x9" style="height: 250px;">
                            <iframe 
                                src="https://www.google.com/maps?q=SMKN+4+Kota+Bogor,+Bogor,+Jawa+Barat,+Indonesia&hl=id&z=15&output=embed" 
                                style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Kontak -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm" style="border-radius: 6px;">
                    <div class="card-header bg-primary text-white py-2" style="border-radius: 6px 6px 0 0;">
                        <h5 class="mb-0" style="font-size: 1rem;">
                            <i class="fas fa-phone me-2"></i>
                            Kontak
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="contact-item mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope text-primary me-2" style="width: 16px; font-size: 0.9rem;"></i>
                                <div>
                                    <span class="fw-bold" style="font-size: 0.85rem;">Email</span><br>
                                    <span class="text-muted" style="font-size: 0.8rem;">info@smkn4bogor.sch.id</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-item mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-primary me-2" style="width: 16px; font-size: 0.9rem;"></i>
                                <div>
                                    <span class="fw-bold" style="font-size: 0.85rem;">Alamat</span><br>
                                    <span class="text-muted" style="font-size: 0.8rem;">Jl. Raya Tajur No. 33, Bogor, Jawa Barat</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-item mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone text-primary me-2" style="width: 16px; font-size: 0.9rem;"></i>
                                <div>
                                    <span class="fw-bold" style="font-size: 0.85rem;">Telepon</span><br>
                                    <span class="text-muted" style="font-size: 0.8rem;">(0251) 123456</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Modals for Galeri -->
@php
    $fotos = \App\Models\Foto::with('kategori')->where('status', 'Aktif')->latest()->get();
@endphp
@foreach($fotos as $foto)
<div class="modal fade" id="imageModal{{ $foto->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $foto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%); border-radius: 16px 16px 0 0;">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-image text-white"></i>
                    </div>
                    <div>
                        <h5 class="modal-title text-white mb-0" id="imageModalLabel{{ $foto->id }}">{{ $foto->judul }}</h5>
                        <small class="text-white-50">{{ $foto->kategori->nama ?? 'Tanpa Kategori' }}</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                @php
                    // Use optimized image for modal (max 800px width, quality 80)
                    $modalImageUrl = $foto->getOptimizedImageUrl(800, 0, 80);
                @endphp
                <img src="{{ $modalImageUrl }}" 
                     class="img-fluid rounded shadow-sm" 
                     alt="{{ $foto->judul }}"
                     loading="lazy"
                     style="max-height: 500px; object-fit: contain;">
                @if($foto->deskripsi)
                <div class="mt-3">
                    <p class="text-muted mb-0">{{ $foto->deskripsi }}</p>
                </div>
                @endif
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>{{ $foto->created_at->format('d F Y') }}
                        <i class="fas fa-clock ms-3 me-1"></i>{{ $foto->created_at->format('H:i') }}
                    </small>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <a href="{{ asset('storage/' . $foto->path) }}" download class="btn btn-success">
                    <i class="fas fa-download me-1"></i>Download
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Jurusan Detail Modal -->
<div class="modal fade" id="jurusanModal" tabindex="-1" aria-labelledby="jurusanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 720px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0" style="background: #0d6efd; border-radius: 12px 12px 0 0;">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                        <i id="jurusanIcon" class="text-primary" style="font-size: 1rem;"></i>
                    </div>
                    <div>
                        <h6 class="modal-title text-white mb-0" id="jurusanModalLabel" style="font-size: 1rem;">
                            <span id="jurusanTitle">Detail Jurusan</span>
                        </h6>
                        <small class="text-white-50" id="jurusanSubtitle" style="font-size: 0.8rem;">Informasi lengkap jurusan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <img id="jurusanImage" class="img-fluid rounded-3 shadow-sm" alt="Gambar Jurusan" style="max-height: 150px; object-fit: cover; width: 100%;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="border rounded-3 p-3" style="max-height: 50vh; overflow-y: auto;">
                        <div class="mb-3">
                                <h6 class="fw-bold text-primary mb-2">
                                <i class="fas fa-info-circle me-2"></i>Deskripsi
                            </h6>
                            <p id="jurusanDesc" class="text-muted mb-0"></p>
                        </div>
                        
                            <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card border-0 bg-light h-100">
                                        <div class="card-body p-4">
                                            <h6 class="fw-bold text-primary mb-3">
                                            <i class="fas fa-star me-2"></i>Kompetensi
                                        </h6>
                                            <ul id="jurusanKompetensi" class="list-unstyled mb-0"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 bg-light h-100">
                                        <div class="card-body p-4">
                                            <h6 class="fw-bold text-success mb-3">
                                            <i class="fas fa-briefcase me-2"></i>Prospek Kerja
                                        </h6>
                                            <ul id="jurusanProspek" class="list-unstyled mb-0"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="mt-4">
                            <div class="card border-0 bg-light">
                                    <div class="card-body p-4">
                                        <h6 class="fw-bold text-info mb-3">
                                        <i class="fas fa-tools me-2"></i>Fasilitas
                                    </h6>
                                        <ul id="jurusanFasilitas" class="list-unstyled mb-0"></ul>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-primary px-3 py-1" data-bs-dismiss="modal" style="border-radius: 16px; font-size: .9rem;">
                    <i class="fas fa-check me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Jurusan Modal Function
function openJurusanModal(slug) {
    console.log('openJurusanModal called with:', slug);
    
    const jurusanData = {
        'pplg': {
            'nama': 'PPLG',
            'nama_lengkap': 'Pengembangan Perangkat Lunak dan Gim',
            'foto': 'images/jurusan/pplg.jpeg',
            'icon': 'fas fa-laptop-code',
            'deskripsi': 'Jurusan PPLG mempersiapkan siswa untuk menjadi developer yang handal dalam pengembangan software, aplikasi web, dan game development.',
            'kompetensi': [
                'Pemrograman Dasar dan Lanjutan',
                'Pengembangan Aplikasi Web',
                'Pengembangan Aplikasi Mobile',
                'Game Development'
            ],
            'prospek_kerja': [
                'Software Developer',
                'Web Developer',
                'Mobile App Developer',
                'Game Developer'
            ],
            'fasilitas': [
                'Lab Komputer Modern',
                'Software Development Tools',
                'Game Development Studio'
            ]
        },
        'tjkt': {
            'nama': 'TJKT',
            'nama_lengkap': 'Teknik Jaringan Komputer dan Telekomunikasi',
            'foto': 'images/jurusan/tjkt.jpeg',
            'icon': 'fas fa-network-wired',
            'deskripsi': 'Jurusan TJKT mempersiapkan siswa untuk menjadi teknisi jaringan yang handal dalam instalasi, konfigurasi, dan maintenance jaringan komputer.',
            'kompetensi': [
                'Instalasi Jaringan Komputer',
                'Konfigurasi Router & Switch',
                'Keamanan Jaringan',
                'Troubleshooting Jaringan'
            ],
            'prospek_kerja': [
                'Network Administrator',
                'System Administrator',
                'IT Support',
                'Network Engineer'
            ],
            'fasilitas': [
                'Lab Jaringan Komputer',
                'Router & Switch Cisco',
                'Server Room'
            ]
        },
        'to': {
            'nama': 'TO',
            'nama_lengkap': 'Teknik Otomotif',
            'foto': 'images/jurusan/to.jpeg',
            'icon': 'fas fa-cogs',
            'deskripsi': 'Jurusan TO mempersiapkan siswa untuk menjadi teknisi otomotif yang handal dalam perbaikan, perawatan, dan diagnosis kendaraan.',
            'kompetensi': [
                'Perbaikan Mesin Kendaraan',
                'Sistem Kelistrikan Otomotif',
                'Sistem Transmisi',
                'Diagnosis Kendaraan'
            ],
            'prospek_kerja': [
                'Automotive Technician',
                'Service Advisor',
                'Parts Specialist',
                'Workshop Manager'
            ],
            'fasilitas': [
                'Bengkel Otomotif',
                'Mesin Kendaraan',
                'Alat Diagnostik'
            ]
        },
        'tpfl': {
            'nama': 'TPFL',
            'nama_lengkap': 'Teknik Pengelasan dan Fabrikasi Logam',
            'foto': 'images/jurusan/tpfl.jpeg',
            'icon': 'fas fa-industry',
            'deskripsi': 'Jurusan TPFL mempersiapkan siswa untuk menjadi teknisi pengelasan dan fabrikasi logam yang handal dalam konstruksi dan industri.',
            'kompetensi': [
                'Teknik Pengelasan SMAW',
                'Teknik Pengelasan GMAW',
                'Fabrikasi Logam',
                'Membaca Gambar Teknik'
            ],
            'prospek_kerja': [
                'Welder',
                'Fabricator',
                'Quality Inspector',
                'Production Supervisor'
            ],
            'fasilitas': [
                'Workshop Pengelasan',
                'Mesin Las Modern',
                'Alat Fabrikasi'
            ]
        }
    };

    const j = jurusanData[slug];
    if (!j) {
        alert('Data jurusan tidak ditemukan');
        return;
    }

    // Set modal title pieces (icon is already handled via class)
    document.getElementById('jurusanTitle').textContent = j.nama_lengkap || j.nama;
    document.getElementById('jurusanSubtitle').textContent = j.nama || 'Jurusan';
        document.getElementById('jurusanIcon').className = j.icon || 'fas fa-graduation-cap';
        document.getElementById('jurusanImage').src = `/${j.foto}`;
        document.getElementById('jurusanImage').alt = j.nama;
        document.getElementById('jurusanDesc').textContent = j.deskripsi || 'Deskripsi tidak tersedia.';
    
        const komp = document.getElementById('jurusanKompetensi');
        komp.innerHTML = '';
    (j.kompetensi || []).forEach(k => { 
        const li = document.createElement('li'); 
        li.className = 'mb-2';
        li.innerHTML = `<i class='fas fa-check-circle text-primary me-2'></i><span class="small">${k}</span>`; 
        komp.appendChild(li); 
    });
    
        const pros = document.getElementById('jurusanProspek');
        pros.innerHTML = '';
    (j.prospek_kerja || []).forEach(p => { 
        const li = document.createElement('li'); 
        li.className = 'mb-2';
        li.innerHTML = `<i class='fas fa-arrow-right text-success me-2'></i><span class="small">${p}</span>`; 
        pros.appendChild(li); 
    });
    
        const fas = document.getElementById('jurusanFasilitas');
        fas.innerHTML = '';
    (j.fasilitas || []).forEach(f => { 
        const li = document.createElement('li'); 
        li.className = 'mb-2';
        li.innerHTML = `<i class='fas fa-check text-info me-2'></i><span class="small">${f}</span>`; 
        fas.appendChild(li); 
    });
    
        (new bootstrap.Modal(document.getElementById('jurusanModal'))).show();
    }

    // Galeri Filter Function
    function initGaleriFilter() {
        const filterButtons = document.querySelectorAll('[data-filter]');
        const galeriItems = document.querySelectorAll('.galeri-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Filter items
                galeriItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-kategori') === filter) {
                        item.style.display = 'block';
                        item.style.animation = 'fadeIn 0.5s ease-in-out';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }

    // Hero slideshow functionality
    function initHeroSlideshow() {
        const images = document.querySelectorAll('.hero-bg-image');
        let currentIndex = 0;
        
        function showNextImage() {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].classList.add('active');
        }
        
        // Change image every 5 seconds
        setInterval(showNextImage, 5000);
    }

    // Smooth scrolling for navigation links
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize hero slideshow
        initHeroSlideshow();
        
        // Initialize galeri filter
        initGaleriFilter();
        
        // Handle navigation clicks
        const navLinks = document.querySelectorAll('a[href^="#"]');
        
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Handle URL hash on page load
        if (window.location.hash) {
            const targetElement = document.querySelector(window.location.hash);
            if (targetElement) {
                setTimeout(() => {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 500);
            }
        }
    });
</script>
<script>
    // Simple scroll reveal using IntersectionObserver
    (function() {
        const items = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window) || items.length === 0) {
            items.forEach(el => el.classList.add('show'));
            return;
        }
        const io = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        items.forEach(el => io.observe(el));
    })();
</script>
@endsection