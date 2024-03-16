<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        switch ($role) {
            case 'admin':
                if ($user->isAdmin()) {
                    return $next($request);
                }
                break;
            case 'employee':
                if ($user->isEmployee()) {
                    return $next($request);
                }
                break;
        }
        return abort(403);
    }
}
