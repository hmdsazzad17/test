@extends('layouts.app')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner">
        <div class="banner-curve"></div>
		<div class="auto-container">
            <div class="inner">
                <div class="theme-icon"></div>
    			<div class="title-box">
                    <h1>Blog</h1>
                    <div class="d-text">Insights and updates from Codelab Web Tech</div>
                </div>
            </div>
		</div>
    </section>
    <!--End Banner Section -->

	<!--News Section-->
    <section class="news-section blog-grid">
        <div class="auto-container">
            <div class="row clearfix">
                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <a href="{{ url('/blog/single') }}"><img src="{{ asset('images/resource/blog-image-1.jpg') }}" alt="" title=""></a>
                        </div>
                        <div class="lower-box">
                            <div class="category">Laravel</div>
                            <h3><a href="{{ url('/blog/single') }}">Why Laravel is the Best Choice for Your Next Project</a></h3>
                            <div class="meta-info">
                                <ul class="clearfix">
                                    <li><a href="#">By Admin</a></li>
                                    <li><a href="#">20 Jan 2024</a></li>
                                </ul>
                            </div>
                            <div class="more-link"><a href="{{ url('/blog/single') }}"><span class="fa fa-arrow-right"></span></a></div>
                        </div>
                    </div>
                </div>
                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <a href="{{ url('/blog/single') }}"><img src="{{ asset('images/resource/blog-image-2.jpg') }}" alt="" title=""></a>
                        </div>
                        <div class="lower-box">
                            <div class="category">React Native</div>
                            <h3><a href="{{ url('/blog/single') }}">The Benefits of Using React Native for Mobile App Development</a></h3>
                            <div class="meta-info">
                                <ul class="clearfix">
                                    <li><a href="#">By Admin</a></li>
                                    <li><a href="#">15 Jan 2024</a></li>
                                </ul>
                            </div>
                            <div class="more-link"><a href="{{ url('/blog/single') }}"><span class="fa fa-arrow-right"></span></a></div>
                        </div>
                    </div>
                </div>
                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <a href="{{ url('/blog/single') }}"><img src="{{ asset('images/resource/blog-image-3.jpg') }}" alt="" title=""></a>
                        </div>
                        <div class="lower-box">
                            <div class="category">AI</div>
                            <h3><a href="{{ url('/blog/single') }}">How AI is Transforming Business Automation</a></h3>
                            <div class="meta-info">
                                <ul class="clearfix">
                                    <li><a href="#">By Admin</a></li>
                                    <li><a href="#">10 Jan 2024</a></li>
                                </ul>
                            </div>
                            <div class="more-link"><a href="{{ url('/blog/single') }}"><span class="fa fa-arrow-right"></span></a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="load-more link-box">
                <a href="#" class="theme-btn btn-style-two"><div class="btn-title">Load More News</div></a>
            </div>

        </div>
    </section>
@endsection
