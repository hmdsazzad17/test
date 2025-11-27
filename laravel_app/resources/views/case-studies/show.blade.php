@extends('layouts.app')

@section('title', 'Case Study - E-commerce Platform with Laravel')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner alternate">
        <div class="image-layer" style="background-image: url({{ asset('assets/images/background/banner-bg-2.jpg') }});"></div>
        <div class="auto-container">
            <div class="inner">
                <div class="title-box">
                    <h1>E-commerce Platform with Laravel</h1>
                    <div class="d-text">A robust and scalable solution</div>
                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->

	<section class="case-single-section">
        <div class="auto-container">
            <div class="case-inner">
                
                <!--Case Images-->
                <div class="case-images">
                    <div class="row clearfix">
                        <!--Image Column-->
                        <div class="image-column col-lg-8 col-md-8 col-sm-12">
                            <figure class="image">
                                <a href="{{ asset('assets/images/resource/case-image-6.jpg') }}" class="lightbox-image"><img src="{{ asset('assets/images/resource/case-image-6.jpg') }}" alt=""></a>
                            </figure>
                        </div>
                        <!--Image Column-->
                        <div class="image-column col-lg-4 col-md-4 col-sm-12">
                            <figure class="image">
                                <a href="{{ asset('assets/images/resource/case-image-7.jpg') }}" class="lightbox-image"><img src="{{ asset('assets/images/resource/case-image-7.jpg') }}" alt=""></a>
                            </figure>
                        </div>
                    </div>
                </div>
                
                <!--Cases Title-->
                <div class="cases-title">
                    <div class="row clearfix">
                        <div class="column col-lg-4 col-md-12 col-sm-12">
                            <h2>E-commerce Platform <br> with Laravel</h2>
                        </div>
                        <div class="column col-lg-8 col-md-12 col-sm-12">
                            <div class="row clearfix">
                                <div class="info-column col-lg-4 col-md-4 col-sm-12">
                                    <div class="inner">
                                        <h3>Date</h3>
                                        <div class="text">15 Jan 2024</div>
                                    </div>
                                </div>
                                <div class="info-column col-lg-4 col-md-4 col-sm-12">
                                    <div class="inner">
                                        <h3>Client Name</h3>
                                        <div class="text">Retail Co.</div>
                                    </div>
                                </div>
                                <div class="info-column col-lg-4 col-md-4 col-sm-12">
                                    <div class="inner">
                                        <h3>Project Type</h3>
                                        <div class="text">Web Development</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Cases Title-->
                
                <div class="bold-text">We developed a feature-rich e-commerce platform for a growing retail business, enabling them to expand their online presence and increase sales.</div>
                <div class="text">
                    <p>The client, a mid-sized retail company, needed a modern and scalable e-commerce solution to replace their outdated online store. The new platform had to be secure, easy to manage, and provide a seamless shopping experience for customers.</p>
                    <p>Our team at Codelab Web Tech chose Laravel, a powerful PHP framework, to build the new platform. This allowed us to create a custom solution that met all of the client's specific requirements, including a user-friendly admin panel, secure payment gateway integration, and advanced product management features.</p>
                </div>
                <div class="two-column clearfix">
                    <div class="row clearfix">
                        <!--Content Column-->
                        <div class="content-column col-lg-5 col-md-12 col-sm-12">
                            <h3>Results and Impact</h3>
                            <p>The new e-commerce platform has been a huge success for the client. They have seen a significant increase in online sales, improved customer satisfaction, and a more streamlined order management process.</p>
                            <p>The platform's performance and security have also been praised by both the client and their customers. The successful launch of this project has solidified our reputation as a leading provider of custom e-commerce solutions.</p>
                        </div>
                        <!--Image Column-->
                        <div class="image-column col-lg-7 col-md-12 col-sm-12">
                            <div class="row clearfix">
                                <div class="column col-md-6 col-sm-12">
                                    <div class="image">
                                        <a href="{{ asset('assets/images/resource/case-image-8.jpg') }}" class="lightbox-image"><img src="{{ asset('assets/images/resource/case-image-8.jpg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="column col-md-6 col-sm-12">
                                    <div class="image">
                                        <a href="{{ asset('assets/images/resource/case-image-9.jpg') }}" class="lightbox-image"><img src="{{ asset('assets/images/resource/case-image-9.jpg') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
