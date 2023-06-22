<div class="boxed_wrapper">

<!--Start Preloader -->
<div class="preloader"></div>
<!--End Preloader --> 

<!--Start header area-->

<!--Start top bar area-->
<section class="top-bar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                <div class="top-left">
                    <ul class="top-contact-info">
                        <li><span class="flaticon-technology"></span>Phone:+234{{ config('global.site_phone') }}</li>    
                        <li><span class="flaticon-contact"></span>{{ config('global.site_email') }}</li>     
                    </ul>   
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                <div class="top-right clearfix">
                    <h5>Stay Connected:</h5> 
                    <ul class="social-links">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
               
            </div>
        </div>
    </div>
</section>
<!--End top bar area-->  

<!--Start mainmenu area-->
<section class="mainmenu-area stricky">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mainmenu-bg clearfix">
                    <!--Start logo-->
                    <div class="logo pull-left">
                        <a href="/">
                            <img src="{{ asset('frontend/img/new-logo.png') }}" alt="STEP Logo">
                        </a>
                    </div>
                    <!--End logo-->
                    <!--Start mainmenu-->
                    <nav class="main-menu pull-left">
                        <div class="navbar-header">     
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="/">Home</a></li>
                                <li class="dropdown"><a href="">About</a>
                                    <ul>
                                        <li><a href="/about">About STEP</a></li>
                                        <li><a href="/step-support">STEP Support</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="">Services</a>
                                    <ul>
                                        <li><a href="/trainings">Trainings</a></li>
                                        <li><a href="/certifications">Certifications</a></li>
                                     
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="">Resources</a>
                                    <ul>
                                        <li><a href="/journal-publication">Journals/Publications</a></li>
                                        <li><a href="/blog">Blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="/events">Events</a></li>
                                <li><a href="/memberships">Membership</a></li>
                                <li><a href="/contact">Contact Us</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!--End mainmenu-->
                    <!--Start mainmenu right box-->
                    <div class="mainmenu-right-box pull-right clearfix">
                        
                        <div class="quote-button">
                            <a href="/login">Login</a>
                        </div>
                    </div> 
                    <!--End mainmenu right box-->
                </div>
            </div>   
        </div>
    </div>
</section>
<!--End mainmenu area-->