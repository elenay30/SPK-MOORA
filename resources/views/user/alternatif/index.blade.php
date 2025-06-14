@extends('layouts.app')

@section('title', 'Daftar Alternatif')

@section('styles')
    <style>
        /* CSS HALAMAN ALTERNATIF - DISAMAKAN DENGAN KRITERIA DAN USER */

        /* Enhanced header styling matching dashboard theme */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 20px;
            color: white;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(161, 98, 7, 0.2);
            border: none;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 2;
        }

        .page-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
            position: relative;
            z-index: 2;
        }

        /* Enhanced buttons */
        .btn-enhanced {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid transparent !important;
            position: relative;
            z-index: 2;
            color: white !important;
            text-decoration: none;
        }

        .btn-enhanced:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-enhanced.btn-info {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            border-color: #0ea5e9 !important;
        }

        .btn-enhanced.btn-info:hover {
            background: linear-gradient(135deg, #0284c7, #0891b2);
            color: white;
            border-color: #0284c7 !important;
        }

        /* Enhanced Statistics Cards - Terpisah seperti dashboard */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
            margin-bottom: 2rem;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .stat-card:hover::before {
            transform: scaleY(1);
        }

        .stat-card.success::before {
            background: linear-gradient(to bottom, #059669, #10b981);
        }

        .stat-card.warning::before {
            background: linear-gradient(to bottom, #d97706, #f59e0b);
        }

        .stat-card.info::before {
            background: linear-gradient(to bottom, #0ea5e9, #06b6d4);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }

        .stat-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: inherit;
            opacity: 0.1;
            border-radius: inherit;
        }

        .stat-icon.success {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .stat-icon.warning {
            background: linear-gradient(135deg, #d97706, #f59e0b);
            color: white;
        }

        .stat-icon.info {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: white;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 0.5rem;
            animation: countUp 1s ease-out;
        }

        .stat-label {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.7;
            margin: 0;
        }

        /* Staggered animation untuk cards */
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }

        .stat-card {
            animation: slideInUp 0.6s ease-out both;
        }

        /* Loading animation untuk angka */
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Remove old stats-info styling */
        .stats-info {
            display: none;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced content card */
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none !important;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-card:nth-child(2) { animation-delay: 0.1s; }
        .content-card:nth-child(3) { animation-delay: 0.2s; }
        .content-card:nth-child(4) { animation-delay: 0.3s; }

        .content-card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.5rem 2rem;
            border-bottom: 2px solid #e2e8f0 !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .content-card-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 2rem;
            right: 2rem;
            height: 2px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .content-card:hover .content-card-header::before {
            transform: scaleX(1);
        }

        .content-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .content-card-body {
            padding: 0 !important;
            border: none !important;
        }

        /* Enhanced table - Clean Modern Design */
        .enhanced-table {
            border-radius: 0;
            box-shadow: none !important;
            border: none !important;
            background: white;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .enhanced-table thead th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            font-weight: 700;
            color: #1f2937;
            padding: 1.2rem 1.5rem;
            border: none !important;
            border-bottom: 3px solid #e5e7eb !important;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            vertical-align: middle;
            text-align: center;
            position: relative;
        }

        .enhanced-table tbody td {
            padding: 1.2rem 1.5rem;
            vertical-align: middle;
            transition: all 0.3s ease;
            border: none !important;
            border-bottom: 1px solid #f3f4f6 !important;
            text-align: center;
            font-size: 0.9rem;
            color: #374151;
        }

        .enhanced-table tbody tr {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
        }

        .enhanced-table tbody tr:nth-child(even) {
            background: #fafbfc;
        }

        .enhanced-table tbody tr:last-child td {
            border-bottom: none !important;
        }

        .enhanced-table tbody tr:hover {
            background: linear-gradient(135deg, #fef7ed 0%, #fef3c7 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(161, 98, 7, 0.15);
            border-radius: 8px;
        }

        .enhanced-table tbody tr:hover td {
            border-color: transparent !important;
        }

        /* Number badges */
        .number-badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
        }

        /* Kode badges */
        .kode-badge {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.8rem;
            border: 2px solid #e5e7eb;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Value badges for penilaian */
        .nilai-badge {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.8rem;
            min-width: 50px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nilai-badge.empty {
            background: linear-gradient(135deg, #6b7280, #9ca3af);
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
        }

        /* User avatar styling */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.2);
        }

        /* User info styling */
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-details h6 {
            margin: 0;
            font-weight: 700;
            color: #1f2937;
            font-size: 0.95rem;
        }

        .user-details small {
            color: #6b7280;
            font-weight: 500;
            font-size: 0.8rem;
        }

        /* Action buttons styling */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            justify-content: center;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
            border: none !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .action-btn:hover::before {
            left: 100%;
        }

        .action-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-info.action-btn {
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        }

        .btn-info.action-btn:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0891b2 100%);
            color: white;
            text-decoration: none;
        }

        /* Alert styling */
        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: none !important;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        /* DataTable wrapper styling */
        .dataTables_wrapper {
            padding: 1.5rem;
            border: none !important;
            background: transparent;
        }

        .dataTables_wrapper>div {
            border: none !important;
        }

        .dataTables_wrapper .row {
            border: none !important;
        }

        .dataTables_wrapper .col-sm-12 {
            border: none !important;
        }

        /* DataTable controls styling */
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border-radius: 10px;
            border: 2px solid #e2e8f0 !important;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            background: white;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_length label {
            font-weight: 500;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0;
        }

        /* Table responsive container */
        .table-responsive {
            border: none !important;
            border-radius: 0;
            overflow: hidden;
            background: white;
            box-shadow: none !important;
        }

        .table-responsive .enhanced-table {
            border: none !important;
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Text alignment dan styling untuk konten */
        .enhanced-table tbody td:nth-child(1), /* No */
        .enhanced-table tbody td:nth-child(2), /* Kode */
        .enhanced-table tbody td:nth-child(4) /* Aksi */ {
            text-align: center;
        }

        .enhanced-table tbody td:nth-child(3) { /* Nama */
            text-align: left;
        }

        /* Header alignment yang konsisten */
        .enhanced-table thead th:nth-child(1), /* No */
        .enhanced-table thead th:nth-child(2), /* Kode */
        .enhanced-table thead th:nth-child(4) /* Aksi */ {
            text-align: center;
        }

        .enhanced-table thead th:nth-child(3) { /* Nama */
            text-align: left;
        }

        /* DataTable info dan pagination styling */
        .dataTables_wrapper .dataTables_info {
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 0.75rem 0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            margin: 0 0.15rem;
            border: 1px solid #d1d5db !important;
            background: white;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f8f9fa;
            border-color: var(--primary) !important;
            color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(161, 98, 7, 0.15);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-color: var(--primary) !important;
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, #92400e 0%, #a16207 100%);
            border-color: #92400e !important;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.4);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #9ca3af;
            cursor: not-allowed;
            opacity: 0.6;
            background: #f9fafb;
            border-color: #e5e7eb !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background: #f9fafb;
            border-color: #e5e7eb !important;
            color: #9ca3af;
            transform: none;
            box-shadow: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .stat-card {
                padding: 1.5rem;
                margin-bottom: 1rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }

            .content-card-header {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
                padding: 1rem 1.5rem;
            }

            .dataTables_wrapper {
                padding: 1rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }

            .action-btn {
                width: 28px;
                height: 28px;
                font-size: 0.7rem;
            }

            .enhanced-table thead th,
            .enhanced-table tbody td {
                padding: 0.75rem 0.5rem;
                font-size: 0.8rem;
            }

            .number-badge {
                width: 25px;
                height: 25px;
                font-size: 0.75rem;
            }

            .kode-badge {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
            }

            .nilai-badge {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
                min-width: 35px;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 0.8rem;
            }

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none;
                text-align: center;
                margin-bottom: 1rem;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                margin-left: 0;
                margin-top: 0.5rem;
                max-width: 300px;
            }

            .dataTables_wrapper .dataTables_length select {
                margin: 0.25rem;
            }

            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                float: none;
                text-align: center;
                margin-top: 1rem;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.4rem 0.6rem;
                margin: 0.1rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .stat-card {
                padding: 1.25rem;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .stat-icon {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }

            .enhanced-table {
                font-size: 0.75rem;
            }

            .enhanced-table thead th {
                padding: 0.6rem 0.4rem;
                font-size: 0.7rem;
            }

            .enhanced-table tbody td {
                padding: 0.6rem 0.4rem;
            }

            .dataTables_wrapper .dataTables_filter input {
                max-width: 250px;
                font-size: 0.85rem;
            }

            .dataTables_wrapper .dataTables_info {
                font-size: 0.8rem;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.3rem 0.5rem;
                font-size: 0.75rem;
            }

            .stat-card:hover,
            .content-card:hover,
            .enhanced-table tbody tr:hover {
                transform: none;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <h1 class="page-title">📊 Daftar Alternatif Karyawan</h1>
        <p class="page-subtitle">Kelola data alternatif karyawan untuk penilaian kinerja sistem pendukung keputusan</p>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="row mb-5">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-number">{{ $alternatifs->count() }}</div>
                <p class="stat-label">Total Alternatif</p>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-list-ul"></i>
                </div>
                <div class="stat-number">{{ $kriterias->count() }}</div>
                <p class="stat-label">Total Kriteria</p>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-calculator"></i>
                </div>
                <div class="stat-number">{{ $alternatifs->count() * $kriterias->count() }}</div>
                <p class="stat-label">Total Penilaian</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Alternatif List Card -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-users"></i>
                Data Alternatif Karyawan
            </h3>
            <div style="font-size: 0.9rem; color: #6b7280;">
                Total: <strong>{{ $alternatifs->count() }}</strong> karyawan terdaftar
            </div>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Karyawan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>
                                    <div class="number-badge">{{ $loop->iteration }}</div>
                                </td>
                                <td>
                                    <span class="kode-badge">{{ $alternatif->kode }}</span>
                                </td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="user-details">
                                            <h6>{{ $alternatif->nama }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('user.alternatif.show', $alternatif->id) }}"
                                            class="action-btn btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Enhanced Penilaian Table Card -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-table"></i>
                Tabel Penilaian Alternatif
            </h3>
            <div style="font-size: 0.9rem; color: #6b7280;">
                Matrix: <strong>{{ $alternatifs->count() }}x{{ $kriterias->count() }}</strong>
            </div>
        </div>
        <div class="content-card-body">
            <div class="alert alert-info">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-2 text-primary"></i>
                    <div>
                        <strong>Informasi:</strong> Tabel ini menampilkan nilai penilaian setiap alternatif berdasarkan
                        kriteria yang telah ditentukan.
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table enhanced-table" id="nilaiTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th class="text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <strong>{{ $kriteria->kode }}</strong>
                                        <small class="text-muted">{{ $kriteria->nama }}</small>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>
                                    <div class="number-badge">{{ $loop->iteration }}</div>
                                </td>
                                <td>
                                    <span class="kode-badge">{{ $alternatif->kode }}</span>
                                </td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            <i class="fas fa-user" style="font-size: 0.8rem;"></i>
                                        </div>
                                        <div class="user-details">
                                            <h6>{{ $alternatif->nama }}</h6>
                                        </div>
                                    </div>
                                </td>
                                @foreach ($kriterias as $kriteria)
                                    <td class="text-center">
                                        @php
                                            $penilaian = $alternatif->penilaians->where('kriteria_id', $kriteria->id)->first();
                                        @endphp
                                        @if($penilaian)
                                            <span class="nilai-badge">{{ $penilaian->nilai }}</span>
                                        @else
                                            <span class="nilai-badge empty">-</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTables with custom configuration
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                "dom": '<"dataTables_wrapper"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>><"table-responsive"t><"dataTables_wrapper"<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                "columnDefs": [
                    { orderable: false, targets: [0, 3] }, // Disable sorting untuk No dan Aksi
                    { className: 'no-sort', targets: [0] } // Extra class untuk No column
                ],
                "responsive": true,
                "drawCallback": function () {
                    // Add animation to new rows
                    $(this.api().table().body()).find('tr').addClass('animate__animated animate__fadeIn');
                }
            });

            $('#nilaiTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                "dom": '<"dataTables_wrapper"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>><"table-responsive"t><"dataTables_wrapper"<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                "columnDefs": [
                    { orderable: false, targets: [0] }, // Disable sorting untuk No
                    { className: 'no-sort', targets: [0] } // Extra class untuk No column
                ],
                "scrollX": true,
                "responsive": false, // Disable responsive karena menggunakan scrollX
                "drawCallback": function () {
                    // Add animation to new rows
                    $(this.api().table().body()).find('tr').addClass('animate__animated animate__fadeIn');
                }
            });

            // Add loading state for better UX
            $('.content-card').each(function (index) {
                $(this).css('animation-delay', (index * 0.1) + 's');
            });

            // Enhanced hover effects for buttons
            $('.btn-enhanced').hover(
                function () {
                    $(this).addClass('animate__animated animate__pulse');
                },
                function () {
                    $(this).removeClass('animate__animated animate__pulse');
                }
            );

            // Add tooltips to action buttons
            $('[title]').each(function() {
                $(this).attr('data-bs-toggle', 'tooltip');
            });
        });
    </script>
@endsection