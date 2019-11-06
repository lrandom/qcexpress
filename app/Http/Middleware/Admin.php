<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guest() || Auth::user()->per != 1) {
            return redirect('admin/login');
        }

        if (strpos($request->pathinfo, 'admin') != true) {
            return $next($request);
        } else {
            return redirect('admin/dashboard');
        }
    }
}