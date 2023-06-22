@extends('layouts.authentication')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('user.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-user.labels.input for="email" :value="__('メールアドレス')" />
            <x-user.inputs.text 
                id="email" 
                class="d-block mt-0-5 width-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                placeholder="name@example.co.jp" 
                required autofocus autocomplete="username" />

            <x-user.errors.input :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="mt-2">
            <x-user.labels.input for="password" :value="__('パスワード')" />

            <x-user.inputs.text id="password" class="d-block mt-1 width-full"
                type="password"
                name="password"
                placeholder="半角英数字8文字以上" 
                required autocomplete="current-password" />

            <x-user.errors.input :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-2">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-center mt-2">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('user.password.request') }}">
                {{ __('パスワードをお忘れの方はこちら') }}
            </a>
        </div>

        <div class="flex items-center justify-center mt-2">
            <x-user.buttons.primary class="px-5 py-1">
                {{ __('ログイン') }}
            </x-user.buttons.primary>
        </div>
    </form>
@endsection