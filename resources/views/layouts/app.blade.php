<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <link rel="icon" type="image/png" href="{{ asset('assets/branding/favicon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'AutoMate - Smart Vehicle Service Management')</title>

    @php
        $viteAssets = ['resources/css/app.css', 'resources/js/app.js'];

        if (request()->routeIs('staff.*') || request()->routeIs('dashboard.staff')) {
            $viteAssets[] = 'resources/css/staff-core.css';
        }
    @endphp

    @vite($viteAssets)
    
    @stack('styles')
</head>
<body class="app-layout-body">
    <div class="app-layout-root">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>

