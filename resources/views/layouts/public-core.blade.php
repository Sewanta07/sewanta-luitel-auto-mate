<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/branding/favicon.png') }}">

    <title>@yield('title', 'AutoMate - Smart Vehicle Service Management')</title>

    @vite('resources/css/public-core.css')

    @stack('styles')
</head>
<body class="app-layout-body">
    <div class="app-layout-root">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
