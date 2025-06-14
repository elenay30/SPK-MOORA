@extends('layouts.app')

@section('title', 'Perhitungan MOORA')

@section('styles')
    <style>
        /* CSS DIPERBAIKI PERHITUNGAN - BORDERLESS DESIGN + POP-UP HAPUS */

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

        .page-title-section { z-index: 2; }
        .page-title { font-size: 2.2rem; font-weight: 700; margin: 0; }
        .page-subtitle { font-size: 1rem; opacity: 0.9; margin-top: 0.5rem; }
        .page-actions { z-index: 2; }

        /* Enhanced button styles */
        .btn-enhanced {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid transparent !important;
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
            border-color: rgba(255, 255, 255, 0.3) !important;
        }
        .btn-enhanced.btn-primary:hover {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            color: var(--primary);
            transform: translateY(-3px) scale(1.05);
            border-color: rgba(255, 255, 255, 0.5) !important;
        }
        .btn-enhanced.btn-info {
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: white;
            border-color: #0ea5e9 !important;
        }
        .btn-enhanced.btn-info:hover {
            background: linear-gradient(135deg, #0284c7, #0891b2);
            color: white;
            border-color: #0284c7 !important;
        }
        .btn-enhanced.btn-danger {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            border-color: #dc2626 !important;
        }
        .btn-enhanced.btn-danger:hover {
            background: linear-gradient(135deg, #b91c1c, #dc2626);
            color: white;
            border-color: #b91c1c !important;
        }

        /* Enhanced content cards */
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none !important;
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
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content-card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.5rem 2rem;
            border-bottom: 2px solid #e2e8f0 !important;
            position: relative;
        }

        .content-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .content-card-body { padding: 1.5rem; }

        /* --- PERBAIKAN UTAMA: CSS Table --- */
        .table-responsive {
            border: none !important;
            padding: 0;
            margin: 0;
        }
        .enhanced-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        /* --- PERBAIKAN UTAMA: CSS Table Header --- */
        .enhanced-table thead th {
            background: #fdfaf6;
            font-weight: 600;
            color: var(--text-dark);
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            vertical-align: middle;
            text-align: left;
            border: none !important;
            /* Garis bawah yang aman & tidak konflik dengan DataTables */
            border-bottom: 2px solid var(--primary-light, #e2e8f0) !important;
        }

        .enhanced-table tbody td {
            padding: 1rem 1.25rem;
            border: none !important;
            vertical-align: middle;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f5f9 !important; /* Garis pemisah antar baris yang tipis */
        }
        .enhanced-table tbody tr:last-child td {
            border-bottom: none !important;
        }
        .enhanced-table tbody tr:hover {
            background-color: #fefbf6 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.1);
        }
        .enhanced-table tbody tr:hover td {
            color: var(--primary);
        }
        
        /* Styling Spesifik Kolom */
        .enhanced-table .col-no, .enhanced-table .col-aksi { text-align: center; }
        .enhanced-table thead .col-no, .enhanced-table thead .col-aksi { text-align: center; }

        /* Number badges */
        .number-badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
        }

        /* Calculation name styling */
        .calculation-name {
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
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
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
            flex-shrink: 0;
        }
        
        /* Date styling */
        .date-info { display: flex; flex-direction: column; gap: 0.25rem; }
        .date-primary { font-weight: 600; color: var(--text-dark); font-size: 0.95rem; }
        .date-secondary { font-size: 0.8rem; color: var(--text-muted); }

        /* Action buttons group */
        .action-buttons { display: flex; gap: 0.5rem; justify-content: center; }

        /* Statistics section */
        .stats-section {
            background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary) !important;
            box-shadow: 0 4px 15px rgba(161, 98, 7, 0.05);
        }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; }
        .stat-item {
            text-align: center; padding: 1rem; background: white; border-radius: 12px;
            box-shadow: 0 4px 15px rgba(161, 98, 7, 0.1); transition: all 0.3s ease;
        }
        .stat-item:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(161, 98, 7, 0.15); }
        .stat-number { font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.5rem; display: block; }
        .stat-label { font-size: 0.85rem; font-weight: 600; color: var(--text-dark); opacity: 0.8; text-transform: uppercase; letter-spacing: 0.5px; }

        /* Empty state */
        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--text-muted); }
        .empty-state .fa-calculator { font-size: 4rem; margin-bottom: 1rem; opacity: 0.3; }
        .empty-state h5 { color: var(--text-dark); margin-bottom: 0.5rem; }
        .empty-state p { margin-bottom: 1.5rem; }

        /* DataTable customization */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1.5rem;
        }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px; border: 1px solid #e2e8f0 !important;
            padding: 0.5rem 0.75rem; transition: all 0.3s ease; background: white;
        }
        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--primary) !important; box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1); outline: none;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important; margin: 0 2px !important; border: 1px solid #e2e8f0 !important;
            background: white !important; color: var(--text-dark) !important; transition: all 0.3s ease !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #fef7ed !important; color: var(--primary) !important;
            transform: translateY(-2px); border-color: var(--primary) !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--gradient) !important; color: white !important;
            box-shadow: 0 4px 15px rgba(161, 98, 7, 0.2) !important; border-color: var(--primary) !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            transform: translateY(-2px);
        }
        
        /* --- PERBAIKAN UTAMA: CSS SweetAlert --- */
        .swal2-popup {
            border-radius: 20px !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15) !important;
            padding: 2rem !important;
        }
        .swal2-title {
            color: var(--text-dark) !important;
            font-weight: 700 !important;
            font-size: 1.5rem !important;
        }
        .swal2-html-container {
            color: var(--text-dark) !important;
            font-size: 1rem !important;
        }
        .swal2-actions {
            gap: 1rem !important;
            margin-top: 1.5rem !important;
        }
        /* Tombol konfirmasi (merah untuk hapus) */
        .swal2-confirm {
            background: linear-gradient(135deg, #dc2626, #ef4444) !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 0.75rem 1.5rem !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3) !important;
        }
        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4) !important;
        }
        /* Tombol batal */
        .swal2-cancel {
            background: #e2e8f0 !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 0.75rem 1.5rem !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            color: #334155 !important;
            transition: all 0.3s ease !important;
        }
        .swal2-cancel:hover {
            background: #d1d5db !important;
            transform: translateY(-2px) !important;
        }
        .swal2-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }
        .swal2-html-container .text-danger { color: #dc2626 !important; font-weight: 600 !important; }
        .swal2-html-container strong { color: var(--text-dark) !important; }
        .swal2-html-container div > strong { color: #dc2626 !important; }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header, .content-card-body, .stats-section { padding: 1.5rem; }
            .page-title { font-size: 1.8rem; }
            .action-buttons { flex-direction: column; width: 100%; }
            .btn-enhanced { width: 100%; justify-content: center; }
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none; text-align: center; margin-bottom: 1rem;
            }
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
    @if ($hasilPerhitungans->count() > 0)
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">{{ $hasilPerhitungans->count() }}</span>
                    <span class="stat-label">Total Perhitungan</span>
                </div>
                <div class="stat-item">
                    <span
                        class="stat-number">{{ $hasilPerhitungans->where('created_at', '>=', now()->startOfMonth())->count() }}</span>
                    <span class="stat-label">Bulan Ini</span>
                </div>
                <div class="stat-item">
                    <span
                        class="stat-number">{{ $hasilPerhitungans->where('created_at', '>=', now()->startOfWeek())->count() }}</span>
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
            @if ($hasilPerhitungans->count() > 0)
                <div class="table-responsive">
                    <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-no"></i> No</th>
                                <th><i class="fas fa-file-alt"></i> Nama Perhitungan</th>
                                <th><i class="fas fa-calendar-alt"></i> Tanggal</th>
                                <th class="col-aksi"><i class="fas fa-cogs"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasilPerhitungans as $hasil)
                                <tr>
                                    <td class="col-no">
                                        <div class="number-badge">{{ $loop->iteration }}</div>
                                    </td>
                                    <td>
                                        <div class="calculation-name">
                                            <div class="calculation-icon">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $hasil->nama_perhitungan }}</strong>
                                                <div class="text-muted small">ID: {{ $hasil->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <span class="date-primary">{{ $hasil->created_at->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }}</span>
                                            <span class="date-secondary">{{ $hasil->created_at->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</span>
                                        </div>
                                    </td>
                                    <td class="col-aksi">
                                        <div class="action-buttons">
                                            <a href="{{ route('user.perhitungan.show', $hasil->id) }}"
                                                class="btn btn-enhanced btn-info btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Lihat detail perhitungan">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('user.perhitungan.destroy', $hasil->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-enhanced btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus perhitungan">
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
                    <i class="fas fa-calculator"></i>
                    <h5>Belum Ada Perhitungan</h5>
                    <p>Anda belum memiliki riwayat perhitungan MOORA.<br>Mulai perhitungan pertama Anda dengan menekan tombol di bawah.</p>
                    <a href="{{ route('user.perhitungan.create') }}" class="btn btn-enhanced btn-primary">
                        <i class="fas fa-plus"></i>
                        Buat Perhitungan Baru
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    {{-- SweetAlert2 & DataTables JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#dataTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Semua"] ],
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json' },
                order: [ [2, 'desc'] ], // Urutkan berdasarkan tanggal, terbaru di atas
                columnDefs: [
                    { orderable: false, targets: [0, 3] }, // Nonaktifkan sort untuk kolom No dan Aksi
                    { className: "dt-center", targets: [0, 3] } // Pusatkan konten kolom No dan Aksi
                ],
                drawCallback: function() {
                    // Re-inisialisasi tooltip setelah tabel digambar ulang
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                }
            });

            // Pop-up konfirmasi hapus
            $('#dataTable tbody').on('click', 'button.btn-danger', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const calculationName = form.closest('tr').find('.calculation-name strong').text().trim();

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `
                        <p>Apakah Anda yakin ingin menghapus riwayat perhitungan:</p>
                        <div style="background: #fef2f2; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #ef4444; text-align: left;">
                            <strong style="color: #dc2626;">${calculationName}</strong>
                        </div>
                        <p class="text-danger mt-3"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Animate stat numbers
            $('.stat-number').each(function() {
                const $this = $(this);
                const countTo = parseInt($this.text().replace(/,/g, ''));
                $({ countNum: 0 }).animate({ countNum: countTo }, {
                    duration: 1200, easing: 'swing',
                    step: function() { $this.text(Math.floor(this.countNum).toLocaleString('id-ID')); },
                    complete: function() { $this.text(countTo.toLocaleString('id-ID')); }
                });
            });
        });

        // Tampilkan notifikasi global dari session
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}'
            });
        @endif
    </script>
@endsection