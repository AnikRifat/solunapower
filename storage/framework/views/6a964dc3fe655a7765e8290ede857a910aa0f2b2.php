
<!-- Header_area_start -->
<div class="header_area fixed-to" id="header_top">
    <!-- Header_top_area_start -->
    <div class="header_top_area" >
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-7 text-center">
                    <div class="header_top_left  d-none d-sm-block">
                        <?php if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0]): ?>
                            <ul class="d-flex justify-content-md-start justify-content-center">
                                <li><i class="fa-solid fa-envelope"></i> <a href="mailto:<?php echo app('translator')->get(@$contact->description->email); ?>"><?php echo app('translator')->get(@$contact->description->email); ?></a> </li>
                                <li><i class="fa-solid fa-phone"></i> <a href="tel:<?php echo app('translator')->get(@$contact->description->phone); ?>"><?php echo app('translator')->get(@$contact->description->phone); ?></a> </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-5 ">
                    <div
                        class="header_top_right d-flex justify-content-md-end justify-content-center align-items-center">
                        <div class="language_select_area">
                            <div class="dropdown">
                                <button class="custom_dropdown dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                     eng
                                </button>
                                <?php
                                    $languageArray = json_decode($languages, true);
                                ?>
                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $languageArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a class="dropdown-item" href="<?php echo e(route('language',$key)); ?>"><span class="flag-icon flag-icon-<?php echo e(strtolower($key)); ?>"></span> <?php echo e($lang); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <?php if(isset($contentDetails['social'])): ?>
                            <div class="login_area">
                                <ul class="social_area d-flex">
                                    <?php $__currentLoopData = $contentDetails['social']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(@$data->content->contentMedia->description->link); ?>" target="_blank" class="<?php echo e(session()->get('trans') == $key ? 'lang_active' : ''); ?>"><i class="<?php echo e(@$data->content->contentMedia->description->icon); ?>"></i></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header_top_area_end -->

    <!-- Nav_area_start -->
    <div class="nav_area">
        <nav class="navbar navbar-expand-lg">
            <div class="container custom_nav">
                <a class="logo" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(getFile(config('location.logoIcon.path').'logo.png')); ?>"
                                              alt="<?php echo e(config('basic.site_title')); ?>"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="bars"><i class="fa-solid fa-bars-staggered"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto text-center align-items-center align-items-center">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::routeIs('about') ? 'active' : ''); ?>" href="<?php echo e(route('about')); ?>"><?php echo app('translator')->get('About'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::routeIs('plan') ? 'active' : ''); ?>" href="<?php echo e(route('plan')); ?>"><?php echo app('translator')->get('Plan'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::routeIs('blog') ? 'active' : ''); ?>" href="<?php echo e(route('blog')); ?>"><?php echo app('translator')->get('Blog'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::routeIs('faq') ? 'active' : ''); ?>" href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('FAQ'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(Request::routeIs('contact') ? 'active' : ''); ?>" href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a>
                        </li>
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="login_btn" href="<?php echo e(route('login')); ?>"><i class="fa-regular fa-user"></i> <?php echo app('translator')->get('Login'); ?></a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="login_btn" href="<?php echo e(route('home')); ?>"><i class="fa-regular fa-user"></i> <?php echo app('translator')->get('Dashboard'); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Nav_area_end -->
</div>
<!-- Header_area_end -->
<?php /**PATH C:\xampp\htdocs\solunapower\resources\views/themes/lightpink/partials/topbar.blade.php ENDPATH**/ ?>