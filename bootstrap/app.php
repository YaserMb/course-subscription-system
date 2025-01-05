<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckSubscription;
use App\Http\Middleware\VerifyDownloadToken;
use App\Http\Middleware\CheckActiveSubscription;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check.subscription' => CheckSubscription::class,
            'admin' => AdminMiddleware::class,
            'verify.download' => VerifyDownloadToken::class,
            'active.subscription' => CheckActiveSubscription::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
