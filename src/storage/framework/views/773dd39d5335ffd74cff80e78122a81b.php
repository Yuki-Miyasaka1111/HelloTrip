<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'placeholder' => '', 'description' => '', 'class' => 'form-input form-textarea', 'width' => '100%', 'height' => '']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'placeholder' => '', 'description' => '', 'class' => 'form-input form-textarea', 'width' => '100%', 'height' => '']); ?>
<?php foreach (array_filter((['name', 'placeholder' => '', 'description' => '', 'class' => 'form-input form-textarea', 'width' => '100%', 'height' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<textarea name="<?php echo e($name); ?>" class="<?php echo e($class); ?> my-1-2-5" placeholder="<?php echo e($placeholder); ?>" style="width: <?php echo e($width); ?>; height: <?php echo e($height); ?>;" <?php echo $attributes; ?>><?php echo e($description); ?></textarea><?php /**PATH /var/www/html/resources/views/components/inputs/textarea.blade.php ENDPATH**/ ?>