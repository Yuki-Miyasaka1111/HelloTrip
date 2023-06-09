<x-guest-layout>
    <form method="POST" action="{{ route('client.register') }}">
        @csrf

        <!-- 会社名 -->
        <div>
            <x-labels.input for="name" :value="__('会社名')" />
            <x-inputs.text 
                id="name" 
                class="block mt-1 w-full" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required autofocus autocomplete="name" />
            <x-errors.input :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- ご担当者名 -->
        <div class="mt-2">
            <x-labels.input for="manager_name" :value="__('ご担当者名')" />
            <x-inputs.text 
                id="manager_name" 
                class="block mt-1 w-full" 
                type="text" 
                name="manager_name" 
                :value="old('manager_name')" 
                required autofocus autocomplete="name" />
            <x-errors.input :messages="$errors->get('manager_name')" class="mt-2" />
        </div>

        <!-- ご担当者所属部署 -->
        <div class="mt-2">
            <x-labels.input for="manager_department" :value="__('ご担当者所属部署')" />
            <x-inputs.text 
                id="manager_department" 
                class="block mt-1 w-full" 
                type="text" 
                name="manager_department" 
                :value="old('manager_department')" 
                required autofocus autocomplete="name" />
            <x-errors.input :messages="$errors->get('manager_department')" class="mt-2" />
        </div>

        <!-- ご担当者連絡先 -->
        <div class="mt-2">
            <x-labels.input for="manager_phone_number" :value="__('ご担当者連絡先')" />
            <x-inputs.text 
                id="manager_phone_number" 
                class="block mt-1 w-full" 
                type="text" 
                name="manager_phone_number" 
                :value="old('manager_phone_number')" 
                required autofocus autocomplete="name" />
            <x-errors.input :messages="$errors->get('manager_phone_number')" class="mt-2" />
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
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('client.login') }}">
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
