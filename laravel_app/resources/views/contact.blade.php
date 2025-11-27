@extends('layouts.app')

@section('title', 'Contact Codelab Web Tech - Get in Touch')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner alternate">
        <div class="image-layer" style="background-image: url({{ asset('assets/images/background/banner-bg-2.jpg') }});"></div>
		<div class="auto-container">
            <div class="inner">
     			<div class="title-box">
                    <h1>Contact Us</h1>
                    <div class="d-text">We'd love to hear from you</div>
                </div>
            </div>
		</div>
    </section>
    <!--End Banner Section -->

	<!--Contact Section-->
    <section class="contact-section-two">
        <div class="auto-container">
            <div class="upper-row">
                <div class="row clearfix">
                    <!--Text Column-->
                    <div class="text-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner">
                            <div class="sec-title">
                                <div class="upper-text">Get in Touch with Codelab Web Tech</div>
                                <h2>Have a Project in Mind? Let's Talk!</h2>
                                <div class="lower-text">We are here to answer any questions you may have about our services. Reach out to us and we'll respond as soon as we can.</div>
                            </div>

                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                    <li><a href="#"><span class="fab fa-pinterest"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Form Column-->
                    <div class="form-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner">
                            <!--Form Box-->
                            <div class="form-box">
                                <div class="default-form contact-form">
                                    <form method="post" action="#" id="contact-form">
                                        <div class="row clearfix">                                    
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="text" name="username" placeholder="Your Name" required="" value="">
                                            </div>
                                            
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="email" name="email" placeholder="Email" required="" value="">
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="text" name="phone" placeholder="Phone" required="" value="">
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="text" name="subject" placeholder="Subject" required="" value="">
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <textarea name="message" placeholder="Message" required=""></textarea>
                                            </div>
                    
                                            <div class="form-group col-md-12 col-sm-12">
                                                <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Send Message</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="lower-row">
                <div class="row clearfix">
                    <!--Info Block-->
                    <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="content-box">
                                <div class="title-box">
                                    <h4><a href="#">Our Office</a></h4>
                                    <div class="sub-text">Main Office</div>
                                </div>
                                <div class="text-content">
                                    <div class="info">
                                        <ul>
                                            <li>Sector 12, Uttara, Dhaka</li>
                                            <li>Call us <a href="tel:+8801890338797"><strong>+8801890338797</strong></a></li>
                                            <li><a href="mailto:info@codelabwebtech.com">info@codelabwebtech.com</a></li>
                                        </ul>
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

@push('scripts')
<!--Google Map-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHJe2MPH8B-gLzZu5QI0Alc73nvkLuuqQ"></script>
<script src="{{ asset('assets/js/map-script.js') }}"></script>
@endpush
