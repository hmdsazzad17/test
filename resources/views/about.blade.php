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
            {!! $page->content !!}
        </div>
    </section>
@endsection
