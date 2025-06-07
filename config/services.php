<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // ============================================================================
    // reCAPTCHA Configuration (Original NoCapatcha format)
    // ============================================================================
    'nocaptcha' => [
        'sitekey' => env('NOCAPTCHA_SITEKEY'),
        'secret' => env('NOCAPTCHA_SECRET'),
        'options' => [
            'timeout' => env('NOCAPTCHA_TIMEOUT', 10),
            'language' => env('NOCAPTCHA_LANGUAGE', 'id'), // Bahasa Indonesia
        ],
    ],

    // ============================================================================
    // reCAPTCHA Configuration (Alternative format for consistency)
    // ============================================================================
    'recaptcha' => [
        'site_key' => env('NOCAPTCHA_SITEKEY'), // Menggunakan env yang sama
        'secret_key' => env('NOCAPTCHA_SECRET'), // Menggunakan env yang sama
        'version' => env('RECAPTCHA_VERSION', 'v2'),
        'timeout' => env('RECAPTCHA_TIMEOUT', 10),
        'skip_on_localhost' => env('RECAPTCHA_SKIP_LOCALHOST', true),
        'language' => env('RECAPTCHA_LANGUAGE', 'id'),
    ],

    // ============================================================================
    // Mail Services (untuk email verification jika dibutuhkan)
    // ============================================================================
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    // ============================================================================
    // File Storage Services
    // ============================================================================
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URL'),
    ],

];