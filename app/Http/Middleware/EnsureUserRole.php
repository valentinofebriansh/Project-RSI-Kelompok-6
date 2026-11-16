<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return $role === 'admin'
                ? redirect()->route('admin.login')
                : redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.approval')
                : redirect()->route('mahasiswa.dashboard');
        }

        return $next($request);
    }
}