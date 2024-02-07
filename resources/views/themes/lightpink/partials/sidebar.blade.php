
<div id="sidebar" class="">
    <div class="sidebar-top">
        <a class="navbar-brand" href="{{route('home')}}">
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
    @php
        $user = \Illuminate\Support\Facades\Auth::user();
        $user_rankings = \App\Models\Ranking::where('rank_lavel', $user->last_lavel)->first();
    @endphp

    @if($user->last_lavel != null && $user_rankings)
        <div class="level-box">
            <h4>@lang(@$user->rank->rank_lavel)</h4>
            <p>@lang(@$user->rank->rank_name)</p>
            <img src="{{ getFile(config('location.rank.path').@$user->rank->rank_icon) }}" alt="" class="level-badge"/>
        </div>
    @endif


    <ul class="main tabScroll">
        <li>
            <a class="{{menuActive('user.home')}}" href="{{route('user.home')}}"
            > <i class="fal fa-border-all"></i> @lang('Dashboard')</a
            >
        </li>
        <li>
            <a href="{{route('plan')}}" class="sidebar-link {{menuActive(['plan'])}}">
                <i class="fal fa-layer-group"></i> @lang('Plan')
            </a>
        </li>


        <li>
            <a href="{{route('user.profile')}}" class="sidebar-link {{menuActive(['user.profile'])}}">
                <i class="fal fa-user"></i> @lang('profile settings')
            </a>
        </li>
        <li>
            <a href="{{route('user.ticket.list')}}" class="sidebar-link {{menuActive(['user.ticket.list', 'user.ticket.create', 'user.ticket.view'])}}">
                <i class="fal fa-user-headset"></i> @lang('support ticket')
            </a>
        </li>

        <li>
            <a href="{{route('user.ticket.list')}}" class="sidebar-link {{menuActive(['user.ticket.list', 'user.ticket.create', 'user.ticket.view'])}}">
                <i class="fal fa-user-headset"></i> @lang('support ticket')
            </a>
        </li>
    </ul>
</div>
