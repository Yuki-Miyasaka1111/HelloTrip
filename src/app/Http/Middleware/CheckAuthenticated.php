<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            session(['redirect_back' => url()->current()]);

            if (Str::startsWith($request->path(), 'project')) {
                return redirect()->route('client.login'); // クライアント用のログインページへリダイレクト
            } else {
                return redirect()->route('user.login'); // ユーザー用のログインページへリダイレクト
            }
        }

        return $next($request);
    }
}
