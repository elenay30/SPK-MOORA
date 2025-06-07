@extends('layouts.app')

@section('title', 'Perhitungan MOORA')

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
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
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

    .page-title-section {
        position: relative;
        z-index: 2;
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
    }

    .page-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }

    .page-actions {
        position: relative;
        z-index: 2;
    }

    /* Enhanced button styles */
    .btn-enhanced {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-enhanced:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .btn-enhanced.btn-primary {
        background: linear-gradient(135deg, #ffffff, #f8fafc);
        color: var(--primary);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-enhanced.btn-primary:hover {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        color: var(--primary);
        transform: translateY(-3px) scale(1.05);
    }

    .btn-enhanced.btn-info {
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
        color: white;
    }

    .btn-enhanced.btn-info:hover {
        background: linear-gradient(135deg, #0284c7, #0891b2);
        color: white;
    }

    .btn-enhanced.btn-danger {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        color: white;
    }

    .btn-enhanced.btn-danger:hover {
        background: linear-gradient(135deg, #b91c1c, #dc2626);
        color: white;
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

    /* Enhanced table */
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
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Calculation name styling */
    .calculation-name {
        font-weight: 600;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .calculation-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
    }

    /* Date styling */
    .date-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .date-primary {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
    }

    .date-secondary {
        font-size: 0.8rem;
        color: var(--text-muted);
        background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        padding: 0.25rem 0.5rem;
        border-radius: 8px;
        display: inline-block;
    }

    /* Action buttons group */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    /* Statistics section */
    .stats-section {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(161, 98, 7, 0.1);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(161, 98, 7, 0.15);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .empty-state h5 {
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        margin-bottom: 1.5rem;
    }

    /* DataTable customization */
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
        box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
        outline: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        margin: 0 2px !important;
        border: none !important;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9) !important;
        color: var(--text-dark) !important;
        transition: all 0.3s ease !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--gradient) !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(161, 98, 7, 0.2) !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--gradient) !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(161, 98, 7, 0.2) !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
            flex-direction: column;
            align-items: flex-start;
        }

        .page-title {
            font-size: 1.8rem;
        }

        .content-card-body {
            padding: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-enhanced {
            width: 100%;
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .enhanced-table thead th,
        .enhanced-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }
    }

    /* Delete confirmation modal enhancement */
    .swal2-popup {
        border-radius: 20px !important;
    }

    .swal2-confirm {
        background: var(--gradient) !important;
        border-radius: 12px !important;
        padding: 0.75rem 1.5rem !important;
        font-weight: 600 !important;
    }

    .swal2-cancel {
        background: linear-gradient(135deg, #64748b, #94a3b8) !important;
        border-radius: 12px !important;
        padding: 0.75rem 1.5rem !important;
        font-weight: 600 !important;
    }
</style>
@endsection

@section('content')
<!-- Enhanced Page Header -->
<div class="page-header">
    <div class="page-title-section">
        <h1 class="page-title">🧮 Perhitungan MOORA</h1>
        <p class="page-subtitle">Kelola dan analisis hasil perhitungan dengan metode Multi-Objective Optimization</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('user.perhitungan.create') }}" class="btn btn-enhanced btn-primary">
            <i class="fas fa-calculator"></i>
            Hitung Baru
        </a>
    </div>
</div>

<!-- Statistics Section -->
@if($hasilPerhitungans->count() > 0)
<div class="stats-section">
    <div class="stats-grid">
        <div class="stat-item">
            <span class="stat-number">{{ $hasilPerhitungans->count() }}</span>
            <span class="stat-label">Total Perhitungan</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $hasilPerhitungans->where('created_at', '>=', now()->startOfMonth())->count() }}</span>
            <span class="stat-label">Bulan Ini</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $hasilPerhitungans->where('created_at', '>=', now()->startOfWeek())->count() }}</span>
            <span class="stat-label">Minggu Ini</span>
        </div>
    </div>
</div>
@endif

<!-- Enhanced Perhitungan List Card -->
<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">
            <i class="fas fa-history"></i>
            Riwayat Perhitungan
        </h3>
    </div>
    <div class="content-card-body">
        @if($hasilPerhitungans->count() > 0)
        <div class="alert alert-info border-0 mb-4" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle me-2 text-primary"></i>
                <div>
                    <strong>Informasi:</strong> Berikut adalah riwayat perhitungan MOORA yang telah Anda lakukan. Klik "Detail" untuk melihat hasil lengkap.
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><i class="fas fa-hash me-2"></i>No</th>
                        <th><i class="fas fa-file-alt me-2"></i>Nama Perhitungan</th>
                        <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                        <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasilPerhitungans as $hasil)
                    <tr>
                        <td>
                            <div class="number-badge">{{ $loop->iteration }}</div>
                        </td>
                        <td>
                            <div class="calculation-name">
                                <div class="calculation-icon">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <div>
                                    <strong>{{ $hasil->nama_perhitungan }}</strong>
                                    <div class="text-muted small">ID: {{ $hasil->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="date-info">
                                <span class="date-primary">{{ $hasil->created_at->setTimezone('Asia/Jakarta')->format('d M Y') }}</span>
                                <span class="date-secondary">{{ $hasil->created_at->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('user.perhitungan.show', $hasil->id) }}"
                                    class="btn btn-enhanced btn-info btn-sm"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Lihat detail perhitungan">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                                <form action="{{ route('user.perhitungan.destroy', $hasil->id) }}"
                                    method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-enhanced btn-danger btn-sm"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Hapus perhitungan">
                                        <i class="fas fa-trash"></i>
                                        Hapus
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
            <i class="fas fa-calculator"></i>
            <h5>Belum Ada Perhitungan</h5>
            <p>Anda belum memiliki riwayat perhitungan MOORA.<br>Mulai perhitungan pertama Anda dengan menekan tombol di bawah.</p>
            <a href="{{ route('user.perhitungan.create') }}" class="btn btn-enhanced btn-primary">
                <i class="fas fa-plus me-2"></i>
                Buat Perhitungan Baru
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable with custom configuration
        $('#dataTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "Semua"]
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            order: [
                [2, 'asc']
            ], // Sort by date descending
            drawCallback: function() {
                // Reinitialize tooltips after table redraw
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Enhanced delete confirmation with SweetAlert2 (if available) or native confirm
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const calculationName = $(this).closest('tr').find('.calculation-name strong').text();

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Hapus Perhitungan?',
                    html: `Apakah Anda yakin ingin menghapus perhitungan <strong>"${calculationName}"</strong>?<br><small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            } else {
                // Fallback to native confirm
                if (confirm(`Apakah Anda yakin ingin menghapus perhitungan "${calculationName}"?`)) {
                    form.submit();
                }
            }
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Enhanced hover effects for buttons
        $('.btn-enhanced').hover(
            function() {
                $(this).addClass('animate__animated animate__pulse');
            },
            function() {
                $(this).removeClass('animate__animated animate__pulse');
            }
        );

        // Add loading state when navigating
        $('a[href*="perhitungan"]').on('click', function() {
            const btn = $(this);
            if (!btn.hasClass('btn-danger')) {
                btn.addClass('disabled');
                btn.find('i').removeClass().addClass('fas fa-spinner fa-spin');
            }
        });

        // Animate stat numbers
        $('.stat-number').each(function() {
            const $this = $(this);
            const countTo = parseInt($this.text());

            $({
                countNum: 0
            }).animate({
                countNum: countTo
            }, {
                duration: 1000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(countTo);
                }
            });
        });
    });
</script>
@endsection