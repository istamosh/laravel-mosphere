<?php

use App\Http\Middleware\CanViewPostMiddleware;
use App\Http\Middleware\IsAdminMiddleware;
use App\Mail\PostCountMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Mail;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // add the can-view-post middleware inbetween the routes
        $middleware->alias(['can-view-post' => CanViewPostMiddleware::class]);
        
        // add is-admin alias using isadminmiddleware
        $middleware->alias(['is-admin' => IsAdminMiddleware::class]);
    })
    // move the scheduled mail job from console.php to here
    // run it with artisan schedule:work
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(function () {
            Mail::to('admin@test')->send(new PostCountMail());
        })->everyFiveMinutes();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
