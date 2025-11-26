@extends('layouts.app')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner alternate">
        <div class="image-layer" style="background-image: url({{ asset('images/background/banner-bg-1.jpg') }});"></div>
		<div class="auto-container">
            <div class="inner">
    			<div class="title-box">
                    <h1>Our Services</h1>
                    <div class="d-text">Comprehensive IT solutions for your business</div>
                </div>
            </div>
		</div>
    </section>
    <!--End Banner Section -->

	<!--Services Section-->
    <section class="services-section">
        <div class="gradient-layer"></div>

        <div class="auto-container">
            <div class="row clearfix">
                <!--Column-->
                <div class="column col-lg-4 col-md-12 col-sm-12">
                    <div class="sec-title wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="upper-text">Our Services</div>
                        <h2><strong>Solutions and Focus Areas</strong></h2>
                        <div class="lower-text">Digital Transformation By IT Solutions</div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-outer">
                                <span class="icon-bg"></span>
                                <div class="icon-box"><img src="{{ asset('images/icons/services/1.png') }}" alt="" title=""></div>
                            </div>
                            <h3 id="laravel"><a href="#">Laravel Development</a></h3>
                            <div class="text">We specialize in building robust and scalable web applications using the Laravel framework. Our team of experts delivers high-quality solutions tailored to your business needs.</div>
                        </div>
                    </div>

                </div>

                <!--Column-->
                <div class="column col-lg-4 col-md-12 col-sm-12">

                    <!--Service Block-->
                    <div class="service-block wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-outer">
                                <span class="icon-bg"></span>
                                <div class="icon-box"><img src="{{ asset('images/icons/services/2.png') }}" alt="" title=""></div>
                            </div>
                            <h3 id="react"><a href="#">React JS Development</a></h3>
                            <div class="text">We create dynamic and interactive user interfaces with React JS. Our frontend developers are experts in building modern, fast, and responsive web applications.</div>
                        </div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-outer">
                                <span class="icon-bg"></span>
                                <div class="icon-box"><img src="{{ asset('images/icons/services/3.png') }}" alt="" title=""></div>
                            </div>
                            <h3 id="node"><a href="#">Node JS Development</a></h3>
                            <div class="text">We develop fast and scalable server-side applications with Node JS. Our backend developers build high-performance APIs and microservices.</div>
                        </div>
                    </div>

                </div>

                <!--Column-->
                <div class="column col-lg-4 col-md-12 col-sm-12">
                    <!--Service Block-->
                    <div class="service-block wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-outer">
                                <span class="icon-bg"></span>
                                <div class="icon-box"><img src="{{ asset('images/icons/services/4.png') }}" alt="" title=""></div>
                            </div>
                            <h3 id="ai"><a href="#">AI Solutions</a></h3>
                            <div class="text">We provide AI-powered solutions to automate and optimize your business processes. Our expertise includes machine learning, natural language processing, and computer vision.</div>
                        </div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-outer">
                                <span class="icon-bg"></span>
                                <div class="icon-box"><img src="{{ asset('images/icons/services/5.png') }}" alt="" title=""></div>
                            </div>
                            <h3 id="mobile"><a href="#">Mobile App Development</a></h3>
                            <div class="text">We build native and cross-platform mobile apps for iOS and Android using technologies like React Native.</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
