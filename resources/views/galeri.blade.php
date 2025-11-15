@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* Gaya Dasar */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f7fa;
    color: #3d4756;
}

/* Gallery Container */
.gallery-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 40px 20px 80px 20px;
    min-height: 100vh;
}

/* Page Header */
.page-header {
    text-align: center;
    margin-bottom: 40px;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 10px;
}

.page-subtitle {
    font-size: 1rem;
    color: #6b7280;
}

/* Filter Section */
.filter-section {
    margin-bottom: 40px;
}

.filter-dropdown {
    width: 100%;
    max-width: 300px;
    padding: 12px 16px;
    border: 1px solid #dde2e9;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 500;
    color: #3d4756;
    background: white;
    cursor: pointer;
    transition: all 0.3s;
    outline: none;
}

.filter-dropdown:hover {
    border-color: #93b5e1;
    box-shadow: 0 2px 8px rgba(100, 140, 200, 0.12);
}

.filter-dropdown:focus {
    border-color: #7ba3d6;
    box-shadow: 0 0 0 3px rgba(123, 163, 214, 0.08);
}

/* Gallery Grid - CSS Grid Biasa */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 30px;
    /* Performance optimizations */
    contain: layout style;
    will-change: transform;
}

/* Modern Card Styles */
.card-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent 50%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    padding: 1.5rem;
}

.card-image-container:hover .card-image-overlay {
    opacity: 1;
}

/* Gallery Card */
.gallery-card {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(100, 120, 150, 0.08);
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    flex-direction: column;
    border: 1px solid #eef1f5;
    contain: layout style;
}

.gallery-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(100, 130, 180, 0.12);
    border-color: #d9e2ec;
}

.gallery-card-image {
    width: 100%;
    height: 240px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    flex-shrink: 0;
    background-color: #f5f7fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
    /* Optimize rendering */
    will-change: transform;
    backface-visibility: hidden;
    /* Lazy loading */
    loading: lazy;
}

.gallery-card:hover .gallery-card-image img {
    transform: scale(1.08);
}

.gallery-card-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* Badge Styles */
.badge-category {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    background: #e3edf7;
    color: #5b7fa6;
    margin-bottom: 12px;
}

.gallery-card-title {
    font-size: 1.05rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 10px 0;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 3em;
}

.gallery-card-desc {
    font-size: 0.875rem;
    color: #6b7280;
    margin-bottom: 14px;
    line-height: 1.5;
    flex-grow: 1;
}

/* Action Buttons on Card */
.card-actions {
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding-top: 14px;
    margin-top: auto;
    border-top: 1px solid #eef1f5;
}

.card-action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 20px;
    border: none;
    background: transparent;
    color: #7d8a9c;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.875rem;
    position: relative;
    z-index: 10;
    border-radius: 6px;
}

.card-action-btn:hover {
    color: #5b7fa6;
    background: rgba(123, 163, 214, 0.08);
}

.card-action-btn.liked {
    color: #ef4444;
}

.card-action-btn.liked:hover {
    color: #dc2626;
    background: rgba(239, 68, 68, 0.08);
}

.card-action-btn i {
    font-size: 1.1rem;
}

.card-action-btn span {
    font-weight: 500;
    font-size: 0.85rem;
}

/* Styling for like count - make it more visible */
.card-action-btn .like-count {
    font-weight: 600;
    font-size: 0.875rem;
}

/* Notification Styles */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    opacity: 0;
    transform: translateX(400px);
    transition: all 0.3s ease;
}

.notification.show {
    opacity: 1;
    transform: translateX(0);
}

.notification-success {
    background: #c7e6d8;
    color: #2d6a4f;
    box-shadow: 0 10px 25px rgba(45, 106, 79, 0.15);
}

.notification-error {
    background: #f5d2d2;
    color: #b91c1c;
    box-shadow: 0 10px 25px rgba(185, 28, 28, 0.15);
}

.notification-info {
    background: #d1e3f7;
    color: #3d5a80;
    box-shadow: 0 10px 25px rgba(61, 90, 128, 0.15);
}

/* Line Clamp Utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Interactive Icons Below Card */
.gallery-interactive-icons {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 10px 0;
    border-top: 1px solid #eef1f5;
    background: #fafbfc;
    margin-top: 10px;
}

.icon-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
    color: #6b7280;
    font-size: 18px;
}

.icon-btn:hover {
    color: #5b7fa6;
    background: rgba(123, 163, 214, 0.08);
    transform: translateY(-2px);
}

.icon-btn.liked {
    color: #ef4444;
}

.icon-btn.liked:hover {
    color: #dc2626;
    background: rgba(239, 68, 68, 0.1);
}

.icon-text {
    font-size: 12px;
    font-weight: 500;
    color: #6b7280;
    text-align: center;
    line-height: 1.2;
}

.icon-btn:hover .icon-text {
    color: #5b7fa6;
}

.icon-btn.liked .icon-text {
    color: #ef4444;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.modal-overlay.active {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 1000px;
    max-height: 90vh;
    overflow: hidden;
    display: flex;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.modal-overlay.active .modal-content {
    transform: translateY(0);
}

.modal-image-container {
    flex: 2;
    background: #f5f7fa;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.modal-image {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
}

.modal-sidebar {
    flex: 1;
    padding: 1.5rem;
    overflow-y: auto;
    max-height: 80vh;
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 1.5rem;
    color: #495057;
    transition: all 0.2s ease;
}

.modal-close:hover {
    background: #f1f3f5;
}

/* Download Modal */
.download-modal {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    padding: 2rem;
    position: relative;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.download-modal h3 {
    margin-top: 0;
    color: #2c3e50;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #495057;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #dde2e9;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s ease;
}

.form-control:focus {
    border-color: #93b5e1;
    outline: none;
    box-shadow: 0 0 0 3px rgba(123, 163, 214, 0.12);
}

.btn {
    display: inline-block;
    font-weight: 500;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 8px;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-primary {
    background: #7ba3d6;
    color: white;
}

.btn-primary:hover {
    background: #6691c9;
}

.btn-block {
    display: block;
    width: 100%;
}

/* Comments Section */
.comments-section {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eef1f5;
}

.comments-list {
    max-height: 300px;
    overflow-y: auto;
    margin-bottom: 1.5rem;
}

.comment {
    display: flex;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eef1f5;
}

.comment:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.comment-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e3edf7;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
    color: #7d8a9c;
    font-weight: bold;
}

.comment-content {
    flex: 1;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.25rem;
}

.comment-author {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
}

.comment-date {
    font-size: 0.75rem;
    color: #adb5bd;
}

.comment-text {
    font-size: 0.9rem;
    color: #495057;
    line-height: 1.5;
}

.comment-form {
    display: flex;
    margin-top: 1rem;
}

.comment-input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 1px solid #dde2e9;
    border-radius: 8px 0 0 8px;
    font-size: 0.9rem;
    transition: border-color 0.2s ease;
}

.comment-input:focus {
    outline: none;
    border-color: #93b5e1;
}

.comment-submit {
    background: #7ba3d6;
    color: white;
    border: none;
    border-radius: 0 8px 8px 0;
    padding: 0 1.25rem;
    cursor: pointer;
    transition: background 0.2s ease;
}

.comment-submit:hover {
    background: #6691c9;
}

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
}

.empty-state-icon {
    color: #9ca3af;
    margin-bottom: 20px;
    font-size: 4rem;
}

.empty-state h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: 8px;
}

.empty-state p {
    color: #6b7280;
    font-size: 1rem;
}

/* Responsive Styles dengan Media Query */
/* Desktop - 3 kolom (default sudah di atas) */
@media (min-width: 1025px) {
    .gallery-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Tablet - 2 kolom */
@media (min-width: 641px) and (max-width: 1024px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .gallery-container {
        padding: 120px 16px 60px 16px;
    }
    
    .page-title {
        font-size: 1.75rem;
    }
    
    .gallery-card-image {
        height: 220px;
    }
}

/* Mobile - 1 kolom */
@media (max-width: 640px) {
    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .gallery-container {
        padding: 100px 16px 50px 16px;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .page-subtitle {
        font-size: 0.9rem;
    }
    
    .gallery-card-image {
        height: 200px;
    }
    
    .filter-dropdown {
        max-width: 100%;
        font-size: 0.85rem;
    }
    
    .card-action-btn {
        padding: 8px 16px;
        font-size: 0.8rem;
    }
    
    .card-action-btn i {
        font-size: 1rem;
    }
}

@media (max-width: 768px) {
    .modal-content {
        flex-direction: column;
        max-height: 90vh;
    }
    
    .modal-image-container {
        padding: 1rem;
        max-height: 50vh;
    }
    
    .modal-sidebar {
        max-height: 40vh;
    }
    
    .notification {
        top: 10px;
        right: 10px;
        left: 10px;
        max-width: calc(100% - 20px);
    }
}

/* ============================================
   SIMPLE IMAGE PREVIEW MODAL
   ============================================ */
.image-preview-modal {
    display: none;
    position: fixed;
    z-index: 10000;
    padding-top: 50px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.image-preview-content {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 80vh;
    object-fit: contain;
    animation: zoomIn 0.3s ease;
    cursor: default;
}

@keyframes zoomIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.image-preview-close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
    cursor: pointer;
    z-index: 10001;
}

.image-preview-close:hover,
.image-preview-close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

.image-preview-caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 40px;
    font-size: 1rem;
    font-weight: 500;
}

/* Responsive untuk mobile */
@media (max-width: 768px) {
    .image-preview-modal {
        padding-top: 80px;
    }
    
    .image-preview-content {
        max-width: 95%;
        max-height: 70vh;
    }
    
    .image-preview-close {
        top: 10px;
        right: 20px;
        font-size: 35px;
    }
    
    .image-preview-caption {
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .image-preview-modal {
        padding-top: 60px;
    }
    
    .image-preview-content {
        max-width: 98%;
        max-height: 65vh;
    }
    
    .image-preview-close {
        top: 5px;
        right: 15px;
        font-size: 30px;
    }
}

</style>
@endsection

@section('content')
<div class="gallery-container">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Galeri Foto Kegiatan</h1>
        <p class="page-subtitle">Lihat dokumentasi kegiatan, kegiatan dan produk sekolah SMKN 4 BOGOR</p>
    </div>

    <!-- Kategori Filter -->
    <div class="filter-section">
        <select id="kategoriFilter" class="filter-dropdown" onchange="window.location.href=this.value">
            <option value="{{ route('galeri') }}" {{ !request('kategori') ? 'selected' : '' }}>
                Semua Kategori
            </option>
            @foreach($kategoris as $kategori)
                @php
                    $kategoriSlug = strtolower(str_replace([' ', '&'], ['', ''], $kategori->nama));
                @endphp
                <option value="{{ route('galeri', ['kategori' => $kategoriSlug]) }}" {{ request('kategori') === $kategoriSlug ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Gallery Grid - CSS Grid Biasa -->
    <div class="gallery-grid">
        @forelse($fotos as $foto)
            @php
                // Use optimized image URL for thumbnail (300x300, quality 70 for smaller file size)
                $thumbnailUrl = $foto->getOptimizedImageUrl(300, 300, 70);
                // Full size for modal preview (max 1200px width, quality 80)
                $fullImageUrl = $foto->getOptimizedImageUrl(1200, 0, 80);
            @endphp
            <div class="gallery-card">
                <!-- Image Container -->
                <div class="gallery-card-image" onclick="openImagePreview('{{ $fullImageUrl }}', '{{ $foto->judul }}')">
                    <img src="{{ $thumbnailUrl }}" 
                         alt="{{ $foto->judul }}" 
                         loading="lazy"
                         width="300" 
                         height="300"
                         decoding="async"
                         fetchpriority="{{ $loop->first ? 'high' : 'low' }}">
                    <div class="card-image-overlay">
                        <div style="color: white;">
                            <h3 style="font-weight: 700; font-size: 1.125rem; margin-bottom: 4px;">{{ $foto->judul }}</h3>
                            <p style="font-size: 0.875rem; opacity: 0.9;">{{ \Carbon\Carbon::parse($foto->created_at)->translatedFormat('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="gallery-card-content">
                    <span class="badge-category">{{ $foto->kategori->nama ?? 'P5' }}</span>
                    <h3 class="gallery-card-title">{{ $foto->judul }}</h3>
                    <p class="gallery-card-desc">{{ $foto->keterangan ?? 'Dokumentasi kegiatan sekolah' }}</p>
                    
                    <!-- Action Buttons -->
                    <div class="card-actions">
                        <!-- Like Button - Displays REAL likes count from database for ALL users (authenticated & guest) -->
                        <button type="button" 
                                onclick="event.stopPropagation(); handleLike({{ $foto->id }}, this)" 
                                class="card-action-btn {{ $foto->is_liked ? 'liked' : '' }}" 
                                data-foto-id="{{ $foto->id }}"
                                title="Total {{ $foto->likes_count ?? 0 }} suka">
                            <i class="{{ $foto->is_liked ? 'fas' : 'far' }} fa-heart"></i>
                            <span class="like-count">{{ $foto->likes_count ?? 0 }}</span>
                        </button>
                        <!-- Download Button - Requires login -->
                        <button type="button" onclick="event.stopPropagation(); handleDownload({{ $foto->id }})" class="card-action-btn">
                            <i class="fas fa-download"></i>
                            <span>Download</span>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-images"></i>
                </div>
                <h2>Tidak ada foto tersedia</h2>
                <p>Belum ada foto yang diunggah untuk kategori ini.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Simple Image Preview Modal -->
<div id="imagePreviewModal" class="image-preview-modal" onclick="closeImagePreview()">
    <span class="image-preview-close" onclick="closeImagePreview()">&times;</span>
    <img class="image-preview-content" id="previewImage" onclick="event.stopPropagation()">
    <div class="image-preview-caption" id="previewCaption"></div>
</div>

    <!-- Modal for Image View -->
    <div id="imageModal" class="modal-overlay">
        <button class="modal-close" onclick="closeModal()">&times;</button>
    <div class="modal-content">
            <div class="modal-image-container">
                <img id="modalImage" src="" alt="" class="modal-image">
            </div>
            <div class="modal-details">
                <h2 id="modalTitle"></h2>
                <p id="modalDate" class="text-muted"></p>
                
                <!-- Like and Comment Buttons -->
                <div class="d-flex gap-3 mb-3">
                    <button class="btn btn-outline-primary like-btn" onclick="toggleLike(currentFotoId, this)">
                        <i class="far fa-heart"></i> <span class="like-count">0</span>
                    </button>
                    <button class="btn btn-outline-primary comment-btn" data-foto-id="currentFotoId">
                        <i class="far fa-comment"></i> <span class="comment-count">0</span>
                    </button>
                    <button class="btn btn-outline-success download-btn" onclick="openDownloadModal(currentFotoId)">
                        <i class="fas fa-download"></i> Unduh
                    </button>
                </div>
                
                <!-- Comments Section -->
                <div class="comments-section">
                    <h5>Komentar</h5>
                    <div class="comments-list">
                        <div id="approvedComments">
                            <p class="text-muted">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                    </div>
                    <form id="commentForm" class="mt-3">
                        <div class="mb-3">
                            <input type="text" id="comment-nama" class="form-control" placeholder="Nama Anda..." required>
                        </div>
                        <div class="mb-3">
                            <textarea id="comment-komentar" class="form-control" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Kirim Komentar</button>
                    </form>
                </div>
            </div>
        </div>
            </div>
            
    <!-- Download Modal -->
    <div id="downloadModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Unduh Foto</h3>
            <p>Silakan isi data diri Anda untuk mengunduh foto.</p>
            <form id="downloadForm">
                <div class="form-group">
                    <label for="download-nama">Nama Lengkap</label>
                    <input type="text" id="download-nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="download-email">Email Aktif</label>
                    <input type="email" id="download-email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="download-password">Password Email Kamu</label>
                    <input type="password" id="download-password" name="password" class="form-control" required minlength="6">
                    <small class="form-text text-muted">Minimal 6 karakter</small>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block mt-4">
                    <i class="fas fa-download me-2"></i> Unduh Foto
                </button>
                
                <div class="text-center mt-3">
                    <p class="small text-muted">Dengan mendaftar, Anda menyetujui ketentuan layanan kami.</p>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>
<script>
let currentFotoId = null;

// Open modal with image
function openModal(fotoId) {
    currentFotoId = fotoId;
    const foto = document.querySelector(`[data-foto-id="${fotoId}"]`).closest('.gallery-card');
    const imgSrc = foto.querySelector('img').src;
    const title = foto.querySelector('.gallery-title').textContent;
    const date = foto.querySelector('.gallery-date').textContent;
    
    // Get like and comment counts from the card
    const likeCount = foto.querySelector('.like-count') ? foto.querySelector('.like-count').textContent : '0';
    const commentCount = foto.querySelector('.comment-count') ? foto.querySelector('.comment-count').textContent : '0';
    
    document.getElementById('modalImage').src = imgSrc;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDate').textContent = date;
    document.getElementById('imageModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    // Update like and comment counts in modal
    const modalLikeCount = document.querySelector('.modal .like-count');
    const modalCommentCount = document.querySelector('.modal .comment-count');
    if (modalLikeCount) modalLikeCount.textContent = likeCount;
    if (modalCommentCount) modalCommentCount.textContent = commentCount;
    
    // Load approved comments
    loadApprovedComments(fotoId);
}

// Close modal
function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Open comment modal (comment section is in image modal)
function openCommentModal(fotoId) {
    currentFotoId = fotoId;
    // Open the main image modal which contains comment section
    openModal(fotoId);
}

// Open download modal
function openDownloadModal(fotoId) {
    currentFotoId = fotoId;
    document.getElementById('downloadModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Close modal when clicking outside the image
window.onclick = function(event) {
    const modal = document.getElementById('imageModal');
    if (event.target === modal) {
        closeModal();
    }
}

// Handle like button click with AJAX
function toggleLike(fotoId, button) {
    fetch(`/api/foto/${fotoId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            foto_id: fotoId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update like count in modal
            const likeCount = button.querySelector('.like-count');
            if (likeCount) {
                likeCount.textContent = data.total_likes;
            }
            
            // Update like count in gallery card
            const cardLikeCount = document.querySelector(`[data-foto-id="${fotoId}"] .like-count`);
            if (cardLikeCount) {
                cardLikeCount.textContent = data.total_likes;
            }
            
            // Update like button visual state
            if (data.action === 'liked') {
                button.classList.add('liked');
                const icon = button.querySelector('i');
                if (icon) {
                    icon.className = 'fa-solid fa-heart';
                }
                
                // Update card like button state
                const cardLikeBtn = document.querySelector(`[data-foto-id="${fotoId}"] .icon-btn.like-btn`);
                if (cardLikeBtn) {
                    cardLikeBtn.classList.add('liked');
                    const cardIcon = cardLikeBtn.querySelector('i');
                    if (cardIcon) {
                        cardIcon.className = 'fa-solid fa-heart';
                    }
                }
            } else {
                button.classList.remove('liked');
                const icon = button.querySelector('i');
                if (icon) {
                    icon.className = 'fa-regular fa-heart';
                }
                
                // Update card like button state
                const cardLikeBtn = document.querySelector(`[data-foto-id="${fotoId}"] .icon-btn.like-btn`);
                if (cardLikeBtn) {
                    cardLikeBtn.classList.remove('liked');
                    const cardIcon = cardLikeBtn.querySelector('i');
                    if (cardIcon) {
                        cardIcon.className = 'fa-regular fa-heart';
                    }
                }
            }
            
            // Show notification
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat memproses like', 'error');
    });
}

// Handle comment form submission with AJAX
document.getElementById('commentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const nama = document.getElementById('comment-nama').value;
    const komentar = document.getElementById('comment-komentar').value;
    
    if (!nama.trim() || !komentar.trim()) {
        showNotification('Harap isi nama dan komentar', 'error');
        return;
    }
    
    handleComment(currentFotoId, nama, komentar);
});

// Handle download button click with AJAX
document.getElementById('downloadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const nama = document.getElementById('download-nama').value;
    const email = document.getElementById('download-email').value;
    const password = document.getElementById('download-password').value;
    
    if (!nama.trim() || !email.trim() || !password.trim()) {
        showNotification('Harap isi semua data dengan benar sebelum mengunduh foto', 'error');
        return;
    }
    
    handleDownload(currentFotoId, nama, email, password);
});

// Close modals when clicking the X button
document.querySelectorAll('.close').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.modal').style.display = 'none';
        document.body.style.overflow = 'auto';
    });
});

// Close modals when pressing Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay, .download-modal').forEach(modal => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }
});

// AJAX Helper Functions
function handleComment(fotoId, nama, komentar) {
    fetch(`/api/foto/${fotoId}/comment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            foto_id: fotoId,
            nama: nama,
            komentar: komentar
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear the form
            document.getElementById('commentForm').reset();
            
            // Show notification
            showNotification(data.message, 'success');
            
            // Reload approved comments
            loadApprovedComments(fotoId);
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat mengirim komentar', 'error');
    });
}

function handleDownload(fotoId, nama, email, password) {
    fetch(`/api/foto/${fotoId}/download`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            foto_id: fotoId,
            nama: nama,
            email: email,
            password: password
        })
    })
    .then(response => {
        if (response.ok) {
            // Close the modal
            document.getElementById('downloadModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            
            // Show success notification
            showNotification('Foto berhasil diunduh! Terima kasih telah menggunakan galeri kami', 'success');
            
            // Trigger download
            return response.blob();
        } else {
            return response.json().then(data => {
                throw new Error(data.message || 'Download gagal');
            });
        }
    })
    .then(blob => {
        // Create download link
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `foto-${fotoId}.jpg`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification(error.message || 'Terjadi kesalahan saat mengunduh foto', 'error');
    });
}

function loadApprovedComments(fotoId) {
    fetch(`/api/foto/${fotoId}/comments/approved`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const commentsContainer = document.getElementById('approvedComments');
            if (commentsContainer) {
                if (data.comments.length > 0) {
                    commentsContainer.innerHTML = data.comments.map(comment => 
                        `<div class="comment-item">
                            <strong>${comment.nama}:</strong> ${comment.komentar}
                            <small class="text-muted d-block">${comment.created_at}</small>
                        </div>`
                    ).join('');
                } else {
                    commentsContainer.innerHTML = '<p class="text-muted">Belum ada komentar yang disetujui.</p>';
                }
            }
        }
    })
    .catch(error => {
        console.error('Error loading comments:', error);
    });
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Hide notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// ============================================
// LIKE & DOWNLOAD SYSTEM WITH DATABASE
// ============================================
// Like counts are stored in database with user_id and foto_id
// Each user can only like once per photo (unique constraint)
// Like count shows total from ALL users who liked the photo

// Check if user is authenticated
const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

/**
 * Handle Like button click
 * - Checks authentication (redirect to register if not logged in)
 * - Sends AJAX request to store/remove like in database
 * - Updates like count in real-time without page reload
 * - Updates button state (red heart if liked, outline if not)
 */
function handleLike(fotoId, button) {
    
    // Check authentication
    if (!isAuthenticated) {
        // Show notification and redirect to register
        showNotification('Silakan login atau daftar terlebih dahulu untuk like foto', 'error');
        setTimeout(() => {
            window.location.href = '{{ route("register") }}';
        }, 1500);
        return;
    }

    // Disable button to prevent double clicks
    button.disabled = true;

    // User is authenticated, proceed with like
    fetch(`/galeri/like/${fotoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Like data received:', data);
        
        if (data.success) {
            // Update like count from database (real-time update)
            const likeCount = button.querySelector('.like-count');
            if (likeCount) {
                likeCount.textContent = data.likes_count; // Total likes from ALL users
            }
            
            // Update icon visual state
            const icon = button.querySelector('i');
            if (data.is_liked) {
                button.classList.add('liked');
                if (icon) {
                    icon.className = 'fas fa-heart';
                }
            } else {
                button.classList.remove('liked');
                if (icon) {
                    icon.className = 'far fa-heart';
                }
            }
            
            showNotification(data.message, 'success');
        } else {
            // Handle redirect if needed
            if (data.redirect) {
                showNotification(data.message, 'error');
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            } else {
                showNotification(data.message, 'error');
            }
        }
    })
    .catch(error => {
        console.error('Like error details:', error);
        showNotification('Terjadi kesalahan saat memproses like: ' + error.message, 'error');
    })
    .finally(() => {
        // Re-enable button
        button.disabled = false;
    });
}

/**
 * Handle Download button click
 * - Checks authentication (redirect to register if not logged in)
 * - Triggers file download from server
 * - Logs download activity to database
 */
function handleDownload(fotoId) {
    
    // Check authentication
    if (!isAuthenticated) {
        // Show notification and redirect to register
        showNotification('Silakan login atau daftar terlebih dahulu untuk download foto', 'error');
        setTimeout(() => {
            window.location.href = '{{ route("register") }}';
        }, 1500);
        return;
    }

    // User is authenticated, start download
    showNotification('Mengunduh foto...', 'info');
    
    // Create a temporary link and trigger download
    window.location.href = `/galeri/download/${fotoId}`;
}

// Open modal for image viewing
function openModal(fotoId, imageSrc, title, category, date, likesCount, downloadsCount) {
    currentFotoId = fotoId;
    
    // Set modal content
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDate').textContent = date;
    
    // Update counts if elements exist
    const modalLikeCount = document.querySelector('#imageModal .like-count');
    if (modalLikeCount) modalLikeCount.textContent = likesCount;
    
    const modalCommentCount = document.querySelector('#imageModal .comment-count');
    if (modalCommentCount) modalCommentCount.textContent = 0;
    
    // Show modal
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Load approved comments
    loadApprovedComments(fotoId);
}

// ============================================
// SIMPLE IMAGE PREVIEW FUNCTIONS
// ============================================

/**
 * Open image preview modal
 * @param {string} imageSrc - Image source URL
 * @param {string} caption - Image caption/title
 */
function openImagePreview(imageSrc, caption) {
    const modal = document.getElementById('imagePreviewModal');
    const modalImg = document.getElementById('previewImage');
    const captionText = document.getElementById('previewCaption');
    
    modal.style.display = 'block';
    modalImg.src = imageSrc;
    captionText.innerHTML = caption;
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

/**
 * Close image preview modal
 */
function closeImagePreview() {
    const modal = document.getElementById('imagePreviewModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
}

// Close modal when pressing Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' || event.key === 'Esc') {
        const modal = document.getElementById('imagePreviewModal');
        if (modal && modal.style.display === 'block') {
            closeImagePreview();
        }
    }
});
</script>
@endpush