<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>@yield('title', 'Codelab Web Tech - Expert IT Solutions')</title>
<!-- Stylesheets -->
<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<!-- Responsive File -->
<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

<!-- Responsive Settings -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="{{ asset('assets/js/respond.js') }}"></script><![endif]-->
@stack('styles')
</head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"><div class="icon"></div></div>

    <!-- Main Header -->
    <header class="main-header header-style-one">
        <!-- Header Top -->
        <div class="header-top header-top-one">
            <div class="auto-container">
				<div class="inner clearfix">
                    <div class="top-left clearfix">
                        <div class="top-text">Your Partner in Digital Transformation</div>
                    </div>
    
                    <div class="top-right clearfix">
                        <!--Info-->
                        <div class="info">
                            <ul class="clearfix">
                                <li class="phone"><a href="tel:+8801890338797"><span class="icon sl-icon-call-in"></span>Phone <strong>+8801890338797</strong></a></li>
                                <li class="email"><a href="mailto:info@codelabwebtech.com"><span class="icon sl-icon-envelope-open"></span>info@codelabwebtech.com</a></li>
                            </ul>
                        </div>
                        <!--Language-->
                        <div class="language">
                            <div class="lang-btn">
                                <span class="flag"><img src="{{ asset('assets/images/icons/icon-lang.png') }}" alt="" title="English"></span>
                                <span class="txt">En</span>
                                <span class="arrow fa fa-angle-down"></span>
                            </div>
                            <div class="lang-dropdown">
                                <ul>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Italian</a></li>
                                    <li><a href="#">Chinese</a></li>
                                    <li><a href="#">Russian</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Upper -->
        <div class="header-upper">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <!--Logo-->
                    <div class="logo-box">
                        <div class="logo"><a href="{{ url('/') }}" title="Codelab Web Tech - Expert IT Solutions"><img src="{{ asset('assets/images/logo.png') }}" alt="Codelab Web Tech - Expert IT Solutions" title="Codelab Web Tech - Expert IT Solutions"></a></div>
                    </div>
                    <div class="right-nav clearfix">
                        <div class="nav-outer clearfix">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class="{{ Request::is('/') ? 'current' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                                        <li class="{{ Request::is('about') ? 'current' : '' }}"><a href="{{ url('about') }}">About Us</a></li>
                                        <li class="dropdown {{ Request::is('services*') ? 'current' : '' }}"><a href="{{ url('services') }}">Services</a>
                                            <ul>
                                                <li><a href="{{ url('services') }}">All Services</a></li>
                                                <li><a href="{{ url('services') }}#laravel">Laravel Development</a></li>
                                                <li><a href="{{ url('services') }}#php">PHP Development</a></li>
                                                <li><a href="{{ url('services') }}#react">React JS Development</a></li>
                                                <li><a href="{{ url('services') }}#node">Node JS Development</a></li>
                                                <li><a href="{{ url('services') }}#python">Python Development</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ Request::is('case-studies') ? 'current' : '' }}"><a href="{{ url('case-studies') }}">Case Studies</a></li>
                                        <li class="{{ Request::is('blog*') ? 'current' : '' }}"><a href="{{ url('blog') }}">Blog</a></li>
                                        <li class="{{ Request::is('contact') ? 'current' : '' }}"><a href="{{ url('contact') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!--Search Btn-->
                        <div class="search-btn">
                            <button type="button" class="theme-btn search-toggler"><span class="fa fa-search"></span></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="{{ url('/') }}" title=""><img src="{{ asset('assets/images/sticky-logo.png') }}" alt="" title=""></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
                </div>
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-targeting-cross"></span></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="{{ url('/') }}"><img src="{{ asset('assets/images/nav-logo.png') }}" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="#"><span class="fab fa-twitter"></span></a></li>
						<li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a href="#"><span class="fab fa-instagram"></span></a></li>
						<li><a href="#"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!-- End Main Header -->

    <!--Search Popup-->
    <div id="search-popup" class="search-popup">
        <div class="close-search theme-btn"><span class="flaticon-targeting-cross"></span></div>
        <div class="popup-inner">
            <div class="overlay-layer"></div>
            <div class="search-form">
                <form method="post" action="#">
                    <div class="form-group">
                        <fieldset>
                            <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required >
                            <input type="submit" value="Search Now!" class="theme-btn">
                        </fieldset>
                    </div>
                </form>
                
                <br>
                <h3>Recent Search Keywords</h3>
                <ul class="recent-searches">
                    <li><a href="#">Laravel</a></li>
                    <li><a href="#">React JS</a></li>
                    <li><a href="#">Node JS</a></li>
                    <li><a href="#">Python</a></li>
                    <li><a href="#">AI</a></li>
                </ul>
            
            </div>
            
        </div>
    </div>

    @yield('content')

	    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="top-pattern-layer-dark"></div>
        
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="auto-container">
                <div class="row clearfix">
                    
                    <!--Column-->
                    <div class="column col-xl-3 col-lg-12 col-md-12 col-sm-12">
                        <div class="footer-widget about-widget">
                            <div class="logo">
                                <a href="#"><img src="{{ asset('assets/images/footer-logo.png') }}" alt=""></a>
                            </div>
                            <div class="text">Codelab Web Tech is your trusted partner for innovative IT solutions.</div>
                            <div class="info">
                                <ul>
                                    <li>Sector 12, Uttara, Dhaka</li>
                                    <li>Call us <a href="tel:+8801890338797"><strong>+8801890338797</strong></a></li>
                                    <li><a href="mailto:info@codelabwebtech.com">info@codelabwebtech.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!--Column-->
                    <div class="column col-xl-9 col-lg-12 col-md-12 col-sm-12">
                        <div class="footer-widget links-widget">
                            <div class="widget-content">
                                <div class="row clearfix">
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="row clearfix">
                                            <div class="column col-lg-4 col-md-4 col-sm-12">
                                                <div class="widget-title">
                                                    <h4>Our Services</h4>
                                                </div>
                                                <ul class="links">
                                                    <li><a href="#">Laravel Development</a></li>
                                                    <li><a href="#">React JS Development</a></li>
                                                    <li><a href="#">Node JS Development</a></li>
                                                    <li><a href="#">Python Development</a></li>
                                                    <li><a href="#">AI Solutions</a></li>
                                                </ul>
                                            </div>
                                            <div class="column col-lg-4 col-md-4 col-sm-12">
                                                <div class="widget-title">
                                                    <h4>About Us</h4>
                                                </div>
                                                <ul class="links">
                                                    <li><a href="{{ url('about') }}">Who We Are</a></li>
                                                    <li><a href="{{ url('case-studies') }}">Case Studies</a></li>
                                                    <li><a href="#">Career Opportunities</a></li>
                                                    <li><a href="#">Our Clients</a></li>
                                                </ul>
                                            </div>
                                            <div class="column col-lg-4 col-md-4 col-sm-12">
                                                <div class="widget-title">
                                                    <h4>Support</h4>
                                                </div>
                                                <ul class="links">
                                                    <li><a href="#">Help Center</a></li>
                                                    <li><a href="{{ url('blog') }}">Latest Articles</a></li>
                                                    <li><a href="{{ url('contact') }}">Contact Us</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column col-lg-4 col-md-12 col-sm-12">
                                        <div class="widget-title empty-title">
                                            <h4>Get In Touch</h4>
                                        </div>
                                        <!--Newsletter-->
                                        <div class="newsletter-form">
                                            <form method="post" action="#">
                                                <div class="form-group clearfix">
                                                    <input type="email" name="email" value="" placeholder="Email address" required>
                                                    <button type="submit" class="theme-btn newsletter-btn"><span class="icon fa fa-paper-plane"></span></button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="social-links">
                                            <div class="title text">Get the latest news & updates</div>
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
                            </div>  
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="inner">
                    <div class="copyright">&copy; 2024 <strong>Codelab Web Tech</strong>. All rights reserved. <a href="#">Privacy Policy</a></div>
                </div>
            </div>
        </div>
        
    </footer>

</div>
<!--End pagewrapper-->

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/js/owl.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar.js') }}"></script>
<script src="{{ asset('assets/js/validate.js') }}"></script>
<script src="{{ asset('assets/js/appear.js') }}"></script>
<script src="{{ asset('assets/js/wow.js') }}"></script>
<script src="{{ asset('assets/js/custom-script.js') }}"></script>
@stack('scripts')
</body>
</html>
