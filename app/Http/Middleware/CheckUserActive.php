<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserActive
{

    public function handle($request, Closure $next)
    {
        if (!Session::get('user') == '') {
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
