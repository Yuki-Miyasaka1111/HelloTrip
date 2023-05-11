<section class="sidebar">
    <ul class="sidebar-nav flex flex-col">
        <li class="sidebar-nav-items">
            <a href="" class="d-block p-1-5 font-weight-bold">
                <img src="" alt="">
                <p>サイドバーを閉じる</p>
            </a>
        </li>
        <li class="sidebar-nav-items">
            <div class="d-block p-1-5 font-weight-bold">
                <img src="" alt="">
                <p>施設情報</p>
            </div>
            <ul class="sidebar-nav-dropdown-item">
                <li class="sidebar-nav-item">
                    <a href="<?php echo e(route('project.hotel.editBasicInformation', $selected_hotel->id)); ?>" class="d-block pb-0-5 px-1-5">基本情報</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="<?php echo e(route('project.hotel.editConcept', $selected_hotel->id)); ?>" class="d-block py-0-5 px-1-5">コンセプト</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="<?php echo e(route('project.hotel.editFacilities', $selected_hotel->id)); ?>" class="d-block py-0-5 px-1-5">設備</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="<?php echo e(route('project.hotel.editFeatures', $selected_hotel->id)); ?>" class="d-block pt-0-5 px-1-5 pb-1-5">特徴</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-items">
            <div class="d-block p-1-5 font-weight-bold">
                <img src="" alt="">
                <p>キャンペーン情報</p>
            </div>
            <ul class="sidebar-nav-dropdown-item">
                <li class="sidebar-nav-item">
                    <a href="" class="d-block pb-0-5 px-1-5">新規登録</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="" class="d-block pt-0-5 px-1-5 pb-1-5">管理</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-items">
            <div class="d-block p-1-5 font-weight-bold">
                <img src="" alt="">
                <p>各種管理</p>
            </div>
            <ul class="sidebar-nav-dropdown-item">
                <li class="sidebar-nav-item">
                    <a href="" class="d-block pb-0-5 px-1-5">コンセプト</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="" class="d-block py-0-5 px-1-5">基本情報</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="" class="d-block py-0-5 px-1-5">設備</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="" class="d-block pt-0-5 px-1-5 pb-1-5">特徴</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-items">
            <a href="" class="d-block p-1-5 font-weight-bold">
                <img src="" alt="">
                <p>請求管理</p>
            </a>
        </li>
        <li class="sidebar-nav-items">
            <?php if(Auth::guard('client')->check()): ?>
                <form method="POST" action="<?php echo e(route('client.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-success d-block p-1-5 width-full text-left font-weight-bold" type="submit">ログアウト</button>
                </form>
            <?php endif; ?>
        </li>
    </ul>
</section>

<section class="sidebar-sm">

</section><?php /**PATH /var/www/html/resources/views/components/navigation/dev-sidebar.blade.php ENDPATH**/ ?>