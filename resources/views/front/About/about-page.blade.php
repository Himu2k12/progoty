@extends('front.master')

@section('title')
    About Us
    @endsection


@section('content')

    <div class="home-page-welcome">
        <div class="container">
            <div class="row">
                @if(isset($about))
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="welcome-content">
                        <header class="entry-header">
                            <h2 class="entry-title">@lang('home.welcome_title')</h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content mt-5">

                                @if (App::isLocale('en'))
                                    <p style="color: white">{{$about->about_content}}</p>
                                @else
                                    <p style="color: white">{{$about->about_content_bangla}}</p>
                                @endif

                        </div><!-- .entry-content -->

                    </div><!-- .welcome-content -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 mt-4 order-1 order-lg-2">
                    <img src="{{asset($about->about_image)}}" alt="About Image">
                </div><!-- .col -->
                @endif
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->


    <div class="about-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="testimonial-cont">
                        <div class="entry-content">
                            <p>@lang('about.title') </p>
                        </div>

                        <div class="entry-footer d-flex flex-wrap align-items-center mt-5">
                           <img src="{{asset("asset/images/olive.png")}}" alt="">
                            <h4>@lang('about.director_name'), <span>@lang('about.position')</span></h4>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 offset-lg-2 col-lg-5">
                    <div class="testimonial-cont">
                        <div class="entry-content">
                            <p>@lang('about.dialogue') </p>
                        </div>

                        <div class="entry-footer d-flex flex-wrap align-items-center mt-5">
                            <img src="{{asset("asset/images/olive.png")}}" alt="">

                            <h4>@lang('about.director_name'), <span>@lang('about.position')</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="help-us">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                    <h2>@lang('about.help')</h2>

                </div>
            </div>
        </div>
    </div>





@endsection
