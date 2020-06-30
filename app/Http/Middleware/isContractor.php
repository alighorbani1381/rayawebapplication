<?php

namespace App\Http\Middleware;

use Closure;

class isContractor
{
    private function isContractor()
    {
        $type = auth()->user()->type;
        $isContractor = ($type == 'contractor') ? true : false;
        return $isContractor;
    }

    public function handle($request, Closure $next)
    {
        if ($this->isContractor())
            return $next($request);
        else
            return redirect()->route('admin.dashboard');
    }
}
