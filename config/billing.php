<?php

return [
    'company_name' => env('BILLING_COMPANY_NAME', env('APP_NAME', 'AutoMate')),
    'tagline' => env('BILLING_COMPANY_TAGLINE', 'Vehicle Service & Rental Management'),
    'address' => env('BILLING_COMPANY_ADDRESS', ''),
    'phone' => env('BILLING_COMPANY_PHONE', ''),
    'email' => env('BILLING_COMPANY_EMAIL', env('MAIL_FROM_ADDRESS', 'support@example.com')),
    'vat' => env('BILLING_COMPANY_VAT', ''),
    'website' => env(
        'BILLING_COMPANY_WEBSITE',
        parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST) ?: env('APP_URL', 'http://localhost')
    ),
];
