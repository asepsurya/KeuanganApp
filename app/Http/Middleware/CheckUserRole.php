<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $role): Response
    {
        // Mengecek apakah pengguna telah login dan apakah role-nya sesuai
        if (auth()->check() && auth()->user()->role !== $role) {
            // Redirect jika role tidak sesuai
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
