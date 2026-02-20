<?php

return [
    'merchant_name' => env('ESEWA_MERCHANT_NAME', 'AutoMate'),
    'product_code' => env('ESEWA_PRODUCT_CODE', 'EPAYTEST'),
    'secret_key' => env('ESEWA_SECRET_KEY', ''),
    'form_url' => env('ESEWA_FORM_URL', 'https://rc-epay.esewa.com.np/api/epay/main/v2/form'),
    'status_check_url' => env('ESEWA_STATUS_CHECK_URL', 'https://rc.esewa.com.np/api/epay/transaction/status/'),
];
