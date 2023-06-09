<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.meta')
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="app" class="bg-secondary" style="display:none;">
        <section class="card p-guest">
            <a href="/" class="p-guest__logo text-center d-block py-1-5">
                <x-common.img.logo_01 class="mx-auto" />
            </a>

            <x-common.buttons.login-register 
                class="d-flex text-center px-1 pt-2" 
                loginText="ログイン" 
                registerText="新規登録" 
            />

            <div class="px-1 py-2">
                {{ $slot }}
            </div>
        </section>

        @include('partials.scripts')
    </body>
</html>
