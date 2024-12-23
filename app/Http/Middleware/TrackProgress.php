<?php

// app/Http/Middleware/TrackProgress.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class TrackProgress
{
    public function handle($request, Closure $next)
    {
        Session::put('progress', 0); // Inisialisasi progres
        return $next($request);
    }
}
