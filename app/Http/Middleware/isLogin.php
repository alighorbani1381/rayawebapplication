<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class isLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check())
            return $next($request);
        else
            return redirect()->route('login.show');
    }
}
