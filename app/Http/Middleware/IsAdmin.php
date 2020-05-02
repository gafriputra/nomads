<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // ngecek sudah login dan admin
        if (Auth::user() && Auth::user()->roles == 'ADMIN') {
            //ngelanjutin request sebelumnya dari user
            return $next($request);
            # code...
        }
        return redirect('/');
    }
}
