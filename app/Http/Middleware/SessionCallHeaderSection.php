<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SessionCallHeaderSection
{
    public function handle($request, Closure $next)
    {
        $user_id = Session::get('user_id');
        $withoutUserCookie = Session::get('without_user_add_to_Cart');

        if (empty($withoutUserCookie)) {
            $without_user_add_to_Cart = "user-" . Str::random(4);
            Session::put('without_user_add_to_Cart', $without_user_add_to_Cart);
        }
        view()->share('user_id', $user_id);
        view()->share('without_user_add_to_Cart', $withoutUserCookie);

        return $next($request);
    }
}
