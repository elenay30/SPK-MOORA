<?php

use App\Http\Controllers\Admin\AlternatifController as AdminAlternatifController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KriteriaController as AdminKriteriaController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\PerhitunganController as AdminPerhitunganController;
use App\Http\Controllers\Admin\SubKriteriaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AlternatifController as UserAlternatifController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\KriteriaController as UserKriteriaController;
use App\Http\Controllers\User\PerhitunganController as UserPerhitunganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - FIXED VERSION (No Excessive Rate Limiting)
|--------------------------------------------------------------------------
*/

// ======================================================================
// PUBLIC ROUTES (No Authentication Required)
// ======================================================================

// Root redirect
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Welcome page
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// ======================================================================
// AUTHENTICATION ROUTES (Guest Only) - FIXED
// ======================================================================

Route::middleware('guest')->group(function () {
    // Login Routes - BASIC rate limiting only
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Register Routes - BASIC rate limiting only  
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// ======================================================================
// AUTHENTICATED ROUTES (Require Authentication) - FIXED
// ======================================================================

Route::middleware('auth')->group(function () {
    
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Redirect
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    })->name('dashboard');

    // ======================================================================
    // ADMIN ROUTES (Admin Only) - REDUCED RATE LIMITING
    // ======================================================================
    
    Route::prefix('admin')
        ->middleware('admin') // REMOVED throttle from group level
        ->name('admin.')
        ->group(function () {
            
            // Dashboard
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            // ================================================================
            // KRITERIA MANAGEMENT - SIMPLIFIED
            // ================================================================
            Route::controller(AdminKriteriaController::class)->group(function () {
                Route::get('/kriteria', 'index')->name('kriteria.index');
                Route::get('/kriteria/create', 'create')->name('kriteria.create');
                Route::get('/kriteria/{kriteria}/edit', 'edit')->name('kriteria.edit');
                Route::post('/kriteria', 'store')->name('kriteria.store');
                Route::put('/kriteria/{kriteria}', 'update')->name('kriteria.update');
                Route::delete('/kriteria/bulk-delete', 'bulkDelete')->name('kriteria.bulk-delete');
                Route::delete('/kriteria/{kriteria}', 'destroy')->name('kriteria.destroy');
            });

            // ================================================================
            // SUB KRITERIA MANAGEMENT - SIMPLIFIED
            // ================================================================
            Route::controller(SubKriteriaController::class)->group(function () {
                Route::get('/subkriteria', 'index')->name('subkriteria.index');
                Route::get('/subkriteria/create', 'create')->name('subkriteria.create');
                Route::get('/subkriteria/{subKriteria}/edit', 'edit')->name('subkriteria.edit');
                Route::post('/subkriteria', 'store')->name('subkriteria.store');
                Route::put('/subkriteria/{subKriteria}', 'update')->name('subkriteria.update');
                Route::delete('/subkriteria/{subKriteria}', 'destroy')->name('subkriteria.destroy');
            });

            // ================================================================
            // ALTERNATIF MANAGEMENT - SIMPLIFIED
            // ================================================================
            Route::controller(AdminAlternatifController::class)->group(function () {
                Route::get('/alternatif', 'index')->name('alternatif.index');
                Route::get('/alternatif/create', 'create')->name('alternatif.create');
                Route::get('/alternatif/{alternatif}/edit', 'edit')->name('alternatif.edit');
                Route::post('/alternatif', 'store')->name('alternatif.store');
                Route::put('/alternatif/{alternatif}', 'update')->name('alternatif.update');
                Route::delete('/alternatif/bulk-delete', 'bulkDelete')->name('alternatif.bulk-delete');
                Route::delete('/alternatif/{alternatif}', 'destroy')->name('alternatif.destroy');
            });

            // ================================================================
            // PENILAIAN MANAGEMENT - SIMPLIFIED
            // ================================================================
            Route::controller(PenilaianController::class)->group(function () {
                Route::get('/penilaian', 'index')->name('penilaian.index');
                Route::get('/penilaian/create', 'create')->name('penilaian.create');
                Route::get('/penilaian/{alternatif}/edit', 'edit')->name('penilaian.edit');
                Route::post('/penilaian', 'store')->name('penilaian.store');
                Route::put('/penilaian/{alternatif}', 'update')->name('penilaian.update');
                Route::delete('/penilaian/{alternatif}', 'destroy')->name('penilaian.destroy');
            });

            // ================================================================
            // PERHITUNGAN MANAGEMENT - SIMPLIFIED
            // ================================================================
            Route::controller(AdminPerhitunganController::class)->group(function () {
                Route::get('/perhitungan', 'index')->name('perhitungan.index');
                Route::get('/perhitungan/{id}', 'show')
                    ->where('id', '[0-9]+')
                    ->name('perhitungan.show');
                
                Route::get('/perhitungan/cetak/{id}', 'cetak')
                    ->where('id', '[0-9]+')
                    ->name('perhitungan.cetak');
                
                Route::post('/perhitungan/calculate', 'calculate')->name('perhitungan.calculate');
                Route::delete('/perhitungan/{id}', 'destroy')
                    ->where('id', '[0-9]+')
                    ->name('perhitungan.destroy');
            });

            // ================================================================
            // USER MANAGEMENT - SIMPLIFIED
            // ================================================================
            Route::controller(UserController::class)->group(function () {
                Route::get('/user', 'index')->name('user.index');
                Route::get('/user/create', 'create')->name('user.create');
                Route::get('/user/{user}/edit', 'edit')->name('user.edit');
                Route::post('/user', 'store')->name('user.store');
                Route::put('/user/{user}', 'update')->name('user.update');
                Route::delete('/user/{user}', 'destroy')->name('user.destroy');
            });
        });

    // ======================================================================
    // USER ROUTES (Regular Users) - FIXED RATE LIMITING
    // ======================================================================
    
    Route::prefix('user')
        ->middleware('user') // REMOVED throttle from group level
        ->name('user.')
        ->group(function () {
            
            Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

            Route::controller(UserKriteriaController::class)->group(function () {
                Route::get('/kriteria', 'index')->name('kriteria.index');
                Route::get('/kriteria/{kriteria}', 'show')->name('kriteria.show');
            });

            Route::controller(UserAlternatifController::class)->group(function () {
                Route::get('/alternatif', 'index')->name('alternatif.index');
                Route::get('/alternatif/{alternatif}', 'show')->name('alternatif.show');
            });

            Route::controller(UserPerhitunganController::class)->group(function () {
                Route::get('/perhitungan', 'index')->name('perhitungan.index');
                Route::get('/perhitungan/create', 'create')->name('perhitungan.create');
                Route::get('/perhitungan/{id}', 'show')
                    ->where('id', '[0-9]+')
                    ->name('perhitungan.show');
                
                Route::get('/perhitungan/cetak/{id}', 'cetak')
                    ->where('id', '[0-9]+')
                    ->name('perhitungan.cetak');
                
                // REMOVED excessive throttling - let AuthController handle rate limiting
                Route::post('/perhitungan/calculate', 'calculate')->name('perhitungan.calculate');
                
                Route::delete('/perhitungan/{id}', 'destroy')
                    ->where('id', '[0-9]+')
                    ->name('perhitungan.destroy');
            });
        });
});

// ======================================================================
// DEBUG ROUTES (Development Only)
// ======================================================================

if (app()->environment(['local', 'testing'])) {
    // Debug sistem
    Route::get('/debug/system', function () {
        try {
            // Test database connection
            $dbConnected = false;
            try {
                DB::connection()->getPdo();
                $dbConnected = true;
            } catch (\Exception $e) {
                // Database connection failed
            }

            return response()->json([
                'laravel_version' => app()->version(),
                'php_version' => PHP_VERSION,
                'environment' => app()->environment(),
                'app_debug' => config('app.debug'),
                'app_key_set' => !empty(config('app.key')),
                'database' => [
                    'connection' => config('database.default'),
                    'host' => config('database.connections.mysql.host'),
                    'database' => config('database.connections.mysql.database'),
                    'connected' => $dbConnected,
                ],
                'session' => [
                    'driver' => config('session.driver'),
                    'lifetime' => config('session.lifetime'),
                    'encrypt' => config('session.encrypt'),
                ],
                'routes' => [
                    'login_exists' => Route::has('login'),
                    'register_exists' => Route::has('register'),
                    'login_submit_exists' => Route::has('login.submit'),
                    'register_submit_exists' => Route::has('register.submit'),
                ],
                'storage' => [
                    'logs_writable' => is_writable(storage_path('logs')),
                    'sessions_writable' => is_writable(storage_path('framework/sessions')),
                    'cache_writable' => is_writable(storage_path('framework/cache')),
                ],
                'captcha' => [
                    'sitekey' => config('services.nocaptcha.sitekey'),
                    'secret_configured' => !empty(config('services.nocaptcha.secret')),
                    'nocaptcha_class_exists' => class_exists('Anhskohbo\NoCaptcha\NoCaptcha'),
                ],
                'csrf' => [
                    'token' => csrf_token(),
                    'token_length' => strlen(csrf_token()),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Debug failed',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    })->name('debug.system');

    // Clear rate limiting cache
    Route::get('/debug/clear-rate-limit', function () {
        \Illuminate\Support\Facades\Cache::flush();
        return response()->json([
            'message' => 'Rate limiting cache cleared successfully!',
            'timestamp' => now()
        ]);
    })->name('debug.clear-rate-limit');

    // Debug CAPTCHA
    Route::get('/debug/captcha', function () {
        return response()->json([
            'nocaptcha_config' => [
                'sitekey' => config('services.nocaptcha.sitekey'),
                'secret_configured' => !empty(config('services.nocaptcha.secret')),
            ],
            'nocaptcha_class_exists' => class_exists('Anhskohbo\NoCaptcha\NoCaptcha'),
            'csrf_token' => csrf_token(),
        ]);
    })->name('debug.captcha');
}

// ======================================================================
// FALLBACK ROUTES
// ======================================================================

Route::fallback(function () {
    if (request()->expectsJson()) {
        return response()->json([
            'error' => 'Route not found',
            'message' => 'The requested endpoint does not exist.'
        ], 404);
    }
    
    return response()->view('errors.404', [], 404);
});

/*
|--------------------------------------------------------------------------
| PERBAIKAN YANG DILAKUKAN:
|--------------------------------------------------------------------------
|
| ❌ DIHAPUS:
| 1. 'throttle:120,1' dari user route group
| 2. 'throttle:60,1' dari admin route group  
| 3. 'throttle:3,5' dari individual routes
| 4. Semua throttle middleware yang excessive
|
| ✅ DITAMBAHKAN:
| 1. Debug route untuk clear rate limiting cache
| 2. Simplified route structure
| 3. Better organization
|
| 🎯 HASIL:
| - Tidak ada triple rate limiting lagi
| - Calculate route bisa diakses normal
| - Performance lebih baik
|
|--------------------------------------------------------------------------
*/