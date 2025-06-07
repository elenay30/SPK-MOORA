<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Simple rate limiting untuk admin routes (lebih ketat)
        $key = 'admin-access:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 50)) { // 50 attempts per minute
            Log::warning('Admin access rate limit exceeded', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'user_id' => Auth::id()
            ]);
            
            return response()->json([
                'error' => 'Too many requests. Please try again later.'
            ], 429);
        }
        
        RateLimiter::hit($key, 60); // 1 minute decay
        
        // Enhanced logging untuk admin access attempts
        if (!Auth::check()) {
            Log::warning('Unauthorized admin access attempt', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'referer' => $request->header('referer'),
                'timestamp' => now()
            ]);
        } elseif (Auth::user() && !Auth::user()->isAdmin()) {
            Log::warning('Non-admin user attempted admin access', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'timestamp' => now()
            ]);
        }
        
        // Original logic preserved
        if (Auth::check() && Auth::user()->isAdmin()) {
            // Simple admin session validation
            $this->validateAdminSessionBasic($request);
            
            // Log successful admin access
            Log::info('Admin access granted', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);
            
            return $next($request);
        }
        
        // Regenerate session untuk security
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
    
    /**
     * Basic admin session validation
     */
    private function validateAdminSessionBasic(Request $request): void
    {
        $user = Auth::user();
        
        // Check if admin account is still active
        if (!$user || (isset($user->is_active) && !$user->is_active) || !$user->isAdmin()) {
            Log::warning('Invalid admin user attempted access', [
                'user_id' => $user?->id,
                'email' => $user?->email ?? 'unknown',
                'ip' => $request->ip()
            ]);
            
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return;
        }
        
        // Admin session timeout check (shorter than regular users - 60 minutes)
        if ($request->session()->has('admin_last_activity')) {
            $lastActivity = $request->session()->get('admin_last_activity');
            if (now()->diffInMinutes($lastActivity) > 60) {
                Log::info('Admin session timeout', [
                    'user_id' => $user->id,
                    'last_activity' => $lastActivity,
                    'ip' => $request->ip()
                ]);
                
                Auth::logout();
                $request->session()->invalidate();
                return;
            }
        }
        
        // Update admin activity timestamp
        $request->session()->put('admin_last_activity', now());
    }
}