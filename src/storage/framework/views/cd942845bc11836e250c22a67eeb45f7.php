<label class="upload-image-wrap m-1-5">
    <input type="file" name="images[]" multiple class="d-none input-image">
    <div class="upload-image-zone width-full height-full d-flex justify-center items-center flex-wrap text-center">
        <img src="" class="drop-image show-drop-image">
        <img src="<?php echo e($imageUrl ?? ''); ?>" class="show-db-image">
        <img src="<?php echo e(asset('img/icons/c-image_icon.svg')); ?>" class="default-image">
    </div>
</label><?php /**PATH /var/www/html/resources/views/components/inputs/image.blade.php ENDPATH**/ ?>