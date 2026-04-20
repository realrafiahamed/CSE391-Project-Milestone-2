<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('admin_id')) {
            return redirect('/admin/login');
        }

        return $next($request);
    }

}
