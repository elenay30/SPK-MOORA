@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('styles')
    <style>
        /* CSS DIPERBAIKI - BORDERLESS DESIGN KONSISTEN */

        /* Enhanced page header */
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
            /* Tidak perlu border untuk header */
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 2;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
            position: relative;
            z-index: 2;
        }

        /* Enhanced content cards - HILANGKAN BORDER UTAMA */
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none !important;
            /* HILANGKAN BORDER CARD */
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .content-card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.5rem 2rem;
            border-bottom: 2px solid #e2e8f0 !important;
            /* PERTAHANKAN BORDER BAWAH HEADER */
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
        }

        .content-card-body {
            padding: 2rem;
            border: none !important;
            /* Hilangkan border body */
        }

        /* Enhanced table - BORDERLESS DESIGN */
        .enhanced-table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: none !important;
            /* Hilangkan shadow karena sudah ada di parent */
            border: none !important;
            /* HILANGKAN BORDER TABEL */
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin: 0;
        }

        .enhanced-table thead th {
            background: linear-gradient(135deg, var(--brown-light) 0%, #fef3c7 100%);
            font-weight: 600;
            color: var(--text-dark);
            padding: 1rem 1.25rem;
            border: none !important;
            /* HILANGKAN BORDER HEADER */
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            vertical-align: middle;
        }

        .enhanced-table thead th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient);
            opacity: 0.7;
        }

        .enhanced-table tbody td {
            padding: 1rem 1.25rem;
            border: none !important;
            /* HILANGKAN SEMUA BORDER CELL */
            vertical-align: middle;
            transition: all 0.2s ease;
        }

        /* Gunakan background stripe sebagai pengganti garis */
        .enhanced-table tbody tr:nth-child(even) {
            background: rgba(249, 250, 251, 0.3);
            /* Stripe sangat halus */
        }

        .enhanced-table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.02) !important;
            /* Garis pemisah sangat tipis */
        }

        .enhanced-table tbody tr:hover {
            background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.1);
        }

        .enhanced-table tbody tr:last-child {
            border-bottom: none !important;
            /* Hilangkan border row terakhir */
        }

        .enhanced-table tbody tr:last-child td {
            border-bottom: none !important;
        }

        /* Enhanced badges - PERTAHANKAN STYLING */
        .enhanced-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            border: none !important;
            /* Badge tidak perlu border */
        }

        .enhanced-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .enhanced-badge:hover::before {
            left: 100%;
        }

        .enhanced-badge.success {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
        }

        .enhanced-badge.danger {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
        }

        /* Enhanced buttons - PERTAHANKAN BORDER */
        .btn-enhanced {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid transparent !important;
            /* Border transparan untuk buttons */
            position: relative;
            overflow: hidden;
        }

        .btn-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.3s ease;
        }

        .btn-enhanced:hover::before {
            left: 100%;
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
            border-color: #0284c7 !important;
        }

        .btn-enhanced.btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Keterangan section styling - PERTAHANKAN BORDER ACCENT */
        .info-section {
            background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
            border-radius: 20px;
            padding: 0;
            border-left: 4px solid var(--primary) !important;
            /* PERTAHANKAN BORDER ACCENT */
            margin-bottom: 2rem;
            border-top: 1px solid rgba(161, 98, 7, 0.1) !important;
            border-right: 1px solid rgba(161, 98, 7, 0.1) !important;
            border-bottom: 1px solid rgba(161, 98, 7, 0.1) !important;
            box-shadow: 0 4px 15px rgba(161, 98, 7, 0.05);
        }

        .info-content {
            padding: 2rem;
        }

        .info-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .info-list {
            margin: 0;
            padding-left: 1.5rem;
        }

        .info-list li {
            padding: 0.5rem 0;
            color: var(--text-dark);
            line-height: 1.6;
            transition: all 0.2s ease;
            border: none;
            /* List items tidak perlu border */
        }

        .info-list li:hover {
            color: var(--primary);
            transform: translateX(5px);
        }

        .info-list strong {
            color: var(--primary);
        }

        .info-text {
            color: var(--text-dark);
            line-height: 1.7;
            margin: 0;
        }

        /* Row number styling - HILANGKAN BORDER */
        .row-number {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            border: none !important;
            /* Badge tidak perlu border */
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
        }

        /* Code badge styling - HILANGKAN BORDER */
        .code-badge {
            background: linear-gradient(135deg, #64748b, #94a3b8);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            border: none !important;
            /* Badge tidak perlu border */
            box-shadow: 0 2px 6px rgba(100, 116, 139, 0.3);
        }

        /* Weight display - HILANGKAN BORDER */
        .weight-display {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 700;
            text-align: center;
            min-width: 60px;
            border: none !important;
            /* Badge tidak perlu border */
            box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3);
        }

        /* Table responsive container - HILANGKAN BORDER */
        .table-responsive {
            border: none !important;
            /* HILANGKAN BORDER CONTAINER */
            border-radius: 0;
            /* Tidak perlu radius karena mengikuti card */
            overflow: hidden;
            background: white;
            box-shadow: none !important;
            /* Hilangkan shadow karena sudah ada di card */
            margin: 0;
            padding: 0;
            /* Hilangkan padding yang bisa menyebabkan gap */
        }

        .table-responsive .enhanced-table {
            border: none !important;
            margin-bottom: 0;
            border-radius: 0;
            /* Mengikuti container */
        }

        /* DataTable styling enhancements - PERTAHANKAN BORDER FORM ELEMENTS */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 1rem 0;
            border: none;
            /* Wrapper tidak perlu border */
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 2px solid #e2e8f0 !important;
            /* PERTAHANKAN BORDER FORM ELEMENTS */
            padding: 0.5rem;
            transition: all 0.3s ease;
            background: white;
        }

        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(161, 98, 7, 0.25);
            outline: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            margin: 0 2px;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0 !important;
            /* PERTAHANKAN BORDER PAGINATION */
            background: white !important;
            color: #374151 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f8f9fa !important;
            border-color: var(--primary) !important;
            color: var(--primary) !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(161, 98, 7, 0.15);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--gradient) !important;
            border: 1px solid var(--primary) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, #92400e 0%, #a16207 100%) !important;
            border-color: #92400e !important;
            color: white !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.4);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #9ca3af !important;
            cursor: not-allowed !important;
            opacity: 0.6 !important;
            background: #f9fafb !important;
            border-color: #e5e7eb !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background: #f9fafb !important;
            border-color: #e5e7eb !important;
            color: #9ca3af !important;
            transform: none !important;
            box-shadow: none !important;
        }

        /* DataTable wrapper styling - pastikan tidak ada border tambahan */
        .dataTables_wrapper {
            border: none !important;
            background: transparent;
            padding: 1.5rem;
            /* Padding hanya di wrapper, bukan di table */
        }

        /* Pastikan tidak ada elemen yang membuat border tambahan */
        .dataTables_wrapper>div {
            border: none !important;
        }

        .dataTables_wrapper .row {
            border: none !important;
        }

        .dataTables_wrapper .col-sm-12 {
            border: none !important;
        }

        /* DataTable Info styling */
        .dataTables_wrapper .dataTables_info {
            color: #6b7280;
            font-size: 0.9rem;
            margin-top: 1.5rem;
            border: none;
            float: left;
            font-weight: 500;
            padding: 0.75rem 0;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1.5rem;
            border: none;
            float: right;
        }

        /* Clearfix untuk footer DataTable */
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 0.75rem;
        }

        .dataTables_wrapper::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
                text-align: center;
            }

            .page-title {
                font-size: 2rem;
            }

            .content-card-body {
                padding: 1.5rem;
            }

            .content-card-header {
                padding: 1.25rem 1.5rem;
            }

            .info-content {
                padding: 1.5rem;
            }

            .enhanced-table thead th,
            .enhanced-table tbody td {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
            }

            .row-number {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }

            .code-badge,
            .weight-display {
                padding: 0.3rem 0.6rem;
                font-size: 0.8rem;
                min-width: 50px;
            }

            /* PERBAIKAN RESPONSIVE UNTUK DATATABLES */
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
                padding: 0.4rem 0.6rem !important;
                margin: 0.1rem !important;
                font-size: 0.8rem !important;
                min-width: 35px;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.75rem;
            }

            .content-card-title {
                font-size: 1.1rem;
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .enhanced-table {
                font-size: 0.8rem;
            }

            .enhanced-table thead th {
                padding: 0.6rem 0.4rem;
                font-size: 0.75rem;
            }

            .enhanced-table tbody td {
                padding: 0.6rem 0.4rem;
            }

            .btn-enhanced {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }

            .enhanced-badge {
                padding: 0.4rem 0.8rem;
                font-size: 0.75rem;
            }

            /* EXTRA SMALL SCREEN ADJUSTMENTS */
            .dataTables_wrapper .dataTables_filter input {
                max-width: 250px;
                font-size: 0.85rem;
            }

            .dataTables_wrapper .dataTables_info {
                font-size: 0.8rem;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.3rem 0.5rem !important;
                font-size: 0.75rem !important;
                min-width: 30px;
            }
        }

        /* Animation for page load */
        .content-card {
            animation: slideInUp 0.6s ease-out both;
        }

        .content-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .content-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .content-card:nth-child(3) {
            animation-delay: 0.3s;
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

        /* Enhanced hover effects untuk mobile touch */
        @media (hover: none) and (pointer: coarse) {

            .enhanced-table tbody tr:hover,
            .content-card:hover,
            .info-list li:hover {
                transform: none;
                box-shadow: inherit;
                background: inherit;
                color: inherit;
            }
        }

        /* PERBAIKAN: Pastikan tidak ada border yang tidak perlu */
        .content-card .content-card-body,
        .table-responsive,
        .enhanced-table {
            border-bottom: none !important;
            box-shadow: none !important;
            margin-bottom: 0 !important;
        }

        /* Prevent any flash effects */
        html,
        body {
            transition: none !important;
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <h1 class="page-title">📋 Daftar Kriteria</h1>
        <p class="page-subtitle">Kelola dan lihat kriteria penilaian karyawan terbaik dengan sistem yang terintegrasi</p>
    </div>

    <!-- Enhanced Main Content Card -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-list-ul me-3" style="color: var(--primary);"></i>
                Kriteria Penilaian Karyawan Terbaik
            </h3>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th><i class="fas fa-tag me-2"></i>Nama</th>
                            <th><i class="fas fa-weight-hanging me-2"></i>Bobot</th>
                            <th><i class="fas fa-chart-line me-2"></i>Jenis</th>
                            <th><i class="fas fa-cogs me-2"></i>Sub-Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriterias as $kriteria)
                            <tr>
                                <td>
                                    <div class="row-number">{{ $loop->iteration }}</div>
                                </td>
                                <td>
                                    <span class="code-badge">{{ $kriteria->kode }}</span>
                                </td>
                                <td>
                                    <strong style="color: var(--text-dark);">{{ $kriteria->nama }}</strong>
                                </td>
                                <td>
                                    <span class="weight-display">{{ $kriteria->bobot }}</span>
                                </td>
                                <td>
                                    @if ($kriteria->jenis == 'benefit')
                                        <span class="enhanced-badge success">
                                            <i class="fas fa-arrow-up me-1"></i>Benefit
                                        </span>
                                    @else
                                        <span class="enhanced-badge danger">
                                            <i class="fas fa-arrow-down me-1"></i>Cost
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.kriteria.show', $kriteria->id) }}"
                                        class="btn btn-enhanced btn-info btn-sm">
                                        <i class="fas fa-eye me-1"></i>Lihat Sub-Kriteria
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Enhanced Information Card -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-info-circle me-3" style="color: var(--primary);"></i>
                Keterangan & Panduan
            </h3>
        </div>
        <div class="content-card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="info-section">
                        <div class="info-content">
                            <h5 class="info-title">
                                <i class="fas fa-chart-bar me-2"></i>Jenis Kriteria
                            </h5>
                            <ul class="info-list">
                                <li>
                                    <i class="fas fa-arrow-up text-success me-2"></i>
                                    <strong>Benefit</strong>: Kriteria yang nilainya semakin tinggi semakin baik
                                    <small class="d-block text-muted mt-1">Contoh: Kinerja, Kehadiran, Prestasi</small>
                                </li>
                                <li>
                                    <i class="fas fa-arrow-down text-danger me-2"></i>
                                    <strong>Cost</strong>: Kriteria yang nilainya semakin rendah semakin baik
                                    <small class="d-block text-muted mt-1">Contoh: Jumlah Pelanggaran, Absensi</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-section">
                        <div class="info-content">
                            <h5 class="info-title">
                                <i class="fas fa-balance-scale me-2"></i>Bobot Kriteria
                            </h5>
                            <p class="info-text">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Bobot menyatakan tingkat kepentingan suatu kriteria relatif terhadap kriteria lainnya.
                                <strong>Jumlah total bobot semua kriteria adalah 1</strong> untuk memastikan perhitungan
                                yang akurat dalam metode MOORA.
                            </p>
                            <div class="mt-3 p-3" style="background: rgba(161, 98, 7, 0.1); border-radius: 10px;">
                                <small class="text-muted">
                                    <i class="fas fa-calculator me-1"></i>
                                    Semakin tinggi bobot, semakin berpengaruh kriteria tersebut dalam hasil akhir
                                    perhitungan.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Initialize DataTable with enhanced styling
            $('#dataTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Semua"]
                ],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "responsive": true,
                "autoWidth": false
            });

            // Add loading animation
            $('table tbody tr').each(function (index) {
                $(this).css('animation-delay', (index * 0.05) + 's');
                $(this).addClass('animate-fade-in');
            });
        });

        // Add CSS for fade-in animation
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                .animate-fade-in {
                    animation: fadeInUp 0.5s ease-out both;
                }

                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `)
            .appendTo('head');
    </script>
@endsection