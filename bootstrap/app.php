<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        channels: __DIR__.'/../routes/channels.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');

        $middleware->alias([
            'multi.auth' => \App\Http\Middleware\CheckMultiGuardAuth::class,
            'check.staff.status' => \App\Http\Middleware\CheckStaffStatus::class,
            'role' => \App\Http\Middleware\EnsureRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Surface errors in Render logs when APP_DEBUG=false (Monolog may target storage/logs).
        $exceptions->reportable(function (\Throwable $e): void {
            fwrite(STDERR, sprintf(
                "[exception] %s: %s in %s:%d\n",
                $e::class,
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            ));
        });
    })->create();
