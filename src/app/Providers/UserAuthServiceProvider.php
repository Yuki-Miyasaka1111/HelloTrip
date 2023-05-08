<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserAuthServiceProvider extends ServiceProvider
{
    use AuthenticatesUsers;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('custom-user', function ($request) {
            $email = $request->input('email');
            $password = $request->input('password');

            $user = \App\Models\User::where('email', $email)->where('is_active', 1)->first();

            if ($user && hash('check', $password, $user->password)) {
                return $user;
            }

            return null;
        });
    }
}
