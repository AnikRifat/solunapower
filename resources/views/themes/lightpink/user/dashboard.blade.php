@extends($theme . 'layouts.user')
@section('title', trans('Dashboard'))
@section('content')
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
                                            @foreach ($plans as $k => $data)
                                                @php
                                                    $getTime = \App\Models\ManageTime::where('time', $data->schedule)->first();
                                                @endphp
                                                @if ($data)
                                                    <li class="col-lg-12 col-sm-12 p-3 ">
                                                        <div class="cmn_box box1 shadow3">
                                                            <div class="row">
                                                                <div class="col-md-1 col-3">
                                                                    <div class="image_area">
                                                                        <img src="https://app.solunapower.pro/uploads/20230727/9ffe9a1795eac5b979adbbe3309f8a49.png" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-9">

                                                                    <div class="price top-left-radius-0">@lang($data->name) - {{ $data->repeatable }}  {{ trans($getTime->name) }}</div>

                                                                    <p>@lang('Capital return') : <small><span
                                                                        class="badge-small badge bg-{{ $data->is_capital_back == 1 ? 'success' : 'danger' }}">{{ $data->is_capital_back == 1 ? trans('Yes') : trans('No') }}</span></small>
                                                            </p>
                                                                    <h>{{ $data->price }}</h>

                                                                </div>
                                                                <div class="col-md-5 col-12" style="
                                                                text-align: right;
                                                            ">
                                                                    @if ($data->profit_type == 1)
                                                                        <p>
                                                                            <span>{{ getAmount($data->profit) }}{{ '%' }}
                                                                            </span> @lang('/')
                                                                            {{ trans($getTime->name) }}
                                                                        </p>
                                                                    @else
                                                                        <p><span
                                                                                class="golden-text"><small><sup>{{ trans($basic->currency_symbol) }}</sup></small>{{ getAmount($data->profit) }}
                                                                                <small class="small-font">@lang('/')
                                                                                    {{ trans($getTime->name) }}</small></span>
                                                                        </p>
                                                                    @endif

                                                                    <div class="btn_area">
                                                                        <button type="button"
                                                                            class="btn btn-success btn-block col-md-btn-sm investNow"
                                                                            data-price="{{ $data->price }}"
                                                                            data-resource="{{ $data }}">@lang('Start')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($gateways->take(8) as $gateway)
                            <div class="col-md-2 col-3">
                                <div class="item">
                                    <div class="image_area">
                                        <img class="img-fluid" src="{{getFile(config('location.gateway.path').@$gateway->image)}}" alt="{{@$gateway->name}}">
                                    </div>
                                </div>
                            </div>

                            @endforeach
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
                                    <h4 class="modal-title" id="exampleModalLabel">@lang('Invest Now')</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal_title plan-name"></div>
                                    <p class="modal_text price-range"></p>
                                    <p class="modal_text profit-details"></p>
                                    <p class="modal_text profit-validity"></p>
                                    <form class="text-start mt-20 login-form" id="invest-form"
                                        action="{{ route('user.purchase-plan') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <h6 for="select" class="form-label">@lang('Select wallet')</h6>
                                            <select class="form-select" aria-label="Default select example"
                                                name="balance_type">
                                                @auth
                                                    <option value="balance">@lang('Deposit Balance - ' . $basic->currency_symbol . getAmount(auth()->user()->balance))</option>
                                                    <option value="interest_balance">@lang('Interest Balance -' . $basic->currency_symbol . getAmount(auth()->user()->interest_balance))</option>
                                                @endauth
                                                <option value="checkout">@lang('Checkout')</option>
                                            </select>
                                        </div>
                                        <h6 for="select" class="form-label">@lang('Amount')</h6>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control invest-amount" name="amount"
                                                id="amount" value="{{ old('amount') }}"
                                                onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                autocomplete="off" placeholder="@lang('Enter amount')">
                                        </div>
                                        <input type="hidden" name="plan_id" class="plan-id">
                                        <button type="submit" class="custom_btn w-100">@lang('Invest Now')</button>
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
                            <h5>@lang('Main Balance')</h5>
                            <h3>
                                <small><sup>{{ trans(config('basic.currency_symbol')) }}</sup></small>{{ getAmount($walletBalance, config('basic.fraction_number')) }}
                            </h3>
                            <i class="far fa-funnel-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-2">
                            <h5>@lang('Interest Balance')</h5>
                            <h3>
                                <small><sup>{{ trans(config('basic.currency_symbol')) }}</sup></small>{{ getAmount($interestBalance, config('basic.fraction_number')) }}
                            </h3>
                            <i class="far fa-hand-holding-usd"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-3">
                            <h5>@lang('Total Deposit')</h5>
                            <h3>
                                <small><sup>{{ trans(config('basic.currency_symbol')) }}</sup></small>{{ getAmount($totalDeposit, config('basic.fraction_number')) }}
                            </h3>
                            <i class="fal fa-box-usd"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-4">
                            <h5>@lang('Total Earn')</h5>
                            <h3>
                                <small><sup>{{ trans(config('basic.currency_symbol')) }}</sup></small>{{ getAmount($totalInterestProfit, config('basic.fraction_number')) }}
                            </h3>
                            <i class="far fa-badge-dollar"></i>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mb-4 d-none">
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box">
                            <h5>@lang('Total Invest')</h5>
                            <h3>
                                <small><sup>{{ trans(config('basic.currency_symbol')) }}</sup></small>{{ getAmount($roi['totalInvestAmount']) }}
                            </h3>
                            <i class="far fa-search-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-2">
                            <h5>@lang('Total Payout')</h5>
                            <h3>
                                <small><sup>{{ trans(config('basic.currency_symbol')) }}</sup></small>{{ getAmount($totalPayout) }}
                            </h3>
                            <i class="fal fa-usd-circle"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-4">
                            <h5>@lang('Total Referral Bonus')</h5>
                            <h3>
                                <small><sup>{{ trans(config('basic.currency_symbol')) }}</sup></small>{{ getAmount($depositBonus + $investBonus) }}
                            </h3>
                            <i class="fal fa-lightbulb-dollar"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="dashboard-box box-3">
                            <h5>@lang('Total Ticket')</h5>
                            <h3>{{ $ticket }}</h3>
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
                                            data-percentage="{{ getPercent($roi['totalInvest'], $roi['completed']) }}"
                                            viewBox="0 0 80 80">
                                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                            <circle class="complete" cx="40" cy="40" r="35"
                                                style="
                                    stroke-dashoffset: 39.58406743523136;
                                    ">
                                            </circle>
                                            <text class="percentage" x="50%" y="53%"
                                                transform="matrix(0, 1, -1, 0, 80, 0)">
                                                {{ getPercent($roi['totalInvest'], $roi['completed']) }} %
                                            </text>
                                        </svg>
                                        <h4 class="golden-text mt-4 text-center">
                                            @lang('Invest Completed')
                                        </h4>
                                    </div>

                                    <div class="circular-progress cp_3">
                                        <svg class="radial-progress"
                                            data-percentage="{{ 100 - getPercent($roi['expectedProfit'], $roi['returnProfit']) }}"
                                            viewBox="0 0 80 80">
                                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                            <circle class="complete" cx="40" cy="40" r="35"
                                                style="
                                    stroke-dashoffset: 39.58406743523136;
                                    ">
                                            </circle>
                                            <text class="percentage" x="50%" y="53%"
                                                transform="matrix(0, 1, -1, 0, 80, 0)">
                                                {{ 100 - getPercent($roi['expectedProfit'], $roi['returnProfit']) }} %
                                            </text>
                                        </svg>

                                        <h4 class="golden-text mt-4 text-center">
                                            @lang('ROI Speed')
                                        </h4>
                                    </div>

                                    <div class="circular-progress cp_2">
                                        <svg class="radial-progress"
                                            data-percentage="{{ getPercent($roi['expectedProfit'], $roi['returnProfit']) }}"
                                            viewBox="0 0 80 80">
                                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                            <circle class="complete" cx="40" cy="40" r="35"
                                                style="
                                    stroke-dashoffset: 147.3406954533613;
                                    ">
                                            </circle>
                                            <text class="percentage" x="50%" y="53%"
                                                transform="matrix(0, 1, -1, 0, 80, 0)">
                                                {{ getPercent($roi['expectedProfit'], $roi['returnProfit']) }} %
                                            </text>
                                        </svg>

                                        <h4 class="golden-text mt-4 text-center">
                                            @lang('ROI Redeemed')
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

@endsection





@push('script')
    <script src="{{ asset($themeTrue . 'js/apexcharts.js') }}"></script>

    <script>
        "use strict";

        var options = {
            theme: {
                mode: "light",
            },

            series: [{
                    name: "{{ trans('Investment') }}",
                    color: 'rgba(247, 147, 26, 1)',
                    data: {!! $monthly['investment']->flatten() !!}
                },
                {
                    name: "{{ trans('Payout') }}",
                    color: 'rgba(240, 16, 16, 1)',
                    data: {!! $monthly['payout']->flatten() !!}
                },
                {
                    name: "{{ trans('Deposit') }}",
                    color: 'rgba(255, 72, 0, 1)',
                    data: {!! $monthly['funding']->flatten() !!}
                },
                {
                    name: "{{ trans('Deposit Bonus') }}",
                    color: 'rgba(39, 144, 195, 1)',
                    data: {!! $monthly['referralFundBonus']->flatten() !!}
                },
                {
                    name: "{{ trans('Investment Bonus') }}",
                    color: 'rgba(136, 203, 245, 1)',
                    data: {!! $monthly['referralInvestBonus']->flatten() !!}
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
                categories: {!! $monthly['investment']->keys() !!},

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
                        return "{{ trans($basic->currency_symbol) }}" + val + ""
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
                let symbol = "{{ trans($basic->currency_symbol) }}";
                let currency = "{{ trans($basic->currency) }}";
                $('.price-range').text(`@lang('Invest'): ${price}`);

                if (data.fixed_amount == '0') {
                    $('.invest-amount').val('');
                    $('#amount').attr('readonly', false);
                } else {
                    $('.invest-amount').val(data.fixed_amount);
                    $('#amount').attr('readonly', true);
                }

                $('.profit-details').html(
                    `@lang('Interest'): ${(data.profit_type == '1') ? `${data.profit} %` : `${data.profit} ${currency}`}`
                    );
                $('.profit-validity').html(
                    `@lang('Per') ${data.schedule} @lang('hours') ,  ${(data.is_lifetime == '0') ? `${data.repeatable} @lang('times')` : `@lang('Lifetime')`}`
                    );
                $('.plan-name').text(data.name);
                $('.plan-id').val(data.id);
                $('.show-currency').text("{{ config('basic.currency') }}");
            });
        })(jQuery);
    </script>
@endpush
