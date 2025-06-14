@extends('layouts.app')

@section('title', 'Manajemen User')

@section('styles')
    <style>
        /* CSS HALAMAN USER - DISAMAKAN DENGAN KRITERIA */

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
        .btn-enhanced.btn-warning { background: linear-gradient(135deg, #d97706, #f59e0b); border-color: #d97706 !important; }
        .btn-enhanced.btn-danger { background: linear-gradient(135deg, #dc2626, #ef4444); border-color: #dc2626 !important; }

        /* User Statistics Cards - dengan hover effect seperti dashboard */
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

        .stats-card.stats-total::before {
            background: linear-gradient(to bottom, #a16207, #d97706);
        }

        .stats-card.stats-admin::before {
            background: linear-gradient(to bottom, #dc2626, #ef4444);
        }

        .stats-card.stats-users::before {
            background: linear-gradient(to bottom, #059669, #10b981);
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
        }

        .stats-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: inherit;
            opacity: 0.1;
            border-radius: inherit;
        }

        .stats-icon.total {
            background: linear-gradient(135deg, #a16207, #d97706);
            color: white;
        }

        .stats-icon.admin {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
        }

        .stats-icon.users {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: #a16207;
            display: block;
            line-height: 1;
            animation: countUp 1s ease-out;
        }

        .stats-card.stats-admin .stats-number {
            color: #dc2626;
        }

        .stats-card.stats-users .stats-number {
            color: #059669;
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
        .stats-card:nth-child(3) { animation-delay: 0.3s; }

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

        /* Hide DataTable sorting untuk kolom No dan Aksi */
        .enhanced-table thead th:first-child.sorting,
        .enhanced-table thead th:first-child.sorting_asc,
        .enhanced-table thead th:first-child.sorting_desc,
        .enhanced-table thead th:last-child.sorting,
        .enhanced-table thead th:last-child.sorting_asc,
        .enhanced-table thead th:last-child.sorting_desc {
            background-image: none !important;
            cursor: default !important;
        }

        .enhanced-table thead th:first-child.sorting::before,
        .enhanced-table thead th:first-child.sorting::after,
        .enhanced-table thead th:first-child.sorting_asc::before,
        .enhanced-table thead th:first-child.sorting_asc::after,
        .enhanced-table thead th:first-child.sorting_desc::before,
        .enhanced-table thead th:first-child.sorting_desc::after,
        .enhanced-table thead th:last-child.sorting::before,
        .enhanced-table thead th:last-child.sorting::after,
        .enhanced-table thead th:last-child.sorting_asc::before,
        .enhanced-table thead th:last-child.sorting_asc::after,
        .enhanced-table thead th:last-child.sorting_desc::before,
        .enhanced-table thead th:last-child.sorting_desc::after {
            display: none !important;
            content: none !important;
        }

        /* Simple hover effect untuk header yang bisa di-sort */
        .enhanced-table thead th:not(:first-child):not(:last-child):hover {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%) !important;
            transform: translateY(-1px);
            transition: all 0.2s ease;
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

        /* Column specific styling - mengikuti style kriteria */
        .col-no {
            text-align: center;
            font-weight: 600;
            color: #6b7280;
            font-size: 0.85rem;
        }

        .col-nama {
            text-align: left;
            font-weight: 700;
            color: #1f2937;
            font-size: 0.95rem;
        }

        .col-email {
            text-align: left;
            color: #6b7280;
            font-size: 0.85rem;
        }

        .col-role {
            text-align: center;
        }

        .col-tanggal {
            text-align: center;
            color: #6b7280;
            font-size: 0.85rem;
        }

        .col-aksi {
            text-align: center;
        }

        /* Enhanced Role Badges - matching kriteria jenis badge style */
        .role-badge {
            border-radius: 12px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .role-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .role-admin { 
            background: linear-gradient(135deg, #dc2626, #ef4444) !important; 
            color: white; 
        }

        .role-user { 
            background: linear-gradient(135deg, #059669, #10b981) !important; 
            color: white; 
        }

        /* Action buttons styling - Enhanced Modern */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            justify-content: center;
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

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
        }

        /* DataTable wrapper styling */
        .dataTables_wrapper {
            padding: 1.5rem;
            border: none !important;
            background: transparent;
        }

        .dataTables_wrapper>div {
            border: none !important;
        }

        .dataTables_wrapper .row {
            border: none !important;
        }

        .dataTables_wrapper .col-sm-12 {
            border: none !important;
        }

        /* DataTable controls styling */
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border-radius: 10px;
            border: 2px solid #e2e8f0 !important;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            background: white;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_length label {
            font-weight: 500;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0;
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

        /* Header alignment yang konsisten */
        .enhanced-table thead th:nth-child(1), /* No */
        .enhanced-table thead th:nth-child(4), /* Role */
        .enhanced-table thead th:nth-child(5), /* Tanggal */
        .enhanced-table thead th:nth-child(6) /* Aksi */ {
            text-align: center;
        }

        .enhanced-table thead th:nth-child(2), /* Nama */
        .enhanced-table thead th:nth-child(3) /* Email */ {
            text-align: left;
        }

        /* DataTable info dan pagination styling */
        .dataTables_wrapper .dataTables_info {
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 500;
            padding: 0.75rem 0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            margin: 0 0.15rem;
            border: 1px solid #d1d5db !important;
            background: white;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f8f9fa;
            border-color: var(--primary) !important;
            color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(161, 98, 7, 0.15);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-color: var(--primary) !important;
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, #92400e 0%, #a16207 100%);
            border-color: #92400e !important;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.4);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #9ca3af;
            cursor: not-allowed;
            opacity: 0.6;
            background: #f9fafb;
            border-color: #e5e7eb !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background: #f9fafb;
            border-color: #e5e7eb !important;
            color: #9ca3af;
            transform: none;
            box-shadow: none;
        }

        /* Loading state styling */
        .btn-delete .fa-spinner {
            animation: spin 1s linear infinite;
        }

        .btn-delete:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive design untuk mobile */
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

            .dataTables_wrapper {
                padding: 1rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }

            .action-btn {
                width: 28px;
                height: 28px;
                font-size: 0.7rem;
            }

            .enhanced-table thead th,
            .enhanced-table tbody td {
                padding: 0.75rem 0.5rem;
                font-size: 0.8rem;
            }

            .role-badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
            }

            .stats-card {
                margin-bottom: 1rem;
                padding: 1.5rem;
            }

            .stats-number {
                font-size: 2rem;
            }

            .col-email {
                max-width: 150px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none;
                text-align: center;
                margin-bottom: 1rem;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                margin-left: 0;
                margin-top: 0.5rem;
                max-width: 300px;
            }

            .dataTables_wrapper .dataTables_length select {
                margin: 0.25rem;
            }

            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                float: none;
                text-align: center;
                margin-top: 1rem;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.4rem 0.6rem;
                margin: 0.1rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .dataTables_wrapper .dataTables_filter input {
                max-width: 250px;
                font-size: 0.85rem;
            }

            .dataTables_wrapper .dataTables_info {
                font-size: 0.8rem;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.3rem 0.5rem;
                font-size: 0.75rem;
            }

            .role-badge {
                font-size: 0.65rem;
                padding: 0.2rem 0.4rem;
            }

            .stats-number {
                font-size: 1.8rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="page-title">👥 Manajemen User</h1>
                <p class="page-subtitle mb-0">Kelola pengguna dan hak akses sistem</p>
            </div>
            <a href="{{ route('admin.user.create') }}" class="btn-enhanced btn-success text-white">
                <i class="fas fa-user-plus me-2"></i>Tambah User
            </a>
        </div>
    </div>

    <!-- User Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card stats-total">
                <div class="stats-icon total">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-number">{{ $users->count() ?? 3 }}</div>
                <div class="stats-label">Total User</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card stats-admin">
                <div class="stats-icon admin">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stats-number">{{ $users->where('role', 'admin')->count() ?? 1 }}</div>
                <div class="stats-label">Administrator</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card stats-users">
                <div class="stats-icon users">
                    <i class="fas fa-user"></i>
                </div>
                <div class="stats-number">{{ $users->where('role', 'user')->count() ?? 2 }}</div>
                <div class="stats-label">User Biasa</div>
            </div>
        </div>
    </div>

    <!-- Enhanced Content Card -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="fas fa-table"></i>
                Daftar User
            </h3>
            <div style="font-size: 0.9rem; color: #6b7280;">
                Total: <strong>{{ $users->count() ?? 3 }}</strong> user terdaftar
            </div>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
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
                                    @if ($user->role === 'admin')
                                        <span class="role-badge role-admin">
                                            <i class="fas fa-crown me-1"></i>Admin
                                        </span>
                                    @else
                                        <span class="role-badge role-user">
                                            <i class="fas fa-user me-1"></i>User
                                        </span>
                                    @endif
                                </td>
                                <td class="col-tanggal">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="col-aksi">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="action-btn btn-edit"
                                            title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn btn-delete" title="Hapus User"
                                                data-name="{{ $user->name }}" data-email="{{ $user->email }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="col-no">1</td>
                                <td class="col-nama">Administrator</td>
                                <td class="col-email">adminmoora2@moora.com</td>
                                <td class="col-role">
                                    <span class="role-badge role-admin">
                                        <i class="fas fa-crown me-1"></i>Admin
                                    </span>
                                </td>
                                <td class="col-tanggal">30 May 2025</td>
                                <td class="col-aksi">
                                    <div class="action-buttons">
                                        <a href="#" class="action-btn btn-edit" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="action-btn btn-delete" title="Hapus User"
                                            data-name="User" data-email="kelompok2@moora.com">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-no">3</td>
                                <td class="col-nama">Yelena Theresia</td>
                                <td class="col-email">yelena.theresia.sibuea.tik23@stu.pnj.ac.id</td>
                                <td class="col-role">
                                    <span class="role-badge role-user">
                                        <i class="fas fa-user me-1"></i>User
                                    </span>
                                </td>
                                <td class="col-tanggal">03 Jun 2025</td>
                                <td class="col-aksi">
                                    <div class="action-buttons">
                                        <a href="#" class="action-btn btn-edit" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="action-btn btn-delete" title="Hapus User"
                                            data-name="Yelena Theresia"
                                            data-email="yelena.theresia.sibuea.tik23@stu.pnj.ac.id">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Enhanced DataTable initialization
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                "dom": '<"dataTables_wrapper"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>><"table-responsive"t><"dataTables_wrapper"<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                "order": [[1, 'asc']], // Default sort by nama
                "columnDefs": [
                    { orderable: false, targets: [0, 5] }, // Disable sorting untuk No dan Aksi
                    { className: 'no-sort', targets: [0] } // Extra class untuk No column
                ],
                "responsive": true
            });

            // Enhanced delete form handling
            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
                const form = this;
                const name = $(form).find('.btn-delete').data('name') || 'User';
                const email = $(form).find('.btn-delete').data('email') || '';

                confirmDelete(name, email, form);
            });
        });

        // Enhanced delete confirmation
        function confirmDelete(name, email, formElement) {
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
            }).then((result) => {
                if (result.isConfirmed) {
                    const button = $(formElement).find('button[type="submit"]');
                    button.html('<i class="fas fa-spinner fa-spin"></i>');
                    button.prop('disabled', true);
                    formElement.submit();
                }
            });
        }

        // Success notification
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
        @endif

        // Error notification
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
@endsection