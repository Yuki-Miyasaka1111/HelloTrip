<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'class' => 'form-input form-text', 'width' => '100%']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'class' => 'form-input form-text', 'width' => '100%']); ?>
<?php foreach (array_filter((['name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'class' => 'form-input form-text', 'width' => '100%']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<input type="<?php echo e($type); ?>" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>" class="<?php echo e($class); ?>" placeholder="<?php echo e($placeholder); ?>" style="width: <?php echo e($width); ?>;" <?php echo $attributes; ?>><?php /**PATH /var/www/html/resources/views/components/inputs/text.blade.php ENDPATH**/ ?>