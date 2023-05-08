<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ClientMiddleware extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('client.login');
        }
    }

    /**
     * Determine if the user is authorized to access the given resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if (! $this->auth->guard($guards)->check()) {
            return redirect()->guest(route('client.login'));
        }

        if ($request->user()->role !== 'client') {
            abort(403);
        }
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function guard()
    {
        return 'web';
    }
    
    /**
     * Get the client user guard to be used during authentication.
     *
     * @return string|null
     */
    protected function client()
    {
        return 'client';
    }
}