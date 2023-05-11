<button <?php echo e($attributes->merge(['type' => 'submit', 'class' => 'c-primary__button', 'style' => 'background: ' . $attributes->get('bg-color', 'linear-gradient(to right, #30cfd0, #330867)')])); ?>>
    <?php echo e($slot); ?>

</button><?php /**PATH /var/www/html/resources/views/components/buttons/primary.blade.php ENDPATH**/ ?>