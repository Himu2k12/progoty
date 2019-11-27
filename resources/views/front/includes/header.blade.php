<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <title>@yield('title')</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('asset/')}}/css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{asset('asset/')}}/css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="{{asset('asset/')}}/css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="{{asset('asset/')}}/css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{asset('asset/')}}/css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('asset/')}}/style.css">
    <link rel="stylesheet" href="{{asset('sty/')}}/css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<header class="site-header">
    <div class="top-header-bar">
        <div class="container">
            <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                    <div class="header-bar-email">
                        @lang('navbar.mail'): <a href="#">bdpssl@gmail.com</a>
                    </div><!-- .header-bar-email -->

                    <div class="header-bar-text">
                        <p>@lang('navbar.top_phone'): <span>+8801718910757 / +8801724674461</span></p>
                    </div><!-- .header-bar-text -->
                </div><!-- .col -->

                <div class="col-12 col-lg-4 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                    <div class="donate-btn">
                        <a href="locale/bn" style="background-color: #FF4800; border: 1px solid white; border-radius: 10px; padding: 10px 20px; text-decoration: none"><span><img src="{{asset('asset/')}}/images/bd.png" width="20px" height="20px"> </span>@lang('navbar.bangla')</a>
                        <a href="locale/en" style="background-color: #FF4800; border: 1px solid white; border-radius: 10px; padding: 10px 20px; text-decoration: none"><span><img src="{{asset('asset/')}}/images/uk.png" width="20px" height="15px"> </span>@lang('navbar.english')</a>
                    </div><!-- .donate-btn -->



                </div><!-- .col -->

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .top-header-bar -->
