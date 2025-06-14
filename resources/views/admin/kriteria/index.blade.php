@extends('layouts.app')

@section('title', 'Manajemen Kriteria')

@section('styles')
    <style>
        /* CSS HALAMAN KRITERIA - DISAMAKAN DENGAN SUB KRITERIA */

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

        /* Enhanced bulk alert */
        .bulk-alert {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            border: 1px solid #dc2626 !important;
            border-radius: 15px;
            color: white;
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.3);
            padding: 1.5rem;
            margin-bottom: 2rem;
            animation: slideInDown 0.5s ease-out;
        }
        @keyframes slideInDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
        .bulk-alert .btn { border-radius: 8px; font-weight: 600; transition: all 0.2s ease; border: 1px solid rgba(255, 255, 255, 0.3) !important; }
        .bulk-alert .btn:hover { transform: translateY(-1px); }

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

        /* Enhanced table - Clean Modern Design + Fixed Sorting Icons */
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

        /* Fix DataTable sorting arrows untuk kolom checkbox */
        .enhanced-table thead th:first-child {
            position: relative !important;
        }

        .enhanced-table thead th:first-child::before,
        .enhanced-table thead th:first-child::after {
            display: none !important;
            content: none !important;
        }

        /* Hide DataTable sorting class untuk checkbox column */
        .enhanced-table thead th:first-child.sorting,
        .enhanced-table thead th:first-child.sorting_asc,
        .enhanced-table thead th:first-child.sorting_desc {
            background-image: none !important;
            cursor: default !important;
        }

        .enhanced-table thead th:first-child.sorting::before,
        .enhanced-table thead th:first-child.sorting::after,
        .enhanced-table thead th:first-child.sorting_asc::before,
        .enhanced-table thead th:first-child.sorting_asc::after,
        .enhanced-table thead th:first-child.sorting_desc::before,
        .enhanced-table thead th:first-child.sorting_desc::after {
            display: none !important;
            content: none !important;
        }

        /* Hide DataTable sorting untuk kolom Aksi juga */
        .enhanced-table thead th:last-child.sorting,
        .enhanced-table thead th:last-child.sorting_asc,
        .enhanced-table thead th:last-child.sorting_desc {
            background-image: none !important;
            cursor: default !important;
        }

        .enhanced-table thead th:last-child.sorting::before,
        .enhanced-table thead th:last-child.sorting::after,
        .enhanced-table thead th:last-child.sorting_asc::before,
        .enhanced-table thead th:last-child.sorting_asc::after,
        .enhanced-table thead th:last-child.sorting_desc::before,
        .enhanced-table thead th:last-child.sorting_desc::after {
            display: none !important;
            content: none !important;
        }

        /* REMOVE semua custom hover effects - biarkan DataTable yang handle */
        .enhanced-table thead th::after {
            display: none !important;
            content: none !important;
        }

        /* Simple hover effect untuk semua header kecuali checkbox dan aksi */
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

        /* Badge untuk Jenis Kriteria - Enhanced */
        .jenis-badge {
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
        .jenis-badge.bg-success { 
            background: linear-gradient(135deg, #059669, #10b981) !important; 
            color: white; 
        }
        .jenis-badge.bg-danger { 
            background: linear-gradient(135deg, #dc2626, #ef4444) !important; 
            color: white; 
        }
        .jenis-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Kode badge styling - Modern Clean */
        .kode-badge {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.8rem;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .kode-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-color: var(--primary);
        }

        /* Custom checkbox - Enhanced & Fully Fixed */
        input[type="checkbox"].custom-checkbox {
            width: 20px !important;
            height: 20px !important;
            border: 2px solid var(--primary) !important;
            border-radius: 6px !important;
            cursor: pointer !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background: white !important;
            background-color: white !important;
            vertical-align: middle !important;
            position: relative !important;
            transition: all 0.3s ease !important;
            outline: none !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
            min-width: 20px !important;
            min-height: 20px !important;
            max-width: 20px !important;
            max-height: 20px !important;
        }
        
        input[type="checkbox"].custom-checkbox:focus {
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1) !important;
            border-color: var(--primary) !important;
            background: white !important;
        }
        
        input[type="checkbox"].custom-checkbox:hover {
            transform: scale(1.1) !important;
            box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1) !important;
            background: white !important;
        }
        
        input[type="checkbox"].custom-checkbox:checked { 
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        
        input[type="checkbox"].custom-checkbox:checked::after { 
            content: '✓' !important; 
            position: absolute !important; 
            top: 50% !important; 
            left: 50% !important; 
            transform: translate(-50%, -50%) !important; 
            color: white !important; 
            font-size: 12px !important; 
            font-weight: bold !important; 
            line-height: 1 !important;
        }
        
        input[type="checkbox"].custom-checkbox:indeterminate { 
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        
        input[type="checkbox"].custom-checkbox:indeterminate::after { 
            content: '–' !important; 
            position: absolute !important; 
            top: 50% !important; 
            left: 50% !important; 
            transform: translate(-50%, -50%) !important; 
            color: white !important; 
            font-size: 14px !important; 
            font-weight: bold !important; 
            line-height: 1 !important;
        }

        /* Complete DataTable checkbox override */
        .dataTables_wrapper input[type="checkbox"].custom-checkbox,
        table.dataTable input[type="checkbox"].custom-checkbox,
        .enhanced-table input[type="checkbox"].custom-checkbox,
        #dataTable input[type="checkbox"].custom-checkbox,
        .table input[type="checkbox"].custom-checkbox {
            width: 20px !important;
            height: 20px !important;
            margin: 0 !important;
            padding: 0 !important;
            border: 2px solid var(--primary) !important;
            background: white !important;
            background-color: white !important;
            box-shadow: none !important;
            outline: none !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            border-radius: 6px !important;
            position: relative !important;
            vertical-align: middle !important;
        }

        .dataTables_wrapper input[type="checkbox"].custom-checkbox:checked,
        table.dataTable input[type="checkbox"].custom-checkbox:checked,
        .enhanced-table input[type="checkbox"].custom-checkbox:checked,
        #dataTable input[type="checkbox"].custom-checkbox:checked,
        .table input[type="checkbox"].custom-checkbox:checked {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .dataTables_wrapper input[type="checkbox"].custom-checkbox:indeterminate,
        table.dataTable input[type="checkbox"].custom-checkbox:indeterminate,
        .enhanced-table input[type="checkbox"].custom-checkbox:indeterminate,
        #dataTable input[type="checkbox"].custom-checkbox:indeterminate,
        .table input[type="checkbox"].custom-checkbox:indeterminate {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%) !important;
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        /* Remove any border/outline from all possible sources */
        input[type="checkbox"].custom-checkbox,
        input[type="checkbox"].custom-checkbox:focus,
        input[type="checkbox"].custom-checkbox:active,
        input[type="checkbox"].custom-checkbox:hover {
            border-image: none !important;
            border-style: solid !important;
            text-decoration: none !important;
        }

        /* Action buttons styling - Enhanced Modern */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            justify-content: center;
        }

        .action-buttons .btn {
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
        }

        .action-buttons .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .action-buttons .btn:hover::before {
            left: 100%;
        }

        .action-buttons .btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .action-buttons .btn.btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .action-buttons .btn.btn-warning:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }

        .action-buttons .btn.btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .action-buttons .btn.btn-danger:hover {
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

        /* Text alignment dan styling untuk konten */
        .enhanced-table tbody td:nth-child(1) { /* Checkbox */
            text-align: center;
        }

        .enhanced-table tbody td:nth-child(2) { /* No */
            text-align: center;
            font-weight: 600;
            color: #6b7280;
            font-size: 0.85rem;
        }

        .enhanced-table tbody td:nth-child(3) { /* Kode */
            text-align: center;
        }

        .enhanced-table tbody td:nth-child(4) { /* Nama */
            text-align: left;
            font-weight: 700;
            color: #1f2937;
            font-size: 0.95rem;
        }

        .enhanced-table tbody td:nth-child(5) { /* Bobot */
            text-align: center;
            font-weight: 700;
            color: var(--primary);
            font-size: 1rem;
        }

        .enhanced-table tbody td:nth-child(6) { /* Jenis */
            text-align: center;
        }

        .enhanced-table tbody td:nth-child(7) { /* Aksi */
            text-align: center;
        }

        /* Header alignment yang konsisten */
        .enhanced-table thead th:nth-child(1), /* Checkbox */
        .enhanced-table thead th:nth-child(2), /* No */
        .enhanced-table thead th:nth-child(3), /* Kode */
        .enhanced-table thead th:nth-child(5), /* Bobot */
        .enhanced-table thead th:nth-child(6), /* Jenis */
        .enhanced-table thead th:nth-child(7) /* Aksi */ {
            text-align: center;
        }

        .enhanced-table thead th:nth-child(4) { /* Nama */
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

            .action-buttons .btn {
                width: 28px;
                height: 28px;
                font-size: 0.7rem;
            }

            .enhanced-table thead th,
            .enhanced-table tbody td {
                padding: 0.75rem 0.5rem;
                font-size: 0.8rem;
            }

            .kode-badge, .jenis-badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
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
        }

        /* Loading state styling */
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
            border: none;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3 !important;
            border-top: 4px solid var(--primary) !important;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            <a href="{{ route('admin.kriteria.create') }}" class="btn-enhanced btn-success text-white">
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
            <div style="font-size: 0.9rem; color: #6b7280;">
                Total: <strong>{{ $kriterias->count() }}</strong> data terdaftar
            </div>
        </div>
        <div class="content-card-body">
            <div class="table-responsive">
                <table class="table enhanced-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" id="pilihSemua" class="custom-checkbox" onchange="toggleSemua()">
                            </th>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Bobot</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriterias as $kriteria)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="pilih-item custom-checkbox" value="{{ $kriteria->id }}" onchange="cekPilihan()">
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="kode-badge">{{ $kriteria->kode }}</span>
                                </td>
                                <td>
                                    {{ $kriteria->nama }}
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $kriteria->bobot }}</span>
                                </td>
                                <td>
                                    @if ($kriteria->jenis == 'benefit')
                                        <span class="jenis-badge bg-success">
                                            <i class="fas fa-arrow-up me-1"></i>Benefit
                                        </span>
                                    @else
                                        <span class="jenis-badge bg-danger">
                                            <i class="fas fa-arrow-down me-1"></i>Cost
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.kriteria.edit', $kriteria->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit Kriteria">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.kriteria.destroy', $kriteria->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Kriteria"
                                                onclick="return confirmDelete(event, '{{ $kriteria->nama }}', '{{ $kriteria->kode }}')">
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTable
            $('#dataTable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                dom: '<"dataTables_wrapper"<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>><"table-responsive"t><"dataTables_wrapper"<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                columnDefs: [
                    { orderable: false, targets: [0, 6] }, // Disable sorting untuk checkbox dan aksi
                    { className: 'no-sort', targets: [0] } // Extra class untuk checkbox column
                ],
            });

            // Enhanced checkbox click handling
            $(document).on('click', '#pilihSemua', function(e) {
                e.stopPropagation();
                toggleSemua();
            });

            $(document).on('click', '.pilih-item', function(e) {
                e.stopPropagation();
                cekPilihan();
            });

            // Additional click area for checkbox cells
            $(document).on('click', 'td:first-child, th:first-child', function(e) {
                if (e.target.type !== 'checkbox') {
                    const checkbox = $(this).find('input[type="checkbox"]')[0];
                    if (checkbox) {
                        checkbox.checked = !checkbox.checked;
                        if (checkbox.id === 'pilihSemua') {
                            toggleSemua();
                        } else {
                            cekPilihan();
                        }
                    }
                }
            });
        });

        // Fungsi konfirmasi delete individual (seperti di sub kriteria)
        function confirmDelete(event, nama, kode) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `
                    <div style="text-align: left;">
                        <p>Apakah Anda yakin ingin menghapus kriteria ini?</p>
                        <div style="background: #fef2f2; padding: 1rem; border-radius: 8px; margin: 1rem 0; border-left: 4px solid #ef4444;">
                            <div style="margin-bottom: 0.5rem;">
                                <strong>Nama:</strong> ${nama}
                            </div>
                            <div>
                                <strong>Kode:</strong> ${kode}
                            </div>
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
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
            return false;
        }

        // Fungsi untuk Hapus Terpilih (Bulk Delete)
        function hapusTerpilih() {
            const terpilih = document.querySelectorAll('.pilih-item:checked');
            const ids = [];
            const names = [];

            terpilih.forEach(function (checkbox) {
                ids.push(checkbox.value);
                const row = checkbox.closest('tr');
                const name = row.querySelector('td:nth-child(4)').textContent.trim();
                names.push(name);
            });

            if (ids.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Pilih minimal satu kriteria untuk dihapus.',
                    confirmButtonColor: 'var(--primary)'
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Hapus Massal',
                html: `
                    <p>Apakah Anda yakin ingin menghapus <strong>${ids.length}</strong> kriteria berikut?</p>
                    <div style="max-height: 200px; overflow-y: auto; background: #f8f9fa; padding: 1rem; border-radius: 8px; margin: 1rem 0; text-align: left;">
                        ${names.map(name => `<div style="padding: 0.25rem 0; border-bottom: 1px solid #dee2e6;">• ${name}</div>`).join('')}
                    </div>
                    <p class="text-danger"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('idsYangDipilih').value = ids.join(',');
                    document.getElementById('formBulkDelete').submit();
                }
            });
        }
        
        function toggleSemua() {
            const pilihSemua = document.getElementById('pilihSemua');
            const checkboxes = document.querySelectorAll('.pilih-item');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = pilihSemua.checked;
            });
            cekPilihan();
        }

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

        function batalPilih() {
            document.querySelectorAll('.pilih-item').forEach(function (checkbox) {
                checkbox.checked = false;
            });
            document.getElementById('pilihSemua').checked = false;
            document.getElementById('pilihSemua').indeterminate = false;
            document.getElementById('bulkAlert').classList.add('d-none');
        }

        @if(session('success'))
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

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
@endsection