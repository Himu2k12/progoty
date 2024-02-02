@extends('front.master')

@section('title')
    Contact Us
@endsection

@section('content')
    <div class="contact-page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-7">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7183.547607804009!2d89.64517564183173!3d25.811035470921365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e2c8e400000001%3A0xe152c1173cf9ba33!2sNageshwari%20Pourashava!5e0!3m2!1sen!2sca!4v1677830549541!5m2!1sen!2sca" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    
                    <div class="contact-gmap">
                        <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=usa&key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes" allowfullscreen></iframe>
                    </div>
                
                </div>
                <div class="col-sm-12 col-lg-5">
                    <div class="entry-content">
                        <h2>@lang('contact.head')</h2>

                        <p></p>

                        <ul class="contact-social d-flex flex-wrap align-items-center">
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>

                        <ul class="contact-info p-0">
                            <li><i class="fa fa-phone"></i><span>@lang('contact.mobile')</span></li>
                            <li><i class="fa fa-envelope"></i><span>bdpssl@gmail.com /</span><span> Office@progatybd.com</span></li>
                            <li><i class="fa fa-map-marker"></i><span>@lang('contact.address')</span></li>
                        </ul>
                    </div>
                </div><!-- .col -->

            </div><!-- .row -->
        </div><!-- .container -->
    </div>


@endsection
