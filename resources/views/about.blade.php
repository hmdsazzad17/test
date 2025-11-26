@extends('layouts.app')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner">
        <div class="banner-curve"></div>
		<div class="auto-container">
            <div class="inner">
                <div class="theme-icon"></div>
    			<div class="title-box">
                    <h1>About Us</h1>
                    <div class="d-text">Learn more about Codelab Web Tech</div>
                </div>
            </div>
		</div>
    </section>
    <!--End Banner Section -->

	<!--About Section-->
    <section class="about-section-three">
        <div class="auto-container">
            <div class="sec-title centered">
                <div class="upper-text">Welcome to Codelab Web Tech</div>
                <h2><strong>Your Partner for Innovative IT Solutions</strong></h2>
            </div>

            <div class="upper-row">
            	<div class="row clearfix">
                    <!--Text Column-->
                    <div class="text-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner">
                            <div class="text">
                                <p>Codelab Web Tech is a premier IT solutions provider dedicated to helping businesses thrive in the digital world. Our journey began with a passion for technology and a commitment to excellence. We specialize in a wide range of services, including web development, mobile app development, and AI-powered solutions.</p>

                                <p>Our mission is to empower our clients with innovative and customized solutions that drive growth, efficiency, and success. We believe in building long-term partnerships based on trust, transparency, and mutual respect.</p>
                            </div>
                        </div>
                    </div>
                    <!--Text Column-->
                    <div class="text-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner">
                            <div class="text">
                                <ul class="list-style-one">
                                    <li>Client-centric approach to every project</li>
                                    <li>Expert team of developers, designers, and strategists</li>
                                    <li>Commitment to quality, on-time delivery, and budget</li>
                                    <li>Expertise in cutting-edge technologies</li>
                                    <li>Proven track record of successful projects</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lower-row">
                <div class="row clearfix">
                    <!--Featured Block-->
                    <div class="featured-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image-box">
                                <a href="{{ url('/services') }}"><img src="{{ asset('images/resource/featured-image-4.jpg') }}" alt="" title=""></a>
                            </div>
                            <div class="lower-box">
                                <h3><a href="{{ url('/services') }}">Our Vision</a></h3>
                                <div class="text">To be a global leader in IT solutions, recognized for our innovation, quality, and commitment to client success.</div>
                                <div class="more-link"><a href="{{ url('/services') }}"><span class="fa fa-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <!--Featured Block-->
                    <div class="featured-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="image-box">
                                <a href="{{ url('/services') }}"><img src="{{ asset('images/resource/featured-image-5.jpg') }}" alt="" title=""></a>
                            </div>
                            <div class="lower-box">
                                <h3><a href="{{ url('/services') }}">Our Mission</a></h3>
                                <div class="text">To deliver exceptional IT solutions that empower our clients to achieve their business objectives and stay ahead of the competition.</div>
                                <div class="more-link"><a href="{{ url('/services') }}"><span class="fa fa-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <!--Featured Block-->
                    <div class="featured-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="image-box">
                                <a href="{{ url('/services') }}"><img src="{{ asset('images/resource/featured-image-6.jpg') }}" alt="" title=""></a>
                            </div>
                            <div class="lower-box">
                                <h3><a href="{{ url('/services') }}">Our Values</a></h3>
                                <div class="text">Integrity, innovation, collaboration, and client satisfaction are the cornerstones of our company culture.</div>
                                <div class="more-link"><a href="{{ url('/services') }}"><span class="fa fa-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
