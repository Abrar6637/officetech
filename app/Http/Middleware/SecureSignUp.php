<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SecureSignUp
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

        // if (!$request->secure()) {
        //     Session::flash('error_messages', 'This action requires a secure connection.');
        //     return redirect()->back()->withErrors('error_message', 'This action requires a secure connection.')->withInput();
        // }

        if (!$request->is('sign-up/form')) {
            if ($request->isMethod('post') && !Session::token() == $request->input('_token')) {
                Session::flash('error_messages', 'CSRF token mismatch.');
                return redirect()->to($request->path())->with('error_message', 'CSRF token mismatch.');
            }
        }
        if (!$request->is('sign-up/ajax')){
            if ($request->isMethod('post') && !Session::token() == $request->input('_token')){
                Session::flash('error_messages', 'CSRF token mismatch.');
                return redirect()->to($request->path())->with('error_message', 'CSRF token mismatch.');
            }
        }

        return $next($request);
    }
}
