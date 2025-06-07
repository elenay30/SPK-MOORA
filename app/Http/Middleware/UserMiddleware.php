<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // DISABLE RATE LIMITING TEMPORARILY
        // $key = 'user-access:' . $request->ip();
        // if (RateLimiter::tooManyAttempts($key, 300)) {
        //     Log::warning('User access rate limit exceeded', [
        //         'ip' => $request->ip(),
        //         'user_agent' => $request->userAgent(),
        //         'url' => $request->fullUrl(),
        //         'user_id' => Auth::id()
        //     ]);
            
        //     return response()->json([
        //         'error' => 'Too many requests. Please try again later.'
        //     ], 429);
        // }
        
        // RateLimiter::hit($key, 60); // DISABLED
        
        // Simple logging unauthorized access attempts
        if (!Auth::check()) {
            Log::info('Unauthorized user access attempt', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'referer' => $request->header('referer'),
                'timestamp' => now()
            ]);
        }
        
        // Original logic preserved
        if (Auth::check()) {
            // Basic session security check
            $this->validateSessionBasic($request);
            
            return $next($request);
        }
        
        // Clear any existing session data untuk security
        $request->session()->flush();
        $request->session()->regenerate();
        
        return redirect()->route('login')
            ->with('error', 'Silakan login terlebih dahulu.');
    }
    
    /**
     * Basic session validation - simplified
     */
    private function validateSessionBasic(Request $request): void
    {
        $user = Auth::user();
        
        // Check if user account is still active
        if (!$user || (isset($user->is_active) && !$user->is_active)) {
            Log::warning('Inactive user attempted access', [
                'user_id' => $user?->id,
                'email' => $user?->email ?? 'unknown',
                'ip' => $request->ip()
            ]);
            
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return;
        }
        
        // Simple session regeneration every 30 minutes
        if (!$request->session()->has('last_regenerated')) {
            $request->session()->put('last_regenerated', now());
            $request->session()->regenerate();
        } elseif ($request->session()->get('last_regenerated') < now()->subMinutes(30)) {
            $request->session()->put('last_regenerated', now());
            $request->session()->regenerate();
        }
        
        // Update last activity
        $request->session()->put('last_activity', now());
    }
}