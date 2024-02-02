<footer class="site-footer">
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="foot-about">
                        <h2 style="text-align: center"><a class="foot-logo" href="#"><img src="{{asset('asset/')}}/images/logo.png" width="70px" alt="kllll"></a></h2>

                        <p></p>

                        <ul class="d-flex flex-wrap align-items-center">
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>

                        </ul>
                    </div><!-- .foot-about -->
                </div><!-- .col -->

                <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                    <h2>@lang('footer.link')</h2>

                    <ul>
                        <li><a href="{{url('/about')}}"></a>@lang('footer.about_us')</li>
                        <li><a href="{{url('/policy')}}">@lang('footer.policy')</a></li>
                        <li><a href="{{url('/contact')}}">@lang('footer.contact_us')</a></li>
                        <li><a href="{{url('/')}}#Events">@lang('footer.events')</a></li>
                        <li><a href="{{url('/')}}#OurTeam">@lang('footer.team')</a></li>
                    </ul>
                </div><!-- .col -->

                <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                    <div class="foot-latest-news">
                        <h2>@lang('footer.upcoming_events')</h2>

                        <ul>
                            @if(isset($events))
                            @foreach($events as $item)
                            <li>
                                <h3><a href="#">{{$item->heading}}</a></h3>
                                <div class="posted-date">{{$item->date}}</div>
                            </li>
                                @endforeach
                                @endif
                        </ul>
                    </div><!-- .foot-latest-news -->
                </div><!-- .col -->

                <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                    <div class="foot-contact">
                        <h2>@lang('footer.contact_header')</h2>

                        <ul>
                            <li><i class="fa fa-phone"></i><span> @lang('contact.mobile')</span></li>
                            <li><i class="fa fa-envelope"></i><span>bdpssl@gmail.com</span></li>
                            <li><i class="fa fa-map-marker"></i><span>@lang('contact.address')</span></li>
                        </ul>
                    </div><!-- .foot-contact -->

                    <div class="subscribe-form">
                        <form class="d-flex flex-wrap align-items-center">
                            <input type="email" placeholder="Your email">
                            <input type="submit" value="send">
                        </form><!-- .flex -->
                    </div><!-- .search-widget -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .footer-widgets -->

    <div class="footer-bar">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Progaty
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div><!-- .col-12 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .footer-bar -->
</footer><!-- .site-footer -->
