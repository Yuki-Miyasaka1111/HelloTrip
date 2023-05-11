<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'value', 'label', 'id', 'checked' => false, 'class' => 'form-checkbox', 'width' => '100%']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'value', 'label', 'id', 'checked' => false, 'class' => 'form-checkbox', 'width' => '100%']); ?>
<?php foreach (array_filter((['name', 'value', 'label', 'id', 'checked' => false, 'class' => 'form-checkbox', 'width' => '100%']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="<?php echo e($class); ?>-wrap py-1 pl-1 pr-3 d-flex justify-between" style="width: <?php echo e($width); ?>;" >
    <span class=""><?php echo e($label); ?></span>
    <input id="<?php echo e($id); ?>" type="checkbox" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>" class="d-none <?php echo e($class); ?>" <?php echo e($checked ? 'checked' : ''); ?> <?php echo $attributes; ?>>
    <label for="<?php echo e($id); ?>" class="<?php echo e($class); ?>-label"></label>
</div>
<?php /**PATH /var/www/html/resources/views/components/inputs/checkbox.blade.php ENDPATH**/ ?>