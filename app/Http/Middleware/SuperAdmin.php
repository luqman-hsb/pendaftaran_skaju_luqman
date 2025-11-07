<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('petugas')->check() || !Auth::guard('petugas')->user()->is_superadmin) {
            abort(403, 'Akses ditolak. Hanya Super Admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}