@php
    $isLoginPage = request()->is('login') || request()->is('owner/login');
    $isRegisterPage = request()->is('register') || request()->is('owner/register');
@endphp

<div {{$attributes}}>
    <a 
        href="{{ request()->is('owner/*') ? '/owner/login' : '/login' }}" 
        class="login-register__button--left font-weight-bold width-medium d-block p-0-5 border-radius-sm border-radius-right-none {{ $isLoginPage ? 'login-register__button--active' : 'login-register__button--inactive' }}">
        {{ $loginText }}
    </a>
    <a 
        href="{{ request()->is('owner/*') ? '/owner/register' : '/register' }}" 
        class="login-register__button--right font-weight-bold width-medium d-block p-0-5 border-radius-sm border-radius-left-none {{ $isRegisterPage ? 'login-register__button--active' : 'login-register__button--inactive' }}">
        {{ $registerText }}
    </a>
</div>