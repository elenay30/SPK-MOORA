@extends('layouts.app')

@section('title', 'Register')

@section('styles')
<style>
/* Simplified and Professional Register Page Styles */
.register-container {
    background: linear-gradient(135deg, 
        var(--warm-gray) 0%, 
        #f3f2f0 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 2rem 0;
}

/* Professional Register Card */
.register-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(161, 98, 7, 0.08), 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(161, 98, 7, 0.08);
    transition: all 0.3s ease;
    width: 100%;
    overflow: hidden;
    margin: 0 auto;
}

.register-card:hover {
    box-shadow: 0 8px 30px rgba(161, 98, 7, 0.12), 0 2px 6px rgba(0, 0, 0, 0.15);
}

/* Professional Card Header */
.register-header {
    background: var(--gradient);
    color: white;
    padding: 2.5rem 3rem;
    text-align: center;
    position: relative;
}

.register-header::after {
    content: '👥';
    position: absolute;
    top: 1.5rem;
    right: 2.5rem;
    font-size: 1.8rem;
    opacity: 0.9;
}

.register-title {
    font-size: 2rem;
    font-weight: 600;
    margin: 0;
    letter-spacing: -0.02em;
}

.register-subtitle {
    font-size: 1rem;
    opacity: 0.95;
    margin-top: 0.5rem;
    font-weight: 400;
}

/* Professional Form Body */
.register-body {
    padding: 3rem;
}

/* Clean Form Controls */
.form-group-enhanced {
    margin-bottom: 2rem;
}

.form-label-enhanced {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.form-label-enhanced i {
    margin-right: 0.75rem;
    color: var(--primary);
    width: 18px;
    font-size: 1.1rem;
}

.form-control-enhanced {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 1.25rem 1.5rem;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    width: 100%;
    background: #fafafa;
    min-height: 52px;
}

.form-control-enhanced:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(161, 98, 7, 0.1);
    outline: none;
    background: white;
}

.form-control-enhanced.is-invalid {
    border-color: #dc3545;
    background: #fef2f2;
}

.form-control-enhanced.is-valid {
    border-color: #10b981;
    background: #f0fdf4;
}

/* Clean Invalid Feedback */
.invalid-feedback-enhanced {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    padding: 0.5rem;
    background: #fef2f2;
    border-radius: 6px;
    border-left: 3px solid #dc3545;
}

.valid-feedback-enhanced {
    color: #10b981;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    padding: 0.5rem;
    background: #f0fdf4;
    border-radius: 6px;
    border-left: 3px solid #10b981;
}

/* Password Requirements */
.password-requirements {
    background: #f8fafc;
    border-radius: 8px;
    padding: 1rem;
    margin-top: 0.5rem;
    border: 1px solid #e5e7eb;
}

.password-requirements h6 {
    margin: 0 0 0.5rem 0;
    font-size: 0.9rem;
    color: var(--text-dark);
    font-weight: 600;
}

.requirement {
    display: flex;
    align-items: center;
    font-size: 0.85rem;
    margin: 0.25rem 0;
    color: #6b7280;
    transition: color 0.3s ease;
}

.requirement i {
    margin-right: 0.5rem;
    width: 16px;
}

.requirement.valid {
    color: #10b981;
}

.requirement.invalid {
    color: #ef4444;
}

/* Clean Captcha Container */
.captcha-container {
    background: #f8fafc;
    border-radius: 8px;
    padding: 1.5rem;
    margin: 2rem 0;
    text-align: center;
    border: 1px solid #e5e7eb;
}

.captcha-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.captcha-title i {
    margin-right: 0.75rem;
    color: var(--primary);
    font-size: 1.1rem;
}

.captcha-error {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    background: #fef2f2;
    padding: 0.5rem;
    border-radius: 6px;
}

/* Professional Submit Button */
.btn-register {
    background: var(--gradient);
    border: none;
    color: white;
    font-weight: 600;
    font-size: 1.05rem;
    padding: 1rem 2rem;
    border-radius: 8px;
    width: 100%;
    transition: all 0.3s ease;
    text-transform: none;
    letter-spacing: 0.025em;
}

.btn-register:hover {
    background: linear-gradient(135deg, #92400e 0%, #a16207 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(161, 98, 7, 0.25);
    color: white;
}

.btn-register:active {
    transform: translateY(0);
}

.btn-register:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Professional Footer */
.register-footer {
    background: #f8fafc;
    text-align: center;
    padding: 2rem 3rem;
    border-top: 1px solid #e5e7eb;
}

.register-footer p {
    margin: 0;
    color: var(--text-light);
    font-size: 0.95rem;
}

.register-footer a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.register-footer a:hover {
    color: var(--secondary);
}

/* Simple Animations */
.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading state */
.btn-register.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn-register.loading::after {
    content: '';
    width: 16px;
    height: 16px;
    margin-left: 10px;
    border: 2px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 1s ease infinite;
    display: inline-block;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Form Rows for Responsive Layout */
.form-row {
    display: flex;
    gap: 1rem;
}

.form-row .form-group-enhanced {
    flex: 1;
}

/* CSRF Token Display (untuk debugging) */
.csrf-debug {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
    padding: 0.75rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    font-size: 0.85rem;
    word-break: break-all;
}

/* Responsive Design */
@media (max-width: 768px) {
    .register-card {
        margin: 1rem;
    }
    
    .register-header {
        padding: 1.5rem 1.5rem;
    }
    
    .register-body {
        padding: 2rem 1.5rem;
    }
    
    .register-footer {
        padding: 1.25rem 1.5rem;
    }
    
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}

@media (max-width: 576px) {
    .register-container {
        padding: 1rem 0;
    }
    
    .register-card {
        margin: 0.5rem;
    }
    
    .register-header::after {
        display: none;
    }
}
</style>
@endsection

@section('content')
<div class="register-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9 col-sm-11">
                <div class="register-card fade-in-up">
                    <div class="register-header">
                        <h4 class="register-title">Bergabung dengan Kami</h4>
                        <p class="register-subtitle">Buat akun baru untuk mengakses sistem</p>
                    </div>
                    <div class="register-body">
                        {{-- CSRF Token Debug Info (hapus di production) --}}
                        @if(app()->environment(['local', 'testing']))
                        <div class="csrf-debug">
                            <strong>🔒 CSRF Token Active:</strong> {{ substr(csrf_token(), 0, 20) }}...
                        </div>
                        @endif

                        {{-- Session Messages --}}
                        @if(session('message'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('register.submit') }}" id="registerForm" novalidate>
                            {{-- CSRF Protection --}}
                            @csrf
                            
                            {{-- Hidden CSRF field untuk fallback --}}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <div class="form-group-enhanced">
                                <label for="name" class="form-label-enhanced">
                                    <i class="fas fa-user"></i>
                                    Nama Lengkap
                                </label>
                                <input id="name" 
                                       type="text" 
                                       class="form-control-enhanced @error('name') is-invalid @enderror" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autocomplete="name" 
                                       autofocus
                                       maxlength="255"
                                       placeholder="Masukkan nama lengkap Anda">
                                @error('name')
                                <div class="invalid-feedback-enhanced">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group-enhanced">
                                <label for="email" class="form-label-enhanced">
                                    <i class="fas fa-envelope"></i>
                                    Email Address
                                </label>
                                <input id="email" 
                                       type="email" 
                                       class="form-control-enhanced @error('email') is-invalid @enderror" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="email"
                                       maxlength="255"
                                       placeholder="Masukkan alamat email Anda">
                                @error('email')
                                <div class="invalid-feedback-enhanced">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                                <div id="email-feedback" class="valid-feedback-enhanced" style="display: none;">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Email valid dan tersedia
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group-enhanced">
                                    <label for="password" class="form-label-enhanced">
                                        <i class="fas fa-lock"></i>
                                        Password
                                    </label>
                                    <input id="password" 
                                           type="password" 
                                           class="form-control-enhanced @error('password') is-invalid @enderror" 
                                           name="password" 
                                           required 
                                           autocomplete="new-password"
                                           minlength="8"
                                           maxlength="16"
                                           placeholder="Masukkan password">
                                    @error('password')
                                    <div class="invalid-feedback-enhanced">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    
                                    {{-- Password Requirements --}}
                                    <div class="password-requirements" id="passwordRequirements">
                                        <h6><i class="fas fa-info-circle me-1"></i>Syarat Password:</h6>
                                        <div class="requirement" id="req-length">
                                            <i class="fas fa-times"></i>
                                            Minimal 8 karakter, maksimal 16 karakter
                                        </div>
                                        <div class="requirement" id="req-lower">
                                            <i class="fas fa-times"></i>
                                            Minimal 1 huruf kecil (a-z)
                                        </div>
                                        <div class="requirement" id="req-upper">
                                            <i class="fas fa-times"></i>
                                            Minimal 1 huruf besar (A-Z)
                                        </div>
                                        <div class="requirement" id="req-number">
                                            <i class="fas fa-times"></i>
                                            Minimal 1 angka (0-9)
                                        </div>
                                        <div class="requirement" id="req-symbol">
                                            <i class="fas fa-times"></i>
                                            Minimal 1 simbol (!@#$%^&*)
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group-enhanced">
                                    <label for="password-confirm" class="form-label-enhanced">
                                        <i class="fas fa-lock"></i>
                                        Konfirmasi Password
                                    </label>
                                    <input id="password-confirm" 
                                           type="password" 
                                           class="form-control-enhanced" 
                                           name="password_confirmation" 
                                           required 
                                           autocomplete="new-password"
                                           maxlength="16"
                                           placeholder="Konfirmasi password">
                                    <div id="password-match-feedback" class="invalid-feedback-enhanced" style="display: none;">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        Password tidak sama
                                    </div>
                                    <div id="password-match-success" class="valid-feedback-enhanced" style="display: none;">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Password sudah cocok
                                    </div>
                                </div>
                            </div>

                            {{-- reCAPTCHA --}}
                            <div class="captcha-container">
                                <div class="captcha-title">
                                    <i class="fas fa-shield-alt"></i>
                                    Verifikasi Keamanan
                                </div>
                                <div class="g-recaptcha" 
                                     data-sitekey="{{ config('services.recaptcha.site_key', env('RECAPTCHA_SITE_KEY')) }}"
                                     data-callback="recaptchaCallback">
                                </div>
                                @error('g-recaptcha-response')
                                <div class="captcha-error">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn-register" id="registerBtn" disabled>
                                    <i class="fas fa-user-plus me-2"></i>
                                    Daftar Sekarang
                                </button>
                            </div>

                            {{-- Security Info --}}
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Data Anda dilindungi dengan enkripsi dan CSRF protection
                                </small>
                            </div>
                        </form>
                    </div>
                    <div class="register-footer">
                        <p>Sudah memiliki akun? 
                            <a href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>
                                Masuk Sekarang
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced form interaction dengan CSRF protection
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('registerBtn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Verify CSRF token exists
    if (!csrfToken) {
        console.error('CSRF token tidak ditemukan!');
        alert('Error: CSRF token tidak ditemukan. Silakan refresh halaman.');
        return;
    }
    
    // Form elements
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password-confirm');
    
    // Password requirements elements
    const requirements = {
        length: document.getElementById('req-length'),
        lower: document.getElementById('req-lower'),
        upper: document.getElementById('req-upper'),
        number: document.getElementById('req-number'),
        symbol: document.getElementById('req-symbol')
    };
    
    // reCAPTCHA callback
    let recaptchaVerified = false;
    window.recaptchaCallback = function() {
        recaptchaVerified = true;
        checkFormValidity();
        console.log('reCAPTCHA verified');
    };
    
    // Expired reCAPTCHA callback
    window.recaptchaExpiredCallback = function() {
        recaptchaVerified = false;
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.6';
        console.log('reCAPTCHA expired');
    };
    
    // Password validation
    function validatePassword(password) {
        const validations = {
            length: password.length >= 8 && password.length <= 16,
            lower: /[a-z]/.test(password),
            upper: /[A-Z]/.test(password),
            number: /\d/.test(password),
            symbol: /[\W_]/.test(password)
        };
        
        // Update requirement indicators
        Object.keys(validations).forEach(key => {
            const element = requirements[key];
            const isValid = validations[key];
            
            element.classList.toggle('valid', isValid);
            element.classList.toggle('invalid', !isValid);
            element.querySelector('i').className = isValid ? 'fas fa-check' : 'fas fa-times';
        });
        
        const allValid = Object.values(validations).every(v => v);
        
        if (allValid) {
            passwordInput.classList.add('is-valid');
            passwordInput.classList.remove('is-invalid');
        } else {
            passwordInput.classList.remove('is-valid');
            if (password.length > 0) {
                passwordInput.classList.add('is-invalid');
            }
        }
        
        return allValid;
    }
    
    // Password confirmation validation
    function validatePasswordConfirmation() {
        const password = passwordInput.value;
        const confirm = passwordConfirmInput.value;
        
        const matchFeedback = document.getElementById('password-match-feedback');
        const successFeedback = document.getElementById('password-match-success');
        
        if (confirm === '') {
            matchFeedback.style.display = 'none';
            successFeedback.style.display = 'none';
            passwordConfirmInput.classList.remove('is-valid', 'is-invalid');
            return false;
        }
        
        if (password === confirm) {
            matchFeedback.style.display = 'none';
            successFeedback.style.display = 'block';
            passwordConfirmInput.classList.add('is-valid');
            passwordConfirmInput.classList.remove('is-invalid');
            return true;
        } else {
            matchFeedback.style.display = 'block';
            successFeedback.style.display = 'none';
            passwordConfirmInput.classList.add('is-invalid');
            passwordConfirmInput.classList.remove('is-valid');
            return false;
        }
    }
    
    // Email validation
    function validateEmail() {
        const email = emailInput.value;
        const emailFeedback = document.getElementById('email-feedback');
        
        if (email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            emailInput.classList.add('is-valid');
            emailInput.classList.remove('is-invalid');
            emailFeedback.style.display = 'block';
            return true;
        } else {
            emailInput.classList.remove('is-valid');
            emailFeedback.style.display = 'none';
            if (email.length > 0) {
                emailInput.classList.add('is-invalid');
            }
            return false;
        }
    }
    
    // Check overall form validity
    function checkFormValidity() {
        const nameValid = nameInput.value.trim().length > 0;
        const emailValid = validateEmail();
        const passwordValid = validatePassword(passwordInput.value);
        const confirmValid = validatePasswordConfirmation();
        
        const allValid = nameValid && emailValid && passwordValid && confirmValid && recaptchaVerified;
        
        submitBtn.disabled = !allValid;
        submitBtn.style.opacity = allValid ? '1' : '0.6';
        
        return allValid;
    }
    
    // Event listeners
    nameInput.addEventListener('input', checkFormValidity);
    emailInput.addEventListener('input', checkFormValidity);
    passwordInput.addEventListener('input', function() {
        validatePassword(this.value);
        validatePasswordConfirmation();
        checkFormValidity();
    });
    passwordConfirmInput.addEventListener('input', function() {
        validatePasswordConfirmation();
        checkFormValidity();
    });
    
    // Form submit handler
    form.addEventListener('submit', function(e) {
        // Verify CSRF token still exists
        const currentToken = document.querySelector('input[name="_token"]')?.value;
        if (!currentToken || currentToken !== csrfToken) {
            e.preventDefault();
            alert('Token keamanan telah berubah. Silakan refresh halaman.');
            return false;
        }
        
        // Verify reCAPTCHA
        const recaptchaResponse = grecaptcha.getResponse();
        if (!recaptchaResponse) {
            e.preventDefault();
            alert('Silakan selesaikan verifikasi reCAPTCHA.');
            return false;
        }
        
        // Final validation
        if (!checkFormValidity()) {
            e.preventDefault();
            alert('Silakan lengkapi semua field dengan benar.');
            return false;
        }
        
        // Add loading state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Memproses...</span>';
        
        console.log('Form submitted with CSRF token');
    });
    
    // Enhanced form validation feedback
    const inputs = document.querySelectorAll('.form-control-enhanced');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = 'var(--primary)';
            this.style.boxShadow = '0 0 0 3px rgba(161, 98, 7, 0.1)';
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Auto-refresh CSRF token setiap 30 menit
    setInterval(function() {
        fetch('/sanctum/csrf-cookie')
            .then(() => {
                const newToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (newToken) {
                    document.querySelector('input[name="_token"]').value = newToken;
                    console.log('CSRF token refreshed');
                }
            })
            .catch(err => console.error('Failed to refresh CSRF token:', err));
    }, 30 * 60 * 1000); // 30 minutes
    
    // Initial form validity check
    checkFormValidity();
});
</script>

{{-- reCAPTCHA Script --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection