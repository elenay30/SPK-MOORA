@extends('layouts.app')

@section('title', 'Manajemen User')

@section('styles')
<style>
    /* Enhanced Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(161, 98, 7, 0.15);
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
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-professional:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #92400e 0%, #a16207 100%);
        color: white;
    }

    /* User Statistics Cards - Simplified */
    .stats-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        text-align: center;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }

    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(161, 98, 7, 0.15);
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .stats-label {
        color: var(--text-light);
        font-weight: 500;
        font-size: 0.9rem;
    }

    .stats-admin {
        border-left: 4px solid #dc2626;
    }

    .stats-admin .stats-number {
        color: #dc2626;
    }

    .stats-users {
        border-left: 4px solid #059669;
    }

    .stats-users .stats-number {
        color: #059669;
    }

    .stats-total {
        border-left: 4px solid var(--primary);
    }

    /* ========== IMPROVED TABLE SECTION ========== */

    /* Enhanced Card Styling for Table */
    .card-enhanced {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card-enhanced:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(161, 98, 7, 0.15);
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
        box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
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
    .col-no {
        text-align: center;
        width: 60px;
        font-weight: 600;
    }

    .col-nama {
        font-weight: 600;
        color: #1f2937;
    }

    .col-email {
        color: #6b7280;
        font-size: 0.85rem;
    }

    .col-role {
        text-align: center;
        width: 120px;
    }

    .col-tanggal {
        text-align: center;
        width: 150px;
        color: #6b7280;
        font-size: 0.85rem;
    }

    .col-aksi {
        text-align: center;
        width: 120px;
    }

    /* Enhanced Role Badges */
    .role-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        min-width: 70px;
        text-align: center;
        border: 1px solid;
    }

    .role-admin {
        background: #fee2e2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .role-user {
        background: #d1fae5;
        color: #065f46;
        border-color: #a7f3d0;
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
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

        .stats-card {
            margin-bottom: 1rem;
        }

        .col-email {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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

        .role-badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
            min-width: 60px;
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
</style>
@endsection

@section('content')
<!-- Enhanced Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-user-cog me-3"></i>
                    Manajemen User
                </h1>
                <p class="page-subtitle">Kelola pengguna dan hak akses sistem</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('admin.user.create') }}" class="btn-professional btn-primary-custom">
                    <i class="fas fa-user-plus me-2"></i>Tambah User
                </a>
            </div>
        </div>
    </div>
</div>

<!-- User Statistics - Simplified -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stats-card stats-total">
            <div class="stats-number">{{ $users->count() ?? 3 }}</div>
            <div class="stats-label">Total User</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stats-card stats-admin">
            <div class="stats-number">{{ $users->where('role', 'admin')->count() ?? 1 }}</div>
            <div class="stats-label">Administrator</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stats-card stats-users">
            <div class="stats-number">{{ $users->where('role', 'user')->count() ?? 2 }}</div>
            <div class="stats-label">User Biasa</div>
        </div>
    </div>
</div>

<!-- IMPROVED TABLE SECTION -->
<div class="card-enhanced">
    <div class="card-header-enhanced">
        <h6 class="card-title-enhanced">
            <i class="fas fa-table me-2"></i>Daftar User
        </h6>
        <div style="font-size: 0.9rem; color: var(--text-light);">
            Total: <strong>{{ $users->count() ?? 3 }}</strong> user terdaftar
        </div>
    </div>
    <div class="card-body p-0">
        <div class="p-3">
            <div class="table-responsive">
                <table class="table table-enhanced" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-nama">Nama</th>
                            <th class="col-email">Email</th>
                            <th class="col-role">Role</th>
                            <th class="col-tanggal">Tanggal Daftar</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users ?? [] as $user)
                        <tr data-id="{{ $user->id }}">
                            <td class="col-no">{{ $loop->iteration }}</td>
                            <td class="col-nama">{{ $user->name }}</td>
                            <td class="col-email">{{ $user->email }}</td>
                            <td class="col-role">
                                @if($user->role === 'admin')
                                    <span class="role-badge role-admin">Admin</span>
                                @else
                                    <span class="role-badge role-user">User</span>
                                @endif
                            </td>
                            <td class="col-tanggal">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="col-aksi">
                                <a href="{{ route('admin.user.edit', $user->id) }}" 
                                   class="action-btn btn-edit" 
                                   title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" 
                                      method="POST" 
                                      class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="action-btn btn-delete" 
                                            title="Hapus User"
                                            onclick="return confirmDelete('{{ $user->name }}', '{{ $user->email }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="col-no">1</td>
                            <td class="col-nama">Administrator</td>
                            <td class="col-email">adminmoora2@moora.com</td>
                            <td class="col-role">
                                <span class="role-badge role-admin">Admin</span>
                            </td>
                            <td class="col-tanggal">30 May 2025</td>
                            <td class="col-aksi">
                                <a href="#" class="action-btn btn-edit" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="action-btn btn-delete" title="Hapus User">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-no">2</td>
                            <td class="col-nama">User</td>
                            <td class="col-email">kelompok2@moora.com</td>
                            <td class="col-role">
                                <span class="role-badge role-user">User</span>
                            </td>
                            <td class="col-tanggal">30 May 2025</td>
                            <td class="col-aksi">
                                <a href="#" class="action-btn btn-edit" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="action-btn btn-delete" title="Hapus User">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-no">3</td>
                            <td class="col-nama">Yelena Theresia</td>
                            <td class="col-email">yelena.theresia.sibuea.tik23@stu.pnj.ac.id</td>
                            <td class="col-role">
                                <span class="role-badge role-user">User</span>
                            </td>
                            <td class="col-tanggal">03 Jun 2025</td>
                            <td class="col-aksi">
                                <a href="#" class="action-btn btn-edit" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="action-btn btn-delete" title="Hapus User">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                { orderable: false, targets: [5] },
                { className: "text-center", targets: [0, 3, 4, 5] }
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

    // Enhanced delete confirmation
    function confirmDelete(name, email) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Konfirmasi Hapus User',
            html: `
                <div style="text-align: left;">
                    <p>Apakah Anda yakin ingin menghapus user berikut?</p>
                    <div style="background: #fef2f2; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #ef4444;">
                        <div style="margin-bottom: 0.5rem;">
                            <strong>Nama:</strong> ${name}
                        </div>
                        <div>
                            <strong>Email:</strong> ${email}
                        </div>
                    </div>
                    <p class="text-danger"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus User!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            width: '500px'
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
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
            showConfirmButton: false
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