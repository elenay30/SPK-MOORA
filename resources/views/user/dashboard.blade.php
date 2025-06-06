@extends('layouts.app')

@section('title', 'User Dashboard')

@section('styles')
<style>
    /* Dashboard specific enhancements */
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: 20px;
        color: white;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(161, 98, 7, 0.2);
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .dashboard-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 0.5rem;
        position: relative;
        z-index: 2;
    }

    /* Enhanced stat cards */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        height: 100%;
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
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
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

    .stat-card.danger::before {
        background: linear-gradient(to bottom, #dc2626, #ef4444);
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

    .stat-icon.danger {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        color: white;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.7;
        margin: 0;
    }

    /* Enhanced content cards */
    .content-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .content-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.12);
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
    }

    .content-card-body {
        padding: 2rem;
    }

    /* Enhanced table */
    .enhanced-table {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
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
    }

    .enhanced-table tbody td {
        padding: 1rem 1.25rem;
        border-color: #f1f5f9;
        vertical-align: middle;
    }

    .enhanced-table tbody tr {
        transition: all 0.2s ease;
    }

    .enhanced-table tbody tr:hover {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        transform: scale(1.01);
    }

    /* Enhanced buttons */
    .btn-enhanced {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: none;
    }

    .btn-enhanced:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .btn-enhanced.btn-success {
        background: linear-gradient(135deg, #059669, #10b981);
    }

    .btn-enhanced.btn-primary {
        background: var(--gradient);
    }

    .btn-enhanced.btn-info {
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
    }

    /* Top alternatives styling */
    .top-alternatives-card {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        border-radius: 20px;
        padding: 2rem;
        border-left: 4px solid var(--primary);
        margin-bottom: 2rem;
    }

    .top-item {
        background: white;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 15px rgba(161, 98, 7, 0.1);
        transition: all 0.3s ease;
        border: none;
    }

    .top-item:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 25px rgba(161, 98, 7, 0.15);
    }

    .rank-badge {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        margin-right: 1rem;
    }

    .rank-badge.rank-1 {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
    }

    .rank-badge.rank-2 {
        background: linear-gradient(135deg, #64748b, #94a3b8);
        color: white;
    }

    .rank-badge.rank-3 {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        color: white;
    }

    .score-badge {
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* About section styling */
    .about-section {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        border-radius: 20px;
        padding: 2rem;
        border-left: 4px solid var(--primary);
    }

    .about-title {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .about-text {
        color: var(--text-dark);
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    .steps-list {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        box-shadow: 0 4px 15px rgba(161, 98, 7, 0.1);
    }

    .steps-list ol {
        margin: 0;
        padding-left: 1.5rem;
    }

    .steps-list li {
        padding: 0.5rem 0;
        color: var(--text-dark);
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .steps-list li:hover {
        color: var(--primary);
        transform: translateX(5px);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem;
        }

        .dashboard-title {
            font-size: 2rem;
        }

        .stat-card {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .content-card-body {
            padding: 1.5rem;
        }

        .top-alternatives-card {
            padding: 1.5rem;
        }
    }

    /* Loading animation for stat numbers */
    .stat-number {
        animation: countUp 1s ease-out;
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

    /* Staggered animation for cards */
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }

    .stat-card {
        animation: slideInUp 0.6s ease-out both;
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
</style>
@endsection

@section('content')
<!-- Enhanced Dashboard Header -->
<div class="dashboard-header">
    <h1 class="dashboard-title">👋 Dashboard User</h1>
    <p class="dashboard-subtitle">Akses informasi dan kelola perhitungan SPK dengan mudah</p>
</div>

<!-- Enhanced Statistics Cards -->
<div class="row mb-5">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="stat-number">{{ $totalAlternatifs }}</div>
            <p class="stat-label">Total Alternatif</p>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card warning">
            <div class="stat-icon warning">
                <i class="fas fa-list-ul"></i>
            </div>
            <div class="stat-number">{{ $totalKriterias }}</div>
            <p class="stat-label">Total Kriteria</p>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card danger">
            <div class="stat-icon danger">
                <i class="fas fa-calculator"></i>
            </div>
            <div class="stat-number">{{ $userPerhitungans }}</div>
            <p class="stat-label">Perhitungan Anda</p>
        </div>
    </div>
</div>

<!-- Enhanced Content Section -->
<div class="row">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="content-card-header">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <h3 class="content-card-title">
                        📊 Perhitungan Terakhir Anda
                    </h3>
                    <div>
                        <a href="{{ route('user.perhitungan.create') }}" class="btn btn-enhanced btn-success btn-sm">
                            <i class="fas fa-plus me-2"></i>Perhitungan Baru
                        </a>
                        <a href="{{ route('user.perhitungan.index') }}" class="btn btn-enhanced btn-primary btn-sm">
                            <i class="fas fa-arrow-right me-2"></i>Lihat Semua
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-card-body">
                <div class="table-responsive">
                    <table class="table enhanced-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-file-alt me-2"></i>Nama Perhitungan</th>
                                <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                                <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestPerhitungans as $perhitungan)
                            <tr>
                                <td>
                                    <strong>{{ $perhitungan->nama_perhitungan }}</strong>
                                </td>
                                <td>
                                    <div class="text-muted small">
                                        {{ $perhitungan->created_at->setTimezone('Asia/Jakarta')->format('d M Y') }}
                                    </div>
                                    <div class="text-primary small">
                                        {{ $perhitungan->created_at->setTimezone('Asia/Jakarta')->format('H:i') }} WIB
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('user.perhitungan.show', $perhitungan->id) }}" 
                                       class="btn btn-enhanced btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                        <p class="mb-0">Anda belum memiliki perhitungan</p>
                                        <small>Buat perhitungan pertama Anda dengan menekan tombol "Perhitungan Baru"</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        @if (count($topAlternatifs) > 0)
        <div class="content-card mb-4">
            <div class="content-card-header">
                <h3 class="content-card-title">
                    🏆 Top 3 Karyawan Terbaik
                </h3>
            </div>
            <div class="content-card-body">
                @foreach ($topAlternatifs as $index => $alternatif)
                <div class="top-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="rank-badge rank-{{ $index + 1 }}">{{ $index + 1 }}</div>
                        <div>
                            <strong>{{ $alternatif['kode'] }}</strong>
                            <div class="text-muted small">{{ $alternatif['nama'] }}</div>
                        </div>
                    </div>
                    <span class="score-badge">{{ number_format($alternatif['nilai_optimasi'], 5) }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="content-card">
            <div class="content-card-header">
                <h3 class="content-card-title">
                    💡 Tentang SPK
                </h3>
            </div>
            <div class="content-card-body">
                <div class="about-section">
                    <p class="about-text">
                        <strong>Sistem Pendukung Keputusan (SPK)</strong> pemilihan karyawan terbaik parking area menggunakan metode 
                        <span class="text-primary font-weight-bold">MOORA</span> 
                        (Multi-Objective Optimization on the basis of Ratio Analysis).
                    </p>
                    
                    <p class="about-text">
                        MOORA adalah metode yang memiliki perhitungan dengan kalkulasi yang minimum dan sangat sederhana. 
                        Metode ini memiliki tingkat selektifitas yang baik dalam menentukan suatu alternatif.
                    </p>
                    
                    <div class="steps-list">
                        <h6 class="about-title mb-3">
                            <i class="fas fa-rocket me-2"></i>Langkah menggunakan sistem:
                        </h6>
                        <ol>
                            <li><i class="fas fa-list me-2 text-primary"></i>Lihat data kriteria dan sub kriteria</li>
                            <li><i class="fas fa-users me-2 text-success"></i>Lihat data alternatif</li>
                            <li><i class="fas fa-calculator me-2 text-warning"></i>Lakukan perhitungan dengan metode MOORA</li>
                            <li><i class="fas fa-trophy me-2 text-danger"></i>Lihat hasil perangkingan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection