<?php 

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || $request->user() && $request->user()->hasVerifiedEmail()) {
            return $next($request);
        }

        return redirect()->route('user.verification.notice');
    }
}
