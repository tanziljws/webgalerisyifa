<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Galeri Sekolah')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Admin Responsive CSS OVERRIDE - LOAD TERAKHIR -->
    <link href="{{ asset('admin-responsive.css') }}" rel="stylesheet">
    
    <style>
        :root {
            /* Theme colors */
            --blue-dark: #1a2b6b;   /* sidebar bg - dark blue */
            --blue-medium: #3b82f6; /* active/hover - royal blue */
            --cyan: #00bfff;        /* icons/primary buttons/accents - sky blue */
            --text-dark: #333333;   /* body text */
            --card-bg: #FFFFFF;     /* cards/content background */

            /* Sidebar tokens */
            --sidebar-bg: #FFFFFF;
            --sidebar-text: #333333;
            --sidebar-text-muted: #666666;
            --sidebar-hover: rgba(59, 130, 246, 0.1); /* light blue tint */
            --sidebar-active: var(--blue-medium);
            --sidebar-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --sidebar-width: 220px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F5F8FF;
            min-height: 100vh;
            overflow-x: hidden;
            max-width: 100%;
            color: var(--text-dark);
        }

        /* Prevent horizontal scroll globally */
        * {
            box-sizing: border-box;
        }

        .container-fluid {
            max-width: 100%;
            overflow-x: hidden;
            padding-left: 10px;
            padding-right: 10px;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
            max-width: 100%;
        }

        .col, .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, 
        .col-7, .col-8, .col-9, .col-10, .col-11, .col-12,
        .col-sm, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6,
        .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12,
        .col-md, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
        .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12,
        .col-lg, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6,
        .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12,
        .col-xl, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6,
        .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12 {
            padding-left: 5px;
            padding-right: 5px;
            max-width: 100%;
        }

        .sidebar {
            height: 100vh;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1040;
            overflow-y: hidden;
            width: var(--sidebar-width);
            box-shadow: var(--sidebar-shadow);
            border-right: 1px solid #e2e8f0;
            padding: 0.5rem 0;
            display: flex;
            flex-direction: column;
        }
        
        @media (max-width: 767.98px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }

        .sidebar-header {
            padding: 0.5rem 1rem 0.75rem;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 0.5rem;
            flex-shrink: 0;
            position: relative;
        }

        /* Close button for mobile */
        .sidebar-close {
            display: none;
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: rgba(59, 130, 246, 0.1);
            border: none;
            border-radius: 6px;
            width: 32px;
            height: 32px;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-text);
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
        }

        .sidebar-close:hover {
            background: rgba(59, 130, 246, 0.2);
            color: var(--blue-medium);
        }

        .sidebar-close i {
            font-size: 1rem;
        }

        @media (max-width: 767.98px) {
            .sidebar-close {
                display: flex;
            }
        }

        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            padding: 0.5rem;
        }

        .sidebar-logo-icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-bottom: 0.25rem;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 8px;
            padding: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-3px); }
        }

        .sidebar-logo-icon i {
            font-size: 1.2rem;
            color: var(--cyan);
        }

        .sidebar-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--sidebar-text);
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .sidebar-subtitle {
            font-size: 0.65rem;
            color: var(--sidebar-text-muted);
            margin: 0.1rem 0 0 0;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            padding: 0.5rem 0.75rem;
            flex: 1;
            overflow-y: auto;
        }

        .nav-link {
            padding: 0.6rem 1rem;
            color: var(--sidebar-text);
            display: flex;
            align-items: center;
            font-weight: 500;
            text-decoration: none;
            border: none;
            font-size: 0.85rem;
            white-space: nowrap;
            border-radius: 6px;
            margin: 0.1rem 0.5rem;
            transition: all 200ms ease;
            position: relative;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-link::before {
            display: none;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text);
            transform: translateX(2px);
        }

        .nav-link.active {
            background: var(--sidebar-active);
            color: #FFFFFF;
            font-weight: 600;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .nav-link i {
            font-size: 1rem;
            margin-right: 0.6rem;
            width: 18px;
            text-align: center;
            color: var(--cyan);
            transition: all 0.2s ease;
        }

        .nav-link:hover i {
            color: var(--cyan);
        }

        .nav-link.active i { 
            color: #FFFFFF; 
        }

        .nav-link span {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            width: calc(100% - var(--sidebar-width));
            max-width: calc(100% - var(--sidebar-width));
            overflow-x: hidden;
            padding: 20px 20px 20px 20px;
            position: relative;
            background: transparent;
            min-height: 100vh;
        }
        
        @media (max-width: 767.98px) {
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 4rem 1rem 1.5rem 1rem;
                transition: all 0.3s ease;
                min-height: 100vh;
                position: relative;
                overflow: visible;
            }
        }

        .card {
            border: none;
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 16px 30px rgba(26, 61, 156, 0.08);
            max-width: 100%;
            overflow: hidden;
            transition: transform 180ms ease, box-shadow 180ms ease;
        }

        .card:hover { transform: translateY(-2px); box-shadow: 0 22px 40px rgba(26, 61, 156, 0.14); }

        /* Ensure all elements don't overflow */
        .table-responsive {
            max-width: 100%;
            overflow-x: auto;
        }

        .table {
            max-width: 100%;
            table-layout: fixed;
        }

        .btn {
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .form-control, .form-select {
            max-width: 100%;
        }

        .alert {
            max-width: 100%;
            word-wrap: break-word;
        }


        .page-content {
            padding: 1rem 1.5rem;
            max-width: 100%;
            overflow-x: hidden;
        }

        @media (max-width: 767.98px) {
            .page-content {
                padding: 0.75rem 1rem;
            }
        }

        @media (max-width: 576px) {
            .page-content {
                padding: 0.5rem 0.75rem;
            }
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.4);
            border-radius: 2px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover { 
            background: rgba(59, 130, 246, 0.6); 
        }

        /* Ensure nav items fit without scrolling */
        .sidebar-nav {
            max-height: calc(100vh - 120px);
        }

        /* Mobile Toggle Button */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1050;
            background: var(--blue-medium);
            border: none;
            border-radius: 10px;
            color: #fff;
            padding: 0.5rem 0.6rem;
            box-shadow: 0 10px 24px rgba(46, 99, 246, 0.35);
            transition: transform 180ms ease, box-shadow 180ms ease;
        }

        .sidebar-toggle:hover { transform: translateY(-1px); box-shadow: 0 14px 30px rgba(46, 99, 246, 0.45); }

        @media (max-width: 767.98px) {
            .sidebar-toggle {
                display: block;
                top: 0.75rem;
                left: 0.75rem;
            }
        }

        /* ========================================
           RESPONSIVE ENHANCEMENTS - 100% RESPONSIVE
           ======================================== */

        /* Tablet Landscape & Small Desktop (768px - 1024px) */
        @media (min-width: 768px) and (max-width: 1024px) {
            :root {
                --sidebar-width: 200px;
            }

            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                width: calc(100% - 200px);
                max-width: calc(100% - 200px);
                padding: 15px 15px 15px 15px;
            }


            .nav-link {
                font-size: 0.8rem;
                padding: 0.5rem 0.8rem;
            }

            .nav-link i {
                font-size: 0.9rem;
                margin-right: 0.5rem;
            }

            .sidebar-title {
                font-size: 0.85rem;
            }

            .sidebar-subtitle {
                font-size: 0.6rem;
            }

            .page-content {
                padding: 0.75rem 1rem;
            }
        }

        /* Tablet Portrait (577px - 767px) */
        @media (min-width: 577px) and (max-width: 767.98px) {
            .sidebar {
                width: 220px;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 4rem 15px 15px 15px;
            }


            .page-content {
                padding: 0.75rem;
            }

            .card {
                margin-bottom: 1rem;
            }

            /* Ensure tables are scrollable */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            /* Better button sizing */
            .btn {
                font-size: 0.85rem;
                padding: 0.4rem 0.8rem;
            }

            .btn-sm {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }

        /* Mobile Landscape (481px - 576px) */
        @media (min-width: 481px) and (max-width: 576px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 3.5rem 12px 12px 12px;
            }


            .sidebar-title {
                font-size: 0.85rem;
            }

            .sidebar-subtitle {
                font-size: 0.6rem;
            }

            .nav-link {
                font-size: 0.8rem;
                padding: 0.5rem 0.8rem;
            }

            .page-content {
                padding: 0.5rem 0.75rem;
            }

            .card-body {
                padding: 0.75rem;
            }

            /* Stack flex items on mobile */
            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.5rem;
            }

            .d-flex.justify-content-between > * {
                width: 100%;
            }

            /* Full width buttons on mobile */
            .btn:not(.btn-sm):not(.btn-close) {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }

        /* Mobile Portrait (320px - 480px) */
        @media (max-width: 480px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 2px 0 15px rgba(0, 0, 0, 0.4);
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 3.5rem 10px 10px 10px;
            }


            .sidebar-toggle {
                top: 0.5rem;
                left: 0.5rem;
                padding: 0.4rem 0.5rem;
            }

            .sidebar-title {
                font-size: 0.8rem;
            }

            .sidebar-subtitle {
                font-size: 0.55rem;
            }

            .nav-link {
                font-size: 0.75rem;
                padding: 0.45rem 0.7rem;
                margin: 0.1rem 0.3rem;
            }

            .nav-link i {
                font-size: 0.85rem;
                margin-right: 0.5rem;
            }

            .page-content {
                padding: 0.5rem;
            }

            .card {
                margin-bottom: 0.75rem;
                border-radius: 12px;
            }

            .card-body {
                padding: 0.75rem;
            }

            .card-header {
                padding: 0.75rem;
            }

            /* Mobile-friendly headings */
            h1, .h1 {
                font-size: 1.5rem;
            }

            h2, .h2 {
                font-size: 1.3rem;
            }

            h3, .h3 {
                font-size: 1.1rem;
            }

            h4, .h4 {
                font-size: 1rem;
            }

            h5, .h5 {
                font-size: 0.9rem;
            }

            h6, .h6 {
                font-size: 0.85rem;
            }

            /* Stack flex items */
            .d-flex.justify-content-between,
            .d-flex.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.5rem;
            }

            .d-flex.justify-content-between > *,
            .d-flex.align-items-center > * {
                width: 100%;
            }

            /* Full width buttons */
            .btn:not(.btn-sm):not(.btn-close):not(.btn-outline-warning):not(.btn-outline-danger) {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .btn-sm {
                font-size: 0.7rem;
                padding: 0.2rem 0.4rem;
            }

            /* Better form controls */
            .form-control,
            .form-select {
                font-size: 0.9rem;
            }

            /* Better table responsiveness */
            .table {
                font-size: 0.8rem;
            }

            .table td,
            .table th {
                padding: 0.4rem;
            }

            /* Better badge sizing */
            .badge {
                font-size: 0.65rem;
                padding: 0.25rem 0.4rem;
            }

            /* Better alert sizing */
            .alert {
                font-size: 0.85rem;
                padding: 0.6rem;
            }

            /* Grid adjustments for mobile */
            .row > * {
                padding-left: 5px;
                padding-right: 5px;
            }

            .col-12 {
                margin-bottom: 0.5rem;
            }

            /* Image responsiveness */
            img {
                max-width: 100%;
                height: auto;
            }
        }

        /* Extra small devices (< 320px) */
        @media (max-width: 319px) {
            .sidebar {
                width: 180px;
            }


            .sidebar-title {
                font-size: 0.75rem;
            }

            .nav-link {
                font-size: 0.7rem;
                padding: 0.4rem 0.6rem;
            }

            .btn {
                font-size: 0.75rem;
                padding: 0.3rem 0.6rem;
            }
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1039;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        @media (max-width: 767.98px) {
            .sidebar-overlay {
                cursor: pointer;
            }
        }

        /* Prevent body scroll when sidebar is open on mobile */
        @media (max-width: 767.98px) {
            body.sidebar-open {
                overflow: hidden;
            }
        }

        /* Print styles */
        @media print {
            .sidebar,
            .sidebar-toggle,
            .btn,
            .alert {
                display: none;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                max-width: 100%;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        /* High DPI screens optimization */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .card {
                border: 0.5px solid rgba(0, 0, 0, 0.05);
            }

            .sidebar {
                border-right: 0.5px solid #e2e8f0;
            }
        }

        /* Landscape orientation specific */
        @media (max-height: 500px) and (orientation: landscape) {
            .sidebar {
                overflow-y: auto;
            }

            .main-content {
                padding-top: 15px;
            }

            .sidebar-header {
                padding: 0.3rem 0.8rem 0.5rem;
            }

            .sidebar-logo-icon {
                width: 30px;
                height: 30px;
            }

            .nav-link {
                padding: 0.4rem 0.8rem;
            }
        }

        /* Accessibility improvements for all devices */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Force hardware acceleration for smoother animations */
        .sidebar,
        .main-content,
        .card {
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        /* Ensure no horizontal overflow on any device */
        html,
        body,
        .container-fluid,
        .row,
        .main-content {
            overflow-x: hidden !important;
            max-width: 100% !important;
        }
    </style>
    
    @yield('styles')
    @stack('styles')
</head>
<body>
    <!-- Mobile Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
        <i class="fas fa-bars" id="toggleIcon"></i>
    </button>

    <!-- Overlay for closing sidebar on mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-logo">
                        <div class="sidebar-logo-icon">
                            <img src="{{ asset('images/logo smkn 4.png') }}" alt="SMKN 4 Logo" style="width: 30px; height: 30px; object-fit: contain;">
                        </div>
                        <div>
                            <h4 class="sidebar-title">SMKN 4 BOGOR</h4>
                            <p class="sidebar-subtitle">Admin Panel</p>
                        </div>
                    </div>
                    <!-- Close button for mobile -->
                    <button class="sidebar-close" id="sidebarClose">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <nav class="sidebar-nav">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a class="nav-link {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}" href="{{ route('admin.petugas.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Kelola Petugas</span>
                    </a>
                    
                    <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                        <i class="fas fa-tags"></i>
                        <span>Kelola Kategori</span>
                    </a>
                    
                    <a class="nav-link {{ request()->routeIs('admin.fotos.*') ? 'active' : '' }}" href="{{ route('admin.fotos.index') }}">
                        <i class="fas fa-images"></i>
                        <span>Kelola Galeri</span>
                    </a>
                    
                    <a class="nav-link {{ request()->routeIs('admin.reports.gallery') || request()->routeIs('admin.reports.gallery.index') ? 'active' : '' }}" href="{{ route('admin.reports.gallery.index') }}">
                        <i class="fas fa-chart-pie"></i>
                        <span>Laporan Galeri</span>
                    </a>
                    
                    <a class="nav-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}" href="{{ route('admin.agenda.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Kelola Agenda</span>
                    </a>
                    
                    <a class="nav-link {{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}" href="{{ route('admin.informasi.index') }}">
                        <i class="fas fa-info-circle"></i>
                        <span>Kelola Informasi</span>
                    </a>
                    
                    <a class="nav-link" href="{{ route('admin.logout') }}" onclick="return confirm('Yakin ingin logout?')">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Page Content -->
                <div class="page-content">

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Mobile Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 Sidebar toggle initialized');
            
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const sidebarClose = document.getElementById('sidebarClose');
            const toggleIcon = document.getElementById('toggleIcon');
            
            console.log('📱 Elements found:', {
                toggle: !!sidebarToggle,
                sidebar: !!sidebar,
                overlay: !!overlay,
                close: !!sidebarClose
            });
            
            // Ensure sidebar is hidden on mobile initially
            if (window.innerWidth <= 767.98 && sidebar) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                console.log('✅ Sidebar hidden on mobile load');
            }
            
            // Function to close sidebar
            function closeSidebar() {
                console.log('🔒 Closing sidebar');
                if (sidebar) sidebar.classList.remove('show');
                if (overlay) overlay.classList.remove('show');
                document.body.style.overflow = '';
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-times');
                    toggleIcon.classList.add('fa-bars');
                }
            }
            
            // Function to open sidebar
            function openSidebar() {
                console.log('🔓 Opening sidebar');
                if (sidebar) sidebar.classList.add('show');
                if (overlay) overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-bars');
                    toggleIcon.classList.add('fa-times');
                }
            }
            
            if (sidebarToggle && sidebar && overlay) {
                console.log('✅ Event listeners will be attached');
                
                // Toggle sidebar when clicking hamburger button
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('🍔 Hamburger clicked!');
                    
                    const isOpen = sidebar.classList.contains('show');
                    console.log('Current state - isOpen:', isOpen);
                    
                    if (isOpen) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                });
                
                // Close sidebar when clicking close button
                if (sidebarClose) {
                    sidebarClose.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('❌ Close button clicked');
                        closeSidebar();
                    });
                }
                
                // Close sidebar when clicking overlay
                overlay.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('⬛ Overlay clicked');
                    closeSidebar();
                });
                
                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 767.98) {
                        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                            closeSidebar();
                        }
                    }
                });
                
                // Close sidebar when clicking nav link on mobile
                const navLinks = sidebar.querySelectorAll('.nav-link');
                console.log('📝 Found', navLinks.length, 'nav links');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 767.98) {
                            console.log('🔗 Nav link clicked, closing sidebar');
                            closeSidebar();
                        }
                    });
                });
                
                // Close sidebar when window is resized to desktop
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 767.98) {
                        console.log('🖥️ Resized to desktop, closing sidebar');
                        closeSidebar();
                    }
                });
                
                // Prevent sidebar from closing when clicking inside it
                sidebar.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                // Close sidebar when pressing Escape key
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape' && sidebar.classList.contains('show')) {
                        console.log('⌨️ Escape key pressed, closing sidebar');
                        closeSidebar();
                    }
                });
            } else {
                console.error('❌ Missing elements:', {
                    toggle: !sidebarToggle,
                    sidebar: !sidebar,
                    overlay: !overlay
                });
            }
        });
    </script>
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>


