<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akses Diblokir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --bg-dark: #111827; /* Dark Blue-Gray */
            --card-bg: #1f2937; /* Lighter Blue-Gray */
            --primary-text: #f9fafb;
            --secondary-text: #9ca3af;
            --accent-color: #f59e0b; /* Amber */
            --error-color: #ef4444; /* Red */
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-dark);
            color: var(--primary-text);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            overflow: hidden;
        }

        .lock-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
            opacity: 0;
            transform: translateY(-30px);
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-wrapper {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;
            background: rgba(239, 68, 68, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: breathe 2s infinite ease-in-out;
        }

        .icon-wrapper i {
            font-size: 40px;
            color: var(--error-color);
        }

        @keyframes breathe {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.3);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 10px 15px rgba(239, 68, 68, 0);
            }
        }

        .title {
            font-size: 26px;
            margin: 0 0 10px;
            font-weight: 700;
            color: var(--primary-text);
        }

        .message {
            font-size: 16px;
            color: var(--secondary-text);
            line-height: 1.6;
            max-width: 350px;
            margin: 0 auto 30px;
        }

        .timer-container {
            background: rgba(0,0,0,0.2);
            border-radius: 12px;
            padding: 20px;
        }

        .countdown-text {
            font-size: 16px;
            color: var(--secondary-text);
        }
        
        .countdown-text #countdown {
            font-size: 22px;
            font-weight: 700;
            color: var(--accent-color);
            margin: 0 5px;
        }

        .progress-bar-container {
            height: 8px;
            width: 100%;
            background-color: #374151;
            border-radius: 4px;
            margin-top: 15px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            width: 100%;
            background-color: var(--accent-color);
            border-radius: 4px;
            transition: width 1s linear; /* Animasi mulus untuk progress bar */
        }
    </style>
</head>
<body>
    <div class="lock-card">
        <div class="icon-wrapper">
            <i class="fas fa-shield-halved"></i>
        </div>
        <h1 class="title">Akses Diblokir Sementara</h1>
        <p class="message">
            Anda telah melakukan terlalu banyak percobaan login yang gagal. Demi keamanan, silakan coba lagi sesaat lagi.
        </p>
        <div class="timer-container">
            <div class="countdown-text">
                Halaman akan dialihkan otomatis dalam 
                <span id="countdown">{{ $seconds }}</span> detik...
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>
        </div>
    </div>

    <script>
        // Ambil elemen dari DOM
        const countdownElement = document.getElementById('countdown');
        const progressBarElement = document.getElementById('progressBar');
        
        // Ambil data dari Blade
        let totalSeconds = {{ $seconds }};
        let secondsLeft = totalSeconds;
        
        // URL untuk redirect setelah selesai
        const loginUrl = "{{ route('login') }}"; // Arahkan ke halaman login utama

        // Fungsi untuk memperbarui tampilan
        function updateDisplay() {
            // Update teks countdown
            countdownElement.textContent = secondsLeft;
            
            // Hitung persentase progress bar (mundur)
            const progressPercentage = (secondsLeft / totalSeconds) * 100;
            progressBarElement.style.width = progressPercentage + '%';
        }

        // Jalankan update pertama kali
        updateDisplay();
        
        // Set interval untuk berjalan setiap detik
        const interval = setInterval(() => {
            secondsLeft--;
            updateDisplay();
            
            // Jika waktu habis
            if (secondsLeft <= 0) {
                clearInterval(interval);
                // Alihkan ke halaman login
                window.location.href = loginUrl;
            }
        }, 1000);
    </script>
</body>
</html>