<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->

<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    @include('partials.seo')

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/bootstrap.min.css')}}" />

    @stack('css-lib')

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/aos.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/radialprogress.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/style_dashboard.css')}}">

    <script src="{{asset($themeTrue.'js/modernizr.custom.js')}}"></script>

    @stack('style')
    <script type="application/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="application/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>

<body  @if(session()->get('rtl') == 1) class="rtl" @endif onload="preloder_function()" class="">

    <!-- preloader_area_start -->
    {{-- <div id="preloader">
    </div> --}}
    <!-- preloader_area_end -->

    <div class="dashboard-wrapper">

        <!-- content -->
        <div id="content">
            <div class="overlay">
                <!-- navbar -->
                <nav class="navbar navbar-expand-lg position-relative ">

                    <div class="d-flex flex-wrap justify-content-between text-white w-100">
                        <a class="navbar-brand" href="{{url('/')}}"> {{config('basic.site_title')}}</a>
                        <div class="wallet-wrapper">
                            <div class="wallet-box d-none d-lg-block ">
                                <h5>{{ $basic->currency_symbol }} @lang('Account Assest') <span>{{ @$user->balance }}</span></h5>

                                <h3 class="mb-0"><span>{{round((@$user?->interest_balance > 0 ? @$user?->interest_balance : '0.00'),2) }}</span><small style="font-size: 20px" class="ml-3 tag">{{ $basic->currency }}</small></h3>

                            </div>
                        </div>

                        <div class="top">
                            <a class="" href="{{route('home')}}">
                                <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}"
                                     alt="{{config('basic.site_title')}}">
                            </a>
                            <button
                                class="sidebar-toggler d-md-none"
                                onclick="toggleSideMenu()"
                            >
                                <i class="fal fa-times"></i>
                            </button>
                        </div>

                        <span class="navbar-text">
                        <!-- notification panel -->
                        @include($theme.'partials.pushNotify')
                         <!-- user panel -->
                     </span>
                    </div>

                    <div class=" header-bottom ">
<div class="d-flex flex-wrap justify-content-center text-center align-items-center">
    <div>
        <a href="{{route('user.addFund')}}">
            <span><i class="fas fa-dollar-sign"></i></span>
            <br>
            <span> Deposit </span></a>

    </div>
    <div>
        <a href="{{ route('user.payout.money') }}">
        <span><i class="fas fa-sync"></i></span>
        <br>
        <span> Withdraw </span>
    </a>
    </div>
    <div>
        <a href="{{ route('faq') }}">
        <span><i class="fas fa-file"></i></span>
        <br>
        <span> License </span>
    </a>
    </div>
    <div>
        <span><i class="fas fa-mobile"></i></span>
        <br>
        <span> App </span>
    </div>
    <div>
        <a href="{{ route('user.ticket.list') }}">
        <span><i class="fas fa-user"></i></span>
        <br>
        <span> Customer service </span>
        </a>
    </div>
</div>
                    </div>
                </nav>

                <div class="content-title text-center">
<h4>Staking list</h4>
<h6>Welcome to the Solunapower Platform ({{config('basic.site_title')}}).</h6>
                </div>
                @include($theme.'partials.marquee')

                @yield('content')
            </div>
        </div>

                <!------ sidebar ------->
                @include($theme.'partials.sidebar')

    </div>

    <!-- arrow up -->
    <a href="#" class="scroll-up"><i class="fal fa-long-arrow-up"></i> </a>

@stack('loadModal')

<script src="{{asset($themeTrue.'js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/jquery-ui.js')}}"></script>
<script src="{{asset($themeTrue.'js/aos.js')}}"></script>
<script src="{{asset($themeTrue.'js/radialprogress.js')}}"></script>
<script src="{{asset($themeTrue.'js/select2.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/fontawesomepro.js')}}"></script>

@stack('extra-js')

<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
<script src="{{asset('assets/global/js/pusher.min.js')}}"></script>
<script src="{{asset('assets/global/js/vue.min.js')}}"></script>
<script src="{{asset('assets/global/js/axios.min.js')}}"></script>
<!-- custom script -->
<script src="{{asset($themeTrue.'js/dashboard.js')}}"></script>


<script>
    'use strict';
    let pushNotificationArea = new Vue({
        el: "#pushNotificationArea",
        data: {
            items: [],
        },
        mounted() {
            this.getNotifications();
            this.pushNewItem();
        },
        methods: {
            getNotifications() {
                let app = this;
                axios.get("{{ route('user.push.notification.show') }}")
                    .then(function (res) {
                        app.items = res.data;
                    })
            },
            readAt(id, link) {
                let app = this;
                let url = "{{ route('user.push.notification.readAt', 0) }}";
                url = url.replace(/.$/, id);
                axios.get(url)
                    .then(function (res) {
                        if (res.status) {
                            app.getNotifications();
                            if (link != '#') {
                                window.location.href = link
                            }
                        }
                    })
            },
            readAll() {
                let app = this;
                let url = "{{ route('user.push.notification.readAll') }}";
                axios.get(url)
                    .then(function (res) {
                        if (res.status) {
                            app.items = [];
                        }
                    })
            },
            pushNewItem() {
                let app = this;
                // Pusher.logToConsole = true;
                let pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                    encrypted: true,
                    cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
                });
                let channel = pusher.subscribe('user-notification.' + "{{ Auth::id() }}");
                channel.bind('App\\Events\\UserNotification', function (data) {
                    app.items.unshift(data.message);
                });
                channel.bind('App\\Events\\UpdateUserNotification', function (data) {
                    app.getNotifications();
                });
            }
        }
    });
</script>

@stack('script')


@if (session()->has('success'))
    <script>
        Notiflix.Notify.Success("@lang(session('success'))");
    </script>
@endif

@if (session()->has('error'))
    <script>
        Notiflix.Notify.Failure("@lang(session('error'))");
    </script>
@endif

@if (session()->has('warning'))
    <script>
        Notiflix.Notify.Warning("@lang(session('warning'))");
    </script>
@endif


@include('plugins')
    <script>
        var root = document.querySelector(':root');
        root.style.setProperty('--primary', '{{config('basic.base_color')??'#ff007a'}}');
    </script>

</body>
</html>
