<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'selectedOption' => null, 'placeholder' => '', 'class' => 'form-input form-select', 'width' => '100%']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'selectedOption' => null, 'placeholder' => '', 'class' => 'form-input form-select', 'width' => '100%']); ?>
<?php foreach (array_filter((['name', 'selectedOption' => null, 'placeholder' => '', 'class' => 'form-input form-select', 'width' => '100%']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<select name="<?php echo e($name); ?>" class="<?php echo e($class); ?>" style="width: <?php echo e($width); ?>;" <?php echo $attributes; ?>>
    <option value=""><?php echo e($placeholder); ?></option>
    <?php echo e($slot); ?>

</select><?php /**PATH /var/www/html/resources/views/components/inputs/select.blade.php ENDPATH**/ ?>