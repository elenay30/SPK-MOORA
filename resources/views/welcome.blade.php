@extends('layouts.app')

@section('title', 'Welcome to SPK Karyawan Terbaik')

@section('styles')
    <!-- Include the fixed CSS here -->
    <style>
        /* PERBAIKAN: CSS Welcome Page - Hilangkan Konflik dan Animasi Berlebihan */

        /* Enhanced Color Variables - Matching App.blade Color Scheme */
        :root {
            --primary: #a16207;
            --secondary: #ca8a04;
            --orange: #ff7e3e;
            --light-primary: #fef3c7;
            --light-secondary: #fffbeb;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            --accent: #059669;
            --soft-bg: #fefefe;
            --text-dark: #1c1917;
            --text-light: #78716c;
            --emerald: #10b981;
            --amber: #f59e0b;
            --brown-light: #fef7ed;
            --brown-medium: #fed7aa;
            --red-soft: #ef4444;
            --warm-gray: #f5f5f4;

            /* Welcome page specific gradients using brown theme */
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            --gradient-soft: linear-gradient(135deg, var(--light-primary) 0%, var(--brown-light) 100%);
            --shadow-primary: 0 20px 40px rgba(161, 98, 7, 0.15);
            --shadow-secondary: 0 10px 30px rgba(202, 138, 4, 0.15);
        }

        /* PERBAIKAN: Hilangkan semua border yang tidak perlu */
        *,
        *::before,
        *::after {
            border-bottom: none !important;
        }

        html,
        body {
            border: none !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
        }

        /* Enhanced Welcome Container - PERBAIKAN: Simplifikasi Background */
        .welcome-container {
            background: linear-gradient(135deg,
                    var(--warm-gray) 0%,
                    #f3f2f0 25%,
                    var(--brown-light) 50%,
                    #fef3c7 75%,
                    var(--light-primary) 100%);
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            padding: 2rem 0;
            border: none !important;
            box-shadow: none !important;
        }

        /* PERBAIKAN: Hilangkan animasi background yang bisa bikin lag */
        .welcome-container::before {
            display: none !important;
        }

        /* Enhanced Hero Card - PERBAIKAN: Simplifikasi */
        .hero-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(161, 98, 7, 0.1);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(161, 98, 7, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid rgba(161, 98, 7, 0.1) !important;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 20px 20px 0 0;
        }

        .hero-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(161, 98, 7, 0.15);
        }

        /* PERBAIKAN: Typography tanpa animasi berlebihan */
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            position: relative;
            line-height: 1.2;
        }

        /* PERBAIKAN: Hilangkan animasi trophy yang bikin ngedip */
        .hero-title::after {
            content: '🏆';
            position: absolute;
            top: -10px;
            right: -40px;
            font-size: 2rem;
            /* animation: bounce-trophy 2s ease-in-out infinite; - DIHILANGKAN */
        }

        .hero-subtitle {
            font-size: 2rem;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 2rem;
            position: relative;
        }

        .hero-subtitle::before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .hero-description {
            font-size: 1.3rem;
            color: var(--text-light);
            font-weight: 500;
            margin-bottom: 2rem;
        }

        /* PERBAIKAN: Button yang tidak nabrak dan stabil */
        .btn-enhanced {
            display: inline-block !important;
            padding: 1rem 2.5rem !important;
            font-size: 1.1rem !important;
            font-weight: 600 !important;
            border-radius: 25px !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            overflow: hidden !important;
            box-shadow: 0 4px 15px rgba(161, 98, 7, 0.2) !important;
            text-decoration: none !important;
            border: none !important;
            margin: 0.5rem !important;
            vertical-align: top !important;
            white-space: nowrap !important;
        }

        /* PERBAIKAN: Hilangkan animasi yang bikin ngedip */
        .btn-enhanced::before {
            display: none !important;
        }

        .btn-enhanced:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(161, 98, 7, 0.25) !important;
        }

        .btn-primary-enhanced {
            background: var(--gradient-primary) !important;
            border: none !important;
            color: white !important;
        }

        .btn-primary-enhanced:hover {
            background: linear-gradient(135deg, #92400e 0%, #a16207 100%) !important;
            color: white !important;
        }

        .btn-outline-enhanced {
            background: transparent !important;
            border: 2px solid var(--secondary) !important;
            color: var(--secondary) !important;
        }

        .btn-outline-enhanced:hover {
            background: var(--gradient-primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
        }

        /* PERBAIKAN: Container button yang stabil */
        .button-container {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 1rem !important;
            flex-wrap: wrap !important;
            margin-top: 2rem !important;
        }

        /* Enhanced Info Card - PERBAIKAN: Simplifikasi */
        .info-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(161, 98, 7, 0.1);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(161, 98, 7, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid rgba(161, 98, 7, 0.1) !important;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 20px 20px 0 0;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(161, 98, 7, 0.12);
        }

        .info-card-header {
            background: var(--gradient-primary);
            color: white;
            padding: 1.5rem 2rem;
            border-radius: 20px 20px 0 0;
            position: relative;
            border: none !important;
        }

        /* PERBAIKAN: Hilangkan animasi icon yang bikin ngedip */
        .info-card-header::after {
            content: '💡';
            position: absolute;
            top: 50%;
            right: 2rem;
            transform: translateY(-50%);
            font-size: 1.5rem;
            /* animation: pulse-icon 2s ease-in-out infinite; - DIHILANGKAN */
        }

        /* Enhanced Steps List - PERBAIKAN: Simplifikasi */
        .steps-container {
            background: var(--gradient-soft);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border: none !important;
            box-shadow: none !important;
        }

        .steps-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .steps-title::before {
            content: '🚀';
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }

        .enhanced-steps {
            counter-reset: step-counter;
            padding-left: 0;
            list-style: none;
        }

        .enhanced-step {
            position: relative;
            margin-bottom: 1.5rem;
            padding: 1rem 1rem 1rem 4rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(161, 98, 7, 0.08);
            transition: all 0.3s ease;
            border: none !important;
            /* PERBAIKAN: Hilangkan animasi slide yang bikin lag */
            opacity: 1 !important;
        }

        .enhanced-step::before {
            content: counter(step-counter);
            counter-increment: step-counter;
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 2.5rem;
            height: 2.5rem;
            background: var(--gradient-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.3);
            transition: all 0.3s ease;
        }

        .enhanced-step:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(161, 98, 7, 0.15);
        }

        .enhanced-step:hover::before {
            transform: translateY(-50%) scale(1.05);
            box-shadow: 0 3px 12px rgba(161, 98, 7, 0.4);
        }

        /* PERBAIKAN: Hilangkan animasi yang tidak perlu */
        .animate-fade-in,
        .animate-fade-in-down,
        .animate-fade-in-up,
        .animate-delay-1,
        .animate-delay-2,
        .animate-delay-3,
        .animate-delay-4,
        .loading-animation {
            /* Hilangkan semua animasi yang bikin ngedip */
            animation: none !important;
            opacity: 1 !important;
        }

        /* Enhanced HR - PERBAIKAN: Simplifikasi */
        .enhanced-hr {
            height: 3px;
            border: none !important;
            background: var(--gradient-primary);
            border-radius: 2px;
            margin: 3rem 0;
            position: relative;
            overflow: hidden;
        }

        /* PERBAIKAN: Hilangkan animasi shine yang bikin ngedip */
        .enhanced-hr::after {
            display: none !important;
        }

        /* PERBAIKAN: Responsive Design yang stabil */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-title::after {
                display: none;
            }

            .hero-subtitle {
                font-size: 1.5rem;
            }

            .btn-enhanced {
                padding: 0.8rem 1.5rem !important;
                font-size: 1rem !important;
                margin: 0.3rem !important;
                width: auto !important;
                display: inline-block !important;
            }

            .button-container {
                flex-direction: column !important;
                align-items: center !important;
            }

            .enhanced-step {
                padding: 1rem 1rem 1rem 3.5rem;
            }

            .enhanced-step::before {
                width: 2rem;
                height: 2rem;
                font-size: 0.9rem;
            }
        }

        /* PERBAIKAN: Override untuk memastikan tidak ada konflik dengan CSS utama */
        .welcome-container .btn {
            border-radius: 25px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            overflow: visible !important;
            white-space: nowrap !important;
        }

        /* PERBAIKAN: Pastikan alert tidak nabrak */
        .alert {
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 2px 8px rgba(161, 98, 7, 0.1) !important;
        }

        /* PERBAIKAN: Hilangkan semua keyframes yang bikin ngedip */
        @keyframes bounce-trophy,
        @keyframes pulse-icon,
        @keyframes slideInLeft,
        @keyframes fadeIn,
        @keyframes fadeInDown,
        @keyframes fadeInUp,
        @keyframes shine,
        @keyframes loadIn,
        @keyframes float-bg {
            /* Semua animasi dihilangkan */
        }

        /* PERBAIKAN: Container utama */
        .container {
            border: none !important;
            box-shadow: none !important;
        }

        .row {
            border: none !important;
            box-shadow: none !important;
        }

        .col-md-10 {
            border: none !important;
            box-shadow: none !important;
        }

        /* PERBAIKAN: Card body */
        .card-body {
            border: none !important;
            box-shadow: none !important;
        }

        /* PASTE CSS DARI ARTIFACT SEBELUMNYA DI SINI */
    </style>
@endsection

@section('content')
    <div class="welcome-container">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <!-- Hero Section - PERBAIKAN: Simplifikasi struktur -->
                    <div class="hero-card shadow-lg">
                        <div class="card-body p-5 text-center">
                            <h1 class="hero-title">
                                Sistem Pendukung Keputusan
                            </h1>
                            <h2 class="hero-subtitle">
                                Pemilihan Karyawan Terbaik Parking Area
                            </h2>
                            <p class="hero-description">
                                Menggunakan Metode MOORA (Multi-Objective Optimization on the basis of Ratio Analysis)
                            </p>

                            <div class="enhanced-hr"></div>

                            <p class="lead">
                                SPK ini membantu menentukan karyawan terbaik berdasarkan kriteria penilaian yang telah
                                ditentukan.
                            </p>

                            <!-- PERBAIKAN: Container button yang stabil -->
                            <div class="button-container mt-4">
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-enhanced btn-primary-enhanced">
                                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard Admin
                                        </a>
                                    @else
                                        <a href="{{ route('user.dashboard') }}" class="btn btn-enhanced btn-primary-enhanced">
                                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard User
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-enhanced btn-primary-enhanced">
                                        <i class="fas fa-sign-in-alt me-2"></i> LOGIN
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-enhanced btn-outline-enhanced">
                                        <i class="fas fa-user-plus me-2"></i> REGISTER
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- Info Section - PERBAIKAN: Simplifikasi -->
                    <div class="info-card mt-5">
                        <div class="info-card-header">
                            <h4 class="mb-0 fw-bold">Tentang Metode MOORA</h4>
                        </div>
                        <div class="card-body p-4">
                            <p class="mb-4">
                                Metode MOORA (Multi-Objective Optimization on the basis of Ratio Analysis) adalah metode
                                perhitungan
                                yang diperkenalkan oleh Brauers dan Zavadkas pada tahun 2006.
                            </p>

                            <div class="steps-container">
                                <h5 class="steps-title">Tahapan perhitungan MOORA:</h5>
                                <ol class="enhanced-steps">
                                    <li class="enhanced-step">
                                        <strong>Membuat matriks keputusan</strong>
                                        <br><small class="text-muted">Menyusun data alternatif dan kriteria dalam bentuk
                                            matriks</small>
                                    </li>
                                    <li class="enhanced-step">
                                        <strong>Normalisasi matriks keputusan</strong>
                                        <br><small class="text-muted">Mengubah nilai matriks menjadi nilai yang dapat
                                            dibandingkan</small>
                                    </li>
                                    <li class="enhanced-step">
                                        <strong>Menghitung nilai optimasi dengan mengalikan bobot kriteria</strong>
                                        <br><small class="text-muted">Mengalikan matriks ternormalisasi dengan bobot
                                            masing-masing kriteria</small>
                                    </li>
                                    <li class="enhanced-step">
                                        <strong>Melakukan perangkingan</strong>
                                        <br><small class="text-muted">Mengurutkan alternatif berdasarkan nilai optimasi
                                            tertinggi</small>
                                    </li>
                                </ol>
                            </div>

                            <div class="alert alert-info border-0"
                                style="background: var(--gradient-soft); border-radius: 15px;">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Keunggulan MOORA:</strong> Memiliki tingkat selektivitas yang baik dalam menentukan
                                suatu alternatif.
                                Metode ini memiliki tingkat fleksibilitas yang tinggi dan kemudahan pemahaman dalam
                                memisahkan
                                bagian subjektif dan objektif dari proses evaluasi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PERBAIKAN: JavaScript yang minimal dan tidak konflik -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // PERBAIKAN: Hilangkan semua animasi yang bikin ngedip
            // Fokus hanya pada functionality yang diperlukan

            // Smooth scroll untuk internal links (jika ada)
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // PERBAIKAN: Pastikan button tidak ada masalah
            const buttons = document.querySelectorAll('.btn-enhanced');
            buttons.forEach(btn => {
                btn.style.position = 'relative';
                btn.style.overflow = 'visible';
                btn.style.display = 'inline-block';
                btn.style.verticalAlign = 'top';
            });
        });
    </script>
@endsection