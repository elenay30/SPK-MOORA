@extends('layouts.app')

@section('title', 'Perhitungan MOORA')

@section('styles')
<style>
    /* CSS HALAMAN PERHITUNGAN - DISAMAKAN DENGAN KRITERIA DAN USER */

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

    /* Stats Cards - Dengan hover effect seperti dashboard */
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: none !important;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, var(--primary), var(--secondary));
        transition: transform 0.3s ease;
        transform: scaleY(0);
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .stats-card:hover::before {
        transform: scaleY(1);
    }

    /* Icon styling seperti dashboard */
    .stats-icon {
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
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
    }

    .stats-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        background: inherit;
        opacity: 0.1;
        border-radius: inherit;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: var(--primary);
        display: block;
        line-height: 1;
        animation: countUp 1s ease-out;
    }

    .stats-label {
        color: #6b7280;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
        display: block;
        opacity: 0.7;
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

    /* Staggered animation untuk cards */
    .stats-card:nth-child(1) { animation-delay: 0.1s; }
    .stats-card:nth-child(2) { animation-delay: 0.2s; }

    .stats-card {
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

    /* Section Title */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .section-title {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 600;
        color: #495057;
        display: flex;
        align-items: center;
    }

    /* Row Number Badge */
    .row-number {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
        transition: all 0.3s ease;
    }

    .enhanced-table tbody tr:hover .row-number {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(161, 98, 7, 0.4);
    }

    /* Calculation Name */
    .calc-name {
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 5px;
        text-align: center;
        font-size: 0.95rem;
    }

    .user-tag {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        color: #4b5563;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        display: inline-block;
        margin-top: 3px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .enhanced-table tbody tr:hover .user-tag {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(161, 98, 7, 0.3);
    }

    /* Date Badge */
    .date-badge {
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
    }

    .enhanced-table tbody tr:hover .date-badge {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.4);
    }

    /* Enhanced Action Buttons */
    .action-group {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        align-items: center;
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
        font-size: 0.9rem;
        font-weight: 500;
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

    .btn-view {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
    }

    .btn-view:hover {
        background: linear-gradient(135deg, #0284c7 0%, #0891b2 100%);
        color: white;
        text-decoration: none;
    }

    .btn-remove {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .btn-remove:hover {
        background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
        color: white;
    }

    /* Enhanced Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6b7280;
    }

    .empty-state .icon {
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

    /* Enhanced Modal */
    .modal-form .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .modal-form .modal-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        border: none;
        border-radius: 15px 15px 0 0;
        padding: 20px 25px;
    }

    .modal-form .modal-title {
        font-weight: 600;
        font-size: 1.2rem;
        margin: 0;
    }

    .modal-form .modal-body {
        padding: 25px;
    }

    .modal-form .modal-footer {
        border: none;
        padding: 15px 25px;
        background: #f8f9fa;
        border-radius: 0 0 15px 15px;
    }

    /* Enhanced Form Elements */
    .input-field {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .input-field:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(161, 98, 7, 0.15);
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #92400e 0%, #a16207 100%);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(161, 98, 7, 0.3);
    }

    .btn-secondary-custom {
        background: #6c757d;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-secondary-custom:hover {
        background: #5a6268;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    .info-notice {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        color: #495057;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border-left: 4px solid #17a2b8;
    }

    /* Button Loading State */
    .btn-loading {
        position: relative;
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: loading-shine 1.5s infinite;
    }

    @keyframes loading-shine {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    /* Form Loading State */
    .form-loading {
        opacity: 0.7;
        pointer-events: none;
        transition: opacity 0.3s ease;
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

    /* Responsive Design */
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

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .enhanced-table thead th,
        .enhanced-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }

        .action-group {
            flex-direction: column;
            gap: 0.25rem;
        }

        .action-btn {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }

        .stats-card {
            margin-bottom: 1rem;
            padding: 1.5rem;
        }

        .stats-number {
            font-size: 2rem;
        }

        .stats-card:hover {
            transform: translateY(-2px);
        }

        .enhanced-table tbody tr:hover {
            transform: translateY(-1px);
        }
    }

    @media (max-width: 576px) {
        .content-card-header {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
            padding: 1rem 1.5rem;
        }

        .stats-card:hover,
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
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="page-title">🧮 Perhitungan MOORA</h1>
                <p class="page-subtitle mb-0">Sistem Pendukung Keputusan - Multi-Objective Optimization by Ratio Analysis</p>
            </div>
            <button type="button" class="btn-enhanced btn-success" data-bs-toggle="modal" data-bs-target="#perhitunganModal">
                <i class="fas fa-plus me-2"></i>Hitung Baru
            </button>
        </div>
    </div>

    <!-- Stats Section -->
    @if (count($hasilPerhitungans) > 0)
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div class="stats-number">{{ count($hasilPerhitungans) }}</div>
                    <div class="stats-label">Total Perhitungan</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stats-number">
                        {{ $hasilPerhitungans->last()->created_at->setTimezone('Asia/Jakarta')->format('M Y') }}
                    </div>
                    <div class="stats-label">Perhitungan Terbaru</div>
                </div>
            </div>
        </div>
    @endif

    <!-- Section Header -->
    <div class="section-header">
        <h5 class="section-title">
            <i class="fas fa-history me-2"></i>Riwayat Perhitungan
        </h5>
        <button type="button" class="btn btn-primary-custom d-md-none" data-bs-toggle="modal"
            data-bs-target="#perhitunganModal">
            <i class="fas fa-plus me-2"></i>Hitung Baru
        </button>
    </div>

    <!-- Enhanced Content Card -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-list"></i>
                Daftar Perhitungan MOORA
            </h3>
            <div style="font-size: 0.9rem; color: #6b7280;">
                Total: <strong>{{ count($hasilPerhitungans) }}</strong> perhitungan
            </div>
        </div>
        <div class="content-card-body">
            @if (count($hasilPerhitungans) > 0)
                <div class="table-responsive">
                    <table class="table enhanced-table">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>Nama Perhitungan</th>
                                <th style="width: 180px;">Tanggal</th>
                                <th style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Urutkan data dari yang lama ke yang baru (ascending) dengan indeks baru
                                $sortedHasilPerhitungans = $hasilPerhitungans->sortBy('created_at')->values();
                            @endphp
                            @foreach ($sortedHasilPerhitungans as $index => $hasil)
                                <tr>
                                    <td>
                                        <span class="row-number">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <div class="calc-name">{{ $hasil->nama_perhitungan }}</div>
                                        <span class="user-tag">
                                            <i class="fas fa-user me-1"></i>{{ $hasil->user->name ?? 'System' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="date-badge">
                                            {{ $hasil->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-group">
                                            <a href="{{ route('admin.perhitungan.show', $hasil->id) }}"
                                                class="action-btn btn-view" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.perhitungan.destroy', $hasil->id) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirmDelete('{{ $hasil->nama_perhitungan }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn btn-remove" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-calculator icon"></i>
                    <h5>Belum Ada Perhitungan</h5>
                    <p>Anda belum melakukan perhitungan MOORA. Klik tombol "Hitung Baru" untuk memulai.</p>
                    <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal"
                        data-bs-target="#perhitunganModal">
                        <i class="fas fa-plus me-2"></i>Mulai Perhitungan
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Perhitungan Baru -->
    <div class="modal fade modal-form" id="perhitunganModal" tabindex="-1" aria-labelledby="perhitunganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="perhitunganModalLabel">
                        <i class="fas fa-calculator me-2"></i>Perhitungan MOORA Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.perhitungan.calculate') }}" method="POST" id="formPerhitungan">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_perhitungan" class="form-label fw-bold">
                                <i class="fas fa-tag me-2"></i>Nama Perhitungan
                            </label>
                            <input type="text" class="input-field" id="nama_perhitungan" name="nama_perhitungan"
                                placeholder="Contoh: Evaluasi Karyawan Q2 2025" required>
                            <div class="form-text mt-2">
                                Berikan nama yang mendeskripsikan perhitungan ini untuk memudahkan identifikasi
                            </div>
                        </div>

                        <div class="info-notice">
                            <i class="fas fa-info-circle text-info"></i>
                            <div>
                                <strong>Informasi:</strong>
                                <p class="mb-0 mt-1">Sistem akan menggunakan data kriteria dan alternatif yang sudah
                                    tersimpan untuk melakukan perhitungan MOORA.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-primary-custom" id="btnHitung">
                            <i class="fas fa-calculator me-2"></i>Mulai Hitung
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Form submission dengan loading state yang smooth (tanpa overlay)
            $('#formPerhitungan').on('submit', function(e) {
                const btn = $('#btnHitung');
                const form = $(this);
                const originalText = btn.html();

                // Loading state pada button saja
                btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Menghitung...');
                btn.prop('disabled', true);
                btn.addClass('btn-loading');

                // Tambah class loading pada form
                form.addClass('form-loading');

                // Reset setelah 8 detik (fallback)
                setTimeout(function() {
                    btn.html(originalText);
                    btn.prop('disabled', false);
                    btn.removeClass('btn-loading');
                    form.removeClass('form-loading');
                }, 8000);
            });

            // Auto focus on modal open
            $('#perhitunganModal').on('shown.bs.modal', function() {
                $('#nama_perhitungan').focus();
            });

            // Prevent form double submission
            let isSubmitting = false;
            $('#formPerhitungan').on('submit', function(e) {
                if (isSubmitting) {
                    e.preventDefault();
                    return false;
                }
                isSubmitting = true;
            });
        });

        // Enhanced delete confirmation
        function confirmDelete(name) {
            // Simpan referensi form sebelum preventDefault
            const form = event.target.closest('form');
            event.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `
                    <div style="text-align: left;">
                        <p>Apakah Anda yakin ingin menghapus perhitungan:</p>
                        <div style="background: #fef2f2; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #ef4444;">
                            <strong style="color: #ef4444;">${name}</strong>
                        </div>
                        <p class="text-danger"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
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

        // Enhanced Success notification dengan pop-up yang menarik
        @if (session('success'))
            @if (str_contains(session('success'), 'berhasil dihapus') || str_contains(session('success'), 'deleted'))
                // SUCCESS MESSAGE UNTUK DELETE - TANPA TOMBOL LIHAT HASIL
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus!',
                    html: `
                        <div style="text-align: center; padding: 1rem;">
                            <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h5 style="margin: 0; color: white;">{{ session('success') }}</h5>
                            </div>
                            <p style="color: #6b7280; margin: 0;">Data perhitungan telah berhasil dihapus dari sistem</p>
                        </div>
                    `,
                    confirmButtonColor: 'var(--primary)',
                    confirmButtonText: '<i class="fas fa-check me-2"></i>OK',
                    customClass: {
                        popup: 'animated bounceIn',
                        confirmButton: 'btn-success-custom'
                    },
                    showClass: {
                        popup: 'animate__animated animate__bounceIn'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__bounceOut'
                    }
                });
            @else
                // SUCCESS MESSAGE UNTUK PERHITUNGAN BARU - DENGAN TOMBOL LIHAT HASIL
                Swal.fire({
                    icon: 'success',
                    title: 'Perhitungan Berhasil!',
                    html: `
                        <div style="text-align: center; padding: 1rem;">
                            <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h5 style="margin: 0; color: white;">{{ session('success') }}</h5>
                            </div>
                            <p style="color: #6b7280; margin: 0;">Data perhitungan telah tersimpan dan siap untuk dilihat</p>
                        </div>
                    `,
                    confirmButtonColor: 'var(--primary)',
                    confirmButtonText: '<i class="fas fa-eye me-2"></i>Lihat Hasil',
                    showCancelButton: true,
                    cancelButtonText: 'Tutup',
                    cancelButtonColor: '#6b7280',
                    reverseButtons: true,
                    customClass: {
                        popup: 'animated bounceIn',
                        confirmButton: 'btn-success-custom',
                        cancelButton: 'btn-secondary-custom'
                    },
                    showClass: {
                        popup: 'animate__animated animate__bounceIn'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__bounceOut'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke halaman hasil terbaru jika user klik "Lihat Hasil"
                        @if (isset($hasilPerhitungans) && $hasilPerhitungans->count() > 0)
                            window.location.href =
                                "{{ route('admin.perhitungan.show', $hasilPerhitungans->last()->id ?? '#') }}";
                        @endif
                    }
                });
            @endif
        @endif

        // Enhanced Error notification dengan pop-up yang menarik
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                html: `
                    <div style="text-align: center; padding: 1rem;">
                        <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                            <h5 style="margin: 0; color: white;">{{ session('error') }}</h5>
                        </div>
                        <p style="color: #6b7280; margin: 0;">Silakan periksa data dan coba lagi</p>
                    </div>
                `,
                confirmButtonColor: 'var(--primary)',
                confirmButtonText: '<i class="fas fa-redo me-2"></i>Coba Lagi',
                customClass: {
                    popup: 'animated shakeX',
                    confirmButton: 'btn-primary-custom'
                },
                showClass: {
                    popup: 'animate__animated animate__shakeX'
                }
            });
        @endif
    </script>
@endsection