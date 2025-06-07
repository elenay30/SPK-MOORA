@extends('layouts.app')

@section('title', 'Manajemen Penilaian')

@section('styles')
<style>
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
        border: none;
        position: relative;
        z-index: 2;
    }

    .btn-enhanced:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .btn-enhanced.btn-primary {
        background: var(--gradient);
    }

    .btn-enhanced.btn-warning {
        background: linear-gradient(135deg, #d97706, #f59e0b);
    }

    .btn-enhanced.btn-danger {
        background: linear-gradient(135deg, #dc2626, #ef4444);
    }

    .btn-enhanced.btn-success {
        background: linear-gradient(135deg, #059669, #10b981);
    }

    .btn-enhanced.btn-info {
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
    }

    /* Enhanced content card */
    .content-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
        animation: slideInUp 0.6s ease-out;
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
    }

    .enhanced-table thead th {
        background: linear-gradient(135deg, var(--brown-light) 0%, #fef3c7 100%);
        font-weight: 600;
        color: var(--text-dark);
        padding: 1rem 0.75rem;
        border: none;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        text-align: center;
        vertical-align: middle;
    }

    .enhanced-table thead th.text-left {
        text-align: left;
    }

    .enhanced-table thead th i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .enhanced-table tbody td {
        padding: 1rem 0.75rem;
        border-color: #f1f5f9;
        vertical-align: middle;
        transition: all 0.2s ease;
        text-align: center;
    }

    .enhanced-table tbody td.text-left {
        text-align: left;
    }

    .enhanced-table tbody tr {
        transition: all 0.2s ease;
    }

    .enhanced-table tbody tr:hover {
        background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
        transform: scale(1.01);
    }

    /* Enhanced score styling */
    .score-value {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        min-width: 50px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }

    .score-value:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    /* Score color coding */
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

    /* Alternative info styling */
    .alternative-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alternative-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .alternative-details h6 {
        margin: 0;
        font-weight: 600;
        color: var(--text-dark);
    }

    .alternative-details small {
        color: #6b7280;
        font-weight: 500;
    }

    /* Action buttons styling */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
    }

    .action-buttons .btn {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .action-buttons .btn:hover {
        transform: translateY(-2px);
    }

    /* Criteria header styling - HORIZONTAL VERSION */
    .criteria-header {
        /* Header sekarang horizontal, bukan vertikal */
        min-width: 120px;
        max-width: 150px;
        padding: 1rem 0.75rem !important;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.8rem;
        line-height: 1.3;
    }

    /* Tooltip untuk nama kriteria yang terpotong */
    .criteria-header[title]:hover {
        position: relative;
        cursor: help;
        overflow: visible;
        z-index: 10;
    }

    /* Style untuk div dalam criteria header */
    .criteria-header .d-flex {
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .criteria-header strong {
        font-size: 0.9rem;
        color: var(--primary);
    }

    .criteria-header small {
        font-size: 0.7rem;
        opacity: 0.8;
        font-weight: 500;
    }

    /* DataTable custom styling */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 8px;
        border: 2px solid #e2e8f0;
        padding: 0.25rem 0.5rem;
    }

    /* Responsive adjustments */
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

        .content-card-body {
            padding: 1.5rem;
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

        .enhanced-table thead th,
        .enhanced-table tbody td {
            padding: 0.5rem 0.25rem;
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
    }

    .empty-state h5 {
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    /* Loading states */
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

    /* Tambahan untuk table scroll horizontal yang lebih smooth */
    .table-responsive {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

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
        <a href="{{ route('admin.penilaian.create') }}" class="btn btn-enhanced btn-success">
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
    </div>
    <div class="content-card-body">
        <div class="table-responsive">
            <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-left">No</th>
                        <th class="text-left">Kode</th>
                        <th class="text-left"><i class="fas fa-user"></i>Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                        <th class="criteria-header" title="{{ $kriteria->nama }}">
                            <div class="d-flex flex-column align-items-center">
                                <strong>{{ $kriteria->kode }}</strong>
                                <small class="opacity-75">{{ $kriteria->nama }}</small>
                            </div>
                        </th>
                        @endforeach
                        <th><i class="fas fa-cogs"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alternatifs as $alternatif)
                    <tr>
                        <td class="text-left">
                            <span class="fw-bold text-primary">{{ $loop->iteration }}</span>
                        </td>
                        <td class="text-left">
                            <span class="badge bg-light text-dark border">{{ $alternatif->kode }}</span>
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
                            if ($nilai >= 80) $scoreClass = 'score-excellent';
                            elseif ($nilai >= 70) $scoreClass = 'score-good';
                            elseif ($nilai >= 60) $scoreClass = 'score-average';
                            elseif ($nilai > 0) $scoreClass = 'score-poor';
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
                                    class="btn btn-enhanced btn-warning btn-sm"
                                    title="Edit Penilaian">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.penilaian.destroy', $alternatif->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-enhanced btn-danger btn-sm"
                                        title="Hapus Semua Penilaian"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus semua penilaian untuk alternatif ini?')">
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
                                <a href="{{ route('admin.penilaian.create') }}" class="btn btn-enhanced btn-primary">
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
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "pageLength": 10,
            "responsive": true,
            "scrollX": true,
            "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            "columnDefs": [{
                    "targets": [0, 1, 2, -1], // No, Kode, Nama, Aksi
                    "className": "text-left"
                },
                {
                    "targets": "_all",
                    "className": "text-center"
                }
            ]
        });
    });
</script>
@endsection