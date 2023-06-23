<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.meta')
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="app" class="bg-tertiary" style="display:none;">
        @include('components.user.navigation.header')

        <main>
            @yield('content')
        </main>

        @include('components.user.navigation.footer')

        @include('partials.scripts')
    </body>
</html>
