<?php
    $isLoginPage = request()->is('login') || request()->is('owner/login');
    $isRegisterPage = request()->is('register') || request()->is('owner/register');
?>

<div <?php echo e($attributes); ?>>
    <a 
        href="<?php echo e(request()->is('owner/*') ? '/owner/login' : '/login'); ?>" 
        class="login-register__button--left font-weight-bold width-medium d-block p-0-5 border-radius-sm border-radius-right-none <?php echo e($isLoginPage ? 'login-register__button--active' : 'login-register__button--inactive'); ?>">
        <?php echo e($loginText); ?>

    </a>
    <a 
        href="<?php echo e(request()->is('owner/*') ? '/owner/register' : '/register'); ?>" 
        class="login-register__button--right font-weight-bold width-medium d-block p-0-5 border-radius-sm border-radius-left-none <?php echo e($isRegisterPage ? 'login-register__button--active' : 'login-register__button--inactive'); ?>">
        <?php echo e($registerText); ?>

    </a>
</div><?php /**PATH /var/www/html/resources/views/components/buttons/login-register.blade.php ENDPATH**/ ?>