@extends('layouts.app')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner alternate">
        <div class="image-layer" style="background-image: url({{ asset('storage/' . $caseStudy->image) }});"></div>
        <div class="auto-container">
            <div class="inner">
                <div class="title-box">
                    <h1>{{ $caseStudy->title }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->

	<section class="case-single-section">
        <div class="auto-container">
            <div class="case-inner">
                
                <!--Cases Title-->
                <div class="cases-title">
                    <div class="row clearfix">
                        <div class="column col-lg-4 col-md-12 col-sm-12">
                            <h2>{{ $caseStudy->title }}</h2>
                        </div>
                        <div class="column col-lg-8 col-md-12 col-sm-12">
                            <div class="row clearfix">
                                <div class="info-column col-lg-4 col-md-4 col-sm-12">
                                    <div class="inner">
                                        <h3>Date</h3>
                                        <div class="text">{{ $caseStudy->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Cases Title-->
                
                <div class="text">
                    {!! $caseStudy->content !!}
                </div>

            </div>
        </div>
    </section>
@endsection
