
<div class="nav-bar">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                <div class="site-branding d-flex align-items-center">
                   <img style="margin-top: 20px; margin-right: 10px" src="{{asset('asset/')}}/images/logo_menu.jpg" width="40px" > <a class="d-block" href="{{url('/')}}" style="text-decoration: none" rel="home"><h2>@lang('navbar.progoty')</h2></a>
                </div><!-- .site-branding -->

                <nav class="site-navigation d-flex justify-content-end align-items-center">
                    <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                        <li class="{{ (request()->is('/')) ? 'current-menu-item' : '' }}"><a href="{{url('/')}}">@lang('navbar.home_menu')</a></li>
                        <li class="{{ (request()->is('about')) ? 'current-menu-item' : '' }}"><a href="{{url('/about')}}" >@lang('navbar.about_menu')</a></li>
                        <li class="{{ (request()->is('policy')) ? 'current-menu-item' : '' }}"><a href="{{url('/policy')}}">@lang('navbar.policy')</a></li>
                        <li class="{{ (request()->is('events')) ? 'current-menu-item' : '' }}"><a href="{{url('/events')}}">@lang('navbar.event')</a></li>
                        @can('isSuper')
                            <li><a href="{{url('/admin-dashboard')}}">@lang('navbar.dashboard')</a></li>
                            @endcan
                        @can('isFieldMan')
                        <li class="{{ (request()->is('new-member-form')) ? 'current-menu-item' : '' }}"><a href="{{url('/new-member-form')}}">@lang('navbar.new_member')</a></li>
                        <li class="{{ (request()->is('new-loan-form')) ? 'current-menu-item' : '' }}"><a href="{{url('/new-loan-form')}}">@lang('navbar.new_loan')</a></li>
                        <li class="{{ (request()->is('savings-form')) ? 'current-menu-item' : '' }}"><a href="{{url('/savings-form')}}">@lang('navbar.collection')</a></li>
                        @endcan
                        @can('isCashier')
                         <li class="{{ (request()->is('Cash-Panel')) ? 'current-menu-item' : '' }}"><a href="{{url('/Cash-Panel')}}">@lang('navbar.collection')</a></li>

                        @endcan
                        @can('isSupervisor')
                        <li class="{{ (request()->is('new-member-requests')) ? 'current-menu-item' : '' }}"><a href="{{url('/new-member-requests')}}">@lang('navbar.panel')</a></li>
                        @endcan
                        @can('isIT')
                        <li class="{{ (request()->is('slider-input')) ? 'current-menu-item' : '' }}"><a href="{{url('/slider-input')}}">@lang('navbar.panel')</a></li>
                        @endcan
                        <li class="{{ (request()->is('contact')) ? 'current-menu-item' : '' }}"><a href="{{url('/contact')}}">@lang('navbar.contact_us')</a></li>
                        @if(isset(Auth::user()->name))
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{Auth::user()->name}}-Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </li>
                        @else
                            <li><a href="{{url('/login')}}"><i class="fa fa-sign-in"></i> @lang('navbar.login')</a></li>
                        @endif
                    </ul>
                </nav><!-- .site-navigation -->

                <div class="hamburger-menu d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div><!-- .hamburger-menu -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .nav-bar -->
</header><!-- .site-header -->
