<!-- footer_area_start -->
<section class="footer_area">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-sm-6">
                <div class="footer_widget">
                    <div class="widget_logo">
                        <h5><a href="<?php echo e(url('/')); ?>" class="site_logo"><img src="<?php echo e(getFile(config('location.logoIcon.path').'logo.png')); ?>" alt="<?php echo e(config('basic.site_title')); ?>"></a></h5>
                        <?php if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0]): ?>
                            <p class=""><?php echo app('translator')->get(strip_tags(@$contact->description->footer_short_details)); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if(isset($contentDetails['social'])): ?>
                        <div class="social_area mt-50">
                            <ul class="">
                                <?php $__currentLoopData = $contentDetails['social']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(@$data->content->contentMedia->description->link); ?>" target="_blank"><i class="<?php echo e(@$data->content->contentMedia->description->icon); ?>"></i></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-2 col-sm-6 <?php echo e((session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'); ?>">
                <div class="footer_widget ps-lg-5">
                    <h5><?php echo app('translator')->get('Links'); ?> <span class="highlight"></span></h5>
                    <ul>
                        <li>
                            <a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('about')); ?>"><?php echo app('translator')->get('About'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('plan')); ?>"><?php echo app('translator')->get('Plan'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('blog')); ?>"><?php echo app('translator')->get('Blog'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 pt-sm-0 pt-3 ps-lg-5 <?php echo e((session()->get('rtl') == 1) ? 'pe-lg-5': 'ps-lg-5'); ?>">
                <div class="footer_widget">
                    <h5><?php echo app('translator')->get('Our Services'); ?> <span class="highlight"></span></h5>
                    <?php if(isset($contentDetails['support'])): ?>
                        <ul>
                            <?php $__currentLoopData = $contentDetails['support']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('getLink', [slug($data->description->title), $data->content_id])); ?>"><?php echo app('translator')->get($data->description->title); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('faq')); ?>"><?php echo app('translator')->get('FAQ'); ?></a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0]): ?>
                <div class="col-lg-3 col-sm-6 pt-sm-0 pt-3">
                    <div class="footer_widget">
                        <h5><?php echo app('translator')->get('Contact Us'); ?> <span class="highlight"></span></h5>
                        <p><?php echo app('translator')->get(@$contact->description->address); ?></p>
                        <p><?php echo app('translator')->get(@$contact->description->email); ?></p>
                        <p><?php echo app('translator')->get(@$contact->description->phone); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- footer_area_end -->

<!-- copy_right_area_start -->
<div class="copy_right_area text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p><?php echo app('translator')->get('Copyright'); ?> &copy; <?php echo e(date('Y')); ?> <?php echo app('translator')->get($basic->site_title); ?> <?php echo app('translator')->get('All Rights Reserved'); ?> </p>
            </div>
        </div>
    </div>
</div>
<!-- copy_right_area_end -->
<?php /**PATH C:\xampp\htdocs\solunapower\resources\views/themes/lightpink/partials/footer.blade.php ENDPATH**/ ?>