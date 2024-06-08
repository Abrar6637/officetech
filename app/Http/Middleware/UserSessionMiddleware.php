<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Session::has('user_authenticated')) {
            return $next($request);
        } 
        else {
            return redirect('/sign-in');
        }
    }
}