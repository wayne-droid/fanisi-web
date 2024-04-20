<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->session()->has('user')) 
        {
            return redirect('/signin');
        }

        return $next($request);
    }
}
