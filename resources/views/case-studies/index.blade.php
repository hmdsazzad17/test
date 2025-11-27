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
                    @foreach ($caseStudies as $caseStudy)
                        <!--Case Block-->
                        <div class="case-block col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <figure class="image-box">
                                    <a href="{{ url('/case-studies/' . $caseStudy->id) }}">
                                        @if ($caseStudy->image)
                                            <img src="{{ asset('storage/' . $caseStudy->image) }}" alt="{{ $caseStudy->title }}" title="">
                                        @endif
                                    </a>
                                </figure>
                                <div class="content-box">
                                    <div class="title-box">
                                        <h4><a href="{{ url('/case-studies/' . $caseStudy->id) }}">{{ $caseStudy->title }}</a></h4>
                                    </div>
                                    <div class="text-content">
                                        <div class="text">{{ Illuminate\Support\Str::limit(strip_tags($caseStudy->content), 100) }}</div>
                                        <div class="link-box"><a href="{{ url('/case-studies/' . $caseStudy->id) }}">View Case Study <span class="arrow fa fa-arrow-right"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection
