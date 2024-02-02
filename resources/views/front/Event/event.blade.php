@extends('front.master')

@section('title')
    Events
    @endsection


@section('content')
<div class="single-page news-page" >
 <div class="page-header">
        <div class="container" >
            <div class="row">
                <div class="col-12">
                    <h1>Events</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="news-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    @foreach($events as $event)
                    <div class="news-content">
                        <a href="#"><img src="{{asset($event->event_picture)}}" alt=""></a>

                        <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">
                            <div class="header-elements">
                                <div class="posted-date">{{$event->date}}</div>

                                <h2 class="entry-title"><a href="#">{{$event->heading}}</a></h2>

                                <div class="post-metas d-flex flex-wrap align-items-center">
                                    <span class="cat-links">in <a href="#">Causes</a></span>
                                    <span class="post-author">BY <a href="#">PROGATY LIMITED</a></span>
                                    
                                </div>
                            </div>

                            <div class="donate-icon">
                                <a href="#"><img src="images/donate-icon.png" alt=""></a>
                            </div>
                        </header>

                        <div class="entry-content">
                            <p>{{$event->description}}</p>
                        </div>

                        <footer class="entry-footer">
                            <a href="#" class="btn gradient-bg">Read More</a>
                        </footer>
                    </div>
                    @endforeach
                   
                    <ul class="pagination d-flex flex-wrap align-items-center p-0">
                        <li class="active"><a href="#">01</a></li>
                        <li><a href="#">02</a></li>
                        <li><a href="#">03</a></li>
                    </ul>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="sidebar">
                        <div class="search-widget">
                            <form class="flex flex-wrap align-items-center">
                                <input type="search" placeholder="Search...">
                                <button type="submit" class="flex justify-content-center align-items-center">GO</button>
                            </form><!-- .flex -->
                        </div><!-- .search-widget -->

                      
                        <div class="upcoming-events">
                            <h2>Upcoming Events</h2>

                            <ul class="p-0">
                                @foreach($events as $event)
                                <li class="d-flex flex-wrap justify-content-between align-items-center">
                                    <figure><a href="#"><img src="{{asset($event->event_picture)}}" width="100px" alt=""></a></figure>

                                    <div class="entry-content">
                                        <h3 class="entry-title"><a href="#">{{$event->heading}}</a></h3>

                                        <div class="post-metas d-flex flex-wrap align-items-center">
                                            <span class="posted-date"><a href="#">{{$event->date}}</a></span>
                                            <span class="event-location"><a href="#">Kurigram, Rangpur</a></span>
                                        </div>

                                        <p></p>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div><!-- .cat-links -->

                        <div class="featured-cause">
                            <h2>Featured Causes</h2>

                            <div class="cause-wrap">
                                <figure class="m-0 position-relative">
                                    <a href="#"><img src="images/cause-3.jpg" alt=""></a>
                                </figure>

                                <div class="cause-content-wrap">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <h3 class="entry-title w-100 m-0"><a href="#">Bring water to the childrens</a></h3>
                                    </header><!-- .entry-header -->

                                    <div class="entry-content">
                                        <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris.</p>
                                    </div><!-- .entry-content -->

                                    <div class="fund-raised w-100">
                                        <div class="fund-raised-bar-3 barfiller">
                                            <div class="tipWrap">
                                                <span class="tip"></span>
                                            </div><!-- .tipWrap -->

                                            <span class="fill" data-percentage="83"></span>
                                        </div><!-- .fund-raised-bar -->

                                        <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="fund-raised-total mt-4">
                                                Raised: $56 880
                                            </div><!-- .fund-raised-total -->

                                            <div class="fund-raised-goal mt-4">
                                                Goal: $70 000
                                            </div><!-- .fund-raised-goal -->
                                        </div><!-- .fund-raised-details -->
                                    </div><!-- .fund-raised -->
                                </div><!-- .cause-content-wrap -->
                            </div><!-- .cause-wrap -->
                        </div>
                    </div><!-- .sidebar -->
                </div><!-- .col -->
            </div>
        </div>
    </div>


</div>


@endsection
