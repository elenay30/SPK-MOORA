@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('styles')
<style>
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

    /* Enhanced content cards */
    .content-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: none;
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
        border-bottom: 2px solid #e2e8f0;
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
    }

    /* Enhanced table */
    .enhanced-table {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .enhanced-table thead th {
        background: linear-gradient(135deg, var(--brown-light) 0%, #fef3c7 100%);
        font-weight: 600;
        color: var(--text-dark);
        padding: 1rem 1.25rem;
        border: none;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
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
        border-color: #f1f5f9;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .enhanced-table tbody tr {
        transition: all 0.2s ease;
    }

    .enhanced-table tbody tr:hover {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        transform: scale(1.01);
    }

    .enhanced-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Enhanced badges */
    .enhanced-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
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
    }

    .enhanced-badge.danger {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        color: white;
    }

    /* Enhanced buttons */
    .btn-enhanced {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
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
    }

    .btn-enhanced.btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }

    /* Keterangan section styling */
    .info-section {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        border-radius: 20px;
        padding: 0;
        border-left: 4px solid var(--primary);
        margin-bottom: 2rem;
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

    /* Row number styling */
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
    }

    /* Code badge styling */
    .code-badge {
        background: linear-gradient(135deg, #64748b, #94a3b8);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
    }

    /* Weight display */
    .weight-display {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 700;
        text-align: center;
        min-width: 60px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 2rem;
        }

        .content-card-body {
            padding: 1.5rem;
        }

        .info-content {
            padding: 1.5rem;
        }

        .enhanced-table thead th,
        .enhanced-table tbody td {
            padding: 0.75rem;
            font-size: 0.9rem;
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

    /* DataTable styling enhancements */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding: 1rem 0;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 2px solid #e2e8f0;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_length select:focus,
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(161, 98, 7, 0.25);
        outline: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--gradient) !important;
        border: none !important;
        color: white !important;
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
                            <strong>Jumlah total bobot semua kriteria adalah 1</strong> untuk memastikan perhitungan yang akurat dalam metode MOORA.
                        </p>
                        <div class="mt-3 p-3" style="background: rgba(161, 98, 7, 0.1); border-radius: 10px;">
                            <small class="text-muted">
                                <i class="fas fa-calculator me-1"></i>
                                Semakin tinggi bobot, semakin berpengaruh kriteria tersebut dalam hasil akhir perhitungan.
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
    $(document).ready(function() {
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
        $('table tbody tr').each(function(index) {
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