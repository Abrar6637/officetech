<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StagingBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (app()->environment('staging')) {
            if (!$request->getUser() || !$request->getPassword()) {
                return response()->make('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
            }
            $user = DB::table('guest_user')
            ->where('email', $request->getUser())
            ->where('status', "1")
            ->first();

            if (!$user || !password_verify($request->getPassword(), $user->password)) {
                return response()->make('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
            }
        }

        return $next($request);
    }
    
}
