<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
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
        return $next($request);
        $token = $request->header('API_KEY');
        if ($token!='bf70391634febf1ce4e076600cbb5710f50a8f62') {
            /*oktat.com*/
            return response()->json(['status' => false,'msg' => 'Unauthorized: Access to this resource is denied.','data'=>(Object)[]], 401);
        }
        return $next($request);
    }
}
