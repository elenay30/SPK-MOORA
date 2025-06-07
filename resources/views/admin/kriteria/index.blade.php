@extends('layouts.app')

@section('title', 'Manajemen Kriteria')

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

    /* Enhanced bulk alert */
    .bulk-alert {
        background: linear-gradient(135deg, #dc2626, #ef4444);
        border: none;
        border-radius: 15px;
        color: white;
        box-shadow: 0 8px 25px rgba(220, 38, 38, 0.3);
        padding: 1.5rem;
        margin-bottom: 2rem;
        animation: slideInDown 0.5s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bulk-alert .btn {
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .bulk-alert .btn:hover {
        transform: translateY(-1px);
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
        padding: 1rem 1.25rem;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .enhanced-table thead th i {
        color: var(--primary);
        margin-right: 0.5rem;
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
        transform: scale(1.01);
    }

    /* Enhanced badges */
    .enhanced-badge {
        border-radius: 20px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }

    .enhanced-badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .enhanced-badge.bg-success {
        background: linear-gradient(135deg, #059669, #10b981) !important;
    }

    .enhanced-badge.bg-danger {
        background: linear-gradient(135deg, #dc2626, #ef4444) !important;
    }

    /* Custom checkbox styling */
    .custom-checkbox {
        width: 18px;
        height: 18px;
        border: 2px solid var(--primary);
        border-radius: 4px;
        position: relative;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .custom-checkbox:checked {
        background: var(--gradient);
        border-color: var(--primary);
    }

    .custom-checkbox:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
        font-weight: bold;
    }

    .custom-checkbox:hover {
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
    }

    /* Action buttons styling */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
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

        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }
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
</style>
@endsection

@section('content')
<!-- Enhanced Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="page-title">📋 Manajemen Kriteria</h1>
            <p class="page-subtitle mb-0">Kelola kriteria penilaian untuk sistem SPK</p>
        </div>
        <a href="{{ route('admin.kriteria.create') }}" class="btn btn-enhanced btn-success">
            <i class="fas fa-plus me-2"></i>Tambah Kriteria
        </a>
    </div>
</div>

<!-- Enhanced Bulk Delete Alert -->
<div id="bulkAlert" class="bulk-alert d-none">
    <div class="row align-items-center">
        <div class="col">
            <div class="d-flex align-items-center">
                <i class="fas fa-trash me-3" style="font-size: 1.2rem;"></i>
                <div>
                    <strong><span id="countText">0 item dipilih</span></strong>
                    <div class="small opacity-75">Pilih item yang ingin dihapus secara bersamaan</div>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-outline-light me-2" onclick="batalPilih()">
                <i class="fas fa-times me-1"></i> Batal
            </button>
            <button type="button" class="btn btn-light text-danger fw-bold" onclick="hapusTerpilih()">
                <i class="fas fa-trash me-1"></i> Hapus Terpilih
            </button>
        </div>
    </div>
</div>

<!-- Enhanced Content Card -->
<div class="content-card">
    <div class="content-card-header">
        <h3 class="content-card-title">
            <i class="fas fa-list-ul"></i>
            Daftar Kriteria
        </h3>
    </div>
    <div class="content-card-body">
        <div class="table-responsive">
            <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="80" class="text-center">
                            <div class="d-flex flex-column align-items-center">
                                <input type="checkbox" id="pilihSemua" class="custom-checkbox" onchange="toggleSemua()">
                                <small class="mt-1">Semua</small>
                            </div>
                        </th>
                        <th>No</th>
                        <th>Kode</th>
                        <th><i class="fas fa-tag"></i>Nama</th>
                        <th><i class="fas fa-weight-hanging"></i>Bobot</th>
                        <th><i class="fas fa-chart-line"></i>Jenis</th>
                        <th><i class="fas fa-cogs"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriterias as $kriteria)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" class="pilih-item custom-checkbox" value="{{ $kriteria->id }}" onchange="cekPilihan()">
                        </td>
                        <td>
                            <span class="fw-bold text-primary">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $kriteria->kode }}</span>
                        </td>
                        <td>
                            <strong>{{ $kriteria->nama }}</strong>
                        </td>
                        <td>
                            <span class="fw-bold">{{ $kriteria->bobot }}</span>
                        </td>
                        <td>
                            @if ($kriteria->jenis == 'benefit')
                            <span class="enhanced-badge bg-success text-white">
                                <i class="fas fa-arrow-up me-1"></i>Benefit
                            </span>
                            @else
                            <span class="enhanced-badge bg-danger text-white">
                                <i class="fas fa-arrow-down me-1"></i>Cost
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kriteria.edit', $kriteria->id) }}"
                                    class="btn btn-enhanced btn-warning btn-sm"
                                    title="Edit Kriteria">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kriteria.destroy', $kriteria->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-enhanced btn-danger btn-sm"
                                        title="Hapus Kriteria"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
    </div>
</div>

<!-- Form tersembunyi untuk bulk delete -->
<form id="formBulkDelete" action="{{ route('admin.kriteria.bulk-delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="ids" id="idsYangDipilih">
</form>
@endsection

@section('scripts')
<script>
    // Inisialisasi DataTable
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "pageLength": 10,
            "responsive": true,
            "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        });
    });

    // Fungsi toggle semua checkbox
    function toggleSemua() {
        const pilihSemua = document.getElementById('pilihSemua');
        const checkboxes = document.querySelectorAll('.pilih-item');

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = pilihSemua.checked;
        });

        cekPilihan();
    }

    // Fungsi cek berapa item yang dipilih
    function cekPilihan() {
        const terpilih = document.querySelectorAll('.pilih-item:checked');
        const jumlah = terpilih.length;
        const alert = document.getElementById('bulkAlert');
        const countText = document.getElementById('countText');

        if (jumlah > 0) {
            alert.classList.remove('d-none');
            countText.textContent = jumlah + ' item dipilih';
        } else {
            alert.classList.add('d-none');
        }

        // Update status checkbox "Semua"
        const semua = document.querySelectorAll('.pilih-item');
        const pilihSemua = document.getElementById('pilihSemua');

        if (jumlah === 0) {
            pilihSemua.checked = false;
            pilihSemua.indeterminate = false;
        } else if (jumlah === semua.length) {
            pilihSemua.checked = true;
            pilihSemua.indeterminate = false;
        } else {
            pilihSemua.checked = false;
            pilihSemua.indeterminate = true;
        }
    }

    // Fungsi batal pilih
    function batalPilih() {
        document.querySelectorAll('.pilih-item').forEach(function(checkbox) {
            checkbox.checked = false;
        });
        document.getElementById('pilihSemua').checked = false;
        document.getElementById('pilihSemua').indeterminate = false;
        document.getElementById('bulkAlert').classList.add('d-none');
    }

    // Fungsi hapus terpilih
    function hapusTerpilih() {
        const terpilih = document.querySelectorAll('.pilih-item:checked');
        const ids = [];

        terpilih.forEach(function(checkbox) {
            ids.push(checkbox.value);
        });

        if (ids.length === 0) {
            alert('Pilih minimal satu item untuk dihapus');
            return;
        }

        const konfirmasi = confirm('Apakah Anda yakin ingin menghapus ' + ids.length + ' item yang dipilih?\n\nItem: ' + ids.join(', '));

        if (konfirmasi) {
            document.getElementById('idsYangDipilih').value = ids.join(',');
            document.getElementById('formBulkDelete').submit();
        }
    }
</script>
@endsection