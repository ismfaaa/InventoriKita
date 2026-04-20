<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\Pengguna;
use App\Http\Middleware\Stakeholder;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
       $middleware->alias([
        'pengguna'=>Pengguna::class,
        'admin'=>Admin::class,
        'stakeholder'=>Stakeholder::class,
       ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
