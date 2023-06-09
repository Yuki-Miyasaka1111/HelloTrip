<x-guest-layout>
    <form method="POST" action="{{ route('user.register') }}">
        @csrf

        <!-- name -->
        <div>
            <x-labels.input for="name" :value="__('名前')" />
            <x-inputs.text 
                id="name" 
                class="d-block mt-0-5 width-full" 
                type="text" 
                name="name" 
                :value="old('name')" 
                placeholder="田中太郎" 
                required autofocus autocomplete="name" />
            <x-errors.input :messages="$errors->get('name')" class="mt-1" />
        </div>
        
        <!-- Email Address -->
        <div class="mt-2">
            <x-labels.input for="email" :value="__('メールアドレス')" />
            <x-inputs.text 
                id="email" 
                class="d-block mt-1 width-full" 
                type="email" name="email" 
                :value="old('email')"
                placeholder="name@example.co.jp" 
                required autocomplete="username" />
            <x-errors.input :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="mt-2">
            <x-labels.input for="password" :value="__('パスワード')" />

            <x-inputs.text id="password" class="d-block mt-1 width-full"
                type="password"
                name="password"
                placeholder="半角英数字8文字以上" 
                required autocomplete="new-password" />

            <x-errors.input :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2">
            <x-labels.input for="password_confirmation" :value="__('確認用パスワード')" />

            <x-inputs.text id="password_confirmation" class="d-block mt-1 width-full"
                type="password"
                name="password_confirmation" 
                placeholder="半角英数字8文字以上" 
                required autocomplete="new-password" />

            <x-errors.input :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="flex items-center justify-center mt-2">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('user.login') }}">
                {{ __('既にご登録の方はこちら') }}
            </a>
        </div>

        <div class="flex items-center justify-center mt-2">
            <x-buttons.primary class="px-5 py-1">
                {{ __('新規登録') }}
            </x-buttons.primary>
        </div>
    </form>
</x-guest-layout>
