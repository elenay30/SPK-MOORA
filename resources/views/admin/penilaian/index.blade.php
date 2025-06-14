@extends('layouts.app')

@section('title', 'Manajemen Penilaian')

@section('styles')
    <style>
        /* CSS HALAMAN PENILAIAN - DISAMAKAN DENGAN KRITERIA */

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

        .btn-enhanced.btn-success { background: linear-gradient(135deg, #059669, #10b981); border-color: #059669 !important; }
        .btn-enhanced.btn-warning { background: linear-gradient(135deg, #d97706, #f59e0b); border-color: #d97706 !important; }
        .btn-enhanced.btn-danger { background: linear-gradient(135deg, #dc2626, #ef4444); border-color: #dc2626 !important; }
        .btn-enhanced.btn-primary { background: linear-gradient(135deg, var(--primary), var(--secondary)); border-color: var(--primary) !important; }

        /* Enhanced content card */
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none !important;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out;
            transition: all 0.3s ease;
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

        /* Enhanced table - Clean Modern Design + Fixed Sorting Icons */
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

        /* Hide DataTable sorting untuk semua kolom - DISABLE SEMUA SORTING */
        .enhanced-table thead th.sorting,
        .enhanced-table thead th.sorting_asc,
        .enhanced-table thead th.sorting_desc {
            background-image: none !important;
            cursor: default !important;
        }

        .enhanced-table thead th.sorting::before,
        .enhanced-table thead th.sorting::after,
        .enhanced-table thead th.sorting_asc::before,
        .enhanced-table thead th.sorting_asc::after,
        .enhanced-table thead th.sorting_desc::before,
        .enhanced-table thead th.sorting_desc::after {
            display: none !important;
            content: none !important;
        }

        /* Hilangkan hover effect sorting - karena sorting disabled */
        .enhanced-table thead th:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
            transform: none !important;
            cursor: default !important;
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

        /* Enhanced score styling */
        .score-value {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.8rem;
            min-width: 50px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .score-value:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Score color coding - matching kriteria badge style */
        .score-value.score-excellent {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .score-value.score-good {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: white;
        }

        .score-value.score-average {
            background: linear-gradient(135deg, #d97706, #f59e0b);
            color: white;
        }

        .score-value.score-poor {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
        }

        .score-value.score-empty {
            background: linear-gradient(135deg, #6b7280, #9ca3af);
            color: white;
        }

        /* Kode badge styling - Modern Clean */
        .kode-badge {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.8rem;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .kode-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-color: var(--primary);
        }

        /* Alternative info styling */
        .alternative-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alternative-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.2);
            transition: all 0.3s ease;
        }

        .alternative-info:hover .alternative-avatar {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(161, 98, 7, 0.3);
        }

        .alternative-details h6 {
            margin: 0;
            font-weight: 700;
            color: #1f2937;
            font-size: 0.95rem;
        }

        .alternative-details small {
            color: #6b7280;
            font-weight: 500;
            font-size: 0.8rem;
        }

        /* Action buttons styling - Enhanced Modern */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            justify-content: center;
        }

        .action-buttons .btn {
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
        }

        .action-buttons .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .action-buttons .btn:hover::before {
            left: 100%;
        }

        .action-buttons .btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .action-buttons .btn.btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .action-buttons .btn.btn-warning:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }

        .action-buttons .btn.btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .action-buttons .btn.btn-danger:hover {
            background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
        }

        /* Criteria header styling - horizontal version dengan styling konsisten */
        .criteria-header {
            min-width: 120px;
            max-width: 150px;
            padding: 1.2rem 0.75rem !important;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 0.875rem;
            line-height: 1.3;
            position: relative;
        }

        .criteria-header .d-flex {
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
        }

        .criteria-header strong {
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .criteria-header small {
            font-size: 0.7rem;
            opacity: 0.8;
            font-weight: 500;
            line-height: 1.2;
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
        .enhanced-table tbody td:nth-child(1) { /* No */
            text-align: center;
            font-weight: 600;
            color: #6b7280;
            font-size: 0.85rem;
        }

        .enhanced-table tbody td:nth-child(2) { /* Kode */
            text-align: center;
        }

        .enhanced-table tbody td:nth-child(3) { /* Nama */
            text-align: left;
        }

        .enhanced-table tbody td:last-child { /* Aksi */
            text-align: center;
        }

        /* Header alignment yang konsisten */
        .enhanced-table thead th:nth-child(1), /* No */
        .enhanced-table thead th:nth-child(2), /* Kode */
        .enhanced-table thead th:last-child /* Aksi */ {
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

        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
            color: var(--primary);
        }

        .empty-state h5 {
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .empty-state p {
            color: #6b7280;
            margin-bottom: 1.5rem;
        }

        /* Responsive design untuk mobile */
        @media (max-width: 1200px) {
            .criteria-header {
                min-width: 100px;
                max-width: 120px;
                font-size: 0.75rem;
                padding: 0.75rem 0.5rem !important;
            }

            .criteria-header strong {
                font-size: 0.8rem;
            }

            .criteria-header small {
                font-size: 0.65rem;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
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

            .alternative-info {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }

            .action-buttons .btn {
                width: 28px;
                height: 28px;
                font-size: 0.7rem;
            }

            .enhanced-table thead th,
            .enhanced-table tbody td {
                padding: 0.75rem 0.5rem;
                font-size: 0.8rem;
            }

            .criteria-header {
                min-width: 80px;
                max-width: 100px;
                font-size: 0.7rem;
                padding: 0.5rem 0.25rem !important;
            }

            .criteria-header strong {
                font-size: 0.75rem;
            }

            .criteria-header small {
                font-size: 0.6rem;
            }

            .score-value {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
            }

            .kode-badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
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
        }

        /* Loading state styling */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            z-index: 10;
            border: none;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3 !important;
            border-top: 4px solid var(--primary) !important;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Tambahan untuk table scroll horizontal yang lebih smooth */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
            opacity: 0.7;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="page-title">📊 Manajemen Penilaian</h1>
                <p class="page-subtitle mb-0">Kelola penilaian alternatif berdasarkan kriteria yang telah ditentukan</p>
            </div>
            <a href="{{ route('admin.penilaian.create') }}" class="btn-enhanced btn-success text-white">
                <i class="fas fa-plus me-2"></i>Tambah Penilaian
            </a>
        </div>
    </div>

    <!-- Enhanced Content Card -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-table"></i>
                Tabel Penilaian Alternatif
            </h3>
            <div style="font-size: 0.9rem; color: #6b7280;">
                Total: <strong>{{ $alternatifs->count() }}</strong> alternatif terdaftar
            </div>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th class="text-left">Nama Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th class="criteria-header" title="{{ $kriteria->nama }}">
                                    <div class="d-flex flex-column align-items-center">
                                        <strong>{{ $kriteria->kode }}</strong>
                                        <small class="opacity-75">{{ $kriteria->nama }}</small>
                                    </div>
                                </th>
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alternatifs as $alternatif)
                            <tr>
                                <td>
                                    <span class="fw-bold">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <span class="kode-badge">{{ $alternatif->kode }}</span>
                                </td>
                                <td class="text-left">
                                    <div class="alternative-info">
                                        <div class="alternative-avatar">
                                            {{ strtoupper(substr($alternatif->nama, 0, 2)) }}
                                        </div>
                                        <div class="alternative-details">
                                            <h6>{{ $alternatif->nama }}</h6>
                                            <small>{{ $alternatif->kode }}</small>
                                        </div>
                                    </div>
                                </td>
                                @foreach ($kriterias as $kriteria)
                                    <td>
                                        @php
                                            $penilaian = $alternatif->penilaians->where('kriteria_id', $kriteria->id)->first();
                                            $nilai = $penilaian ? $penilaian->nilai : null;

                                            // Score classification for styling
                                            $scoreClass = 'score-empty';
                                            if ($nilai !== null) {
                                                if ($nilai >= 80)
                                                    $scoreClass = 'score-excellent';
                                                elseif ($nilai >= 70)
                                                    $scoreClass = 'score-good';
                                                elseif ($nilai >= 60)
                                                    $scoreClass = 'score-average';
                                                elseif ($nilai > 0)
                                                    $scoreClass = 'score-poor';
                                            }
                                        @endphp
                                        <span class="score-value {{ $scoreClass }}">
                                            {{ $nilai ?? '-' }}
                                        </span>
                                    </td>
                                @endforeach
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.penilaian.edit', $alternatif->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit Penilaian">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.penilaian.destroy', $alternatif->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                title="Hapus Semua Penilaian"
                                                onclick="confirmDelete('{{ $alternatif->nama }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($kriterias) + 4 }}" class="text-center">
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <h5>Belum Ada Data Penilaian</h5>
                                        <p class="mb-3">Silakan tambahkan penilaian untuk alternatif yang tersedia</p>
                                        <a href="{{ route('admin.penilaian.create') }}" class="btn-enhanced btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Penilaian Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- SweetAlert2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- DataTables JS & CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    {{-- ========================================================== --}}
    {{-- PENAMBAHAN: CSS & JS untuk Ekstensi FixedColumns --}}
    {{-- ========================================================== --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                "dom": '<"dataTables_wrapper"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>><"table-responsive"t><"dataTables_wrapper"<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                "responsive": false, // Responsive harus false saat menggunakan scrollX
                "scrollX": true,
                
                // ==========================================================
                // PENAMBAHAN: Konfigurasi FixedColumns
                // ==========================================================
                "fixedColumns": {
                    "left": 3,  // Jumlah kolom yang di-pin di kiri (No, Kode, Nama Alternatif)
                    "right": 1 // Jumlah kolom yang di-pin di kanan (Aksi)
                },

                // ==========================================================
                // DISABLE SEMUA SORTING
                // ==========================================================
                "ordering": false, // Disable semua sorting functionality

                // Tambahkan ini agar lebar tabel menyesuaikan
                "scrollCollapse": true,
            });
        });

        // Enhanced delete confirmation function
        function confirmDelete(alternatifNama) {
            // Simpan referensi form sebelum preventDefault
            const form = event.target.closest('form');
            event.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `
                    <div style="text-align: left;">
                        <p>Apakah Anda yakin ingin menghapus <strong>semua penilaian</strong> untuk alternatif:</p>
                        <div style="background: #fef2f2; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #ef4444;">
                            <strong style="color: #dc2626;">${alternatifNama}</strong>
                        </div>
                        <p class="text-danger"><strong>Semua data nilai untuk alternatif ini akan hilang dan tidak dapat dibatalkan!</strong></p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tambah loading pada button delete
                    const deleteBtn = event.target.closest('button');
                    if (deleteBtn) {
                        deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...';
                        deleteBtn.disabled = true;
                        deleteBtn.classList.add('btn-loading');
                    }
                    
                    // Submit form yang sudah disimpan
                    if (form) {
                        form.submit();
                    }
                }
            });

            return false;
        }

        // Success notification
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
        @endif

        // Error notification
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
@endsection