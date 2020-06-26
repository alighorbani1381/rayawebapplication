<?php

namespace App\Http\Middleware;

use Closure;
class isAdmin
{
    private function isAdmin()
    {
        $type = auth()->user()->type;
        $isAdmin = ($type == 'admin') ? true : false;
        return $isAdmin;
    }

    public function handle($request, Closure $next)
    {
        if($this->isAdmin())
        return $next($request);
        else
        return redirect()->route('contractor.dashbord');
            
    }
}
