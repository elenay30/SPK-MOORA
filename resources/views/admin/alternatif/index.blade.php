@extends('layouts.app')

@section('title', 'Manajemen Alternatif')

@section('styles')
<style>
    /* Enhanced Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(161, 98, 7, 0.15) !important;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
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
    
    .page-header-content {
        position: relative;
        z-index: 2;
    }
    
    .page-title {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
    }
    
    .page-subtitle {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
        font-size: 1rem;
        font-weight: 400;
    }

    /* Enhanced Button Styling */
    .btn-professional {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border: none;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-professional:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #92400e 0%, #a16207 100%);
        color: white;
    }

    /* Enhanced Bulk Alert */
    .bulk-alert {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3) !important;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .bulk-alert .btn-outline-light {
        border: 2px solid rgba(255,255,255,0.3);
        color: white;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .bulk-alert .btn-outline-light:hover {
        background: rgba(255,255,255,0.2);
        border-color: rgba(255,255,255,0.5);
        transform: scale(1.05);
    }

    .bulk-alert .btn-light {
        background: white;
        color: #dc2626;
        font-weight: 700;
        border-radius: 8px;
        border: none;
        transition: all 0.3s ease;
    }

    .bulk-alert .btn-light:hover {
        background: #f8f9fa;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2) !important;
    }

    /* Enhanced Card Styling */
    .card-enhanced {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card-enhanced:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(161, 98, 7, 0.15) !important;
    }

    .card-header-enhanced {
        background: linear-gradient(135deg, #fef7ed 0%, #fed7aa 100%);
        border-bottom: 2px solid var(--primary);
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-title-enhanced {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
    }

    /* DataTable Controls Styling */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        font-weight: 500;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dataTables_wrapper .dataTables_length select {
        padding: 0.375rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        margin: 0 0.5rem;
    }

    .dataTables_wrapper .dataTables_filter input {
        padding: 0.375rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        margin-left: 0.5rem;
        width: 200px;
    }

    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1) !important;
    }

    /* Enhanced Table */
    .table-enhanced {
        margin: 0;
        font-size: 0.9rem;
        background: white;
        width: 100%;
    }

    .table-enhanced thead {
        background: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }

    .table-enhanced thead th {
        border: none;
        padding: 1rem 1.25rem;
        font-weight: 600;
        color: #374151;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        position: relative;
        vertical-align: middle;
    }

    /* Custom DataTable Sorting Icons */
    .table-enhanced thead th.sorting,
    .table-enhanced thead th.sorting_asc,
    .table-enhanced thead th.sorting_desc {
        cursor: pointer;
        padding-right: 2rem;
    }

    .table-enhanced thead th.sorting:after,
    .table-enhanced thead th.sorting_asc:after,
    .table-enhanced thead th.sorting_desc:after {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 0.7rem;
        color: #9ca3af;
    }

    .table-enhanced thead th.sorting:after {
        content: "\f0dc";
    }

    .table-enhanced thead th.sorting_asc:after {
        content: "\f0de";
        color: var(--primary);
    }

    .table-enhanced thead th.sorting_desc:after {
        content: "\f0dd";
        color: var(--primary);
    }

    .table-enhanced tbody td {
        padding: 1rem 1.25rem;
        border: none;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        transition: all 0.2s ease;
    }

    .table-enhanced tbody tr {
        transition: all 0.2s ease;
    }

    .table-enhanced tbody tr:hover {
        background: #fafbfc;
    }

    .table-enhanced tbody tr:last-child td {
        border-bottom: none;
    }

    /* Column Specific Styling */
    .col-checkbox {
        text-align: center;
        width: 80px;
    }

    .col-no {
        text-align: center;
        width: 60px;
        font-weight: 600;
    }

    .col-kode {
        text-align: center;
        width: 120px;
    }

    .col-nama {
        font-weight: 600;
        color: #1f2937;
    }

    .col-aksi {
        text-align: center;
        width: 120px;
    }

    /* Enhanced Checkbox Styling */
    .checkbox-enhanced {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
        transform: scale(1.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .checkbox-enhanced:hover {
        transform: scale(1.4);
    }

    .checkbox-label {
        font-size: 0.8rem;
        color: var(--text-light);
        font-weight: 500;
        margin-top: 0.25rem;
        display: block;
    }

    /* Enhanced Code Badge */
    .code-badge {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3) !important;
        display: inline-block;
        min-width: 60px;
        text-align: center;
    }

    /* Enhanced Action Buttons */
    .action-btn {
        padding: 0.375rem 0.5rem;
        border-radius: 6px;
        font-size: 0.8rem;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        margin: 0 0.125rem;
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15) !important;
    }

    .btn-edit {
        background: #f59e0b;
        color: white;
    }

    .btn-edit:hover {
        background: #d97706;
        color: white;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
    }

    /* DataTable Pagination Styling */
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1rem;
        border: none !important;
        border-bottom: none !important;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.375rem 0.75rem;
        margin: 0 0.125rem;
        border: 1px solid #d1d5db;
        background: white;
        color: #374151;
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
        color: #374151;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #92400e;
        border-color: #92400e;
        color: white;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: #9ca3af;
        cursor: not-allowed;
        opacity: 0.5;
    }

    .dataTables_wrapper .dataTables_info {
        color: #6b7280;
        font-size: 0.85rem;
        margin-top: 1rem;
        border: none !important;
        border-bottom: none !important;
        box-shadow: none !important;
    }

    /* Force remove all bottom borders from DataTable elements */
    .dataTables_wrapper,
    .dataTables_wrapper *,
    .dataTables_wrapper::before,
    .dataTables_wrapper::after {
        border-bottom: none !important;
        box-shadow: none !important;
    }

    /* Remove any lingering borders from card elements */
    .card-body,
    .card-body *,
    .table-responsive,
    .table-responsive * {
        border-bottom: none !important;
    }

    /* Loading Animation */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.9);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
            text-align: center;
        }

        .page-title {
            font-size: 1.5rem;
            flex-direction: column;
            text-align: center;
        }

        .btn-professional {
            width: 100%;
            margin-top: 1rem;
            justify-content: center;
        }

        .table-enhanced {
            font-size: 0.8rem;
        }

        .table-enhanced thead th,
        .table-enhanced tbody td {
            padding: 0.75rem 0.5rem;
        }

        .action-btn {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }

        .bulk-alert {
            text-align: center;
        }

        .bulk-alert .row {
            flex-direction: column;
            gap: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 100%;
            margin-left: 0;
            margin-top: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .card-header-enhanced {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }

        .checkbox-label {
            font-size: 0.7rem;
        }

        .code-badge {
            font-size: 0.7rem;
            padding: 0.4rem 0.6rem;
            min-width: 50px;
        }
    }

    /* Animation for deleted rows */
    .row-deleting {
        background: #fee2e2 !important;
        animation: fadeOut 0.5s ease-out forwards;
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateX(-100%);
        }
    }

    /* Success animation */
    .success-flash {
        animation: successPulse 0.6s ease-out;
    }

    @keyframes successPulse {
        0% { background: #10b981; }
        50% { background: #059669; }
        100% { background: transparent; }
    }
</style>
@endsection

@section('content')
<!-- Enhanced Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-users me-3"></i>
                    Manajemen Alternatif
                </h1>
                <p class="page-subtitle">Kelola data alternatif karyawan untuk penilaian</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('admin.alternatif.create') }}" class="btn-professional btn-primary-custom">
                    <i class="fas fa-plus me-2"></i>Tambah Alternatif
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Bulk Delete Alert -->
<div id="bulkAlert" class="alert bulk-alert d-none mb-3">
    <div class="row align-items-center">
        <div class="col-md-8 col-12 mb-3 mb-md-0">
            <div class="d-flex align-items-center">
                <i class="fas fa-trash-alt me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <strong style="font-size: 1.1rem;"><span id="countText">0 item dipilih</span></strong>
                    <div style="font-size: 0.9rem; opacity: 0.9;">Pilih item yang ingin dihapus</div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="d-flex gap-2 justify-content-end">
                <button type="button" class="btn btn-outline-light btn-sm" onclick="batalPilih()">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-light btn-sm" onclick="hapusTerpilih()">
                    <i class="fas fa-trash me-2"></i>Hapus Terpilih
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Card -->
<div class="card-enhanced">
    <div class="card-header-enhanced">
        <h6 class="card-title-enhanced">
            <i class="fas fa-table me-2"></i>Daftar Alternatif
        </h6>
        <div style="font-size: 0.9rem; color: var(--text-light);">
            Total: <strong>{{ $alternatifs->count() }}</strong> alternatif
        </div>
    </div>
    <div class="card-body p-0">
        <div class="p-3">
            <div class="table-responsive">
                <table class="table table-enhanced" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col-checkbox">
                                <div class="text-center">
                                    <input type="checkbox" 
                                           id="pilihSemua" 
                                           class="checkbox-enhanced" 
                                           onchange="toggleSemua()">
                                    <label class="checkbox-label" for="pilihSemua">Semua</label>
                                </div>
                            </th>
                            <th class="col-no">No</th>
                            <th class="col-kode">Kode</th>
                            <th class="col-nama">Nama</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alternatifs as $alternatif)
                        <tr data-id="{{ $alternatif->id }}">
                            <td class="col-checkbox">
                                <input type="checkbox" 
                                       class="pilih-item checkbox-enhanced" 
                                       value="{{ $alternatif->id }}" 
                                       onchange="cekPilihan()">
                            </td>
                            <td class="col-no">
                                <span class="badge bg-light text-dark">{{ $loop->iteration }}</span>
                            </td>
                            <td class="col-kode">
                                <span class="code-badge">{{ $alternatif->kode }}</span>
                            </td>
                            <td class="col-nama">{{ $alternatif->nama }}</td>
                            <td class="col-aksi">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.alternatif.edit', $alternatif->id) }}" 
                                       class="action-btn btn-edit" 
                                       title="Edit Alternatif">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.alternatif.destroy', $alternatif->id) }}" 
                                          method="POST" 
                                          class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-btn btn-delete" 
                                                title="Hapus Alternatif"
                                                onclick="return confirmDelete('{{ $alternatif->nama }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div style="color: #6b7280;">
                                    <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                    <h6>Belum ada data alternatif</h6>
                                    <p class="mb-0">Silakan tambah alternatif untuk memulai penilaian</p>
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

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

<!-- Form tersembunyi untuk bulk delete -->
<form id="formBulkDelete" action="{{ route('admin.alternatif.bulk-delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="ids" id="idsYangDipilih">
</form>
@endsection

@section('scripts')
<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    // Enhanced DataTable initialization
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
            order: [[1, 'asc']],
            columnDefs: [
                { orderable: false, targets: [0, 4] },
                { className: "text-center", targets: [0, 1, 2, 4] }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            drawCallback: function(settings) {
                // Remove default bootstrap classes from pagination
                $('.paginate_button').removeClass('btn btn-outline-primary');
            }
        });

        // Enhanced delete form handling
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const row = $(form).closest('tr');
            
            showLoading();
            row.addClass('row-deleting');
            
            setTimeout(() => {
                form.submit();
            }, 500);
        });
    });

    // Enhanced toggle functions
    function toggleSemua() {
        const pilihSemua = document.getElementById('pilihSemua');
        const checkboxes = document.querySelectorAll('.pilih-item');

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = pilihSemua.checked;
            
            // Add visual feedback
            const row = checkbox.closest('tr');
            if (checkbox.checked) {
                row.style.background = 'linear-gradient(135deg, #fef3c7 0%, #fde68a 100%)';
            } else {
                row.style.background = '';
            }
        });

        cekPilihan();
    }

    // Enhanced selection checker
    function cekPilihan() {
        const terpilih = document.querySelectorAll('.pilih-item:checked');
        const jumlah = terpilih.length;
        const alert = document.getElementById('bulkAlert');
        const countText = document.getElementById('countText');

        // Update visual feedback for selected rows
        document.querySelectorAll('.pilih-item').forEach(function(checkbox) {
            const row = checkbox.closest('tr');
            if (checkbox.checked) {
                row.style.background = 'linear-gradient(135deg, #fef3c7 0%, #fde68a 100%)';
                row.style.borderLeft = '4px solid var(--primary)';
            } else {
                row.style.background = '';
                row.style.borderLeft = '';
            }
        });

        if (jumlah > 0) {
            alert.classList.remove('d-none');
            countText.textContent = jumlah + ' item dipilih';
            
            // Add pulse animation
            alert.style.animation = 'none';
            setTimeout(() => {
                alert.style.animation = 'slideDown 0.3s ease-out';
            }, 10);
        } else {
            alert.classList.add('d-none');
        }

        // Enhanced checkbox state management
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

    // Enhanced cancel function
    function batalPilih() {
        document.querySelectorAll('.pilih-item').forEach(function(checkbox) {
            checkbox.checked = false;
            const row = checkbox.closest('tr');
            row.style.background = '';
            row.style.borderLeft = '';
        });
        
        document.getElementById('pilihSemua').checked = false;
        document.getElementById('pilihSemua').indeterminate = false;
        document.getElementById('bulkAlert').classList.add('d-none');
    }

    // Enhanced delete function
    function hapusTerpilih() {
        const terpilih = document.querySelectorAll('.pilih-item:checked');
        const ids = [];
        const names = [];

        terpilih.forEach(function(checkbox) {
            ids.push(checkbox.value);
            const row = checkbox.closest('tr');
            const name = row.querySelector('.col-nama').textContent.trim();
            names.push(name);
        });

        if (ids.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih minimal satu item untuk dihapus',
                confirmButtonColor: 'var(--primary)'
            });
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Hapus',
            html: `
                <p>Apakah Anda yakin ingin menghapus <strong>${ids.length}</strong> alternatif berikut?</p>
                <div style="max-height: 200px; overflow-y: auto; background: #f8f9fa; padding: 1rem; border-radius: 8px; margin: 1rem 0;">
                    ${names.map(name => `<div style="padding: 0.25rem 0; border-bottom: 1px solid #dee2e6;">• ${name}</div>`).join('')}
                </div>
                <p class="text-danger"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
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
                showLoading();
                document.getElementById('idsYangDipilih').value = ids.join(',');
                document.getElementById('formBulkDelete').submit();
            }
        });
    }

    // Enhanced delete confirmation
    function confirmDelete(name) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            html: `
                <p>Apakah Anda yakin ingin menghapus alternatif:</p>
                <div style="background: #fef2f2; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #ef4444;">
                    <strong style="color: #dc2626;">${name}</strong>
                </div>
                <p class="text-danger"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
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
                event.target.closest('form').submit();
            }
        });
        
        return false;
    }

    // Loading functions
    function showLoading() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').style.display = 'none';
    }

    // Success notification
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: 'var(--primary)',
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    // Error notification
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonColor: 'var(--primary)'
        });
    @endif
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection