<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // Check for expired session (ORIGINAL LOGIC)
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $sessionLifetime = config('session.lifetime', 120);
            
            if ($lastActivity && now()->diffInMinutes($lastActivity) > $sessionLifetime) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return view('auth.login')->with('message', 'Session Anda telah berakhir, silakan login kembali.');
            }
            
            session(['last_activity' => now()]);
            return $this->redirectBasedOnRole();
        }

        // ORIGINAL RATE LIMITING (tidak diubah)
        $key = Str::lower($request->ip()) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->view('auth.blocked', ['seconds' => $seconds], 429);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Enhanced logging (tidak mengganggu rate limiting)
        Log::info('Login attempt started', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'has_captcha' => !empty($request->input('g-recaptcha-response')),
            'timestamp' => now()
        ]);

        // ORIGINAL VALIDATION (tidak diubah)
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'g-recaptcha-response.required' => 'Silakan verifikasi bahwa Anda bukan robot.',
            'g-recaptcha-response.captcha' => 'Verifikasi reCAPTCHA gagal, silakan coba lagi.',
        ]);

        if ($validator->fails()) {
            Log::warning('Login validation failed', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'errors' => $validator->errors()->toArray(),
            ]);
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');
        
        // ORIGINAL RATE LIMITING (tidak diubah)
        $key = Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            Log::alert("ALERT: 5x login gagal dari IP {$request->ip()} - Email: {$request->email}");
            $seconds = RateLimiter::availableIn($key);
            return response()->view('auth.blocked', ['seconds' => $seconds], 429);
        }

        // ORIGINAL LOGIN LOGIC (tidak diubah)
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();
            
            // Set initial last activity
            session(['last_activity' => now()]);
            
            // Enhanced success logging
            Log::info('Login successful', [
                'user_id' => Auth::id(),
                'email' => $request->email,
                'ip' => $request->ip(),
                'timestamp' => now()
            ]);
            
            return $this->redirectBasedOnRole();
        }

        // ORIGINAL FAILED LOGIN LOGIC (tidak diubah)
        RateLimiter::hit($key, 300); // blokir 5 menit
        Log::warning("Login gagal: {$request->email} dari IP {$request->ip()}");

        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak valid.',
        ])->withInput($request->except('password'));
    }

    public function showRegistrationForm()
    {
        // ORIGINAL LOGIC (tidak diubah)
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $sessionLifetime = config('session.lifetime', 120);
            
            if ($lastActivity && now()->diffInMinutes($lastActivity) > $sessionLifetime) {
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();
                return view('auth.register')->with('message', 'Session Anda telah berakhir.');
            }
            
            return $this->redirectBasedOnRole();
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Enhanced logging
        Log::info('Registration attempt started', [
            'email' => $request->email,
            'name' => $request->name,
            'ip' => $request->ip(),
            'timestamp' => now()
        ]);

        // Enhanced validation dengan security patterns
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s\-\'\.]+$/u'
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
                'confirmed',
            ],
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.regex' => 'Nama hanya boleh mengandung huruf, spasi, tanda hubung, dan titik.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 16 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'g-recaptcha-response.required' => 'Silakan verifikasi bahwa Anda bukan robot.',
            'g-recaptcha-response.captcha' => 'Verifikasi reCAPTCHA gagal, silakan coba lagi.',
        ]);

        if ($validator->fails()) {
            Log::warning('Registration validation failed', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'errors' => $validator->errors()->toArray()
            ]);
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        try {
            // Double-check email uniqueness
            if (User::where('email', strtolower(trim($request->email)))->exists()) {
                return redirect()->back()
                    ->withInput($request->except('password', 'password_confirmation'))
                    ->withErrors(['email' => 'Email sudah terdaftar.']);
            }

            // ORIGINAL USER CREATION LOGIC
            $user = User::create([
                'name' => trim($request->name),
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);

            Log::info('User registered successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
                'timestamp' => now()
            ]);

            return redirect()->route('login')
                ->with('success', 'Pendaftaran berhasil! Silakan login dengan akun baru Anda.');
                
        } catch (\Exception $e) {
            Log::error('Registration failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'ip' => $request->ip()
            ]);
            
            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.');
        }
    }

    public function logout(Request $request)
    {
        $userId = Auth::id();
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('User logged out', [
            'user_id' => $userId,
            'ip' => $request->ip(),
            'timestamp' => now()
        ]);

        // UBAH: Redirect ke welcome instead of login setelah logout
        return redirect()->route('welcome')->with('success', 'Anda telah berhasil logout.');
    }

    private function redirectBasedOnRole()
    {
        return Auth::user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
}