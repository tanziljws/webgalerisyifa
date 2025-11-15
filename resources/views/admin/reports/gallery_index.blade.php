@extends('layouts.admin')

@section('title','Laporan Galeri - Admin Panel')
@section('page-title','Laporan Galeri')

@section('content')
<div class="mb-4">
    <!-- Filter dan Generate PDF -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Filter & Generate Laporan</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Filter Periode</label>
                    <select name="period" class="form-select" onchange="this.form.submit()">
                        <option value="all" {{ $period === 'all' ? 'selected' : '' }}>Semua Waktu</option>
                        <option value="weekly" {{ $period === 'weekly' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                        <option value="monthly" {{ $period === 'monthly' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-primary" href="{{ route('admin.gallery.report', request()->only('period')) }}" target="_blank">
                        <i class="fas fa-file-pdf me-1"></i>Generate PDF
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Summary Cards - Simple -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 text-center bg-primary text-white">
                <div class="fs-4 fw-bold">{{ $summary['total_users'] }}</div>
                <div class="small">User Aktif Terdaftar</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center bg-info text-white">
                <div class="fs-4 fw-bold">{{ $summary['total_photos'] }}</div>
                <div class="small">Total Foto</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center bg-success text-white">
                <div class="fs-4 fw-bold">{{ $summary['total_likes'] }}</div>
                <div class="small">Total Like</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center bg-warning text-white">
                <div class="fs-4 fw-bold">{{ $summary['total_downloads'] }}</div>
                <div class="small">Total Download</div>
            </div>
        </div>
    </div>
</div>

<!-- Daftar User Terdaftar yang Aktif -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Daftar User yang Sudah Register/Login (Aktif)</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-info mb-3">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Informasi:</strong> Daftar ini menampilkan user yang sudah melakukan registrasi dan login dengan status akun <strong>aktif</strong>. User yang tidak aktif tidak ditampilkan dalam daftar ini.
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="35%">Nama Lengkap</th>
                        <th width="40%">Email</th>
                        <th width="20%" class="text-center">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">{{ $user->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Tidak ada user aktif terdaftar pada periode ini</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3" class="text-end">TOTAL USER AKTIF:</th>
                        <th class="text-center">{{ $summary['total_users'] }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Laporan Like & Download per Kategori -->
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0">Laporan Like & Download Berdasarkan Kategori</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-info mb-3">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Informasi:</strong> Laporan ini menampilkan total jumlah like dan download yang dikelompokkan berdasarkan kategori galeri.
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th width="35%">Kategori</th>
                        <th width="20%" class="text-center">Total Foto</th>
                        <th width="20%" class="text-center">Total Like</th>
                        <th width="20%" class="text-center">Total Download</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoriStats as $index => $stat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $stat['nama'] }}</strong></td>
                        <td class="text-center">{{ $stat['total_fotos'] }} foto</td>
                        <td class="text-center">{{ $stat['total_likes'] }}</td>
                        <td class="text-center">{{ $stat['total_downloads'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data kategori pada periode ini</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="2" class="text-end">TOTAL KESELURUHAN:</th>
                        <th class="text-center">{{ $summary['total_photos'] }} foto</th>
                        <th class="text-center">{{ $summary['total_likes'] }}</th>
                        <th class="text-center">{{ $summary['total_downloads'] }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* ========================================
       PROFESSIONAL REPORT STYLING - BLUE THEME
       ======================================== */
    
    /* Modern Card Styling */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(26, 43, 107, 0.08);
        overflow: hidden;
    }
    
    /* Enhanced Card Headers */
    .card-header {
        background: #3b82f6;
        border: none;
        padding: 0.85rem 1rem;
        border-bottom: none;
    }
    
    .card-header h5 {
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.1px;
        color: #ffffff;
        margin: 0;
    }
    
    .card-body {
        padding: 1.25rem;
        background: #ffffff;
    }
    
    /* Summary Cards with Blue Theme */
    .col-md-3 .card {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: none;
    }
    
    .col-md-3 .card.bg-primary {
        background: #3b82f6 !important;
    }
    
    .col-md-3 .card.bg-info {
        background: #3b82f6 !important;
    }
    
    .col-md-3 .card.bg-success {
        background: #10b981 !important;
    }
    
    .col-md-3 .card.bg-warning {
        background: #f59e0b !important;
    }
    
    .col-md-3 .card .fs-4 {
        font-size: 1.5rem !important;
        font-weight: 700;
        text-shadow: none;
        margin-bottom: 0.25rem;
    }
    
    .col-md-3 .card .small {
        font-size: 0.75rem;
        font-weight: 500;
        opacity: 0.95;
        letter-spacing: 0.2px;
        text-transform: uppercase;
    }
    
    /* Professional Table Styling - Blue Theme */
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    }
    
    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table thead {
        background: #3b82f6 !important;
        display: table-header-group !important; /* pastikan header kolom selalu tampil */
    }
    
    .table thead th {
        background-color: #3b82f6 !important;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.2px;
        padding: 0.65rem 0.5rem;
        border-bottom: 1px solid #d1d5db !important;
        border-top: none !important;
        vertical-align: middle;
        white-space: nowrap;
    }
    
    .table tbody tr {
        border-bottom: 1px solid #e5e7eb;
    }
    
    .table tbody tr:hover {
        background: #f9fafb;
    }
    
    .table tbody td {
        padding: 0.6rem 0.5rem;
        vertical-align: middle;
        color: #333333;
        font-size: 0.8rem;
        border: none;
    }
    
    .table tbody td:first-child {
        font-weight: 600;
        color: #1a2b6b;
    }
    
    .table tfoot {
        background: #f3f4f6;
        border-top: 2px solid #d1d5db;
    }
    
    .table tfoot th {
        padding: 0.7rem 0.5rem;
        font-weight: 700;
        color: #1a2b6b;
        font-size: 0.8rem;
        border: none;
    }
    
    /* Modern Alert Box - Blue Theme */
    .alert-info {
        background: #dbeafe;
        border: 1px solid #93c5fd;
        border-radius: 6px;
        padding: 0.75rem 0.85rem;
        color: #1e40af;
        font-size: 0.8rem;
        box-shadow: none;
    }
    
    .alert-info i {
        color: #3b82f6;
        font-size: 0.85rem;
    }
    
    .alert-info strong {
        color: #1e40af;
    }
    
    /* Enhanced Badges - Blue Theme */
    .badge {
        padding: 0.3rem 0.5rem;
        border-radius: 4px;
        font-weight: 600;
        font-size: 0.7rem;
        letter-spacing: 0.05px;
        box-shadow: none;
        transition: all 0.2s ease;
    }
    
    .badge:hover {
        opacity: 0.9;
    }
    
    .badge.bg-info {
        background: #3b82f6 !important;
    }
    
    .badge.bg-success {
        background: #10b981 !important;
    }
    
    .badge.bg-warning {
        background: #f59e0b !important;
        color: #ffffff !important;
    }
    
    .badge.bg-secondary {
        background: #6b7280 !important;
    }
    
    .badge i {
        margin-right: 0.2rem;
        font-size: 0.65rem;
    }
    
    /* Filter Section Styling - Blue Theme */
    .form-select {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
        transition: all 0.2s ease;
        background-color: #ffffff;
    }
    
    .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.75rem;
        margin-bottom: 0.4rem;
        letter-spacing: 0.1px;
    }
    
    .btn-primary {
        background: #3b82f6;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.1px;
        box-shadow: none;
        transition: all 0.2s ease;
    }
    
    .btn-primary:hover {
        background: #2563eb;
        transform: none;
    }
    
    /* Typography Enhancements */
    strong {
        font-weight: 600;
        color: #1a2b6b;
    }
    
    .text-muted {
        color: #666666 !important;
    }
    
    /* Spacing Improvements */
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    
    /* Icon Consistency */
    i.fas, i.fa {
        vertical-align: middle;
    }

    /* ========================================
       RESPONSIVE STYLING
       ======================================== */
    
    @media (max-width: 768px) {
        .row.g-3 {
            gap: 0.75rem;
        }

        .col-md-3 {
            margin-bottom: 0.75rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .col-md-3 .card .fs-4 {
            font-size: 1.5rem !important;
        }
        
        .table thead th,
        .table tbody td,
        .table tfoot th {
            padding: 0.8rem 0.7rem;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .row.g-3 {
            gap: 0.5rem;
        }

        .col-md-4 {
            margin-bottom: 0.75rem;
        }

        .col-md-3 .card {
            padding: 0.75rem !important;
        }

        .col-md-3 .card .fs-4 {
            font-size: 1.5rem !important;
        }

        .small {
            font-size: 0.75rem;
        }

        .card-body {
            padding: 0.75rem !important;
        }

        /* Form responsiveness */
        .row.align-items-end {
            flex-direction: column;
            align-items: stretch !important;
        }

        .col-md-4 {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .btn {
            width: 100%;
            margin-top: 0.5rem;
        }

        /* Table responsiveness */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: -0.75rem;
            padding: 0.75rem;
        }

        .table {
            font-size: 0.7rem !important;
            min-width: 100%;
        }

        .table th,
        .table td {
            padding: 0.5rem 0.35rem !important;
            white-space: nowrap;
            font-size: 0.7rem !important;
        }
        
        .table th {
            font-weight: 600 !important;
        }

        .badge {
            font-size: 0.65rem !important;
            padding: 0.25rem 0.45rem !important;
        }
        
        .badge.fs-6 {
            font-size: 0.65rem !important;
        }

        /* Card adjustments */
        .card-header h5 {
            font-size: 0.85rem !important;
        }
        
        .card-header {
            padding: 0.75rem !important;
        }
        
        /* Alert responsiveness */
        .alert {
            padding: 0.6rem !important;
            font-size: 0.75rem !important;
        }
        
        .alert i {
            font-size: 0.85rem !important;
        }
        
        /* Tfoot responsiveness */
        .table tfoot th {
            font-size: 0.7rem !important;
        }
        
        /* Icon sizing in badges */
        .badge i.fas,
        .badge i.fa {
            font-size: 0.65rem !important;
        }
        
        /* Table header specific */
        .table thead {
            font-size: 0.7rem !important;
        }
        
        /* Make table header sticky for better mobile scrolling */
        .table-responsive {
            position: relative;
        }
        
        .table thead th {
            position: sticky;
            top: 0;
            background-color: #212529 !important;
            z-index: 10;
        }
        
        /* Better text wrapping for long content */
        .table td strong {
            display: block;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* Minimum column widths for better readability */
        .table th:first-child,
        .table td:first-child {
            min-width: 35px;
        }
        
        /* Ensure tables have proper min-width for horizontal scroll */
        .table {
            min-width: 600px;
        }
        
        /* Visual indicator for scrollable content */
        .table-responsive::after {
            content: '← Geser untuk melihat lebih banyak →';
            display: block;
            text-align: center;
            font-size: 0.65rem;
            color: #6c757d;
            padding: 0.4rem;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            margin-top: -0.75rem;
            font-style: italic;
        }
    }

    @media (max-width: 400px) {
        .col-md-3 .card {
            padding: 0.65rem !important;
        }

        .col-md-3 .card .fs-4 {
            font-size: 1.3rem !important;
        }

        .table {
            font-size: 0.65rem !important;
        }

        .table th,
        .table td {
            padding: 0.45rem 0.3rem !important;
            font-size: 0.65rem !important;
        }
        
        .badge {
            font-size: 0.6rem !important;
            padding: 0.2rem 0.4rem !important;
        }
        
        .card-header h5 {
            font-size: 0.8rem !important;
        }
        
        .card-body {
            padding: 0.65rem !important;
        }
        
        .alert {
            padding: 0.5rem !important;
            font-size: 0.7rem !important;
        }
        
        /* Icon in badges for very small screens */
        .badge i.fas,
        .badge i.fa {
            font-size: 0.6rem !important;
        }
        
        /* Table for very small screens */
        .table {
            min-width: 550px;
        }
        
        .table td strong {
            max-width: 80px;
        }
    }

    /* Better mobile card spacing */
    @media (max-width: 576px) {
        .mb-4 {
            margin-bottom: 1.25rem !important;
        }

        .card {
            margin-bottom: 1rem;
        }
    }
</style>
@endsection


