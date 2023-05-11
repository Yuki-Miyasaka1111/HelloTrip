<div class="width-large bg-primary mx-auto my-2">
<?php if(isset($clickable) && $clickable === 'true'): ?>
    <a href="<?php echo e(route('project.hotel.index', $hotel->id)); ?>" class="flex justify-start items-center p-2">
<?php else: ?>
    <div class="flex justify-start items-center p-2">
<?php endif; ?>
        <div class="project_card_left mr-2">
            <img src="https://micado.jp/wp-content/uploads/2023/04/noname-2-1024x683.png" alt="<?php echo e($hotel->name); ?>">
        </div>
        <div class="project_card_right">
            <b class="project_card_right-ttl"><?php echo e($hotel->name); ?></b>
            <div class="project_card_right-flex flex items-center mt-2">
            <?php if($hotel->is_public): ?>
                <p class="project_card_right-public mr-1 font-weight-bold">公開</p>
                <p class="project_card_right-public_url font-weight-bold"><?php echo e(route('hotel.show', $hotel->id)); ?></p>
            <?php else: ?>
                <p class="project_card_right-private mr-1 font-weight-bold">非公開</p>
                <p class="project_card_right-private_url font-weight-bold"><?php echo e(route('hotel.show', $hotel->id)); ?></p>
            <?php endif; ?>
            </div>
        </div>
<?php if(isset($clickable) && $clickable === 'true'): ?>
    </a>
<?php else: ?>
    </div>
<?php endif; ?>
</div><?php /**PATH /var/www/html/resources/views/components/partials/project-card.blade.php ENDPATH**/ ?>