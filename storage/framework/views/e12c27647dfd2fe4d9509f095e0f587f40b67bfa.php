
<div id="sidebar" class="">
    <div class="sidebar-top">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(getFile(config('location.logoIcon.path').'logo.png')); ?>"
                 alt="<?php echo e(config('basic.site_title')); ?>">
        </a>
        <button
            class="sidebar-toggler d-md-none"
            onclick="toggleSideMenu()"
        >
            <i class="fal fa-times"></i>
        </button>
    </div>
    <?php
        $user = \Illuminate\Support\Facades\Auth::user();
        $user_rankings = \App\Models\Ranking::where('rank_lavel', $user->last_lavel)->first();
    ?>

    <?php if($user->last_lavel != null && $user_rankings): ?>
        <div class="level-box">
            <h4><?php echo app('translator')->get(@$user->rank->rank_lavel); ?></h4>
            <p><?php echo app('translator')->get(@$user->rank->rank_name); ?></p>
            <img src="<?php echo e(getFile(config('location.rank.path').@$user->rank->rank_icon)); ?>" alt="" class="level-badge"/>
        </div>
    <?php endif; ?>


    <ul class="main tabScroll">
        <li>
            <a class="<?php echo e(menuActive('user.home')); ?>" href="<?php echo e(route('user.home')); ?>"
            > <i class="fal fa-border-all"></i> <?php echo app('translator')->get('Dashboard'); ?></a
            >
        </li>
        <li>
            <a href="<?php echo e(route('plan')); ?>" class="sidebar-link <?php echo e(menuActive(['plan'])); ?>">
                <i class="fal fa-layer-group"></i> <?php echo app('translator')->get('Plan'); ?>
            </a>
        </li>


        <li>
            <a href="<?php echo e(route('user.profile')); ?>" class="sidebar-link <?php echo e(menuActive(['user.profile'])); ?>">
                <i class="fal fa-user"></i> <?php echo app('translator')->get('profile settings'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('user.ticket.list')); ?>" class="sidebar-link <?php echo e(menuActive(['user.ticket.list', 'user.ticket.create', 'user.ticket.view'])); ?>">
                <i class="fal fa-user-headset"></i> <?php echo app('translator')->get('support ticket'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('user.ticket.list')); ?>" class="sidebar-link <?php echo e(menuActive(['user.ticket.list', 'user.ticket.create', 'user.ticket.view'])); ?>">
                <i class="fal fa-user-headset"></i> <?php echo app('translator')->get('support ticket'); ?>
            </a>
        </li>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\solunapower\resources\views/themes/lightpink/partials/sidebar.blade.php ENDPATH**/ ?>