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
                    <img src="{{asset('asset/')}}/images/policy.jpg" width="100%" alt="welcome">
                </div><!-- .col -->
            </div>
            <!-- .row -->
        <div class="row" style="padding-top: 30px">
            <table class="table table-striped table-bordered table-hover">
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
                            <p>@lang('about.dialogue')</p>
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
                    <h2>We are Here to Help You!</h2>
                </div>
            </div>
        </div>
    </div>





@endsection
