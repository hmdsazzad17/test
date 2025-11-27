@extends('layouts.app')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner">
        <div class="banner-curve"></div>
		<div class="auto-container">
            <div class="inner">
                <div class="theme-icon"></div>
    			<div class="title-box">
                    <h1>Blog</h1>
                    <div class="d-text">Insights and updates from Codelab Web Tech</div>
                </div>
            </div>
		</div>
    </section>
    <!--End Banner Section -->

	<!--News Section-->
    <section class="news-section blog-grid">
        <div class="auto-container">
            <div class="row clearfix">
                @foreach ($blogs as $blog)
                    <!--News Block-->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <a href="{{ url('/blog/' . $blog->id) }}">
                                    @if ($blog->image)
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" title="">
                                    @endif
                                </a>
                            </div>
                            <div class="lower-box">
                                <h3><a href="{{ url('/blog/' . $blog->id) }}">{{ $blog->title }}</a></h3>
                                <div class="meta-info">
                                    <ul class="clearfix">
                                        <li><a href="#">By Admin</a></li>
                                        <li><a href="#">{{ $blog->created_at->format('d M Y') }}</a></li>
                                    </ul>
                                </div>
                                <div class="more-link"><a href="{{ url('/blog/' . $blog->id) }}"><span class="fa fa-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
