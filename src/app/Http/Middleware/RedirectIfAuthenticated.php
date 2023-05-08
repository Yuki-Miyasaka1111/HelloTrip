<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    private const GUARD_USER = 'web';
    private const GUARD_CLIENT = 'client';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard(self::GUARD_USER)->check() && $request->routeIs('user.*')) {
                return redirect()->guest(route('user.login'));
            }
            if (Auth::guard(self::GUARD_CLIENT)->check() && $request->routeIs('client.*')) {
                return redirect()->guest(route('client.login'));
            }
        }

        return $next($request);
    }
}
