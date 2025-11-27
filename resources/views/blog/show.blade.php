@extends('layouts.app')

@section('content')
    <!-- Inner Banner Section -->
    <section class="inner-banner">
        <div class="banner-curve"></div>
		<div class="auto-container">
            <div class="inner">
                <div class="theme-icon"></div>
    			<div class="title-box">
                    <h1>Blog Post</h1>
                    <div class="d-text">{{ $blog->title }}</div>
                </div>
            </div>
		</div>
    </section>
    <!--End Banner Section -->

	<div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!--Content Side-->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">
                    <div class="blog-content">
                        
                        <div class="post-details">
                            <!--News Block-->
                            <div class="news-block-three">
                                <div class="inner-box">
                                    <div class="image-box">
                                        @if ($blog->image)
                                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" title="">
                                        @endif
                                    </div>
                                    <div class="lower-box">
                                        <h3>{{ $blog->title }}</h3>
                                        <div class="meta-info">
                                            <ul class="clearfix">
                                                <li><a href="#">By Admin</a></li>
                                                <li><a href="#">{{ $blog->created_at->format('d M Y') }}</a></li>
                                            </ul>
                                        </div>

                                        <div class="text">
                                            {!! $blog->content !!}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                    <aside class="sidebar blog-sidebar">
                        <!--Sidebar Widget-->
                        <div class="sidebar-widget search-box">
                            <form method="post" action="#">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search.." required="">
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>

                        </div>
                        <div class="sidebar-widget archives">
                            <div class="widget-inner">
                                <div class="sidebar-title">
                                    <h3>Categories</h3>
                                </div>

                                <ul>
                                    <li><a href="#">Web Development</a></li>
                                    <li class="active"><a href="#">Laravel</a></li>
                                    <li><a href="#">React JS</a></li>
                                    <li><a href="#">Node JS</a></li>
                                    <li><a href="#">Python</a></li>
                                    <li><a href="#">AI</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="sidebar-widget recent-posts">
                            <div class="widget-inner">
                                <div class="sidebar-title">
                                    <h3>Recent Posts</h3>
                                </div>

                                <div class="post">
                                    <figure class="post-thumb"><img src="{{ asset('images/resource/post-thumb-1.jpg') }}" alt=""></figure>
                                    <h3 class="text"><a href="#">Why Laravel is the Best Choice for Your Next Project</a></h3>
                                </div>

                                <div class="post">
                                    <figure class="post-thumb"><img src="{{ asset('images/resource/post-thumb-2.jpg') }}" alt=""></figure>
                                    <h3 class="text"><a href="#">The Benefits of Using React Native for Mobile App Development</a></h3>
                                </div>

                                <div class="post">
                                    <figure class="post-thumb"><img src="{{ asset('images/resource/post-thumb-3.jpg') }}" alt=""></figure>
                                    <h3 class="text"><a href="#">How AI is Transforming Business Automation</a></h3>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget popular-tags">
                            <div class="widget-inner">
                                <div class="sidebar-title">
                                    <h3>Popular Tags</h3>
                                    
                                </div>
                                <ul class="tags-list clearfix">
                                    <li><a href="#">Laravel</a></li>
                                    <li><a href="#">React JS</a></li>
                                    <li><a href="#">Node JS</a></li>
                                    <li><a href="#">Python</a></li>
                                    <li><a href="#">AI</a></li>
                                    <li><a href="#">Web Development</a></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                
            </div>
        </div>
    </div>
@endsection
