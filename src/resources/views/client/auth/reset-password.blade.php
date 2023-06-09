<x-guest-layout>
    <form method="POST" action="{{ route('client.password.update') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input for="email" :value="__('Email')" />
            <x-text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input for="password" :value="__('Password')" />
            <x-text id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input for="password_confirmation" :value="__('Confirm Password')" />

            <x-text id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary>
                {{ __('Reset Password') }}
            </x-primary>
        </div>
    </form>
</x-guest-layout>
