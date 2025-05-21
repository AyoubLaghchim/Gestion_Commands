<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ChekAge;
use App\Http\Middleware\LogRequest;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UserMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //définir un middleware comme global

        // $middleware->append(ChekAge::class);
        // $middleware->append(LogRequest::class);
        // $middleware->appendToGroup('Grp205',[
        //     chekAge::class,
        //     LogRequest::class
        // ]);
        // $middleware->append(AuthMiddleware::class);
        $middleware->alias([
            'checkAge' =>  chekAge::class,
            'Login' =>    LogRequest::class,
            'admin' => AuthMiddleware::class,          
            'user' => UserMiddleware::class,          
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
