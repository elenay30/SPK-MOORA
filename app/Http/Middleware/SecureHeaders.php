<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class SecureHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // CSP Header
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://code.jquery.com https://www.google.com https://www.gstatic.com; " .
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; " .
            "font-src 'self' https://cdnjs.cloudflare.com; " .
            "img-src 'self' data: https:; " .
            "connect-src 'self'; " .
            "frame-ancestors 'self';"
        );

        // Anti-clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // MIME type sniffing protection
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Hide server info - PENTING: Letakkan di awal!
        header_remove('X-Powered-By');
        
        // HSTS untuk HTTPS
        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        // Fix XSRF-TOKEN cookie HttpOnly flag
        $this->fixXsrfTokenCookie($response);

        return $response;
    }

    private function fixXsrfTokenCookie(Response $response): void
    {
        $cookies = $response->headers->getCookies();
        
        foreach ($cookies as $cookie) {
            if ($cookie->getName() === 'XSRF-TOKEN') {
                // Debug log
                \Log::info('Found XSRF-TOKEN cookie, fixing HttpOnly flag');
                
                // Remove old cookie
                $response->headers->removeCookie(
                    $cookie->getName(), 
                    $cookie->getPath(), 
                    $cookie->getDomain()
                );
                
                // Add new cookie with HttpOnly flag
                $response->headers->setCookie(
                    new Cookie(
                        $cookie->getName(),
                        $cookie->getValue(),
                        $cookie->getExpiresTime(),
                        $cookie->getPath(),
                        $cookie->getDomain(),
                        $cookie->isSecure(),
                        true, // HttpOnly = true
                        false,
                        $cookie->getSameSite()
                    )
                );
                
                \Log::info('XSRF-TOKEN cookie fixed with HttpOnly flag');
                break;
            }
        }
    }
}