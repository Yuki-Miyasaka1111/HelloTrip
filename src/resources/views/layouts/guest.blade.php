<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.meta')
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="app" class="bg-tertiary" style="display:none;">
        @include('components.user.navigation.header')
        @include('components.user.navigation.category-bar')

        <main>
            @yield('content')
        </main>

        @include('partials.scripts')
    </body>
</html>
