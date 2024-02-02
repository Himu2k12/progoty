@extends('front.master')

@section('title')
    Home
    @endsection

@section('addStyle')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <style>
        .bs-slider{
            overflow: hidden;
            max-height: 650px;
            position: relative;
            background: #000000;
        }
        .bs-slider:hover {
            cursor: -moz-grab;
            cursor: -webkit-grab;
        }
        .bs-slider:active {
            cursor: -moz-grabbing;
            cursor: -webkit-grabbing;
        }
        .bs-slider .bs-slider-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.0);
        }
        .bs-slider > .carousel-inner > .item > img,
        .bs-slider > .carousel-inner > .item > a > img {
            margin: auto;
            width: 100% !important;
        }

        /********************
        *****Slide effect
        **********************/

        .fade {
            opacity: 1;
        }
        .fade .item {
            top: 0;
            z-index: 1;
            opacity: 0;
            width: 100%;
            position: absolute;
            left: 0 !important;
            display: block !important;
            -webkit-transition: opacity ease-in-out 1s;
            -moz-transition: opacity ease-in-out 1s;
            -ms-transition: opacity ease-in-out 1s;
            -o-transition: opacity ease-in-out 1s;
            transition: opacity ease-in-out 1s;
        }
        .fade .item:first-child {
            top: auto;
            position: relative;
        }
        .fade .item.active {
            opacity: 1;
            z-index: 2;
            -webkit-transition: opacity ease-in-out 1s;
            -moz-transition: opacity ease-in-out 1s;
            -ms-transition: opacity ease-in-out 1s;
            -o-transition: opacity ease-in-out 1s;
            transition: opacity ease-in-out 1s;
        }






        /*---------- LEFT/RIGHT ROUND CONTROL ----------*/
        .control-round .carousel-control {
            top: 47%;
            opacity: 0;
            width: 45px;
            height: 45px;
            z-index: 100;
            color: #ffffff;
            display: block;
            font-size: 24px;
            cursor: pointer;
            overflow: hidden;
            line-height: 43px;
            text-shadow: none;
            position: absolute;
            font-weight: normal;
            background: transparent;
            -webkit-border-radius: 100px;
            border-radius: 100px;
        }
        .control-round:hover .carousel-control{
            opacity: 1;
        }
        .control-round .carousel-control.left {
            left: 1%;
        }
        .control-round .carousel-control.right {
            right: 1%;
        }
        .control-round .carousel-control.left:hover,
        .control-round .carousel-control.right:hover{
            color: #fdfdfd;
            background: rgba(0, 0, 0, 0.5);
            border: 0px transparent;
        }
        .control-round .carousel-control.left>span:nth-child(1){
            left: 45%;
        }
        .control-round .carousel-control.right>span:nth-child(1){
            right: 45%;
        }





        /*---------- INDICATORS CONTROL ----------*/
        .indicators-line > .carousel-indicators{
            right: 45%;
            bottom: 3%;
            left: auto;
            width: 90%;
            height: 20px;
            font-size: 0;
            overflow-x: auto;
            text-align: right;
            overflow-y: hidden;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 1px;
            white-space: nowrap;
        }
        .indicators-line > .carousel-indicators li{
            padding: 0;
            width: 15px;
            height: 15px;
            border: 1px solid rgb(158, 158, 158);
            text-indent: 0;
            overflow: hidden;
            text-align: left;
            position: relative;
            letter-spacing: 1px;
            background: rgb(158, 158, 158);
            -webkit-font-smoothing: antialiased;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            margin-right: 5px;
            -webkit-transition: all 0.5s cubic-bezier(0.22,0.81,0.01,0.99);
            transition: all 0.5s cubic-bezier(0.22,0.81,0.01,0.99);
            z-index: 10;
            cursor:pointer;
        }
        .indicators-line > .carousel-indicators li:last-child{
            margin-right: 0;
        }
        .indicators-line > .carousel-indicators .active{
            margin: 1px 5px 1px 1px;
            box-shadow: 0 0 0 2px #fff;
            background-color: transparent;
            position: relative;
            -webkit-transition: box-shadow 0.3s ease;
            -moz-transition: box-shadow 0.3s ease;
            -o-transition: box-shadow 0.3s ease;
            transition: box-shadow 0.3s ease;
            -webkit-transition: background-color 0.3s ease;
            -moz-transition: background-color 0.3s ease;
            -o-transition: background-color 0.3s ease;
            transition: background-color 0.3s ease;

        }
        .indicators-line > .carousel-indicators .active:before{
            transform: scale(0.5);
            background-color: #fff;
            content:"";
            position: absolute;
            left:-1px;
            top:-1px;
            width:15px;
            height: 15px;
            border-radius: 50%;
            -webkit-transition: background-color 0.3s ease;
            -moz-transition: background-color 0.3s ease;
            -o-transition: background-color 0.3s ease;
            transition: background-color 0.3s ease;
        }



        /*---------- SLIDE CAPTION ----------*/
        .slide_style_left {
            text-align: left !important;
        }
        .slide_style_right {
            text-align: right !important;
        }
        .slide_style_center {
            text-align: center !important;
        }

        .slide-text {
            left: 0;
            top: 25%;
            right: 0;
            margin: auto;
            padding: 10px;
            position: absolute;
            text-align: left;
            padding: 10px 85px;

        }

        .slide-text > h1 {

            padding: 0;
            color: #ffffff;
            font-size: 70px;
            font-style: normal;
            line-height: 84px;
            margin-bottom: 30px;
            letter-spacing: 1px;
            display: inline-block;
            -webkit-animation-delay: 0.7s;
            animation-delay: 0.7s;
        }
        .slide-text > p {
            padding: 0;
            color: #ffffff;
            font-size: 20px;
            line-height: 24px;
            font-weight: 300;
            margin-bottom: 40px;
            letter-spacing: 1px;
            animation-delay: 1.1s;
            animation-delay: 1.1s;
        }
        .slide-text > a.btn-default{
            color: #000;
            font-weight: 400;
            font-size: 13px;
            line-height: 15px;
            margin-right: 10px;
            text-align: center;
            padding: 17px 30px;
            white-space: nowrap;
            letter-spacing: 1px;
            display: inline-block;
            border: none;
            text-transform: uppercase;
            -webkit-animation-delay: 2s;
            animation-delay: 2s;
            -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
            transition: background 0.3s ease-in-out, color 0.3s ease-in-out;

        }
        .slide-text > a.btn-primary{
            color: #ffffff;
            cursor: pointer;
            font-weight: 400;
            font-size: 13px;
            line-height: 15px;
            margin-left: 10px;
            text-align: center;
            padding: 17px 30px;
            white-space: nowrap;
            letter-spacing: 1px;
            background: #00bfff;
            display: inline-block;
            text-decoration: none;
            text-transform: uppercase;
            border: none;
            -webkit-animation-delay: 2s;
            animation-delay: 2s;
            -webkit-transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
            transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
        }
        .slide-text > a:hover,
        .slide-text > a:active {
            color: #ffffff;
            background: #222222;
            -webkit-transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
            transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
        }






        /*------------------------------------------------------*/
        /* RESPONSIVE
        /*------------------------------------------------------*/

        @media (max-width: 991px) {
            .slide-text h1 {
                font-size: 20px;
                line-height: 50px;
                margin-bottom: 20px;
            }
            .slide-text > p {

                font-size: 18px;
            }
        }


        /*---------- MEDIA 480px ----------*/
        @media  (max-width: 768px) {
            .slide-text {
                padding: 10px 50px;
            }
            .slide-text h1 {
                font-size: 20px;
                line-height: 40px;
                margin-bottom: 10px;
            }
            .slide-text > p {
                font-size: 14px;
                line-height: 20px;
                margin-bottom: 20px;
            }
            .control-round .carousel-control{
                display: none;
            }

        }
        @media  (max-width: 480px) {
            .slide-text {
                padding: 10px 30px;
            }
            .slide-text h1 {
                font-size: 20px;
                line-height: 25px;
                margin-bottom: 5px;
            }
            .slide-text bounce {
                animation-delay:2s;
            }
            .slide-text zoomOutLeft {
                animation-delay:1s;
            }
            .slide-text > p {
                font-size: 12px;
                line-height: 18px;
                margin-bottom: 10px;
            }
            .slide-text > a.btn-default,
            .slide-text > a.btn-primary {
                font-size: 10px;
                line-height: 10px;
                margin-right: 10px;
                text-align: center;
                padding: 10px 15px;
            }
            .indicators-line > .carousel-indicators{
                display: none;
            }



        }
        .bounce{
            animation-duration:5s;
            animation-iteration-count:3;
        }
        .pt{
            padding-left:50px;
            height:30px;
        }
        .divblog,pr{
            box-shadow: 0 1px 2px rgba(0,0,0,0.15);

        }
        .divblog:hover{

            box-shadow:4px 4px 20px 4px #D8D8D8;
        }
        .pr:hover{
            box-shadow:4px 4px 40px 4px #D8D8D8;
        }
        .pr{
            min-height:400px;
        }
        .pc{
            font-size:13px;
            height:40px;
            border-radius:0px;
            background-color:black;
            color:white;
            line-height:20px;
            width:70%;
            text-align:center;
        }
        .pc:hover{
            box-shadow:4px 4px 30px 4px #D8D8D8;
        }
        .tweet{
            background-image: url('http://www.crafthousebrews.com/wp-content/uploads/2015/02/wide_brick_tile_dark_6.jpg');
            min-height:400px;
            max-width:100%;
            color:white;
            text-align:center;
        }
        .slidetweet{
            margin:0 auto;
            width:50%;
        }
        .it{
            padding-top:40px;
        }
        .form-control{
            border-left:0px;
            border-right:0px;
            border-top:0px;
            border-radius:0px;
        }
        .mail:hover{
            box-shadow:4px 4px 40px 4px #D8D8D8;
        }






        .contain {
            position:relative;
            overflow:hidden;
            border:1px solid blue;

        }
        .contain .textbox {
            width:100%;
            height:370px;
            position:absolute;
            bottom:0;
            left:0;
            margin-bottom:-280px;

            background-color:white;

            -webkit-box-shadow: inset 0px 0px 5px 2px rgba(255,255,255,.75);
            box-shadow: inset 0px 0px 5px 2px rgba(255,255,255,.75);
        }
        .contain:hover .textbox {
            margin-bottom:0;
        }
        .text {
            padding-top: 20px;

        }
        .textbox {
            -webkit-transition: all 0.7s ease;
            transition: all 0.7s ease;
        }

        .teamlink:hover{
            background-color:#F0F0F0;
            border-radius:50%;
            height:40px;
            width:40px;
            padding-top:10px;
            text-align:center;
            margin-right:6px;
        }
    </style>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    @endsection

@section('content')
    <div id="bootstrap-touch-slider" class="carousel bs-slider slide  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >


        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
            <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
            <li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper For Slides -->
        <div class="carousel-inner" role="listbox">

            <!-- first Slide -->
            <div class="item active">

                <!-- Slide Background -->
                <img src="{{asset('websiteImages/bg-1.jpg')}}" alt="Bootstrap Touch Slider"  class="slide-image"/>
                <div class="bs-slider-overlay"></div>

                <div class="container">
                    <div class="row">
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                            <h2 style="color:#ff4800"  class="bounce animated"><B>@lang('home.progoty_name')</B></h2>
                            <p class="fadeInLeft animated">@lang('home.progoty_dialogue')</p>
                            <a href="{{url('/about')}}" target="_blank" class="btn btn-default fadeInLeft animated">About Us</a>
                            <a href="{{url('/contact')}}" target="_blank"  class="btn btn-primary fadeInRight animated" >Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Slide -->

            <!-- Second Slide -->
             @if(isset($slider))
            @foreach($slider as $item)
            <div class="item">
                <!-- Slide Background -->
                <img src="{{asset($item->slide_name)}}" alt="Bootstrap Touch Slider"  class="slide-image"/>
                <div class="bs-slider-overlay"></div>
                <div class="container">
                    <div class="row">
                        <!-- Slide Text Layer -->
                        <div class="slide-text slide_style_left">
                            <h2 style="color:#ff4800; "  class="bounce animated">@lang('home.progoty_name')</h2>
                            <p class="fadeInLeft animated">@lang('home.progoty_dialogue')</p>
                            <a href="{{url('/about')}}" target="_blank" class="btn btn-default fadeInLeft animated">About Us</a>
                            <a href="{{url('/contact')}}" target="_blank"  class="btn btn-primary fadeInRight animated" >Contact Us</a>
                        </div>
                    </div>
                </div>
                <!-- Slide Text Layer -->
            </div>
            @endforeach
            @endif
            <!-- End of Slide -->

        </div><!-- End of Wrapper For Slides -->

        <!-- Left Control -->
        <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <!-- Right Control -->
        <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
    <div class="home-page-icon-boxes">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box active">
                        <figure class="d-flex justify-content-center">
                            <img src="{{asset('asset/')}}/images/hands-gray.png" alt="">
                            <img src="{{asset('asset/')}}/images/hands-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">@lang('home.member_invitation')</h3>
                        </header>

                        <div class="entry-content">
                            <p>@lang('home.memberInvitation')</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="{{asset('asset/')}}/images/donation-gray.png" alt="">
                            <img src="{{asset('asset/')}}/images/donation-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">@lang('home.loan')</h3>
                        </header>

                        <div class="entry-content">
                            <p>@lang('home.loanContent') </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="{{asset('asset/')}}/images/charity-gray.png" alt="">
                            <img src="{{asset('asset/')}}/images/charity-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">@lang('home.savings')</h3>
                        </header>

                        <div class="entry-content">
                            <p>@lang('home.savingsDetails') </p>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->
    @if( isset($about))
    <div class="home-page-welcome">
        <div class="container">
            <div class="row">
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

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->
    @endif

    @if(isset($LatestEvents))
        <div id="Events" class="home-page-events">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="upcoming-events">
                        <div class="section-heading">
                            <h2 class="entry-title">@lang('footer.upcoming_events')</h2>
                        </div><!-- .section-heading -->
                    @foreach($events as $event)
                        <div class="event-wrap d-flex flex-wrap justify-content-between">
                            <figure class="m-0">
                                <img src="{{asset($event->event_picture)}}" alt="">
                            </figure>

                            <div class="event-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a href="#">{{$event->heading}}</a></h3>

                                    <div class="posted-date">
                                        <a href="#">{{$event->date}} </a>
                                    </div><!-- .posted-date -->

                                    <div class="cats-links">
                                        <a href="#">{{$event->location}}</a>
                                    </div><!-- .cats-links -->
                                </header><!-- .entry-header -->

                                <div class="entry-content" style="overflow:hidden;max-height:58px">
                                    <p style="text-align:justify" class="m-0">{{$event->description}}</p>
                                </div><!-- .entry-content -->
                                <div class="entry-footer">
                                    <a href="{{url('/events')}}">Read More</a>
                                </div>
                            </div><!-- .event-content-wrap -->
                        </div><!-- .event-wrap -->
                    @endforeach
                    </div><!-- .upcoming-events -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6">
                    <div class="featured-cause">
                        <div class="section-heading">
                            <h2 class="entry-title">@lang('home.latest_event')</h2>
                        </div><!-- .section-heading -->

                        <div class="cause-wrap d-flex flex-wrap justify-content-between">
                            <figure class="m-0">
                                <img src="{{asset($LatestEvents->event_picture)}}" alt="pic"/>
                            </figure>

                            <div class="cause-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a href="#">{{$LatestEvents->heading}}</a></h3>

                                    <div class="posted-date">
                                        <a href="#">{{$LatestEvents->date}} </a>
                                    </div><!-- .posted-date -->

                                    <div class="cats-links">
                                        <a href="#">{{$LatestEvents->location}}</a>
                                    </div><!-- .cats-links -->
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p class="m-0">{{$LatestEvents->description}}</p>
                                </div><!-- .entry-content -->

                            </div><!-- .cause-content-wrap -->

                        </div><!-- .cause-wrap -->
                    </div><!-- .featured-cause -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-events -->
    @endif
    <div id="OurTeam" class="our-causes">
        <div class="container">
            <div class="row">
                <div class="coL-12">
                    <div class="section-heading">
                        <h2 class="entry-title">@lang('home.our_team')</h2>
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->
            <div class="row">
                <div class="col-12">
                    <div class="swiper-container causes-slider">
                        <div class="swiper-wrapper">
                            @foreach($teamMembers as $item)
                                <div class="swiper-slide">
                                    <div class="cause-wrap" style="width: 95%;padding-left:30px; margin-right: 0px;">
                                        <figure class="m-0">
                                            <img src="{{asset($item->staff_photo)}}" height="297px" width="297px" alt="">

                                            <div class="figure-overlay d-flex justify-content-center align-items-center position-absolute w-100 h-100">
                                                <a href="#" class="btn gradient-bg mr-2">Contact Now</a>
                                            </div><!-- .figure-overlay -->
                                        </figure>

                                        <div class="cause-content-wrap">
                                            <header class="entry-header d-flex flex-wrap align-items-center">
                                                <h3 class="entry-title w-100 m-0"><a href="#">{{$item->name}}</a></h3>
                                            </header><!-- .entry-header -->

                                            <div class="entry-content">
                                                Blood Group: {{$item->blood_group}}
                                            </div><!-- .entry-content -->
                                            <div class="fund-raised-goal mt-4">
                                                POST: <b>@if($item->role=='Admin'){{'Executive Director'}} @else {{$item->role}} @endif</b>
                                            </div><!-- .fund-raised-goal -->

                                        </div><!-- .cause-content-wrap -->
                                    </div><!-- .cause-wrap -->
                                </div><!-- .swiper-slide -->
                            @endforeach
                        </div><!-- .swiper-wrapper -->
                    </div><!-- .swiper-container -->
                    <!-- Add Arrows -->
                    <div class="swiper-button-next flex justify-content-center align-items-center">
                        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg></span>
                    </div>

                    <div class="swiper-button-prev flex justify-content-center align-items-center">
                        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg></span>
                    </div>
                    <!-- Add Arrows -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .our-causes -->

    <div class="home-page-limestone">
        <div class="container">
            <div class="row align-items-end">
                <div class="coL-12 col-lg-6">
                    <div class="section-heading">
                        <h2 class="entry-title">@lang('home.message')</h2>

                        <p class="mt-5">@lang('about.dialogue')</p>
                    </div><!-- .section-heading -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6">
                    <div class="milestones d-flex flex-wrap justify-content-between">
                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{asset('asset/')}}/images/teamwork.png" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="{{$numberOfsavings}}" data-speed="2000"></div>
                                </div>

                                <h3 class="entry-title">@lang('home.savings_number')</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->

                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{asset('asset/')}}/images/donation.png" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="{{$numberOfLoans}}" data-speed="2000"></div>
                                </div>

                                <h3 class="entry-title">@lang('home.loan_number')</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->

                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{asset('asset/')}}/images/dove.png" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="{{$numberOfusers}}" data-speed="2000"></div>
                                </div>

                                <h3 class="entry-title">@lang('home.volunteer')</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->
                    </div><!-- .milestones -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .our-causes -->

@endsection
