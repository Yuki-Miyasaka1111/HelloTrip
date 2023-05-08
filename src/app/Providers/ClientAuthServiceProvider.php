<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ClientAuthServiceProvider extends ServiceProvider
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
        $this->app['auth']->viaRequest('custom-client', function ($request) {
            $email = $request->input('email');
            $password = $request->input('password');

            $client = \App\Models\Client::where('email', $email)->where('is_active', 1)->first();

            if ($client && hash('check', $password, $client->password)) {
                return $client;
            }

            return null;
        });
    }
}
