@extends('layouts.app')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner alternate">
        <div class="image-layer" style="background-image: url({{ asset('images/background/banner-bg-2.jpg') }});"></div>
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
            {!! $page->content !!}
        </div>
    </section>
@endsection
