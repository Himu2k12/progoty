@extends('front.master')

@section('title')
    About Us
@endsection


@section('content')

    <div class="welcome-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="welcome-content">
                        <header class="entry-header">
                            <h2 class="entry-title" style="color: black">@lang('policy.top_header')</h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content mt-5">
                            <p><i class="fa fa-star"></i> @lang('policy.policy_one')</p>
                            <p><i class="fa fa-star"></i> @lang('policy.policy_two')</p>
                            <p><i class="fa fa-star"></i> @lang('policy.policy_three')</p>
                            <p><i class="fa fa-star"></i> @lang('policy.policy_four')</p>
                        </div><!-- .entry-content -->
                    </div><!-- .welcome-content -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <img src="{{asset('asset/')}}/images/sonchoy.jpg" width="100%" alt="welcome">
                </div><!-- .col -->
            </div>
            <!-- .row -->
        <div class="row" style="padding-top: 30px">
            <table class="table table-striped">
                <tr>
                    <th>@lang('policy.table_head_one')</th>
                    <th>@lang('policy.table_head_two')</th>
                    <th>@lang('policy.table_head_three')</th>
                    <th>@lang('policy.table_head_four')</th>
                    <th>@lang('policy.table_head_five')</th>
                </tr>
                <tr>
                    <td>@lang('policy.table_body_des_one')</td>
                    <td>@lang('policy.table_body_rd_one')</td>
                    <td>@lang('policy.table_body_int_one')</td>
                    <td>@lang('policy.table_body_bonus_one')</td>
                    <td>@lang('policy.table_body_total_one')</td>

                </tr>
                <tr>

                    <td>@lang('policy.table_body_des_two')</td>
                    <td>@lang('policy.table_body_rd_two')</td>
                    <td>@lang('policy.table_body_int_two')</td>
                    <td>@lang('policy.table_body_bonus_two')</td>
                    <td>@lang('policy.table_body_total_two')</td>

                </tr>
                <tr>

                    <td>@lang('policy.table_body_des_three')</td>
                    <td>@lang('policy.table_body_rd_three')</td>
                    <td>@lang('policy.table_body_int_three')</td>
                    <td>@lang('policy.table_body_bonus_three')</td>
                    <td>@lang('policy.table_body_total_three')</td>

                </tr>
                <tr>

                    <td>@lang('policy.table_body_des_four')</td>
                    <td>@lang('policy.table_body_rd_four')</td>
                    <td>@lang('policy.table_body_int_four')</td>
                    <td>@lang('policy.table_body_bonus_four')</td>
                    <td>@lang('policy.table_body_total_four')</td>

                </tr>
                <tr>

                    <td>@lang('policy.table_body_des_five')</td>
                    <td>@lang('policy.table_body_rd_five')</td>
                    <td>@lang('policy.table_body_int_five')</td>
                    <td>@lang('policy.table_body_bonus_five')</td>
                    <td>@lang('policy.table_body_total_five')</td>
                </tr>
            </table>

        </div>
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->

    <div class="about-stats" style="margin: 50px">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="circular-progress-bar">
                        <div class="circle" id="loader_1">
                            <strong class="d-flex justify-content-center"></strong>
                        </div>

                        <h3 class="entry-title">Hard Work</h3>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="circular-progress-bar">
                        <div class="circle" id="loader_2">
                            <strong class="d-flex justify-content-center"></strong>
                        </div>

                        <h3 class="entry-title">Pure Love</h3>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="circular-progress-bar">
                        <div class="circle" id="loader_3">
                            <strong class="d-flex justify-content-center"></strong>
                        </div>

                        <h3 class="entry-title">Smart Ideas</h3>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="circular-progress-bar">
                        <div class="circle" id="loader_4">
                            <strong class="d-flex justify-content-center"></strong>
                        </div>

                        <h3 class="entry-title">Good Decisions</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="welcome-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 order-1 order-lg-1">
                    <img src="{{asset('asset/')}}/images/welcome.jpg"  width="100%" alt="welcome">
                </div><!-- .col -->

                <div class="col-12 col-lg-6 order-2 order-lg-2">
                    <div class="welcome-content">
                        <header class="entry-header">
                            <h2 class="entry-title" style="color: black">Wellcome to our Charity</h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content mt-5">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestibulum mauris quis aliquam. Integer accumsan sodales odio, id tempus velit ullamcorper id. Quisque at erat eu libero consequat tempus. Quisque molestie convallis tempus. Ut semper purus metus, a euismod sapien sodales ac. Duis viverra eleifend fermentum.</p>
                        </div><!-- .entry-content -->

                        <div class="entry-footer mt-5">
                            <a href="#" class="btn gradient-bg mr-2">Read More</a>
                        </div><!-- .entry-footer -->
                    </div><!-- .welcome-content -->
                </div><!-- .col -->

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->

    <div class="about-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="testimonial-cont">
                        <div class="entry-content">
                            <p>সঞ্চয় করুন জীবন গড়ুন </p>
                        </div>

                        <div class="entry-footer d-flex flex-wrap align-items-center mt-5">
                            <img src="images/testimonial-1.jpg" alt="">

                            <h4>@lang('about.director_name'), <span>@lang('about.position')</span></h4>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 offset-lg-2 col-lg-5">
                    <div class="testimonial-cont">
                        <div class="entry-content">
                            <p>সঞ্চয়ের মাধ্যমে সুখী সমৃদ্ধ পরিবার গড়ে তুলুন </p>
                        </div>

                        <div class="entry-footer d-flex flex-wrap align-items-center mt-5">
                            <img src="images/testimonial-2.jpg" alt="">

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
                    <h2>Help us so we can help others</h2>

                    <a class="btn orange-border" href="#">Donate now</a>
                </div>
            </div>
        </div>
    </div>





@endsection