<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SPK Karyawan Terbaik')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* PERBAIKAN CSS - Menghilangkan konflik dan mempertahankan struktur tabel */

        :root {
            --primary: #a16207;
            --secondary: #ca8a04;
            --orange: #ff7e3e;
            --light-primary: #fef3c7;
            --light-secondary: #fffbeb;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            --accent: #059669;
            --soft-bg: #fefefe;
            --text-dark: #1c1917;
            --text-light: #78716c;
            --emerald: #10b981;
            --amber: #f59e0b;
            --brown-light: #fef7ed;
            --brown-medium: #fed7aa;
            --red-soft: #ef4444;
            --warm-gray: #f5f5f4;
            --header-height: 80px;
        }

        /* RESET YANG LEBIH SELEKTIF - HANYA UNTUK ELEMEN YANG DIPERLUKAN */
        html {
            background: linear-gradient(135deg, var(--warm-gray) 0%, #f3f2f0 100%) !important;
            overflow-x: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, var(--warm-gray) 0%, #f3f2f0 100%);
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden !important;
        }

        /* HANYA HILANGKAN GARIS PADA ELEMEN LAYOUT UTAMA - BUKAN TABEL */
        .container-fluid,
        .row:not(.table-responsive .row),
        main,
        footer {
            border-bottom: none !important;
            border-left: none !important;
            border-right: none !important;
            border-top: none !important;
        }

        /* PASTIKAN VIEWPORT TIDAK ADA GARIS TAPI TETAP PERTAHANKAN GARIS TABEL */
        html::after,
        body::after,
        .container-fluid::after,
        .main-content::after {
            display: none !important;
            content: none !important;
        }

        main {
            flex: 1;
        }

        /* Enhanced Navbar styling */
        .navbar {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 25%, var(--primary) 75%, var(--secondary) 100%) !important;
            box-shadow: 0 8px 32px rgba(161, 98, 7, 0.3);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            height: var(--header-height);
            position: relative;
            overflow: visible;
            z-index: 1000;
        }

        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.08)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.06)"/><circle cx="90" cy="80" r="1.2" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="70" r="0.8" fill="rgba(255,255,255,0.04)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(2deg);
            }
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            background: linear-gradient(45deg, #ffffff, #fbbf24, #ffffff);
            background-size: 200% 200%;
            animation: shimmer 3s ease-in-out infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        @keyframes shimmer {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 0 20px rgba(251, 191, 36, 0.5));
        }

        .navbar-brand::before {
            content: '🏆';
            position: absolute;
            left: -2.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(-50%);
            }

            40% {
                transform: translateY(-60%);
            }

            60% {
                transform: translateY(-55%);
            }
        }

        /* Enhanced Navigation Links */
        .navbar-nav {
            position: relative;
            z-index: 1001;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.75rem 1.25rem !important;
            border-radius: 25px;
            margin: 0 0.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
            display: inline-block;
            z-index: 1001;
        }

        .user-dropdown-toggle {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.75rem 1.25rem !important;
            border-radius: 25px;
            margin: 0 0.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .user-dropdown-toggle:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .user-dropdown-toggle::before {
            content: '👤';
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        .user-dropdown-toggle::after {
            content: '▼';
            margin-left: 0.5rem;
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .user-dropdown.show .user-dropdown-toggle::after {
            transform: rotate(180deg);
        }

        .user-dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background: white;
            min-width: 200px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 0.75rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) scale(0.95);
            transition: all 0.3s ease;
            z-index: 10000;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .user-dropdown.show .user-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .user-dropdown-item {
            display: block;
            width: 100%;
            padding: 0.75rem 1.5rem;
            color: var(--text-dark);
            font-weight: 500;
            border: none;
            background: none;
            text-align: left;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .user-dropdown-item:hover {
            background: linear-gradient(135deg, var(--light-primary), var(--brown-light));
            color: var(--primary);
            transform: translateX(5px);
        }

        /* Mobile hamburger enhancement */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover,
        .navbar-toggler:focus {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Button styling */
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #92400e;
            border-color: #92400e;
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .bg-primary {
            background: var(--gradient) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        /* Sidebar styling */
        .sidebar {
            min-height: calc(100vh - var(--header-height));
            background: linear-gradient(180deg, #fef7ed 0%, #fed7aa 100%);
            box-shadow: 2px 0 15px rgba(161, 98, 7, 0.15);
            border-right: 1px solid rgba(161, 98, 7, 0.1);
        }

        .sidebar .nav-link {
            color: #92400e;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 10px;
            padding: 12px 15px;
            border-left: 3px solid transparent;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            color: #78350f;
            background: rgba(161, 98, 7, 0.1);
            transform: translateX(3px);
            border-left-color: var(--primary);
            box-shadow: 0 2px 4px rgba(161, 98, 7, 0.1);
        }

        .sidebar .nav-link.active {
            color: white;
            background: var(--gradient);
            font-weight: 600;
            border-left-color: var(--orange);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.25);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main content area */
        .main-content {
            background: var(--warm-gray);
            min-height: calc(100vh - var(--header-height));
        }

        /* Footer - TANPA GARIS */
        footer {
            padding: 1rem 0;
            background: transparent;
            color: var(--text-light);
            border: none !important;
            box-shadow: none !important;
        }

        /* =============================================== */
        /* STYLING KHUSUS UNTUK TABEL - JANGAN DIHILANGKAN */
        /* =============================================== */

        /* Card dashboard styling */
        .card-dashboard {
            border-left: 4px solid var(--primary);
            transition: all 0.2s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-top: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(161, 98, 7, 0.15);
        }

        .card-dashboard.card-primary {
            border-left-color: var(--primary);
        }

        .card-dashboard.card-success {
            border-left-color: var(--emerald);
        }

        .card-dashboard.card-warning {
            border-left-color: var(--amber);
        }

        .card-dashboard.card-danger {
            border-left-color: #ef4444;
        }

        /* Alert styling */
        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
            border-radius: 8px;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
            border-radius: 8px;
            border: 1px solid #fecaca;
        }

        .alert-info {
            background-color: #eff6ff;
            border-color: #bfdbfe;
            color: #1e40af;
            border-radius: 8px;
            border: 1px solid #bfdbfe;
        }

        .alert-warning {
            background-color: #fffbeb;
            border-color: #fed7aa;
            color: #92400e;
            border-radius: 8px;
            border: 1px solid #fed7aa;
        }

        /* =============================================== */
        /* TABLE STYLING - PERTAHANKAN SEMUA GARIS TABEL */
        /* =============================================== */

        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb !important;
            /* PASTIKAN BORDER TABEL ADA */
        }

        .table thead {
            background: var(--brown-light);
            border-bottom: 2px solid #e5e7eb !important;
            /* GARIS BAWAH HEADER */
        }

        .table thead th {
            border-bottom: 2px solid #e5e7eb !important;
            /* GARIS ANTAR KOLOM HEADER */
            border-right: 1px solid #f3f4f6 !important;
            /* GARIS KANAN HEADER */
            color: var(--text-dark);
            font-weight: 600;
            padding: 1rem 1.25rem;
        }

        .table thead th:last-child {
            border-right: none !important;
        }

        .table tbody td {
            border-bottom: 1px solid #f3f4f6 !important;
            /* GARIS BAWAH CELL */
            border-right: 1px solid #f9fafb !important;
            /* GARIS KANAN CELL */
            padding: 1rem 1.25rem;
            vertical-align: middle;
            transition: all 0.2s ease;
        }

        .table tbody td:last-child {
            border-right: none !important;
        }

        .table tbody tr:last-child td {
            border-bottom: 1px solid #e5e7eb !important;
            /* GARIS BAWAH ROW TERAKHIR */
        }

        .table tbody tr:hover {
            background: #fafbfc;
        }

        /* Enhanced Table Classes */
        .table-enhanced {
            margin: 0;
            font-size: 0.9rem;
            background: white;
            width: 100%;
            border: 1px solid #e5e7eb !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        .table-enhanced thead {
            background: #f9fafb;
            border-bottom: 2px solid #e5e7eb !important;
        }

        .table-enhanced thead th {
            border: none;
            border-bottom: 2px solid #e5e7eb !important;
            border-right: 1px solid #f3f4f6 !important;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #374151;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            position: relative;
            vertical-align: middle;
        }

        .table-enhanced thead th:last-child {
            border-right: none !important;
        }

        .table-enhanced tbody td {
            padding: 1rem 1.25rem;
            border: none;
            border-bottom: 1px solid #f3f4f6 !important;
            border-right: 1px solid #f9fafb !important;
            vertical-align: middle;
            transition: all 0.2s ease;
        }

        .table-enhanced tbody td:last-child {
            border-right: none !important;
        }

        .table-enhanced tbody tr {
            transition: all 0.2s ease;
        }

        .table-enhanced tbody tr:hover {
            background: #fafbfc;
        }

        .table-enhanced tbody tr:last-child td {
            border-bottom: 1px solid #e5e7eb !important;
        }

        /* Table Responsive */
        .table-responsive {
            border: 1px solid #e5e7eb !important;
            border-radius: 8px;
            overflow: hidden;
        }

        /* DataTable Wrapper - JANGAN HILANGKAN BORDER */
        .dataTables_wrapper {
            border: none !important;
            /* Wrapper tidak perlu border */
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            font-weight: 500;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1rem;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_info {
            color: #6b7280;
            font-size: 0.85rem;
            margin-top: 1rem;
            border: none !important;
        }

        /* =============================================== */
        /* CARD STYLING - PERTAHANKAN BORDER YANG DIPERLUKAN */
        /* =============================================== */

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb !important;
            /* BORDER CARD */
            transition: all 0.2s ease;
            background: white;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(161, 98, 7, 0.1);
        }

        .card-header {
            background: var(--brown-light);
            border-bottom: 2px solid var(--primary) !important;
            /* GARIS BAWAH HEADER CARD */
            font-weight: 600;
            border-radius: 10px 10px 0 0;
            padding: 1.25rem 1.5rem;
        }

        .card-enhanced {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
            /* BORDER CARD ENHANCED */
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-enhanced:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(161, 98, 7, 0.15);
        }

        .card-header-enhanced {
            background: linear-gradient(135deg, #fef7ed 0%, #fed7aa 100%);
            border-bottom: 2px solid var(--primary) !important;
            /* GARIS BAWAH HEADER */
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* =============================================== */
        /* FORM DAN ELEMENT LAINNYA */
        /* =============================================== */

        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef !important;
            /* BORDER FORM */
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(161, 98, 7, 0.15);
        }

        /* Modal styling */
        .modal-content {
            border: 1px solid #e5e7eb !important;
            /* BORDER MODAL */
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: var(--gradient);
            color: white;
            border-bottom: 2px solid var(--primary) !important;
            /* GARIS BAWAH MODAL HEADER */
            border-radius: 10px 10px 0 0;
        }

        .modal-footer {
            border-top: 1px solid #e5e7eb !important;
            /* GARIS ATAS MODAL FOOTER */
            background: #f8f9fa;
            border-radius: 0 0 10px 10px;
        }

        /* Badge styling */
        .badge {
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 15px;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            /* BORDER BADGE */
        }

        /* Responsive adjustments for header */
        @media (max-width: 991.98px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .navbar-brand::before {
                left: -2rem;
                font-size: 1.2rem;
            }

            .navbar-collapse {
                background: rgba(26, 54, 93, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 15px;
                margin-top: 1rem;
                padding: 1rem;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                z-index: 1002;
            }

            .user-dropdown-menu {
                position: static !important;
                transform: none !important;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
                border: 1px solid rgba(255, 255, 255, 0.2) !important;
                background: rgba(255, 255, 255, 0.95) !important;
                margin-top: 0.5rem !important;
                border-radius: 10px !important;
                opacity: 1 !important;
                visibility: visible !important;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.25rem;
            }

            .navbar-brand::before {
                display: none;
            }

            .sidebar .nav-link {
                margin: 1px 5px;
                padding: 10px 12px;
            }

            .sidebar .nav-link:hover {
                transform: none;
            }

            .table-enhanced {
                font-size: 0.8rem;
            }

            .table-enhanced thead th,
            .table-enhanced tbody td {
                padding: 0.75rem 0.5rem;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #92400e, #a16207);
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- Enhanced Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                SPK Karyawan Terbaik
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <div class="user-dropdown" id="userDropdown">
                                <button class="user-dropdown-toggle" type="button" onclick="toggleUserDropdown()">
                                    {{ auth()->user()->name }}
                                </button>
                                <div class="user-dropdown-menu">
                                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="user-dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 d-md-block sidebar p-0">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            @if(auth()->user()->isAdmin())
                                <!-- Admin Sidebar -->
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                        href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.kriteria.*') ? 'active' : '' }}"
                                        href="{{ route('admin.kriteria.index') }}">
                                        <i class="fas fa-list-ul"></i> Kriteria
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.subkriteria.*') ? 'active' : '' }}"
                                        href="{{ route('admin.subkriteria.index') }}">
                                        <i class="fas fa-list-alt"></i> Sub Kriteria
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.alternatif.*') ? 'active' : '' }}"
                                        href="{{ route('admin.alternatif.index') }}">
                                        <i class="fas fa-users"></i> Alternatif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.penilaian.*') ? 'active' : '' }}"
                                        href="{{ route('admin.penilaian.index') }}">
                                        <i class="fas fa-clipboard-check"></i> Penilaian
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.perhitungan.*') ? 'active' : '' }}"
                                        href="{{ route('admin.perhitungan.index') }}">
                                        <i class="fas fa-calculator"></i> Perhitungan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}"
                                        href="{{ route('admin.user.index') }}">
                                        <i class="fas fa-user-cog"></i> Manajemen User
                                    </a>
                                </li>
                            @else
                                <!-- User Sidebar -->
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                                        href="{{ route('user.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.kriteria.*') ? 'active' : '' }}"
                                        href="{{ route('user.kriteria.index') }}">
                                        <i class="fas fa-list-ul"></i> Kriteria
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.alternatif.*') ? 'active' : '' }}"
                                        href="{{ route('user.alternatif.index') }}">
                                        <i class="fas fa-users"></i> Alternatif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.perhitungan.*') ? 'active' : '' }}"
                                        href="{{ route('user.perhitungan.index') }}">
                                        <i class="fas fa-calculator"></i> Perhitungan
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 main-content">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </main>
            @else
                <!-- Content for guest users -->
                <main class="col-12 py-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </main>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} SPK Pemilihan Karyawan Terbaik | MOORA Method</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SIMPLE DROPDOWN JAVASCRIPT -->
    <script>
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const dropdown = document.getElementById('userDropdown');
            const isClickInside = dropdown.contains(event.target);

            if (!isClickInside) {
                dropdown.classList.remove('show');
            }
        });

        // Prevent dropdown from closing when clicking inside
        document.getElementById('userDropdown').addEventListener('click', function (event) {
            event.stopPropagation();
        });
    </script>

    @yield('scripts')
</body>

</html>