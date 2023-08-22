<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LoginController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserLogin
{

    public function handle($request, Closure $next)
    {
        if (Session::get('user') == '') {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
