@extends('layouts.app')

@section('title', 'Codelab Web Tech - Expert IT Solutions')

@section('content')
    <!-- Banner Section -->
    <section class="banner-section banner-one">
        <div class="banner-curve"></div>

		<div class="banner-carousel theme-carousel owl-theme owl-carousel" data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 300, "responsive":{ "0" :{ "items": "1" }, "768" :{ "items" : "1" } , "1000":{ "items" : "1" }}}'>
			
            <!-- Slide Item -->
			<div class="slide-item">
				<div class="auto-container">
					<div class="content-box">
                        <div class="round-layer"></div>
                        
                        <div class="content">
                            <div class="inner">
                                <div class="sub-title">Welcome to Codelab Web Tech</div>
							<h1>Expert Solutions in <strong>Laravel, React, and More</strong></h1>
                                <div class="text">We build robust and scalable web applications tailored to your business needs.</div>
        						<div class="links-box">
                                    <a href="{{ url('about') }}" class="theme-btn btn-style-one"><div class="btn-title">Learn More</div></a>
                                    <a href="{{ url('contact') }}" class="theme-btn btn-style-two"><div class="btn-title">Get a Quote</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="content-image"><img src="{{ asset('assets/images/main-slider/content-image-1.png') }}" alt="" title=""></div>
					</div>  
				</div>
			</div>

			<!-- Slide Item -->
            <div class="slide-item">

                <div class="auto-container">
                    <div class="content-box">
                        <div class="round-layer"></div>

                        <div class="content">
                            <div class="inner alternate">
                                <div class="sub-title">Custom Software Development</div>
                                <h1><strong>AI and Business Automation</strong> to Drive Growth</h1>
                                <div class="text">Leverage the power of AI and automation to streamline your operations.</div>
                                <div class="links-box">
                                    <a href="{{ url('about') }}" class="theme-btn btn-style-one"><div class="btn-title">More Details</div></a>
                                    <a href="{{ url('services') }}" class="theme-btn btn-style-two"><div class="btn-title">Our Services</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="content-image"><img src="{{ asset('assets/images/main-slider/content-image-2.png') }}" alt="" title=""></div>
                    </div>  
                </div>
            </div>

		</div>
    </section>
    <!--End Banner Section -->

	<!--About Section-->
    <section class="about-section">
        <div class="auto-container">
        	<div class="row clearfix">
                <!--Text Column-->
                <div class="text-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <div class="sec-title">
                            <div class="upper-text">About Codelab Web Tech</div>
                            <h2>Your Trusted Partner for <strong>Innovative IT Solutions</strong></h2>
                        </div>

                        <div class="text-content">
                            <p>Codelab Web Tech is a leading IT solutions provider, specializing in web development, mobile app development, and AI solutions. Our team of experts is dedicated to delivering high-quality, scalable, and reliable solutions that help our clients achieve their business goals.</p>
                            <ul class="list-style-one">
                                <li>Expertise in Laravel, PHP, React JS, Node JS, and more</li>
                                <li>Customized solutions to meet your unique needs</li>
                                <li>Focus on quality, performance, and security</li>
                                <li>Dedicated to client success and long-term partnerships</li>
                                <li>Agile development process for faster delivery</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Image Column-->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <!--Images-->
                        <div class="images">
                            <div class="row clearfix">
                                <figure class="image col-md-6 col-sm-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="{{ asset('assets/images/resource/about-image-1.jpg') }}" alt="" title=""></figure>
                                <figure class="image col-md-6 col-sm-6 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="{{ asset('assets/images/resource/about-image-2.jpg') }}" alt="" title=""></figure>
                                <figure class="image col-md-6 col-sm-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="{{ asset('assets/images/resource/about-image-3.jpg') }}" alt="" title=""></figure>
                                <figure class="image col-md-6 col-sm-6 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="{{ asset('assets/images/resource/about-image-4.jpg') }}" alt="" title=""></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Separator-->
    <div class="theme-separator"></div>

    <!--Services Section-->
    <section class="services-section">
        <div class="gradient-layer"></div>
        <div class="pattern-layer"></div>

        <div class="auto-container">
            <div class="row clearfix">
                <!--Column-->
                <div class="column col-lg-4 col-md-12 col-sm-12">
                    <div class="sec-title wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="upper-text">Our Services</div>
                        <h2><strong>Expertise and Solutions</strong></h2>
                        <div class="lower-text">Delivering excellence in every project</div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-outer">
                                <span class="icon-bg"></span>
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/services/1.png') }}" alt="" title=""></div>
                            </div>
                            <h3><a href="#">Laravel Development</a></h3>
                            <div class="text">We build robust and scalable web applications using the Laravel framework.</div>
                            <div class="more-link"><a href="#"><span class="fa fa-arrow-right"></span></a></div>
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
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/services/2.png') }}" alt="" title=""></div>
                            </div>
                            <h3><a href="#">React JS Development</a></h3>
                            <div class="text">We create dynamic and interactive user interfaces with React JS.</div>
                            <div class="more-link"><a href="#"><span class="fa fa-arrow-right"></span></a></div>
                        </div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-outer">
                                <span class="icon-bg"></span>
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/services/3.png') }}" alt="" title=""></div>
                            </div>
                            <h3><a href="#">Node JS Development</a></h3>
                            <div class="text">We develop fast and scalable server-side applications with Node JS.</div>
                            <div class="more-link"><a href="#"><span class="fa fa-arrow-right"></span></a></div>
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
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/services/4.png') }}" alt="" title=""></div>
                            </div>
                            <h3><a href="#">AI Solutions</a></h3>
                            <div class="text">We provide AI-powered solutions to automate and optimize your business processes.</div>
                            <div class="more-link"><a href="#"><span class="fa fa-arrow-right"></span></a></div>
                        </div>
                    </div>

                    <!--Service Block-->
                    <div class="service-block wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-outer">
                                <span class="icon-bg"></span>
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/services/5.png') }}" alt="" title=""></div>
                            </div>
                            <h3><a href="#">Mobile App Development</a></h3>
                            <div class="text">We build native and cross-platform mobile apps for iOS and Android.</div>
                            <div class="more-link"><a href="#"><span class="fa fa-arrow-right"></span></a></div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="bottom-text">
                <div class="text">Ready to start your project? <a href="{{ url('contact') }}"><strong>Contact Us</strong></a> or Call us Today! <a href="tel:+8801890338797"><strong>+8801890338797</strong></a></div>
            </div>

        </div>
    </section>
@endsection
