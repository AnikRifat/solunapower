@if(isset($templates['investment'][0]) && $investment = $templates['investment'][0])
    <section class="plan_area shape3">
        <div class="container-fluid">
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
    </section>

    <!-- Plan_modal_start -->
    <div class="plan_modal">
        <!-- Modal -->
        <div class="modal fade" id="investNowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow1">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">@lang('Invest Now')</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img
                                src="{{ asset($themeTrue.'img/modal/cancel.png') }}" alt="@lang('not found')"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal_title plan-name"></div>
                        <p class="modal_text price-range"></p>
                        <p class="modal_text profit-details"></p>
                        <p class="modal_text profit-validity"></p>
                        <form class="text-start mt-20 login-form" id="invest-form"
                              action="{{route('user.purchase-plan')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <h6 for="select" class="form-label">@lang('Select wallet')</h6>
                                <select class="form-select" aria-label="Default select example" name="balance_type">
                                    @auth
                                        <option
                                            value="balance">@lang('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance))</option>
                                        <option
                                            value="interest_balance">@lang('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance))</option>
                                    @endauth
                                    <option value="checkout">@lang('Checkout')</option>
                                </select>
                            </div>
                            <h6 for="select" class="form-label">@lang('Amount')</h6>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control invest-amount" name="amount" id="amount"
                                       value="{{old('amount')}}"
                                       onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                       autocomplete="off"
                                       placeholder="@lang('Enter amount')">
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
@endif
<!-- plan_area_end -->

@push('script')
    <script>
        "use strict";
        (function ($) {
            $(document).on('click', '.investNow', function () {
                var planModal = new bootstrap.Modal(document.getElementById('investNowModal'))
                planModal.show()
                let data = $(this).data('resource');
                let price = $(this).data('price');
                let symbol = "{{trans($basic->currency_symbol)}}";
                let currency = "{{trans($basic->currency)}}";
                $('.price-range').text(`@lang('Invest'): ${price}`);

                if (data.fixed_amount == '0') {
                    $('.invest-amount').val('');
                    $('#amount').attr('readonly', false);
                } else {
                    $('.invest-amount').val(data.fixed_amount);
                    $('#amount').attr('readonly', true);
                }

                $('.profit-details').html(`@lang('Interest'): ${(data.profit_type == '1') ? `${data.profit} %` : `${data.profit} ${currency}`}`);
                $('.profit-validity').html(`@lang('Per') ${data.schedule} @lang('hours') ,  ${(data.is_lifetime == '0') ? `${data.repeatable} @lang('times')` : `@lang('Lifetime')`}`);
                $('.plan-name').text(data.name);
                $('.plan-id').val(data.id);
                $('.show-currency').text("{{config('basic.currency')}}");
            });
        })(jQuery);
    </script>
@endpush
