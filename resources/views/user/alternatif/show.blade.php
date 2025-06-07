@extends('layouts.app')

@section('title', 'Detail Alternatif')

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
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin-top: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        backdrop-filter: blur(10px);
        font-size: 0.9rem;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border-color: rgba(255, 255, 255, 0.5);
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
        animation: slideInUp 0.6s ease-out both;
    }

    .content-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    .content-card:nth-child(2) {
        animation-delay: 0.1s;
    }

    .content-card:nth-child(3) {
        animation-delay: 0.2s;
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
        gap: 0.5rem;
    }

    .content-card-body {
        padding: 2rem;
    }

    /* Enhanced info table */
    .info-table {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 0;
    }

    .info-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-table tbody tr:hover {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
    }

    .info-table tbody th {
        background: linear-gradient(135deg, var(--brown-light) 0%, #fef3c7 100%);
        font-weight: 600;
        color: var(--text-dark);
        padding: 1rem 1.25rem;
        border: none;
        font-size: 0.9rem;
        width: 30%;
        vertical-align: middle;
    }

    .info-table tbody td {
        padding: 1rem 1.25rem;
        border: none;
        vertical-align: middle;
        font-weight: 500;
        color: var(--primary);
    }

    /* Enhanced main table */
    .enhanced-table {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 0;
    }

    .enhanced-table thead th {
        background: linear-gradient(135deg, var(--brown-light) 0%, #fef3c7 100%);
        font-weight: 600;
        color: var(--text-dark);
        padding: 1rem 1.25rem;
        border: none;
        font-size: 0.9rem;
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
        height: 2px;
        background: var(--gradient);
        opacity: 0.3;
    }

    .enhanced-table tbody td {
        padding: 1rem 1.25rem;
        border-color: #f1f5f9;
        vertical-align: middle;
        transition: all 0.2s ease;
    }

    .enhanced-table tbody tr {
        transition: all 0.2s ease;
    }

    .enhanced-table tbody tr:hover {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        transform: scale(1.005);
    }

    .enhanced-table tbody tr:hover td {
        color: var(--primary);
        font-weight: 500;
    }

    /* Number badges */
    .number-badge {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Kode badges */
    .kode-badge {
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Value badges for nilai */
    .nilai-badge {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        min-width: 50px;
        text-align: center;
        display: inline-block;
    }

    .nilai-badge.empty {
        background: linear-gradient(135deg, #64748b, #94a3b8);
    }

    /* Employee info styling */
    .employee-info {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border-left: 5px solid var(--primary);
        position: relative;
        overflow: hidden;
    }

    .employee-info::before {
        content: '👤';
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 3rem;
        opacity: 0.1;
    }

    .employee-avatar {
        width: 80px;
        height: 80px;
        background: var(--gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin-right: 1.5rem;
        box-shadow: 0 8px 25px rgba(161, 98, 7, 0.3);
    }

    .employee-details h3 {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .employee-details p {
        color: var(--text-light);
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    /* Alert info styling */
    .alert-enhanced {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border: none;
        border-radius: 15px;
        padding: 1.25rem;
        margin-bottom: 2rem;
        border-left: 4px solid #3b82f6;
    }

    .alert-enhanced .alert-icon {
        background: #3b82f6;
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.8rem;
            flex-direction: column;
            align-items: flex-start;
        }

        .content-card-body {
            padding: 1.5rem;
        }

        .employee-info {
            padding: 1.5rem;
        }

        .employee-avatar {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .employee-details h3 {
            font-size: 1.25rem;
        }

        .enhanced-table thead th,
        .enhanced-table tbody td,
        .info-table tbody th,
        .info-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }
    }

    /* Loading state */
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        border-radius: 20px;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endsection

@section('content')
<!-- Enhanced Page Header -->
<div class="page-header">
    <div class="page-title">
        <div>
            <h1 style="margin: 0; font-size: inherit;">📋 Detail Alternatif: {{ $alternatif->kode }} - {{ $alternatif->nama }}</h1>
            <p class="page-subtitle">Informasi lengkap dan nilai kriteria karyawan</p>
        </div>
        <a href="{{ route('user.alternatif.index') }}" class="back-btn">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<!-- Employee Info Section -->
<div class="employee-info">
    <div class="d-flex align-items-center">
        <div class="employee-avatar">
            <i class="fas fa-user"></i>
        </div>
        <div class="employee-details">
            <h3>{{ $alternatif->nama }}</h3>
            <p><strong>Kode Alternatif:</strong> {{ $alternatif->kode }}</p>
            <p><strong>Status:</strong> <span class="kode-badge">Aktif</span></p>
        </div>
    </div>
</div>

<!-- Enhanced Information Card -->
<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">
            <i class="fas fa-info-circle"></i>
            Informasi Alternatif
        </h3>
    </div>
    <div class="content-card-body">
        <div class="table-responsive">
            <table class="table info-table">
                <tbody>
                    <tr>
                        <th><i class="fas fa-code me-2"></i>Kode</th>
                        <td><span class="kode-badge">{{ $alternatif->kode }}</span></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-user me-2"></i>Nama Karyawan</th>
                        <td><strong>{{ $alternatif->nama }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Enhanced Kriteria Values Card -->
<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">
            <i class="fas fa-star"></i>
            Nilai Kriteria Penilaian
        </h3>
    </div>
    <div class="content-card-body">
        <div class="alert-enhanced d-flex align-items-center mb-4">
            <div class="alert-icon">
                <i class="fas fa-info"></i>
            </div>
            <div>
                <strong>Informasi:</strong> Berikut adalah nilai penilaian karyawan berdasarkan setiap kriteria yang telah ditetapkan dalam sistem.
            </div>
        </div>

        <div class="table-responsive">
            <table class="table enhanced-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hash me-2"></i>No</th>
                        <th><i class="fas fa-code me-2"></i>Kode Kriteria</th>
                        <th><i class="fas fa-list-ul me-2"></i>Nama Kriteria</th>
                        <th><i class="fas fa-star me-2"></i>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriterias as $kriteria)
                    <tr>
                        <td>
                            <div class="number-badge">{{ $loop->iteration }}</div>
                        </td>
                        <td>
                            <span class="kode-badge">{{ $kriteria->kode }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 35px; height: 35px;">
                                        <i class="fas fa-clipboard-list text-white" style="font-size: 0.8rem;"></i>
                                    </div>
                                </div>
                                <div>
                                    <strong>{{ $kriteria->nama }}</strong>
                                    <div class="text-muted small">Kriteria ID: {{ $kriteria->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                $penilaian = $alternatif->penilaians->where('kriteria_id', $kriteria->id)->first();
                                $nilai = $penilaian ? $penilaian->nilai : '-';
                                $keterangan = '';
                                
                                // Jika kriteria memiliki sub kriteria, tampilkan keterangan
                                if ($nilai != '-' && $kriteria->subKriterias->count() > 0) {
                                    $subKriteria = $kriteria->subKriterias->where('nilai', $nilai)->first();
                                    if ($subKriteria) {
                                        $keterangan = ' (' . $subKriteria->keterangan . ')';
                                    }
                                }
                            @endphp
                            @if($nilai != '-')
                                <span class="nilai-badge">{{ $nilai }}{{ $keterangan }}</span>
                            @else
                                <span class="nilai-badge empty">{{ $nilai }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Add loading state for better UX
        $('.content-card').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
        });

        // Enhanced hover effects for badges
        $('.kode-badge, .nilai-badge').hover(
            function() {
                $(this).addClass('animate__animated animate__pulse');
            },
            function() {
                $(this).removeClass('animate__animated animate__pulse');
            }
        );

        // Add tooltips if needed
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Smooth scroll for any internal links
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
            }
        });
    });
</script>
@endsection