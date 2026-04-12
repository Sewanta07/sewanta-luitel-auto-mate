<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <link rel="icon" type="image/png" href="{{ asset('assets/branding/favicon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'AutoMate')</title>

    @vite(['resources/css/app.css', 'resources/css/customer-core.css', 'resources/js/app.js', 'resources/js/customer-core.js'])

    @stack('styles')
</head>
<body class="app-layout-body">
    <div class="app-layout-root">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
