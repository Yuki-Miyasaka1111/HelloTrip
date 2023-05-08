<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected string $user_route  = 'user.login';
    protected string $client_route = 'client.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if (Route::is('user.*')) {
                return route('user.login');
            } elseif (Route::is('client.*')) {
                return route('client.login');
            }
        }
    
        // デフォルトの動作（例外をスローする）を維持する
        return parent::redirectTo($request);
    }

    public function handle($request, \Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        // ユーザーがアクティブかどうかを確認
        $user = auth()->user();
        if ($user && !$user->is_active) {
            // ユーザーがアクティブでない場合、ログアウトし、ログイン画面にリダイレクト
            auth()->logout();
            return redirect()->route($this->user_route)
                ->with('error', 'アカウントが有効化されていません。メールに記載されたリンクからアカウントを有効化してください。');
        }

        return $next($request);
    }
}
