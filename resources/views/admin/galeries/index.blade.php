@extends('layouts.admin')

@section('title', 'Galeri - Admin Panel')

@section('page-title', 'Galeri')

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; min-width: 45px;">
                    <i class="fas fa-images"></i>
                </div>
                <div>
                    <h1 class="h4 mb-1 fw-bold text-dark">
                        Galeri SMKN 4 BOGOR
                    </h1>
                    <p class="text-muted mb-0 small">Kelola koleksi foto sekolah</p>
                </div>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <form method="GET" action="{{ route('admin.fotos.index') }}" class="d-flex align-items-center gap-2">
                    <select name="kategori" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach(($kategoris ?? []) as $kategori)
                            <option value="{{ $kategori->id }}" {{ (isset($selectedKategori) && (string)$selectedKategori === (string)$kategori->id) ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('admin.fotos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Foto
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Content -->
<div class="gallery-container">
    @forelse($fotos as $foto)
    <div class="gallery-item">
        <div class="gallery-card">
            <div class="gallery-thumb-wrapper">
                <img src="{{ asset('storage/' . $foto->path) }}" alt="{{ $foto->judul }}" class="gallery-thumb">
            </div>
            <div class="gallery-card-body">
                <div class="gallery-title">{{ $foto->judul }}</div>
                <div class="gallery-category">
                    <i class="fas fa-tag"></i>
                    <span>{{ $foto->kategori ? $foto->kategori->nama : 'Belum ada kategori' }}</span>
                </div>
                    </div>
            <div class="gallery-actions">
                <button type="button" class="btn btn-info btn-sm" title="Lihat" onclick="viewPhoto({{ $foto->id }})">
                    <i class="fas fa-eye"></i>
                </button>
                <button type="button" class="btn btn-warning btn-sm" title="Edit" onclick="editPhoto({{ $foto->id }})">
                    <i class="fas fa-edit"></i>
                </button>
                <form action="{{ route('admin.fotos.destroy', $foto->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin hapus foto ini?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="gallery-empty">
        <div class="gallery-empty-icon">
            <i class="fas fa-images"></i>
        </div>
        <h3 class="gallery-empty-title">Belum ada foto</h3>
        <p class="gallery-empty-subtitle">Mulai dengan menambahkan foto pertama ke galeri</p>
        <a href="{{ route('admin.fotos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah Foto Pertama
        </a>
    </div>
    @endforelse
</div>

<!-- View Photo Modal -->
<div class="modal fade" id="viewPhotoModal" tabindex="-1" aria-labelledby="viewPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title" id="viewPhotoModalLabel">
                    <i class="fas fa-eye me-1"></i>
                    Detail Foto
                </h6>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="text-center mb-3">
                    <img id="viewPhotoImage" class="img-fluid rounded" style="max-height: 250px; object-fit: contain;">
                        </div>
                <div class="photo-details">
                    <h6 id="viewPhotoTitle" class="mb-2"></h6>
                    <div class="d-flex justify-content-center align-items-center gap-1 flex-wrap">
                        <span id="viewPhotoCategory" class="badge bg-primary small"></span>
                    </div>
                </div>
                    </div>
        </div>
    </div>
</div>

<!-- Edit Photo Modal -->
<div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title" id="editPhotoModalLabel">
                    <i class="fas fa-edit me-1"></i>
                    Edit Foto
                </h6>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPhotoForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_photo_id" name="photo_id">
                <div class="modal-body p-3">
                    <div class="mb-2">
                        <label for="edit_judul" class="form-label small">Judul Foto <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="edit_judul" name="judul" required>
                        </div>
                    <div class="mb-2">
                        <label for="edit_kategori_id" class="form-label small">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="edit_kategori_id" name="kategori_id" required>
                                @foreach($kategoris ?? [] as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="mb-2">
                        <label for="edit_foto" class="form-label small">Foto Baru (Opsional)</label>
                        <input type="file" class="form-control form-control-sm" id="edit_foto" name="foto" accept="image/*">
                        <small class="text-muted small">Biarkan kosong jika tidak ingin mengubah foto</small>
                    </div>
                    <div class="mb-2">
                        <div class="text-center">
                            <img id="edit_current_photo" class="img-fluid rounded" style="max-height: 120px; object-fit: contain;">
                    </div>
                </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="fas fa-save me-1"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* CSS Variables */
    :root {
        --primary-color: #667eea;
        --secondary-color: #f093fb;
        --success-color: #4facfe;
        --info-color: #43e97b;
        --warning-color: #fa709a;
        --glass-bg: rgba(255, 255, 255, 0.25);
        --glass-border: rgba(255, 255, 255, 0.18);
        --shadow-light: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        --shadow-medium: 0 15px 35px rgba(0, 0, 0, 0.1);
        --shadow-heavy: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Background */
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }


    /* Gallery Container */
    .gallery-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        width: 100%;
        max-width: 100%;
        padding: 0;
    }

    .gallery-item {
        width: 100%;
        max-width: 100%;
        min-width: 0;
    }

    /* Gallery Card */
    .gallery-card {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        box-shadow: var(--shadow-light);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        min-height: 280px;
        position: relative;
        width: 100%;
        max-width: 100%;
    }

    .gallery-card:hover {
        box-shadow: var(--shadow-heavy);
    }

    /* Gallery Thumbnail */
    .gallery-thumb-wrapper {
        position: relative;
        width: 100%;
        height: 150px;
        overflow: hidden;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .gallery-card:hover .gallery-thumb {
        transform: scale(1.05);
    }

    /* Gallery Card Body */
    .gallery-card-body {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1 1 auto;
    }

    .gallery-title {
        font-size: 1rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
        line-height: 1.2;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .gallery-category {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
    }

    .gallery-category i {
        font-size: 0.8rem;
        color: var(--primary-color);
    }

    .gallery-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        padding: 1rem;
        opacity: 1;
    }

    /* Gallery Actions */
    .gallery-actions .btn {
        padding: 0.5rem;
        font-size: 0.8rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
    }

    .gallery-actions .btn:hover {
        transform: scale(1.05);
        text-decoration: none;
    }

    /* Remove active states for view button */
    .gallery-actions .btn-info:active,
    .gallery-actions .btn-info:focus,
    .gallery-actions .btn-info:focus-visible {
        background-color: #0dcaf0 !important;
        border-color: #0dcaf0 !important;
        box-shadow: none !important;
        transform: none !important;
        outline: none !important;
    }

    /* Gallery Empty State */
    .gallery-empty {
        grid-column: 1 / -1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 2rem;
        text-align: center;
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--shadow-light);
    }

    .gallery-empty-icon {
        width: 80px;
        height: 80px;
        background: var(--primary-color);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }

    .gallery-empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .gallery-empty-subtitle {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .gallery-container {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
    }

    @media (max-width: 991px) {
        .gallery-card { 
            min-height: 260px; 
        }
        .gallery-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
    }

    @media (max-width: 767px) {
        
        .gallery-card { 
            min-height: 240px; 
        }
        
        .gallery-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
    }

    @media (max-width: 575px) {
        
        .gallery-card { 
            border-radius: 12px; 
            min-height: 220px;
        }
        
        .gallery-container {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .gallery-empty {
            padding: 2rem 1rem;
        }
        
        .gallery-empty-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }
    
    /* Modal Styles */
    .modal-dialog {
        margin: 1rem auto;
    }
    
    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    
    .modal-header {
        border-bottom: 1px solid #dee2e6;
        background: #f8f9fa;
    }
    
    .modal-footer {
        border-top: 1px solid #dee2e6;
        background: #f8f9fa;
    }
    
    .badge.small {
        font-size: 0.7rem;
        padding: 0.3rem 0.5rem;
    }
    
    .form-control-sm, .form-select-sm {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }
    
    .btn-sm {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }
    
    .modal-title {
        font-size: 1rem;
        font-weight: 600;
    }
    
    .photo-details p {
        font-size: 0.875rem;
    }
    
    /* Modal Z-Index Fixes - Remove backdrop overlay completely */
    .modal {
        z-index: 1055 !important;
        background: transparent !important;
        background-color: transparent !important;
    }
    
    .modal-backdrop,
    .modal-backdrop.show,
    .modal-backdrop.fade,
    div.modal-backdrop {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
        background: transparent !important;
        background-color: transparent !important;
    }
    
    .modal.show {
        background: transparent !important;
        background-color: transparent !important;
    }
    
    .modal.fade {
        background: transparent !important;
        background-color: transparent !important;
    }
    
    body.modal-open {
        overflow: auto !important;
        padding-right: 0 !important;
    }
    
    .modal-content {
        position: relative;
        z-index: 1056 !important;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4) !important;
    }
</style>
@endsection

@section('scripts')
<script>
// Global variables
let currentPhotoId = null;

// Function to view photo
async function viewPhoto(photoId) {
    currentPhotoId = photoId;
    
    // Clean up any stuck modals/backdrops first
    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
    
    // Close any open modals
    const openModals = document.querySelectorAll('.modal.show');
    openModals.forEach(modal => {
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) bsModal.hide();
    });
    
    try {
        // Use route helper to ensure correct URL
        const baseUrl = '{{ url("/") }}';
        const url = `${baseUrl}/admin/fotos/${photoId}`;
        
        const res = await fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            credentials: 'same-origin'
        });
        
        if (!res.ok) {
            const errorText = await res.text();
            throw new Error(`HTTP error! status: ${res.status}, message: ${errorText}`);
        }
        
        const data = await res.json();
        
        if (data?.success && data?.data) {
            const f = data.data;
            const imageSrc = f.full_path || (f.path ? `${window.location.origin}/storage/${f.path}` : '');
            
            const viewPhotoImage = document.getElementById('viewPhotoImage');
            const viewPhotoTitle = document.getElementById('viewPhotoTitle');
            const viewPhotoCategory = document.getElementById('viewPhotoCategory');
            
            if (viewPhotoImage && imageSrc) {
                viewPhotoImage.src = imageSrc;
            }
            if (viewPhotoTitle) {
                viewPhotoTitle.textContent = f.judul || '—';
            }
            if (viewPhotoCategory) {
                viewPhotoCategory.textContent = f.kategori?.nama || '—';
            }
            
            // Force cleanup before showing modal
            setTimeout(() => {
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('padding-right');
                
                setTimeout(() => {
                    const modalEl = document.getElementById('viewPhotoModal');
                    if (modalEl) {
                        const modal = new bootstrap.Modal(modalEl, {
                            backdrop: false,
                            keyboard: true,
                            focus: true
                        });
                        modal.show();
                    }
                }, 50);
            }, 50);
        } else {
            throw new Error(data?.message || 'Format response tidak valid');
        }
    } catch (error) {
        console.error('Error loading photo details:', error);
        alert('Gagal memuat detail foto: ' + (error.message || 'Terjadi kesalahan'));
        
        // Remove any backdrop that might be stuck
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }
}

// Function to edit photo
async function editPhoto(photoId) {
    currentPhotoId = photoId;
    
    // Clean up any stuck modals/backdrops first
    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
    
    // Close any open modals
    const openModals = document.querySelectorAll('.modal.show');
    openModals.forEach(modal => {
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) bsModal.hide();
    });
    
    try {
        // Use route helper to ensure correct URL
        const baseUrl = '{{ url("/") }}';
        const url = `${baseUrl}/admin/fotos/${photoId}`;
        
        const res = await fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            credentials: 'same-origin'
        });
        
        if (!res.ok) {
            const errorText = await res.text();
            throw new Error(`HTTP error! status: ${res.status}, message: ${errorText}`);
        }
        
        const data = await res.json();
        
        if (data?.success && data?.data) {
            const f = data.data;
            const editPhotoId = document.getElementById('edit_photo_id');
            const editJudul = document.getElementById('edit_judul');
            const editKategoriId = document.getElementById('edit_kategori_id');
            
            if (editPhotoId) editPhotoId.value = f.id || '';
            if (editJudul) editJudul.value = f.judul || '';
            if (editKategoriId) editKategoriId.value = f.kategori_id || '';
            
            // Update current photo preview if element exists
            const currentPhotoElement = document.getElementById('edit_current_photo');
            if (currentPhotoElement) {
                const imageSrc = f.full_path || (f.path ? `${window.location.origin}/storage/${f.path}` : '');
                if (imageSrc) {
                    currentPhotoElement.src = imageSrc;
                }
            }
            
            // Force cleanup before showing modal
            setTimeout(() => {
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('overflow');
                document.body.style.removeProperty('padding-right');
                
                setTimeout(() => {
                    const modalEl = document.getElementById('editPhotoModal');
                    if (modalEl) {
                        const modal = new bootstrap.Modal(modalEl, {
                            backdrop: false,
                            keyboard: true,
                            focus: true
                        });
                        modal.show();
                    }
                }, 50);
            }, 50);
        } else {
            throw new Error(data?.message || 'Format response tidak valid');
        }
    } catch (error) {
        console.error('Error loading photo details for edit:', error);
        alert('Gagal memuat detail foto: ' + (error.message || 'Terjadi kesalahan'));
        
        // Remove any backdrop that might be stuck
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }
}

// Edit form submission
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editPhotoForm');
    if (editForm) {
        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            // Debug: Log form data
            console.log('Form data:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            try {
                // Add _method for Laravel to recognize as PUT request
                formData.append('_method', 'PUT');
                
                const res = await fetch(`{{ url('admin/fotos') }}/${currentPhotoId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });
                
                console.log('Response status:', res.status);
                
                // Check if response is JSON
                const contentType = res.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await res.text();
                    console.error('Non-JSON response:', text);
                    alert('Server mengembalikan response yang tidak valid. Cek console untuk detail.');
                    return;
                }
                
                    const data = await res.json();
                console.log('Response data:', data);
                
                    if (data?.success) {
                    const editModal = bootstrap.Modal.getInstance(document.getElementById('editPhotoModal'));
                    if (editModal) editModal.hide();
                    alert('Foto berhasil diupdate!');
                    location.reload();
                    } else {
                    let errorMessage = 'Gagal mengupdate foto';
                    if (data?.message) {
                        errorMessage = data.message;
                    }
                    if (data?.errors) {
                        const errorList = Object.values(data.errors).flat().join('\n');
                        errorMessage = `Error validasi:\n${errorList}`;
                    }
                    alert(errorMessage);
                }
            } catch (error) {
                console.error('Error:', error);
                if (error.message.includes('Unexpected token')) {
                    alert('Server error: Response bukan JSON. Kemungkinan ada error di server.');
                    } else {
                    alert(`Error: ${error.message}`);
                }
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
});
</script>
@endsection