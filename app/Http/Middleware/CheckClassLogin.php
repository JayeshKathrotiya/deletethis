<?php

namespace App\Http\Middleware;

use Closure;

class CheckClassLogin
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
        if (!$request->session()->exists('class_login_session')) {
            return redirect('/');
        }
        return $next($request);
    }
}
