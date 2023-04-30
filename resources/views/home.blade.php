<!doctype html>
<html lang="en">

<head>
   
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--====== Title ======-->
    <title>Nucleuz</title>
    
    <!--====== Favicon Icon ======-->
    <!-- <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png"> -->
	  <link rel="icon" type="image/x-icon" href="{{ URL('public/favicon.png') }}">


    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ URL('public/Website/lib/appie/assets/css/bootstrap.min.css') }}">
    
    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{ URL('public/Website/lib/appie/assets/css/font-awesome.min-alt.css') }}">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css"> -->

    
    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ URL('public/Website/lib/appie/assets/css/animate.min.css') }}">
    
    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ URL('public/Website/lib/appie/assets/css/magnific-popup.css') }}">
    
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ URL('public/Website/lib/appie/assets/css/slick.css') }}">
    
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ URL('public/Website/lib/appie/assets/css/custom-animation.css') }}">
    <link rel="stylesheet" href="{{ URL('public/Website/lib/appie/assets/css/default.css') }}">
    
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ URL('public/Website/lib/appie/assets/css/style.css') }}">

</head>

<body>   

    <!--====== PRELOADER PART START ======-->

    <div class="loader-wrap">
        <div class="preloader"><div class="preloader-close">Preloader Close</div></div>
        <div class="layer layer-one"><span class="overlay"></span></div>
        <div class="layer layer-two"><span class="overlay"></span></div>        
        <div class="layer layer-three"><span class="overlay"></span></div>        
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== OFFCANVAS MENU PART START ======-->

    <div class="off_canvars_overlay">
                
    </div>
    <div class="offcanvas_menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="offcanvas_menu_wrapper">
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="fa fa-times"></i></a>  
                        </div>
                        <div class="offcanvas-brand text-center mb-40">
                            <img src="{{ URL('public/Website/lib/appie/assets/images/logo.png') }}" alt="">
                        </div>
                        <div id="menu" class="text-left ">
                            <ul class="offcanvas_main_menu">
                                <li class="menu-item-has-children active">
                                    <a href="#">Home</a>
                                    <ul class="sub-menu">
                                        <li><a href="index.html">Home 1</a></li>
                                        <li><a href="index-2.html">Home 2</a></li>
                                        <li><a href="index-3.html">Home 3</a></li>
                                        <li><a href="index-4.html">Home 4</a></li>
                                        <li><a href="index-5.html">Home 5</a></li>
                                        <li><a href="index-6.html">Home 6</a></li>
                                        <li><a href="index-7.html">Home 7</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children active">
                                    <a href="#service">Service</a>
                                </li>
                                <li class="menu-item-has-children active">
                                    <a href="#features">Feature</a>
                                </li>
                                <li class="menu-item-has-children active">
                                    <a href="#testimonial">Testimonial</a>
                                </li>
                                <li class="menu-item-has-children active">
                                    <a href="#">News</a>
                                    <ul class="sub-menu">
                                        <li><a href="index.html">news page</a></li>
                                        <li><a href="index-2.html">Single News</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children active">
                                    <a href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="offcanvas-social">
                            <ul class="text-center">
                                <li><a href="$"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="$"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="$"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="$"><i class="fab fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                        <div class="footer-widget-info">
                            <ul>
                                <li><a href="#"><i class="fal fa-envelope"></i> support@appie.com</a></li>
                                <li><a href="#"><i class="fal fa-phone"></i> +(642) 342 762 44</a></li>
                                <li><a href="#"><i class="fal fa-map-marker-alt"></i> 442 Belle Terre St Floor 7, San Francisco, AV 4206</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== OFFCANVAS MENU PART ENDS ======-->
	
	
   
    <!--====== APPIE HEADER PART START ======-->
    
    <header class="appie-header-area appie-header-2-area appie-sticky">
        <div class="container">
		<div class='row'>
			<div class='text-center col-11'>
			<a href="/"><img id="bookingLogo" src="{{ URL('public/logo.png') }}" style="max-width:250px;" alt="main_logo"></a>
			</div>
			<div class="col-1 mt-4">
			    <a class="btn btn-primary" href="{{ URL('login') }}">Login</a>
			</div>
		</div>
            <div class="header-nav-box">
                <div class="row align-items-center">
                    <!-- <div class="col-lg-2 col-md-4 col-sm-5 col-6 order-1 order-sm-1"> -->
                        <!-- <div class="appie-logo-box"> -->
                            <!-- <a href="#"> -->
                                <!-- <img src="/static/img/favicon.png" alt=""> -->
                            <!-- </a> -->
                        <!-- </div> -->
                    <!-- </div> -->
                    <!-- <div class="col-lg-12 col-md-1 col-sm-1 order-3 order-sm-2"> -->
                    <div class="col-12">
                        <div class="appie-header-main-menu">
                            <ul>
                                <!-- <li> -->
                                    <!-- <a href="#">Home <i class="fal fa-angle-down"></i></a> -->
                                    <!-- <ul class="sub-menu"> -->
                                        <!-- <li><a href="index.html">Home 1</a></li> -->
                                        <!-- <li><a href="index-2.html">Home 2</a></li> -->
                                        <!-- <li><a href="index-3.html">Home 3</a></li> -->
                                        <!-- <li><a href="index-4.html">Home 4</a></li> -->
                                        <!-- <li><a href="index-5.html">Home 5</a></li> -->
                                        <!-- <li><a href="index-6.html">Home 6</a></li> -->
                                        <!-- <li><a href="index-7.html">Home 7</a></li> -->
                                        <!-- <li><a href="index-8.html">Home 8</a></li> -->
                                        <!-- <li><a href="index-rtl.html">Home Rtl</a></li> -->
                                        <!-- <li><a href="index-dark.html">Home Dark</a></li> -->
                                    <!-- </ul> -->
                                <!-- </li> -->
                                <!-- <li> -->
                                    <!-- <a href="service-details.html">Service</a> -->
                                <!-- </li> -->
                                <!-- <li>  -->
                                    <!-- <a href="#">Pages  <i class="fal fa-angle-down"></i></a> -->
                                    <!-- <ul class="sub-menu"> -->
                                        <!-- <li><a href="about-us.html">About Us 1</a></li> -->
                                        <!-- <li><a href="about-us-2.html">About Us 2</a></li> -->
                                        <!-- <li><a href="error.html">Error</a></li> -->
                                        <!-- <li><a href="shop.html">shop</a></li> -->
                                        <!-- <li><a href="shop-details.html">Shop Details</a></li> -->
                                    <!-- </ul> -->
                                <!-- </li> -->
                                <!-- <li> -->
                                    <!-- <a href="#">News <i class="fal fa-angle-down"></i></a> -->
                                    <!-- <ul class="sub-menu"> -->
                                        <!-- <li><a href="news.html">News Page</a></li> -->
                                        <!-- <li><a href="single-news.html">Single News</a></li> -->
                                    <!-- </ul> -->
                                <!-- </li> -->
                                <!-- <li><a href="contact.html">Contact</a></li> -->
								<!-- <div class='text-center col-12' > -->
								<!-- <a href="/"><img id="bookingLogo" src="/static/img/logo_small_n.png" style="max-height:90px;" alt="main_logo"></a> -->
<!-- <p class="text-muted">A Prozorp Product</p> -->
								<!-- </div> -->
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4  col-md-7 col-sm-6 col-6 order-2 order-sm-3"> -->
                        <!-- <div class="appie-btn-box text-right"> -->
                            <!-- <a class="main-btn ml-30" href="#">Get Started</a> -->
                            <!-- <div class="toggle-btn ml-30 canvas_open d-lg-none d-block"> -->
                                <!-- <i class="fa fa-bars"></i> -->
                            <!-- </div> -->
                        <!-- </div> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </header>
    
    <!--====== APPIE HEADER PART ENDS ======-->

    <!--====== APPIE HERO PART START ======-->
    
    <section class="appie-hero-area-2 mb-90">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="appie-hero-content-2">
                        <h1 class="appie-title">Your offline processes made online and  <span>SIMPLE</span></h1>
                        <p>Find the best application on nucleuz.app</p>
                        <form action="#">
                            <div class="input-box">
                                <input id='first_email' type="text" placeholder="info@nucleuz.app">
                                <i class="fal fa-envelope"></i>
                                <button  type='button' title='Subscribe' onclick="javascript:showSubscribe();"><i class="fal fa-arrow-right"></i></button>
                            </div>
                        </form>
                        <!-- <div class="hero-users"> -->
                            <!-- <img src="/static/lib/appie/assets/images/hero-mans.png" alt=""> -->
                            <!-- <span>30k <span> Feedback</span></span> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="appie-hero-thumb-3 wow animated fadeInRight" data-wow-duration="2000ms" data-wow-delay="400ms">
            <!-- <img src="/static/img/hero-thumb-3.png" alt=""> -->
            <!-- <img src="/static/img/mobile-final.png" alt=""> -->
            <img src="{{ URL('public/Website/img/mobile-reservz.png') }}" alt="">
        </div>
        <div class="hero-shape-1">
            <img src="assets/images/shape/shape-9.png" alt="">
        </div>
        <div class="hero-shape-2">
            <img src="assets/images/shape/shape-10.png" alt="">
        </div>
        <div class="hero-shape-3">
            <img src="assets/images/shape/shape-11.png" alt="">
        </div>
        <div class="hero-shape-4">
            <img src="assets/images/shape/shape-12.png" alt="">
        </div>
    </section>
    
    <!--====== APPIE HERO PART ENDS ======-->
	
	<form id='frmHome' method='post'>
	<input type='hidden' id='key' name='key' value=''>
	</form>


    <!--====== APPIE SERRVICE 2 PART START ======-->
    
    <section class="appie-services-2-area pb-100" id="service">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8 col-md-8">
                    <div class="appie-section-title">
                        <h3 class="appie-title">All our modules are designed with "common people in mind"</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="appie-section-title text-right">
                        <a class="main-btn" href="#">View all Features <i class="fal fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
				<a href='{{ URL("login") }}' class='submit-button' data-key='food'>
                    <div class="appie-single-service text-center mt-30 wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="200ms">
                        <div class="icon fas fa-lg fa-hamburger	 text-white">
                            <!-- <img src="/static/lib/appie/assets/images/icon/1.png" alt=""> -->
                            <span>1</span>
                        </div>
                        <h4 class="appie-title">Car Rental</h4>
                    </div>
				</a>
                </div>
                <div class="col-lg-3 col-md-6">
				<a href='{{ URL("login") }}' class='submit-button' data-key='car'>
                    <div class="appie-single-service text-center mt-30 item-2 wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="400ms">
                        <div class="icon fa fa-lg fa-car text-white">
                            <!-- <img src="/static/lib/appie/assets/images/icon/2.png" alt=""> -->
                            <span>2</span>
                        </div>
                        <h4 class="appie-title">Visitor Management</h4>
                    </div>
				</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="appie-single-service text-center mt-30 item-3 wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="600ms">
                        <div class="icon fa fa-lg fa-user text-white">
                            <!-- <img src="/static/lib/appie/assets/images/icon/3.png" alt=""> -->
                            <span>3</span>
                        </div>
                        <h4 class="appie-title">CRM</h4>
                        <p>Coming Soon</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="appie-single-service text-center mt-30 item-4 wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="800ms">
                        <div class="icon fas fa-lg fa-pen-nib	text-white">
                            <!-- <img src="/static/lib/appie/assets/images/icon/4.png" alt=""> -->
                            <span>4</span>
                        </div>
                        <h4 class="appie-title">Help Desk Ticketing System</h4>
                        <p>Coming Soon</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== APPIE SERRVICE 2 PART ENDS ======-->

    <!--====== APPIE ABOUT PART START ======-->
    
    <section class="appie-about-area mb-100 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-about-box wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="200ms">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="about-thumb">
                                    <img src="assets/images/about-thumb.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="appie-about-content">
                                    <span>Marketing</span>
                                    <h3 class="title">Make a lasting impression with appie.</h3>
                                    <p>Jolly good quaint james bond victoria sponge happy days cras arse over blatant.</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="appie-about-service mt-30">
                                            <div class="icon">
                                                <i class="fal fa-check"></i>
                                            </div>
                                            <h4 class="title">Carefully designed</h4>
                                            <p>Mucker plastered bugger all mate morish are.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="appie-about-service mt-30">
                                            <div class="icon">
                                                <i class="fal fa-check"></i>
                                            </div>
                                            <h4 class="title">Choose a App</h4>
                                            <p>Mucker plastered bugger all mate morish are.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== APPIE ABOUT PART ENDS ======-->

    <!--====== APPIE FEATURES 2 PART START ======-->
    
    <section class="appie-features-area-2 pt-90 pb-100 d-none" id="features">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="appie-section-title appie-section-title-2 text-center">
                        <h3 class="appie-title">Wherever you need <br> us the most</h3>
                        <p>The full monty spiffing good time no biggie cack grub fantastic. </p>
                    </div>
                </div>
            </div>
            <div class="row mt-30 align-items-center">
                <div class="col-lg-6">
                    <div class="appie-features-boxes">
                        <div class="appie-features-box-item">
                            <h4 class="title">Well Integrated</h4>
                            <p>The bee's knees chancer car boot absolutely.</p>
                        </div>
                        <div class="appie-features-box-item item-2">
                            <h4 class="title">Clean and modern Design</h4>
                            <p>The bee's knees chancer car boot absolutely.</p>
                        </div>
                        <div class="appie-features-box-item item-3">
                            <h4 class="title">Light and dark mode</h4>
                            <p>The bee's knees chancer car boot absolutely.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="appie-features-thumb wow animated fadeInRight" data-wow-duration="2000ms" data-wow-delay="200ms">
                        <img src="assets/images/features-thumb-2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="features-shape-1">
            <img src="assets/images/shape/shape-15.png" alt="">
        </div>
        <div class="features-shape-2">
            <img src="assets/images/shape/shape-14.png" alt="">
        </div>
        <div class="features-shape-3">
            <img src="assets/images/shape/shape-13.png" alt="">
        </div>
    </section>
    
    <!--====== APPIE FEATURES 2 PART ENDS ======-->

    <!--====== APPIE COUNTER PART START ======-->
    
    <section class="appie-counter-area pt-90 pb-190 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-section-title">
                        <h3 class="appie-title">How does it work</h3>
                        <p>The full monty spiffing good time no biggie cack grub fantastic. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="appie-single-counter mt-30 wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="200ms">
                        <div class="counter-content">
                            <div class="icon">
                                <img src="assets/images/icon/counter-icon-1.svg" alt="">
                            </div>
                            <h3 class="title"><span class="counter-item">45</span>k+</h3>
                            <p>Active Installation</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="appie-single-counter mt-30 item-2 wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="400ms">
                        <div class="counter-content">
                            <div class="icon">
                                <img src="assets/images/icon/counter-icon-2.svg" alt="">
                            </div>
                            <h3 class="title"><span class="counter-item">108</span>+</h3>
                            <p>Active Installation</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="appie-single-counter mt-30 item-3 wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="600ms">
                        <div class="counter-content">
                            <div class="icon">
                                <img src="assets/images/icon/counter-icon-3.svg" alt="">
                            </div>
                            <h3 class="title"><span class="counter-item">307</span>+</h3>
                            <p>Active Installation</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="appie-single-counter mt-30 item-4 wow animated fadeInUp" data-wow-duration="2000ms" data-wow-delay="800ms">
                        <div class="counter-content">
                            <div class="icon">
                                <img src="assets/images/icon/counter-icon-4.svg" alt="">
                            </div>
                            <h3 class="title"><span class="counter-item">725</span>k+</h3>
                            <p>Active Installation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== APPIE COUNTER PART ENDS ======-->

    <!--====== APPIE VIDEO PLAYER PART START ======-->
    
    <section class="appie-video-player-area pb-100 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="appie-video-player-item">
                        <div class="thumb">
                            <img src="assets/images/video-thumb-1.jpg" alt="">
                            <div class="video-popup">
                                <a class="appie-video-popup" href="https://www.youtube.com/watch?v=EE7NqzhMDms"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                        <div class="content">
                            <h3 class="title">Watch the two-minute video to learn how.</h3>
                            <p>The wireless cheesed on your bike mate zonked a load of old tosh hunky dory it's all gone to pot haggle william car boot pear shaped geeza.</p>
                            <a class="main-btn" href="#">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="appie-video-player-slider">
                        <div class="item">
                            <img src="assets/images/video-slide-1.jpg" alt="">
                        </div>
                        <div class="item">
                            <img src="assets/images/video-slide-2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== APPIE VIDEO PLAYER PART ENDS ======-->

    <!--====== APPIE DOWNLOAD PART START ======-->
    
    <section class="appie-download-area pt-150 pb-160 mb-90 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="appie-download-content">
                        <span>Download Our App</span>
                        <h3 class="title">App is available <br> for free on app store</h3>
                        <p>Jolly good quaint james bond victoria sponge happy days cras arse over blatant.</p>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fab fa-apple"></i>
                                    <span>Download for <span>iOS</span></span>
                                </a>
                            </li>
                            <li>
                                <a class="item-2" href="#">
                                    <i class="fab fa-google-play"></i>
                                    <span>Download for <span>Android</span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="download-shape-1">
            <img src="assets/images/shape/shape-15.png" alt="">
        </div>
        <div class="download-shape-2">
            <img src="assets/images/shape/shape-14.png" alt="">
        </div>
        <div class="download-shape-3">
            <img src="assets/images/shape/shape-13.png" alt="">
        </div>
    </section>
    
    <!--====== APPIE DOWNLOAD PART ENDS ======-->

    <!--====== APPIE PRICING 2 PART START ======-->
    
    <section class="appie-pricing-2-area pb-100 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-section-title text-center">
                        <h3 class="appie-title">Simple pricing for Everyone</h3>
                        <p>The full monty spiffing good time no biggie cack grub fantastic. </p>
                        <div class="appie-pricing-tab-btn">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Monthly</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Yearly</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-md-6">
                                    <div class="pricing-one__single pricing-one__single_2 wow animated fadeInLeft">
                                        <div class="pricig-heading">
                                            <h6>Fresh</h6>
                                            <div class="price-range"><sup>$</sup> <span>04</span><p>/month</p></div>
                                            <p>Get your 99 days free trial</p>
                                        </div>
                                        <div class="pricig-body">
                                            <ul>
                                                <li><i class="fal fa-check"></i> 60-day chat history</li>
                                                <li><i class="fal fa-check"></i> 15 GB cloud storage</li>
                                                <li><i class="fal fa-check"></i> 24/7 Support</li>
                                            </ul>
                                            <div class="pricing-btn mt-35">
                                                <a class="main-btn" href="#">Choose plan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="pricing-one__single pricing-one__single_2 active wow animated fadeInUp">
                                        <div class="pricig-heading">
                                            <h6>Sweet</h6>
                                            <div class="price-range"><sup>$</sup> <span>16</span><p>/month</p></div>
                                            <p>Billed $276 per website annually.</p>
                                        </div>
                                        <div class="pricig-body">
                                            <ul>
                                                <li><i class="fal fa-check"></i> 60-day chat history</li>
                                                <li><i class="fal fa-check"></i> 50 GB cloud storage</li>
                                                <li><i class="fal fa-check"></i> 24/7 Support</li>
                                            </ul>
                                            <div class="pricing-btn mt-35">
                                                <a class="main-btn" href="#">Choose plan</a>
                                            </div>
                                            <div class="pricing-rebon">
                                                <span>Most Popular</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="pricing-one__single pricing-one__single_2 item-2 wow animated fadeInRight">
                                        <div class="pricig-heading">
                                            <h6>Juicy</h6>
                                            <div class="price-range"><sup>$</sup> <span>27</span><p>/month</p></div>
                                            <p>Billed $276 per website annually.</p>
                                        </div>
                                        <div class="pricig-body">
                                            <ul>
                                                <li><i class="fal fa-check"></i> 60-day chat history</li>
                                                <li><i class="fal fa-check"></i> Data security</li>
                                                <li><i class="fal fa-check"></i> 100 GB cloud storage</li>
                                                <li><i class="fal fa-check"></i> 24/7 Support</li>
                                            </ul>
                                            <div class="pricing-btn mt-35">
                                                <a class="main-btn" href="#">Choose plan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-md-6">
                                    <div class="pricing-one__single pricing-one__single_2 animated fadeInLeft">
                                        <div class="pricig-heading">
                                            <h6>Fresh</h6>
                                            <div class="price-range"><sup>$</sup> <span>32</span><p>/Yearly</p></div>
                                            <p>Get your 99 days free trial</p>
                                        </div>
                                        <div class="pricig-body">
                                            <ul>
                                                <li><i class="fal fa-check"></i> 60-day chat history</li>
                                                <li><i class="fal fa-check"></i> 15 GB cloud storage</li>
                                                <li><i class="fal fa-check"></i> 24/7 Support</li>
                                            </ul>
                                            <div class="pricing-btn mt-35">
                                                <a class="main-btn" href="#">Choose plan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="pricing-one__single pricing-one__single_2 active animated fadeInUp">
                                        <div class="pricig-heading">
                                            <h6>Sweet</h6>
                                            <div class="price-range"><sup>$</sup> <span>116</span><p>/Yearly</p></div>
                                            <p>Billed $276 per website annually.</p>
                                        </div>
                                        <div class="pricig-body">
                                            <ul>
                                                <li><i class="fal fa-check"></i> 60-day chat history</li>
                                                <li><i class="fal fa-check"></i> 50 GB cloud storage</li>
                                                <li><i class="fal fa-check"></i> 24/7 Support</li>
                                            </ul>
                                            <div class="pricing-btn mt-35">
                                                <a class="main-btn" href="#">Choose plan</a>
                                            </div>
                                            <div class="pricing-rebon">
                                                <span>Most Popular</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="pricing-one__single pricing-one__single_2 item-2 animated fadeInRight">
                                        <div class="pricig-heading">
                                            <h6>Juicy</h6>
                                            <div class="price-range"><sup>$</sup> <span>227</span><p>/Yearly</p></div>
                                            <p>Billed $276 per website annually.</p>
                                        </div>
                                        <div class="pricig-body">
                                            <ul>
                                                <li><i class="fal fa-check"></i> 60-day chat history</li>
                                                <li><i class="fal fa-check"></i> Data security</li>
                                                <li><i class="fal fa-check"></i> 100 GB cloud storage</li>
                                                <li><i class="fal fa-check"></i> 24/7 Support</li>
                                            </ul>
                                            <div class="pricing-btn mt-35">
                                                <a class="main-btn" href="#">Choose plan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== APPIE PRICING 2 PART ENDS ======-->

    <!--====== APPIE TESTIMONIAL 2 PART START ======-->
    
    <section class="appie-testimonial-2-area mb-90 d-none" id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-testimonial-2-box">
                        <div class="appie-testimonial-slider-2">
                            <div class="appie-testimonial-slider-2-item">
                                <div class="item">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial-user-1.png" alt="">
                                        <ul>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                        <span>(4.7) review</span>
                                    </div>
                                    <div class="content">
                                        <p>Why I say old chap that is spiffing chip shop such a fibber the bee's knees, the wireless Richard fantastic do one cracking goal pukka baking cakes starkers mush don't get shirty with me argy bargy, I naff chimney pot blimey he lost his bottle cup.</p>
                                        <div class="author-info">
                                            <h5 class="title">Hanson Deck</h5>
                                            <span>Web developer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="appie-testimonial-slider-2-item">
                                <div class="item">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial-user-1.png" alt="">
                                        <ul>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                        <span>(4.7) review</span>
                                    </div>
                                    <div class="content">
                                        <p>Why I say old chap that is spiffing chip shop such a fibber the bee's knees, the wireless Richard fantastic do one cracking goal pukka baking cakes starkers mush don't get shirty with me argy bargy, I naff chimney pot blimey he lost his bottle cup.</p>
                                        <div class="author-info">
                                            <h5 class="title">Hanson Deck</h5>
                                            <span>Web developer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== APPIE TESTIMONIAL 2 PART ENDS ======-->

    <!--====== APPIE SPONSER PART START ======-->
    
    <section class="appie-sponser-area pb-100 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-section-title text-center">
                        <h3 class="appie-title">Appie works best with <br> your favorite platforms</h3>
                        <p>Join over 40,000 businesses worldwide.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="appie-sponser-box d-flex justify-content-center">
                        <div class="sponser-item">
                            <img src="assets/images/sponser-1.png" alt="">
                        </div>
                        <div class="sponser-item">
                            <img src="assets/images/sponser-2.png" alt="">
                        </div>
                        <div class="sponser-item">
                            <img src="assets/images/sponser-3.png" alt="">
                        </div>
                        <div class="sponser-item">
                            <img src="assets/images/sponser-4.png" alt="">
                        </div>
                        <div class="sponser-item">
                            <img src="assets/images/sponser-5.png" alt="">
                        </div>
                        <div class="sponser-item">
                            <img src="assets/images/sponser-6.png" alt="">
                        </div>
                    </div>
                    <div class="appie-sponser-box item-2 d-flex justify-content-center">
                        <div class="sponser-item">
                            <img src="assets/images/sponser-7.png" alt="">
                        </div>
                        <div class="sponser-item">
                            <img src="assets/images/sponser-8.png" alt="">
                        </div>
                        <div class="sponser-item">
                            <img src="assets/images/sponser-9.png" alt="">
                        </div>
                        <div class="sponser-item">
                            <img src="assets/images/sponser-10.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sponser-shape">
            <img src="assets/images/sponser-shape.png" alt="">
        </div>
    </section>
    
    <!--====== APPIE SPONSER PART ENDS ======-->

    <!--====== APPIE FOOTER PART START ======-->
    
    <section class="appie-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="footer-about-widget footer-about-widget-2">
                        <div class="logo">
                            <a href="#"><img src="{{ URL('public/logo.png') }}" style="max-width:150px;"></a>
                        </div>
                        <p>Nucleuz is a product of Prozorp Technologies.</p>
                        <a href="https://prozorp.com">Read More <i class="fal fa-arrow-right"></i></a>
                        <!-- <div class="social mt-30"> -->
                            <!-- <ul> -->
                                <!-- <li><a href="#"><i class="fab fa-facebook-f"></i></a></li> -->
                                <!-- <li><a href="#"><i class="fab fa-twitter"></i></a></li> -->
                                <!-- <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li> -->
                                <!-- <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li> -->
                            <!-- </ul> -->
                        <!-- </div> -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="footer-navigation footer-navigation-2">
                        <h4 class="title">Company</h4>
                        <ul>
                            <li><a href="https://prozorp.com/about-us/">About Us</a></li>
                            <li><a href="https://prozorp.com/service/">Service</a></li>
                            <!-- <li><a href="#">Case Studies</a></li> -->
                            <!-- <li><a href="#">Blog</a></li> -->
                            <li><a href="https://prozorp.com/#contact/">Contact</a></li>
                        </ul>
                    </div>
                    
                    <span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?
sealID=g4PwCRptvsShK6POKzS51LHib0so4yy9KnTT5CQQkagfW2pKf55iiUJh3Rlu"></script></span>
                </div>
                <!-- <div class="col-lg-3 col-md-6 d-none"> -->
                    <!-- <div class="footer-navigation footer-navigation-2"> -->
                        <!-- <h4 class="title">Support</h4> -->
                        <!-- <ul> -->
                            <!-- <li><a href="#">Community</a></li> -->
                            <!-- <li><a href="#">Resources</a></li> -->
                            <!-- <li><a href="#">Faqs</a></li> -->
                            <!-- <li><a href="#">Privacy Policy</a></li> -->
                            <!-- <li><a href="#">Careers</a></li> -->
                        <!-- </ul> -->
                    <!-- </div>                     -->
                <!-- </div> -->
                <div class="col-lg-4 col-md-4">
                    <div class="footer-widget-info">
                        <h4 class="title">Get In Touch</h4>
                        <ul>
                            <li><a href="mailto:info@prozorp.com"><i class="fal fa-envelope"></i> info@prozorp.com</a></li>
                            <li><i class="fal fa-phone"></i> +(91) 80727 10851<br>Chennai, India</li>
							<li>&nbsp;</li>
                            <li><i class="fal fa-phone"></i> +(968) 96285658<br>Muscat, Oman</li>
                            <!-- <li><a href="#"><i class="fal fa-map-marker-alt"></i> 442 Belle Terre St Floor 7, San Francisco, AV 4206</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-copyright d-flex align-items-center justify-content-between pt-35">
                        <div class="apps-download-btn invisible">
                        <ul>
                            <li><a href="#"><i class="fab fa-apple"></i> Download for iOS</a></li>
                            <li><a class="item-2" href="#"><i class="fab fa-google-play"></i> Download for Android</a></li>
                        </ul>
                        </div>
                        <div class="copyright-text">
                            <p>Copyright © 2022 Prozorp. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== APPIE FOOTER PART ENDS ======-->


    <!--====== APPIE BACK TO TOP PART ENDS ======-->
    <div class="back-to-top back-to-top-2">
        <a href="#"><i class="fal fa-arrow-up"></i></a>
    </div>
    <!--====== APPIE BACK TO TOP PART ENDS ======-->


    
    
    
    
    
    <!--====== jquery js ======-->
    <script src="{{ URL('public/Website/lib/appie/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ URL('public/Website/lib/appie/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ URL('public/Website/lib/appie/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL('public/Website/lib/appie/assets/js/popper.min.js') }}"></script>
    
    <!--====== wow js ======-->
    <script src="{{ URL('public/Website/lib/appie/assets/js/wow.js') }}"></script>
    
    <!--====== Slick js ======-->
    <script src="{{ URL('public/Website/lib/appie/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ URL('public/Website/lib/appie/assets/js/waypoints.min.js') }}"></script>

    <!--====== TweenMax js ======-->
    <script src="{{ URL('public/Website/lib/appie/assets/js/TweenMax.min.js') }}"></script>
    
    <!--====== Slick js ======-->
    <script src="{{ URL('public/Website/lib/appie/assets/js/slick.min.js') }}"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="{{ URL('public/Website/lib/appie/assets/js/jquery.magnific-popup.min.js') }}"></script>
    
    <!--====== Main js ======-->
    <script src="{{ URL('public/Website/lib/appie/assets/js/main.js') }}"></script>
	
<script>
$(document).ready(function(){
	
	$(".submit-button").click(function(){
		var key = $(this).attr('data-key');
		$("#frmHome input[name='key']").val(key);
		$("#frmHome").submit();
	});
	
<?php if (isset($info)): ?>
	$("#txtAlert").text("<?=$info?>");
	$("#modAlert").modal();
<?php endif; ?>
});

function showSubscribe() {
	var email = $("#first_email").val();
	$("#email").val(email);
	$("#modSubscribe").modal();
}
</script>



<div class="modal" tabindex="-1" role="dialog" id='modSubscribe'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Subscribe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form method='post' id='frmSubscribe'>
      <div class="modal-body">
			<input class='form-control' type='email' name='email' id='email' value='' placeholder='Email' required>
			<input class='form-control' type='text' name='name' id='name' value='' placeholder='Name' required>
			<input type='hidden' name='key' value='subscribe'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Subscribe</button>
      </div>
		</form>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id='modAlert'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<p id='txtAlert'></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	
	

</body>

</html>
