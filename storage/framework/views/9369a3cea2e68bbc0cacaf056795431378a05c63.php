<?php $__env->startSection('title', trans('Dashboard')); ?>
<?php $__env->startSection('content'); ?>
    <!-- main -->
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <section class="plan_area my-3" style="background: #fff;border-radius: 10px;">
                    <div class="">
                        <div class="row">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="monthly" role="tabpanel"
                                    aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="">
                                        <ul class="list-unstyled row pt-30 justify-content-center">
                                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();
                                                ?>
                                                <?php if($data): ?>
                                                    <li class="col-lg-12 col-sm-12 p-3 ">
                                                        <div class="cmn_box box1 shadow3">
                                                            <div class="row">
                                                                <div class="col-md-1 col-3">
                                                                    <div class="image_area">
                                                                        <img src="https://app.solunapower.pro/uploads/20230727/9ffe9a1795eac5b979adbbe3309f8a49.png" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-9">

                                                                    <div class="price top-left-radius-0"><?php echo app('translator')->get($data->name); ?> - <?php echo e($data->repeatable); ?>  <?php echo e(trans($getTime->name)); ?></div>

                                                                    <p><?php echo app('translator')->get('Capital return'); ?> : <small><span
                                                                        class="badge-small badge bg-<?php echo e($data->is_capital_back == 1 ? 'success' : 'danger'); ?>"><?php echo e($data->is_capital_back == 1 ? trans('Yes') : trans('No')); ?></span></small>
                                                            </p>
                                                                    <h><?php echo e($data->price); ?></h>

                                                                </div>
                                                                <div class="col-md-5 col-12" style="
                                                                text-align: right;
                                                            ">
                                                                    <?php if($data->profit_type == 1): ?>
                                                                        <p>
                                                                            <span><?php echo e(getAmount($data->profit)); ?><?php echo e('%'); ?>

                                                                            </span> <?php echo app('translator')->get('/'); ?>
                                                                            <?php echo e(trans($getTime->name)); ?>

                                                                        </p>
                                                                    <?php else: ?>
                                                                        <p><span
                                                                                class="golden-text"><small><sup><?php echo e(trans($basic->currency_symbol)); ?></sup></small><?php echo e(getAmount($data->profit)); ?>

                                                                                <small class="small-font"><?php echo app('translator')->get('/'); ?>
                                                                                    <?php echo e(trans($getTime->name)); ?></small></span>
                                                                        </p>
                                                                    <?php endif; ?>

                                                                    <div class="btn_area">
                                                                        <button type="button"
                                                                            class="btn btn-success btn-block col-md-btn-sm investNow"
                                                                            data-price="<?php echo e($data->price); ?>"
                                                                            data-resource="<?php echo e($data); ?>"><?php echo app('translator')->get('Start'); ?></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php $__currentLoopData = $gateways->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2 col-3">
                                <div class="item">
                                    <div class="image_area">
                                        <img class="img-fluid" src="<?php echo e(getFile(config('location.gateway.path').@$gateway->image)); ?>" alt="<?php echo e(@$gateway->name); ?>">
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </section>

                <!-- Plan_modal_start -->
                <div class="plan_modal">
                    <!-- Modal -->
                    <div class="modal fade" id="investNowModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow1">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Invest Now'); ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal_title plan-name"></div>
                                    <p class="modal_text price-range"></p>
                                    <p class="modal_text profit-details"></p>
                                    <p class="modal_text profit-validity"></p>
                                    <form class="text-start mt-20 login-form" id="invest-form"
                                        action="<?php echo e(route('user.purchase-plan')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="mb-3">
                                            <h6 for="select" class="form-label"><?php echo app('translator')->get('Select wallet'); ?></h6>
                                            <select class="form-select" aria-label="Default select example"
                                                name="balance_type">
                                                <?php if(auth()->guard()->check()): ?>
                                                    <option value="balance"><?php echo app('translator')->get('Deposit Balance - ' . $basic->currency_symbol . getAmount(auth()->user()->balance)); ?></option>
                                                    <option value="interest_balance"><?php echo app('translator')->get('Interest Balance -' . $basic->currency_symbol . getAmount(auth()->user()->interest_balance)); ?></option>
                                                <?php endif; ?>
                                                <option value="checkout"><?php echo app('translator')->get('Checkout'); ?></option>
                                            </select>
                                        </div>
                                        <h6 for="select" class="form-label"><?php echo app('translator')->get('Amount'); ?></h6>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control invest-amount" name="amount"
                                                id="amount" value="<?php echo e(old('amount')); ?>"
                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                autocomplete="off" placeholder="<?php echo app('translator')->get('Enter amount'); ?>">
                                        </div>
                                        <input type="hidden" name="plan_id" class="plan-id">
                                        <button type="submit" class="custom_btn w-100"><?php echo app('translator')->get('Invest Now'); ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Plan_modal_end -->

                <!-- plan_area_end -->

            </div>
            <div class="col-12">
                <div class="row g-4 mb-4 d-none">
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5><?php echo app('translator')->get('Main Balance'); ?></h5>
                            <h3>
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($walletBalance, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="far fa-funnel-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-2">
                            <h5><?php echo app('translator')->get('Interest Balance'); ?></h5>
                            <h3>
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($interestBalance, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="far fa-hand-holding-usd"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-3">
                            <h5><?php echo app('translator')->get('Total Deposit'); ?></h5>
                            <h3>
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($totalDeposit, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="fal fa-box-usd"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-4">
                            <h5><?php echo app('translator')->get('Total Earn'); ?></h5>
                            <h3>
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($totalInterestProfit, config('basic.fraction_number'))); ?>

                            </h3>
                            <i class="far fa-badge-dollar"></i>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mb-4 d-none">
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5><?php echo app('translator')->get('Total Invest'); ?></h5>
                            <h3>
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($roi['totalInvestAmount'])); ?>

                            </h3>
                            <i class="far fa-search-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-2">
                            <h5><?php echo app('translator')->get('Total Payout'); ?></h5>
                            <h3>
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($totalPayout)); ?>

                            </h3>
                            <i class="fal fa-usd-circle"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-4">
                            <h5><?php echo app('translator')->get('Total Referral Bonus'); ?></h5>
                            <h3>
                                <small><sup><?php echo e(trans(config('basic.currency_symbol'))); ?></sup></small><?php echo e(getAmount($depositBonus + $investBonus)); ?>

                            </h3>
                            <i class="fal fa-lightbulb-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-3">
                            <h5><?php echo app('translator')->get('Total Ticket'); ?></h5>
                            <h3><?php echo e($ticket); ?></h3>
                            <i class="fal fa-ticket"></i>
                        </div>
                    </div>
                </div>

                <!-- charts -->
                <section class="chart-information">
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0 d-none">
                            <div class="progress-wrapper">
                                <div id="container" class="apexcharts-canvas"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none">
                            <div class="progress-wrapper progress-wrapper-circle">
                                <div class="progress-container d-flex flex-column flex-sm-row justify-content-around">
                                    <div class="circular-progress cp_1">
                                        <svg class="radial-progress"
                                            data-percentage="<?php echo e(getPercent($roi['totalInvest'], $roi['completed'])); ?>"
                                            viewBox="0 0 80 80">
                                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                            <circle class="complete" cx="40" cy="40" r="35"
                                                style="
                                    stroke-dashoffset: 39.58406743523136;
                                    ">
                                            </circle>
                                            <text class="percentage" x="50%" y="53%"
                                                transform="matrix(0, 1, -1, 0, 80, 0)">
                                                <?php echo e(getPercent($roi['totalInvest'], $roi['completed'])); ?> %
                                            </text>
                                        </svg>
                                        <h4 class="golden-text mt-4 text-center">
                                            <?php echo app('translator')->get('Invest Completed'); ?>
                                        </h4>
                                    </div>

                                    <div class="circular-progress cp_3">
                                        <svg class="radial-progress"
                                            data-percentage="<?php echo e(100 - getPercent($roi['expectedProfit'], $roi['returnProfit'])); ?>"
                                            viewBox="0 0 80 80">
                                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                            <circle class="complete" cx="40" cy="40" r="35"
                                                style="
                                    stroke-dashoffset: 39.58406743523136;
                                    ">
                                            </circle>
                                            <text class="percentage" x="50%" y="53%"
                                                transform="matrix(0, 1, -1, 0, 80, 0)">
                                                <?php echo e(100 - getPercent($roi['expectedProfit'], $roi['returnProfit'])); ?> %
                                            </text>
                                        </svg>

                                        <h4 class="golden-text mt-4 text-center">
                                            <?php echo app('translator')->get('ROI Speed'); ?>
                                        </h4>
                                    </div>

                                    <div class="circular-progress cp_2">
                                        <svg class="radial-progress"
                                            data-percentage="<?php echo e(getPercent($roi['expectedProfit'], $roi['returnProfit'])); ?>"
                                            viewBox="0 0 80 80">
                                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                            <circle class="complete" cx="40" cy="40" r="35"
                                                style="
                                    stroke-dashoffset: 147.3406954533613;
                                    ">
                                            </circle>
                                            <text class="percentage" x="50%" y="53%"
                                                transform="matrix(0, 1, -1, 0, 80, 0)">
                                                <?php echo e(getPercent($roi['expectedProfit'], $roi['returnProfit'])); ?> %
                                            </text>
                                        </svg>

                                        <h4 class="golden-text mt-4 text-center">
                                            <?php echo app('translator')->get('ROI Redeemed'); ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>





<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset($themeTrue . 'js/apexcharts.js')); ?>"></script>

    <script>
        "use strict";

        var options = {
            theme: {
                mode: "light",
            },

            series: [{
                    name: "<?php echo e(trans('Investment')); ?>",
                    color: 'rgba(247, 147, 26, 1)',
                    data: <?php echo $monthly['investment']->flatten(); ?>

                },
                {
                    name: "<?php echo e(trans('Payout')); ?>",
                    color: 'rgba(240, 16, 16, 1)',
                    data: <?php echo $monthly['payout']->flatten(); ?>

                },
                {
                    name: "<?php echo e(trans('Deposit')); ?>",
                    color: 'rgba(255, 72, 0, 1)',
                    data: <?php echo $monthly['funding']->flatten(); ?>

                },
                {
                    name: "<?php echo e(trans('Deposit Bonus')); ?>",
                    color: 'rgba(39, 144, 195, 1)',
                    data: <?php echo $monthly['referralFundBonus']->flatten(); ?>

                },
                {
                    name: "<?php echo e(trans('Investment Bonus')); ?>",
                    color: 'rgba(136, 203, 245, 1)',
                    data: <?php echo $monthly['referralInvestBonus']->flatten(); ?>

                }
            ],
            chart: {
                type: 'bar',
                // height: ini,
                background: '#000',
                toolbar: {
                    show: false
                }

            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: <?php echo $monthly['investment']->keys(); ?>,

            },
            yaxis: {
                title: {
                    text: ""
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                colors: ['#000'],
                y: {
                    formatter: function(val) {
                        return "<?php echo e(trans($basic->currency_symbol)); ?>" + val + ""
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#container"), options);
        chart.render();

        function copyFunction() {
            var copyText = document.getElementById("sponsorURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success(`Copied: ${copyText.value}`);
        }
    </script>




    <script>
        "use strict";
        (function($) {
            $(document).on('click', '.investNow', function() {
                var planModal = new bootstrap.Modal(document.getElementById('investNowModal'))
                planModal.show()
                let data = $(this).data('resource');
                let price = $(this).data('price');
                let symbol = "<?php echo e(trans($basic->currency_symbol)); ?>";
                let currency = "<?php echo e(trans($basic->currency)); ?>";
                $('.price-range').text(`<?php echo app('translator')->get('Invest'); ?>: ${price}`);

                if (data.fixed_amount == '0') {
                    $('.invest-amount').val('');
                    $('#amount').attr('readonly', false);
                } else {
                    $('.invest-amount').val(data.fixed_amount);
                    $('#amount').attr('readonly', true);
                }

                $('.profit-details').html(
                    `<?php echo app('translator')->get('Interest'); ?>: ${(data.profit_type == '1') ? `${data.profit} %` : `${data.profit} ${currency}`}`
                    );
                $('.profit-validity').html(
                    `<?php echo app('translator')->get('Per'); ?> ${data.schedule} <?php echo app('translator')->get('hours'); ?> ,  ${(data.is_lifetime == '0') ? `${data.repeatable} <?php echo app('translator')->get('times'); ?>` : `<?php echo app('translator')->get('Lifetime'); ?>`}`
                    );
                $('.plan-name').text(data.name);
                $('.plan-id').val(data.id);
                $('.show-currency').text("<?php echo e(config('basic.currency')); ?>");
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme . 'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\solunapower\resources\views/themes/lightpink/user/dashboard.blade.php ENDPATH**/ ?>