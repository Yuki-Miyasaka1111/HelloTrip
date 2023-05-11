<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">トップページ</h2>
                <?php if(Auth::check()): ?>
                    <h3>ユーザー名: <?php echo e($user_name); ?></h3>
                <?php else: ?>
                    <h3>ユーザー名: 未ログイン</h3>
                <?php endif; ?>

                <?php if(Auth::guard('client')->check()): ?>
                    <h3>クライアントユーザー名: <?php echo e($client_name); ?></h3>
                <?php else: ?>
                    <h3>クライアントユーザー名: 未ログイン</h3>
                <?php endif; ?>
            </div>
            <div class="text-right">
            <a class="btn btn-success" href="<?php echo e(route('hotel.create')); ?>">新規登録</a>
            <?php if(Auth::check()): ?>
                <p>ログインユーザー名: <?php echo e(Auth::user()->name); ?></p>
                <form method="POST" action="<?php echo e(route('user.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-success" type="submit">ログアウト</button>
                </form>
            <?php endif; ?>
            </div>
        </div>
    </div>
 
    <table class="table table-bordered">
        <tr>
            <th style="text-align:right">No</th>
            <th style="text-align:right">ホテル名</th>
            <th style="text-align:right">価格</th>
            <th style="text-align:right">カテゴリ</th>
            <th style="text-align:right">地域</th>
        </tr>
        <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align:right"><?php echo e($hotel->id); ?></td>
            <td style="text-align:right"><a href="<?php echo e(route('hotel.show',$hotel->id)); ?>?page_id=<?php echo e($page_id); ?>"><?php echo e($hotel->name); ?></a></td>
            <td style="text-align:right"><?php echo e($hotel->price); ?>円</td>
            <td style="text-align:right"><?php echo e($hotel->category->category_name); ?></td>
            <td style="text-align:right"><?php echo e($hotel->region->region_name); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <?php echo $hotels->links('pagination::bootstrap-5'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/top.blade.php ENDPATH**/ ?>