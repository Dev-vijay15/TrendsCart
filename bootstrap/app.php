<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,

// Register AdminMiddleware

          'admin' => \App\Http\Middleware\AdminMiddleware::class,
          'user' => \App\Http\Middleware\UserMiddleware::class,
        ]);


    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            // Check if the request expects a JSON response
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Resource not found.'], 404);
            }

            // For web requests, return a custom 404 view
            
            return response()->view('errors.404', [], 404);
        });
    })->create();
