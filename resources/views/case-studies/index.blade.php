@extends('layouts.app')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner">
        <div class="banner-curve"></div>
		<div class="auto-container">
            <div class="inner">
                <div class="theme-icon"></div>
    			<div class="title-box">
                    <h1>Case Studies</h1>
                    <div class="d-text">Explore our successful projects</div>
                </div>
            </div>
		</div>
    </section>
    <!--End Banner Section -->

	<!--Cases Section-->
    <section class="cases-section cases-page">
        <div class="auto-container">

            <div class="sec-title centered">
                <div class="upper-text">Our Work</div>
                <h2><strong>Featured Case Studies</strong></h2>
            </div>

            <!--Carousel Box-->
            <div class="cases-box">
                <div class="row clearfix">
                    <!--Case Block-->
                    <div class="case-block col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <figure class="image-box">
                                <a href="{{ url('/case-studies/single') }}"><img src="{{ asset('images/resource/case-image-1.jpg') }}" alt="" title=""></a>
                            </figure>
                            <div class="content-box">
                                <div class="title-box">
                                    <h4><a href="{{ url('/case-studies/single') }}">E-commerce Platform with Laravel</a></h4>
                                    <div class="sub-text">Web Development</div>
                                </div>
                                <div class="text-content">
                                    <div class="text">Building a scalable and secure e-commerce platform using the Laravel framework.</div>
                                    <div class="link-box"><a href="{{ url('/case-studies/single') }}">View Case Study <span class="arrow fa fa-arrow-right"></span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Case Block-->
                    <div class="case-block col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <figure class="image-box">
                                <a href="{{ url('/case-studies/single') }}"><img src="{{ asset('images/resource/case-image-2.jpg') }}" alt="" title=""></a>
                            </figure>
                            <div class="content-box">
                                <div class="title-box">
                                    <h4><a href="{{ url('/case-studies/single') }}">Interactive Dashboard with React JS</a></h4>
                                    <div class="sub-text">Frontend Development</div>
                                </div>
                                <div class="text-content">
                                    <div class="text">Developing a real-time data visualization dashboard using React JS.</div>
                                    <div class="link-box"><a href="{{ url('/case-studies/single') }}">View Case Study <span class="arrow fa fa-arrow-right"></span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Case Block-->
                    <div class="case-block col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <figure class="image-box">
                                <a href="{{ url('/case-studies/single') }}"><img src="{{ asset('images/resource/case-image-4.jpg') }}" alt="" title=""></a>
                            </figure>
                            <div class="content-box">
                                <div class="title-box">
                                    <h4><a href="{{ url('/case-studies/single') }}">AI-Powered Chatbot</a></h4>
                                    <div class="sub-text">Artificial Intelligence</div>
                                </div>
                                <div class="text-content">
                                    <div class="text">Creating an intelligent chatbot to automate customer support and enhance user engagement.</div>
                                    <div class="link-box"><a href="{{ url('/case-studies/single') }}">View Case Study <span class="arrow fa fa-arrow-right"></span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Case Block-->
                    <div class="case-block col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <figure class="image-box">
                                <a href="{{ url('/case-studies/single') }}"><img src="{{ asset('images/resource/case-image-5.jpg') }}" alt="" title=""></a>
                            </figure>
                            <div class="content-box">
                                <div class="title-box">
                                    <h4><a href="{{ url('/case-studies/single') }}">React Native Mobile App</a></h4>
                                    <div class="sub-text">Mobile App Development</div>
                                </div>
                                <div class="text-content">
                                    <div class="text">Building a cross-platform mobile app for iOS and Android using React Native.</div>
                                    <div class="link-box"><a href="{{ url('/case-studies/single') }}">View Case Study <span class="arrow fa fa-arrow-right"></span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
